<?php
/*
 * Plugin Name: PayTR - WooCommerce eklentisi
 * Plugin URI: http://www.paytr.com/
 * Description: PayTR üyeliğiniz ile WooCommerce üzerinden ödeme almanız için gerekli altyapı.
 * Version: 1.1
 * Author: ali.yilmaz
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action('plugins_loaded', 'woocommerce_paytrcheckout', 0);

function woocommerce_paytrcheckout()
{
    add_action( 'woocommerce_process_product_meta', 'woocommerce_process_product_meta_fields_save' );
    function woocommerce_process_product_meta_fields_save( $post_id ){
        $woo_select = isset( $_POST['installment_number'] ) ? $_POST['installment_number'] : null;
        update_post_meta( $post_id, 'installment_number', $woo_select );
    }
    
    if ( !class_exists('WC_Payment_Gateway') ) return; # WC_Payment_Gateway tanımlı değilse..
    if ( class_exists('WC_Gateway_PayTRCheckout') ) return; # WC_Gateway_PayTRCheckout tanımlı ise..
    
    class WC_Gateway_PayTRCheckout extends WC_Payment_Gateway
    {
        var $paytr_merchant_id;
        var $paytr_merchant_key;
        var $paytr_merchant_salt;
        var $paytr_installment;
        var $paytr_installment_list;
		
		protected $category_full = array();
		protected $category_installment = array();
        
        public function __construct()
        {
            $plugin = plugin_basename( __FILE__ );
            global $woocommerce;
            
            /*
             * WC Checkout alanında görünebilir olması için gereken zorunlu alanlar.
             * Doc. URL: https://docs.woothemes.com/document/payment-gateway-api/
             */
            $this->id                   = 'paytrcheckout';
            $this->has_fields           = true;
            $this->icon                 = plugin_dir_url( __FILE__ ) . 'paytr_logo.png';
            $this->method_title         = 'PayTR Ödeme Alt Yapısı';
            $this->method_description   = 'Web sitenizi PayTR avantajlarıyla alışverişe açmak için aşağıdaki ayarları yapmanız gerekmektedir.<br/>PayTR, sadece TRY, USD ve EUR para birimlerini desteklemektedir.';
            
            # init_form_fields fonksiyonunda tanımlanan özelleştirmeleri işler
            $this->init_form_fields();

            $this->init_settings();
            
            $this->title                = $this->get_option( 'title' );
            $this->description          = $this->get_option( 'description' );
            $this->paytr_merchant_id    = trim( $this->get_option( 'paytr_merchant_id' ) );
            $this->paytr_merchant_key   = trim( $this->get_option( 'paytr_merchant_key' ) );
            $this->paytr_merchant_salt  = trim( $this->get_option( 'paytr_merchant_salt' ) );
            $this->paytr_installment    = trim( $this->get_option( 'paytr_installment' ) );
            $this->paytr_lang    = trim( $this->get_option( 'paytr_lang' ) );
			
            # API Kancaları
            if (version_compare(WOOCOMMERCE_VERSION, '2.0.0', '>=')) {
                add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
            } else {
                add_action( 'woocommerce_update_options_payment_gateways', array( $this, 'process_admin_options' ) );
            }
            
            add_action( 'woocommerce_receipt_' . $this->id, array( $this, 'receipt_page' ) );
            add_action( 'woocommerce_api_wc_gateway_paytrcheckout', array( $this, 'paytrcheckout_response' ) );
            
        }
        
        # Payment Plugin düzenleme kontrolü
        function admin_options()
        {
                parent::admin_options();
        }
        
        # Para birimi TRY seçilimi kontrolü
        public function is_valid_for_use()
        {
            return in_array( get_woocommerce_currency(), apply_filters( 'woocommerce_paypal_supported_currencies', array( 'TRY', 'USD', 'EUR' ) ) );
        }
        
        # Notify URL
        function paytrcheckout_response()
        {
            global $woocommerce;
			
            $hash = base64_encode( hash_hmac( 'sha256', $_POST['merchant_oid']. $this->paytr_merchant_salt. $_POST['status']. $_POST['total_amount'], $this->paytr_merchant_key, true ) );
            
            if( $hash != $_POST['hash'] )
                die('PAYTR notification failed: bad hash');

            $order_id = explode('PAYTRWOO', $_POST['merchant_oid']); 
            $order = new WC_Order( $order_id[1] );

            if ( $order->post_status == 'wc-pending' OR $order->post_status == 'wc-failed' ) {

                if( $_POST['status'] == 'success' ){

                    $total_amount = round( $_POST['total_amount'] / 100, 2 );
                    $amount = $total_amount - $order->get_total();
                    $amount = $amount > 0 ? $amount : 'YOK';
                    
                    $note = "Ödeme onaylandı.<br/>## PAYTR SİSTEM NOTU ##<br/># Müşteri Ödeme Tutarı: ".$total_amount . "<br/># Vade Farkı: ".$amount."<br/># Sipariş numarası: ".$_POST['merchant_oid'];

                    $order->add_order_note(sprintf(__( $note, 'woocommerce')));

                    $order->update_status( 'processing' );
                    
                } else { # FAILED
                    $note = 'Ödeme başarısız.';
                    $error_note = ( array_key_exists('failed_reason_msg', $_POST) ? '<br/>Hata: '.$_POST['failed_reason_msg'] : null );
                    
                    $order->add_order_note(sprintf(__( $note . $error_note, 'woocommerce')));

                    $order->update_status( 'failed' );
                }

            }
            
            echo 'OK'; exit;
            
        }

        function init_form_fields()
        {
            /*
             * WooCommerce > Ayarlar > Ödeme sayfasının "PayTR Ödeme Alt Yapısı" sekmesinde bulunan özelleştirmeler
             */
			 
            $this->form_fields = array(
				'enabled' => array(
					'title' => __( 'Modül Durumu', 'woocommerce' ),
					'type' => 'checkbox',
					'label' => __( 'Açık/Kapalı', 'woocommerce' ),
					'default' => 'yes'
				),
                'title' => array(
                    'title' => __( 'Ödeme Türü İsmi', 'woocommerce' ),
                    'type' => 'text',
                    'description' => __( 'Ödeme tipi\'nin görünen sekme ismi.', 'woocommerce' ),
                    'default' => __( 'Banka ve Kredi Kartı', 'woocommerce' )
                ),
                'description' => array(
                  'title' => __( 'Description', 'woocommerce' ),
                  'type' => 'textarea',
                  'description' => __( 'PayTR seçildiğinde bilgi mesajı olarak gösterilen mesaj.', 'woocommerce' ),
                  'default' => __("Bu ödeme yöntemini seçtiğinizde Tüm Kredi Kartlarına taksit imkanı vardır.", 'woocommerce')
                ),
                'paytr_merchant_id' => array(
                    'title' => __( 'Mağaza No', 'woocommerce' ),
                    'type' => 'text',
                    'description' => __( 'PayTR\'ın mağaza paneline girerek Bilgi sekmesindeki <u>Mağaza No</u> bilgisini alarak buraya yazacaksınız.', 'woocommerce' )
                ),
                'paytr_merchant_key' => array(
                    'title' => __( 'Mağaza Parola', 'woocommerce' ),
                    'type' => 'text',
                    'description' => __( 'PayTR\'ın mağaza paneline girerek Bilgi sekmesindeki <u>Mağaza Parola</u> bilgisini alarak buraya yazacaksınız.', 'woocommerce' )
                ),
                'paytr_merchant_salt' => array(
                    'title' => __( 'Mağaza Gizli Anahtar', 'woocommerce' ),
                    'type' => 'text',
                    'description' => __( 'PayTR\'ın mağaza paneline girerek Bilgi sekmesindeki <u>Mağaza Gizli Anahtar</u> bilgisini alarak buraya yazacaksınız.', 'woocommerce' )
                ),
                'paytr_lang' => array(
                    'title' => __( 'Dil Seçeneği', 'woocommerce' ),
                    'type'       => 'select',
                    'default'     => '0',
					'options'	=> array(
						'0' => __( 'Otomatik', 'woocommerce' ),
						'1' => __( 'Türkçe', 'woocommerce' ),
						'2' => __( 'İngilizce', 'woocommerce' )
					)
                ),
                'paytr_installment' => array(
                    'title' => __( 'Genel Maksimum Taksit Sayısı', 'woocommerce' ),
                    'type'       => 'select',
                    'default'     => '0',
					'options'	=> array(
						'0' => __( 'Tüm Taksit Seçenekleri', 'woocommerce' ),
						'1' => __( 'Tek Çekim (Taksit Yok)', 'woocommerce' ),
						'2' => __( '2 Taksit\'e kadar', 'woocommerce' ),
						'3' => __( '3 Taksit\'e kadar', 'woocommerce' ),
						'4' => __( '4 Taksit\'e kadar', 'woocommerce' ),
						'5' => __( '5 Taksit\'e kadar', 'woocommerce' ),
						'6' => __( '6 Taksit\'e kadar', 'woocommerce' ),
						'7' => __( '7 Taksit\'e kadar', 'woocommerce' ),
						'8' => __( '8 Taksit\'e kadar', 'woocommerce' ),
						'9' => __( '9 Taksit\'e kadar', 'woocommerce' ),
						'10' => __( '10 Taksit\'e kadar', 'woocommerce' ),
						'11' => __( '11 Taksit\'e kadar', 'woocommerce' ),
						'12' => __( '12 Taksit\'e kadar', 'woocommerce' ),
						'13' => __( 'KATEGORİ BAZLI', 'woocommerce' )
					)
                )
            );
			
			if ( $this->get_option('paytr_installment') == 13 ) {
				$installment_arr = array(
					'0' => 'Tüm Taksit Seçenekleri',
					'1' => 'Tek Çekim (Taksit Yok)',
					'2' => '2 Taksit\'e kadar',
					'3' => '3 Taksit\'e kadar',
					'4' => '4 Taksit\'e kadar',
					'5' => '5 Taksit\'e kadar',
					'6' => '6 Taksit\'e kadar',
					'7' => '7 Taksit\'e kadar',
					'8' => '8 Taksit\'e kadar',
					'9' => '9 Taksit\'e kadar',
					'10' => '10 Taksit\'e kadar',
					'11' => '11 Taksit\'e kadar',
					'12' => '12 Taksit\'e kadar',
				);
				
				$tree = $this->category_parser(); $finish = array(); $this->category_parser_clear( $tree, 0, array(), $finish );

				foreach ( $finish as $key => $item ) {
					
					$this->form_fields['paytr_installment_cat_'.$key] = array(
						'title' => __( $item, 'woocommerce' ),
						'type'       => 'select',
						'default'     => '0',
						'options' => $installment_arr
					);
					
					$this->paytr_installment_list[ $key ] = ( $this->get_option('paytr_installment_cat_'.$key) ? $this->get_option('paytr_installment_cat_'.$key) : 0 );

				}

			}

        }

        # Siparişi Onayla "tık" yapınca gerçekleşen işlemler
        function process_payment( $order_id = null )
        {
            $order = wc_get_order( $order_id );
            
            return array(
                'result'     => 'success',
                'redirect'   => $order->get_checkout_payment_url( true )
            );
        }
        
        # Siparişi Onayla "tık" sonrasında gelen sayfa
        public function receipt_page( $order )
        {
            echo $this->generate_paytrcheckout_form( $order );
        }
        
        # IFRAME Oluşturucu
        public function generate_paytrcheckout_form( $order_id )
        {
            global $woocommerce;
            
            $order = new WC_Order( $order_id );

			$this->category_parser_prod();
			
            $user_ip      = $this->GetIP();
            
            $merchant_oid   = time().'PAYTRWOO'.$order_id; # Benzersiz sipariş numarası
            $email          = substr( $order->billing_email, 0, 100 );
            $payment_amount = $order->get_total() * 100; # Çekilecek fiyat
            
            $user_name          = substr($order->billing_first_name . ' ' . $order->billing_last_name, 0, 60);
            $user_address       = substr($order->billing_address_1 . ' ' . $order->billing_address_2 . ' ' . $order->billing_city . ' ' . $order->billing_postcode, 0, 300);
            $user_phone         = substr($order->billing_phone, 0, 20);
            
            # Sepetteki Ürünler
            $user_basket = array(); $item_loop = 0;
            $user_basket_installment = array();
            
            if ( sizeof( $order->get_items() ) > 0 ) {
				
				$installment = array();
				
                foreach ( $order->get_items() as $item ) {
					
                    if ( $item['qty'] ) {

                        $item_loop++;

                        $product = $order->get_product_from_item( $item );
                        
                        $item_name  = $item['name'];

                        $item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
                        if ( $meta = $item_meta->display( true, true ) )
                            $item_name .= ' ( ' . $meta . ' )';

                        $item_total_inc_tax = $order->get_item_subtotal( $item, true )*$item['qty'];

                        $sku = '';
                        if ( $product->get_sku() ) {
                            $sku = '[STK:'.$product->get_sku().']';
                        }
                        
                        $user_basket[] = array(
                            str_replace(':',' = ',$sku).' '.$item_name,
                            $item_total_inc_tax,
                            $item['qty']
                        );
						
						if ( $this->paytr_installment == 13 ) {
							$this->category_installment = $this->paytr_installment_list;
							
							$categorys = get_the_terms( $item['product_id'], 'product_cat' );
							
							foreach ($categorys as $cat) {
								
								if ( array_key_exists( $cat->term_id, $this->paytr_installment_list ) ) {
									$installment[ $cat->term_id ] = $this->paytr_installment_list[ $cat->term_id ];
								} else {
									$installment[ $cat->term_id ] = $this->cat_search_prod( $cat->term_id );
								}
							}
							
						}
						
                    }
					
					if ( $this->paytr_installment != 13 ) {
						$merchant['max_installment']    = in_array( $this->paytr_installment , range( 0, 12 ) ) ? $this->paytr_installment : 0;
					} else {
						$installment =  count( array_diff( $installment, array( 0 ) ) ) > 0 ? min( array_diff( $installment, array( 0 ) ) ) : 0;
						$merchant['max_installment'] = $installment ? $installment : 0;
					}

                }
				
            }
            
            $user_basket = base64_encode(json_encode( $user_basket ));
			
			$merchant['no_installment']     = ( $merchant['max_installment'] == 1 ) ? 1 : 0;

            $debug_on = 1;

            $currency = strtoupper( get_woocommerce_currency() );

            $hash_str = $this->paytr_merchant_id .$user_ip .$merchant_oid .$email .$payment_amount .$user_basket. $merchant['no_installment']. $merchant['max_installment']. $currency;
            
            $paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$this->paytr_merchant_salt,$this->paytr_merchant_key,true));

            $post_vals= array(
                'merchant_id'       => $this->paytr_merchant_id,
                'user_ip'           => $this->GetIP(),
                'merchant_oid'      => $merchant_oid,
                'email'             => $email,
                'payment_amount'    => $payment_amount,
                'paytr_token'       => $paytr_token,
                'user_basket'       => $user_basket,
                'debug_on'          => $debug_on,
                'no_installment'    => $merchant['no_installment'],
                'max_installment'   => $merchant['max_installment'],
                'user_name'         => $user_name,
                'user_address'      => $user_address,
                'user_phone'        => $user_phone,
                'currency'          => $currency,
                'merchant_fail_url' => $woocommerce->cart->get_cart_url()
            );
			
			if ( defined( 'WOOCOMMERCE_VERSION' ) && version_compare( WOOCOMMERCE_VERSION, '2.6.12', '>=' ) ) {
				$post_vals['merchant_ok_url'] = $order->get_checkout_order_received_url();
			} else {
				$post_vals['merchant_ok_url'] = WC_Abstract_Order::get_checkout_order_received_url();
			}

			if ( $this->paytr_lang == 0 ) {
				$lang_arr = array( 'tr', 'tr-tr', 'tr_tr', 'turkish', 'turk', 'türkçe', 'turkce', 'try', 'trl', 'tl' );
				$post_vals['lang'] = ( in_array( strtolower( get_locale() ), $lang_arr ) ? 'tr': 'en' );
			} else {
				$post_vals['lang'] = ( $this->paytr_lang == 1 ? 'tr' : 'en' );
			}

            $ch=curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 90);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 90);
            $result = @curl_exec($ch);

            if(curl_errno($ch))
            {
                die("PAYTR IFRAME connection error. err:".curl_error($ch));
            }
            curl_close($ch);

            $result=json_decode($result,1);

            if($result[status]=='success')
            {
                $token=$result[token];
            }
            else
            {
                die("PAYTR IFRAME failed. reason:".$result[reason]);
            }
            # END
        ?>
            <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
            <iframe src="https://www.paytr.com/odeme/guvenli/<?php echo $token; ?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%;"></iframe>
            <script type="text/javascript">
            setInterval(function(){
                iFrameResize({},'#paytriframe');
            }, 1000);
            </script>
        <?php

        }
        
        public function GetIP()
        {
            if( $_SERVER["HTTP_CLIENT_IP"] ) {
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            } elseif( $_SERVER["HTTP_X_FORWARDED_FOR"] ) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else {
              $ip = $_SERVER["REMOTE_ADDR"];
            }
            return $ip;
        }

		public function category_parser()
		{
			$all_cats = get_terms( 'product_cat', array() ); $cats = array();
			foreach ( $all_cats as $cat ) {
				$cats[] = array( 'id' => $cat->term_id, 'parent_id' => $cat->parent, 'name' => $cat->name );
			}
			
			$cat_tree = array();
			foreach ( $cats as $key => $item ) {
				if ( $item['parent_id'] == 0 ) {
					$cat_tree[ $item['id'] ] = array( 'id' => $item['id'], 'name' => $item['name'] );
					$this->parent_category_parser( $cats, $cat_tree[ $item['id'] ] );
				}
			}
			return $cat_tree;
		}

		public function parent_category_parser( &$cats = array(), &$cat_tree = array() )
		{
			foreach ( $cats as $key => $item ) {
				if ( $item['parent_id'] == $cat_tree['id'] ) {
					$cat_tree['parent'][ $item['id'] ] = array( 'id' => $item['id'], 'name' => $item['name'] );
					$this->parent_category_parser( $cats, $cat_tree['parent'][ $item['id'] ] );
				}
			}
		}

		public function category_parser_clear( $tree, $level = 0, $arr = array(), &$finish_him = array() )
		{
			foreach ( $tree as $id => $item ) {
				if ( $level == 0 ) { unset($arr); $arr=array(); $arr[] = $item['name']; }
				elseif ( $level == 1 OR $level == 2) {
					if ( count( $arr ) == ( $level + 1 ) ) { $deleted = array_pop($arr); }
					$arr[] = $item['name'];
				}
				if ( $level < 3 ) {
					$nav = null;
					foreach ( $arr as $key => $val ) {
						$nav .= $val.( $level != 0 ? ' > ' : null );
					}
					$finish_him[ $item['id'] ] = rtrim($nav,' > ').'<br>';
					if ( !empty( $item['parent'] ) ) {
						$this->category_parser_clear( $item['parent'], $level + 1, $arr, $finish_him );
					}
				}
			}
		}

		public function category_parser_prod()
		{
			$all_cats = get_terms( 'product_cat', array() ); $cats = array();
			foreach ( $all_cats as $cat ) {
				$this->category_full[ $cat->term_id ] = $cat->parent;
			}
		}

		public function cat_search_prod( $category_id = 0 )
		{
			if ( !empty( $this->category_full[ $category_id ] ) AND array_key_exists( $this->category_full[ $category_id ], $this->category_installment ) ) {
				$return = $this->category_installment[ $this->category_full[ $category_id ] ];
			} else {
				foreach ( $this->category_full as $id => $parent ) {
					if ( $category_id == $id ) {
						if ( $parent == 0 ) { $return = 0; }
						elseif ( array_key_exists( $parent, $this->category_installment ) ) { $return = $this->category_installment[ $parent ]; }
						else { $return = $this->cat_search_prod( $parent ); }
					} else {
						$return = 0;
					}
				}
			}
			return $return;
		}
		
    } # class WC_Gateway_PayTRCheckout
    
} # plugin function woocommerce_paytrcheckout
/*
 * WC Checkout listesinde yer almasını sağlayan blok
 * Doc. URL: https://docs.woothemes.com/document/payment-gateway-api/
 */
function add_paytr_payment_gateway( $methods ) {
    $methods[] = 'WC_Gateway_PayTRCheckout'; # Plug-in sınıf ismi
    return $methods;
}
add_filter( 'woocommerce_payment_gateways', 'add_paytr_payment_gateway' );
?>