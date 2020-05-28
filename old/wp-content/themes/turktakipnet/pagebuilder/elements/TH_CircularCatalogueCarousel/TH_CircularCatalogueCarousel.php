<?php if(! defined('ABSPATH')){ return; }
/*
Name: Circular Catalogue Carousel
Description: Create and display a Circular Catalogue Carousel element
Class: TH_CircularCatalogueCarousel
Category: headers, Fullwidth
Level: 1
Scripts: true
*/

    /**
     * Class TH_CircularCatalogueCarousel
     *
     * Create and display a Circular Catalogue Carousel element
     *
     * @package  Kallyas
     * @category Page Builder
     * @author Team Hogash
     * @since 4.0.0
     */
    class TH_CircularCatalogueCarousel extends ZnElements
    {
        public static function getName(){
            return __( "Circular Catalogue Carousel", 'zn_framework' );
        }

        /**
         * Load dependant resources
         */
        function scripts(){
            wp_enqueue_style( 'circular_carousel', THEME_BASE_URI . '/sliders/circular_content_carousel/css/circular_content_carousel.css',  array('kallyas-styles'), ZN_FW_VERSION );
            wp_enqueue_script( 'caroufredsel', THEME_BASE_URI . '/sliders/caroufredsel/jquery.carouFredSel-packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
        }

        /**
         * This method is used to display the output of the element.
         * @return void
         */
        function element()
        {

            $options = $this->data['options'];

            if( empty( $options ) ) { return; }

            $bottom_mask = $this->opt('hm_header_bmasks','none');
            $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

            $style = '';
            if ( isset ( $options['ww_header_style'] ) && ! empty ( $options['ww_header_style'] ) ) {
                $style = 'uh_' . $options['ww_header_style'];
            }

            $countitm = 0;
            $singleItem = $this->opt('single_item');
            $hasItems = isset ( $singleItem ) && is_array( $singleItem );
            if($hasItems){
                $countitm = count($singleItem);
            }
?>

<div class="kl-slideshow circularcatalogue circularcarousel__slideshow <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>">

    <div class="bgback"></div>
    <?php
        WpkPageHelper::zn_background_source( array(
            'source_type' => $this->opt('source_type'),
            'source_background_image' => $this->opt('background_image'),
            'source_vd_yt' => $this->opt('source_vd_yt'),
            'source_vd_self_mp4' => $this->opt('source_vd_self_mp4'),
            'source_vd_self_ogg' => $this->opt('source_vd_self_ogg'),
            'source_vd_self_webm' => $this->opt('source_vd_self_webm'),
            'source_vd_vp' => $this->opt('source_vd_vp'),
            'source_vd_autoplay' => $this->opt('source_vd_autoplay'),
            'source_vd_loop' => $this->opt('source_vd_loop'),
            'source_vd_muted' => $this->opt('source_vd_muted'),
            'source_vd_controls' => $this->opt('source_vd_controls'),
            'source_vd_controls_pos' => $this->opt('source_vd_controls_pos'),
            'source_overlay' => $this->opt('source_overlay'),
            'source_overlay_color' => $this->opt('source_overlay_color'),
            'source_overlay_opacity' => $this->opt('source_overlay_opacity'),
            'source_overlay_color_gradient' => $this->opt('source_overlay_color_gradient'),
            'source_overlay_color_gradient_opac' => $this->opt('source_overlay_color_gradient_opac'),
        ) );
    ?>
    <div class="th-sparkles"></div>

    <div class="kl-slideshow-inner container kl-slideshow-safepadding">
        <div class="row">
            <div class="ca-container" data-count="<?php echo $countitm; ?>">
                <div class="ca-nav">
                    <span class="ca-nav-prev"><span class="glyphicon glyphicon-chevron-left kl-icon-white"></span></span>
                    <span class="ca-nav-next"><span class="glyphicon glyphicon-chevron-right kl-icon-white"></span></span>
                </div>
                <div class="ca-wrapper ca-catalogue" data-autoplay="<?php echo $this->opt('ww_slider_autoplay') == 1 ? 1:0 ; ?>" data-timout="<?php echo $this->opt('ww_slider_timeout', 9000) ?>">
                <?php
                    if ( $hasItems )
                    {
                        $i = 1;
                        foreach ( $singleItem as $slide )
                        {
                            echo '<div class="ca-item ca-item-' . $i . '">';

                            echo '<div class="ca-item-main">';

                                 $bg = '';
                                 if ( isset ( $slide['ww_slide_image'] ) && ! empty ( $slide['ww_slide_image'] ) ) {
                                     $bg = 'style="background-image:url(' . $slide['ww_slide_image'] . ');"';
                                 }

                                echo '<div class="ca-background" ' . $bg . '></div><!-- background color -->';

                                // More button
                                if( isset($slide['cc_enablepanel']) && !empty($slide['cc_enablepanel']) ){
                                    $smore = isset($slide['cc_slide_read_text']) && !empty($slide['cc_slide_read_text']) ? $slide['cc_slide_read_text'] : '' ;
                                    $smore_theme = isset($slide['cc_slide_more_theme']) && !empty($slide['cc_slide_more_theme']) ? $slide['cc_slide_more_theme'] : 'light' ;
                                    echo '<a href="#" class="circularcatalogue__more js-ca-more js-ca-more-close circularcatalogue__more--'.$smore_theme.'" data-text="'.$smore.'"><span></span></a>';
                                }

                                echo '<div class="circularcatalogue__details">';
                                    // Top label
                                    if ( isset ( $slide['ww_top_label'] ) && ! empty ( $slide['ww_top_label'] ) ) {
                                        echo '<h4 class="circularcatalogue__tlabel">' . $slide['ww_top_label'] . '</h4>';
                                    }
                                    // Title
                                    if ( isset ( $slide['ww_slide_title'] ) && ! empty ( $slide['ww_slide_title'] ) ) {
                                        echo '<h3 class="circularcatalogue__title">';
                                        echo '<span>' . $slide['ww_slide_title'] . '</span>';
                                        echo '</h3>';
                                    }
                                    // Bottom label
                                    if ( isset ( $slide['ww_bottom_label'] ) && ! empty ( $slide['ww_bottom_label'] ) ) {
                                        echo '<h4 class="circularcatalogue__blabel">' . $slide['ww_bottom_label'] . '</h4>';
                                    }
                                echo '</div>';

                            echo '</div>';

                            if( $this->opt('cc_enablepanel', 1) ){

                                echo '<div class="ca-content-wrapper">';

                                    //echo '<a href="#" class="ca-close"><span class="glyphicon glyphicon-remove"></span></a>';

                                    echo '<div class="ca-content">';

                                    // Content Title
                                    if ( isset ( $slide['ww_slide_content_title'] ) && ! empty ( $slide['ww_slide_content_title'] ) ) {
                                        echo '<h6 class="ca-panel-title">' . $slide['ww_slide_content_title'] . '</h6>';
                                    }

                                    // Image gallery in panel
                                    $gal_img1 = isset ( $slide['cc_sidegal1'] ) && ! empty ( $slide['cc_sidegal1'] );
                                    $gal_img2 = isset ( $slide['cc_sidegal2'] ) && ! empty ( $slide['cc_sidegal2'] );
                                    $gal_img3 = isset ( $slide['cc_sidegal3'] ) && ! empty ( $slide['cc_sidegal3'] );

                                    if( $gal_img1 || $gal_img2 || $gal_img3 ){

                                        $img_width = (isset ( $slide['cc_sidegal_w'] ) && ! empty ( $slide['cc_sidegal_w'] )) ? $slide['cc_sidegal_w'] : 200;
                                        // 4/3 ratio for height
                                        $img_height = $img_width * 0.75;

                                        echo '<ul class="ca-gallery mfp-gallery mfp-gallery--images">';
                                            if( $gal_img1 ){
                                                $gal_img1_resize = vt_resize( '', $slide['cc_sidegal1'], $img_width, $img_height, true );
                                                echo '<li><a href="'.$slide['cc_sidegal1'].'"><img src="'.$gal_img1_resize['url'].'" alt="" class="img-responsive"></a></li>';
                                            }
                                            if( $gal_img2 ){
                                                $gal_img2_resize = vt_resize( '', $slide['cc_sidegal2'], $img_width, $img_height, true );
                                                echo '<li><a href="'.$slide['cc_sidegal2'].'"><img src="'.$gal_img2_resize['url'].'" alt="" class="img-responsive"></a></li>';
                                            }
                                            if( $gal_img3 ){
                                                $gal_img3_resize = vt_resize( '', $slide['cc_sidegal3'], $img_width, $img_height, true );
                                                echo '<li><a href="'.$slide['cc_sidegal3'].'"><img src="'.$gal_img3_resize['url'].'" alt="" class="img-responsive"></a></li>';
                                            }
                                        echo '</ul>';
                                    }

                                    // Content description
                                    if ( isset ( $slide['ww_slide_desc_full'] ) && ! empty ( $slide['ww_slide_desc_full'] ) ) {

                                        $content = wpautop( $slide['ww_slide_desc_full'] );
                                        echo '<div class="ca-content-text">';
                                            if ( preg_match( '%(<[^>]*>.*?</)%i', $content, $regs ) ) {
                                                echo do_shortcode( $content );
                                            }
                                            else {
                                                echo '<p>' . do_shortcode( $content ) . '</p>';
                                            }
                                        echo '</div>';
                                    }

                                    // Link
                                    if ( (isset($slide['ww_slide_read_text_content']) && ! empty($slide['ww_slide_read_text_content']))
                                         && (isset($slide['ww_slide_link']['url']) && ! empty($slide['ww_slide_link']['url'])) )
                                    {
                                        echo '<a class="btn btn-lined lined-gray" href="' . $slide['ww_slide_link']['url'] . '" target="' .
                                             $slide['ww_slide_link']['target'] . '">' .
                                             $slide['ww_slide_read_text_content'] . '</a>';
                                    }
                                    echo '</div>';
                                echo '</div>';
                            }

                            echo '</div><!-- end ca-item -->';
                            $i ++;
                        }
                    }
                ?>
                </div>
                <!-- end ca-wrapper -->
            </div>
            <!-- end circular content carousel -->
        </div>
    </div>
    <?php
        WpkPageHelper::zn_bottommask_markup($bottom_mask);
    ?>
    <!-- header bottom style -->
</div><!-- end kl-slideshow -->


<?php
        }

        /**
         * This method is used to retrieve the configurable options of the element.
         * @return array The list of options that compose the element and then passed as the argument for the render() function
         */
        function options()
        {
            $uid = $this->data['uid'];


            $extra_options = array (
                "name"           => __( "Slides", 'zn_framework' ),
                "description"    => __( "Here you can create your Circular Content Slides.", 'zn_framework' ),
                "id"             => "single_item",
                "std"            => "",
                "type"           => "group",
                "add_text"       => __( "Slide", 'zn_framework' ),
                "remove_text"    => __( "Slide", 'zn_framework' ),
                "group_sortable" => true,
                "element_title" => "ww_slide_title",
                "subelements"    => array (
                    'has_tabs'  => true,
                    'general' => array(
                        'title' => 'General options',
                        'options' => array(
                            array (
                                "name"        => __( "Slide image", 'zn_framework' ),
                                "description" => __( "Select an image for this Slide", 'zn_framework' ),
                                "id"          => "ww_slide_image",
                                "std"         => "",
                                "type"        => "media"
                            ),
                            array (
                                "name"        => __( "Slide title", 'zn_framework' ),
                                "description" => __( "This title will appear over the image", 'zn_framework' ),
                                "id"          => "ww_slide_title",
                                "std"         => "",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Top label (above title)", 'zn_framework' ),
                                "description" => __( "This label will appear above the title", 'zn_framework' ),
                                "id"          => "ww_top_label",
                                "std"         => "",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Bottom label (below title)", 'zn_framework' ),
                                "description" => __( "This label will appear below the title", 'zn_framework' ),
                                "id"          => "ww_bottom_label",
                                "std"         => "",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Enable Content Panel?", 'zn_framework' ),
                                "description" => __( "If enabled, a 'MORE' button will appear which upon clicking will open a big panel with user defined content.", 'zn_framework' ),
                                "id"          => "cc_enablepanel",
                                "std"         => "1",
                                "value"       => "1",
                                "type"        => "toggle2",
                            ),
                            array (
                                "name"        => __( "Panel MORE button text", 'zn_framework' ),
                                "description" => __( "Please enter a text that you want to use as read more text", 'zn_framework' ),
                                "id"          => "cc_slide_read_text",
                                "std"         => "MORE",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "More button color theme", 'zn_framework' ),
                                "description" => __( "In case you have a light image, use the dark color, or incase of a normal or dark image, use the light color theme.", 'zn_framework' ),
                                "id"          => "cc_slide_more_theme",
                                "std"         => "light",
                                "type"        => "select",
                                "options"     => array (
                                    'light'  => __( "Light color", 'zn_framework' ),
                                    'dark' => __( "Dark color", 'zn_framework' )
                                ),
                            ),

                        ),
                    ),
                    'content' => array(
                        'title' => 'Content panel options',
                        'options' => array(
                            array (
                                "name"        => __( "Slide content title", 'zn_framework' ),
                                "description" => __( "This title will appear after someone will press the read more text button, above the content.", 'zn_framework' ),
                                "id"          => "ww_slide_content_title",
                                "std"         => "",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Slide content text", 'zn_framework' ),
                                "description" => __( "This text will appear after someone will press the read more button. Please note that you can use HTML in this textarea.", 'zn_framework' ),
                                "id"          => "ww_slide_desc_full",
                                "std"         => "",
                                "type"        => "visual_editor",
                                'class'       => 'zn_full'
                            ),
                            array (
                                "name"        => __( "Slide read more text", 'zn_framework' ),
                                "description" => __( "Please enter a text that you want to use as read more text that will appear bellow the content", 'zn_framework' ),
                                "id"          => "ww_slide_read_text_content",
                                "std"         => "",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Content read more link", 'zn_framework' ),
                                "description" => __( "Here you can add a link bellow the content of your slide", 'zn_framework' ),
                                "id"          => "ww_slide_link",
                                "std"         => "",
                                "type"        => "link",
                                "options"     => array (
                                    '_self'  => __( "Same window", 'zn_framework' ),
                                    '_blank' => __( "New window", 'zn_framework' )
                                ),
                            ),
                        ),
                    ),
                    'gallery' => array(
                        'title' => 'Content side gallery',
                        'options' => array(
                            array (
                                "name"        => __( "Gallery width", 'zn_framework' ),
                                "description" => __( "The width of the gallery in px", 'zn_framework' ),
                                "id"          => "cc_sidegal_w",
                                "std"         => "200",
                                "type"        => "text"
                            ),
                            array (
                                "name"        => __( "Image #1", 'zn_framework' ),
                                "description" => __( "Select an image for this gallery", 'zn_framework' ),
                                "id"          => "cc_sidegal1",
                                "std"         => "",
                                "type"        => "media"
                            ),
                            array (
                                "name"        => __( "Image #2", 'zn_framework' ),
                                "description" => __( "Select an image for this gallery", 'zn_framework' ),
                                "id"          => "cc_sidegal2",
                                "std"         => "",
                                "type"        => "media"
                            ),
                            array (
                                "name"        => __( "Image #3", 'zn_framework' ),
                                "description" => __( "Select an image for this gallery", 'zn_framework' ),
                                "id"          => "cc_sidegal3",
                                "std"         => "",
                                "type"        => "media"
                            ),
                        ),
                    ),
                    // 'woocommerce' => array(
                    //     'title' => 'WooCommerce Integration',
                    //     'options' => array(
                    //         array (
                    //             "name"        => __( "Coming soon!", 'zn_framework' ),
                    //             "description" => __( "This is a complicated feature and we want to see if it's in demand. Ask this feature and we'll do our best to make it!", 'zn_framework' ),
                    //             "id"          => "cc_woo",
                    //             "std"         => "",
                    //             "type"        => "zn_title",
                    //             "class"        => "zn_full",
                    //         ),
                    //         // TODO
                    //         // - field select product (automatically everything should be queried and fed with info)
                    //         // - option to show/hide gallery
                    //     ),
                    // ),
                )
            );

            $options = array (
                'has_tabs'  => true,
                'general' => array(
                    'title' => 'General options',
                    'options' => array(
                        array (
                            "name"        => __( "Autoplay carousel?", 'zn_framework' ),
                            "description" => __( "Does the carousel autoplay itself?", 'zn_framework' ),
                            "id"          => "ww_slider_autoplay",
                            "std"         => "1",
                            "value"         => "1",
                            "type"        => "toggle2"
                        ),
                        array (
                            "name"        => __( "Timout duration", 'zn_framework' ),
                            "description" => __( "The amount of milliseconds the carousel will pause", 'zn_framework' ),
                            "id"          => "ww_slider_timeout",
                            "std"         => "9000",
                            "type"        => "text"
                        ),
                    ),
                ),

                'items' => array(
                    'title' => 'Carousel Items',
                    'options' => array(
                        $extra_options,
                    ),
                ),

                'background' => array(
                    'title' => 'Background & Styles Options',
                    'options' => array(

                        array (
                            "name"        => __( "Element Background Style", 'zn_framework' ),
                            "description" => __( "Select the background style you want to use for this slider. Please note that styles can be created from the unlimited headers options in the theme admin's page.", 'zn_framework' ),
                            "id"          => "ww_header_style",
                            "std"         => "",
                            "type"        => "select",
                            "options"     => WpkZn::getThemeHeaders(true),
                            "class"       => ""
                        ),

                        // Background image/video or youtube
                        array (
                            "name"        => __( "Background Source Type", 'zn_framework' ),
                            "description" => __( "Please select the source type of the background.", 'zn_framework' ),
                            "id"          => "source_type",
                            "std"         => "",
                            "type"        => "select",
                            "options"     => array (
                                ''  => __( "None (Will just rely on the background color (if any) )", 'zn_framework' ),
                                'image'  => __( "Image", 'zn_framework' ),
                                'video_self' => __( "Self Hosted Video", 'zn_framework' ),
                                'video_youtube' => __( "Youtube Video", 'zn_framework' )
                            )
                        ),

                        array(
                            'id'          => 'background_image',
                            'name'        => 'Background image',
                            'description' => 'Please choose a background image for this section.',
                            'type'        => 'background',
                            'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
                            'class'       => 'zn_full',
                            'dependency' => array( 'element' => 'source_type' , 'value'=> array('image') )
                        ),

                        // array(
                        //  'id'            => 'enable_parallax',
                        //  'name'          => 'Enable parallax',
                        //  'description'   => 'Select if you want to enable parallax effect on background image',
                        //  'type'          => 'toggle2',
                        //  'std'           => '',
                        //  'value'         => 'yes'
                        // ),



                        // Youtube video
                        array (
                            "name"        => __( "Slide Video Youtube ID", 'zn_framework' ),
                            "description" => __( "Add an Youtube ID", 'zn_framework' ),
                            "id"          => "source_vd_yt",
                            "std"         => "",
                            "type"        => "text",
                            "placeholder" => "ex: tR-5AZF9zPI",
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_youtube') )
                        ),
                        /* LOCAL VIDEO */
                        array(
                            'id'          => 'source_vd_self_mp4',
                            'name'        => 'Mp4 video source',
                            'description' => 'Add the MP4 video source for your local video',
                            'type'        => 'media_upload',
                            'std'         => '',
                            'data'  => array(
                                'type' => 'video/mp4',
                                'button_title' => 'Add / Change mp4 video',
                            ),
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                        ),
                        array(
                            'id'          => 'source_vd_self_ogg',
                            'name'        => 'Ogg/Ogv video source',
                            'description' => 'Add the OGG video source for your local video',
                            'type'        => 'media_upload',
                            'std'         => '',
                            'data'  => array(
                                'type' => 'video/ogg',
                                'button_title' => 'Add / Change ogg video',
                            ),
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                        ),
                        array(
                            'id'          => 'source_vd_self_webm',
                            'name'        => 'Webm video source',
                            'description' => 'Add the WEBM video source for your local video',
                            'type'        => 'media_upload',
                            'std'         => '',
                            'data'  => array(
                                'type' => 'video/webm',
                                'button_title' => 'Add / Change webm video',
                            ),
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self') )
                        ),
                        array(
                            'id'          => 'source_vd_vp',
                            'name'        => 'Video poster',
                            'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices.',
                            'type'        => 'media',
                            'std'         => '',
                            'class'       => 'zn_full',
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') )
                        ),
                        array(
                            'id'          => 'source_vd_autoplay',
                            'name'        => 'Autoplay video?',
                            'description' => 'Enable autoplay for video?',
                            'type'        => 'select',
                            'std'         => 'yes',
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                            "options"     => array (
                                "yes" => __( "Yes", 'zn_framework' ),
                                "no"  => __( "No", 'zn_framework' )
                            ),
                            "class"       => "zn_input_xs"
                        ),
                        array(
                            'id'          => 'source_vd_loop',
                            'name'        => 'Loop video?',
                            'description' => 'Enable looping the video?',
                            'type'        => 'select',
                            'std'         => 'yes',
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                            "options"     => array (
                                "yes" => __( "Yes", 'zn_framework' ),
                                "no"  => __( "No", 'zn_framework' )
                            ),
                            "class"       => "zn_input_xs"
                        ),
                        array(
                            'id'          => 'source_vd_muted',
                            'name'        => 'Start mute?',
                            'description' => 'Start the video with muted audio?',
                            'type'        => 'select',
                            'std'         => 'yes',
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                            "options"     => array (
                                "yes" => __( "Yes", 'zn_framework' ),
                                "no"  => __( "No", 'zn_framework' )
                            ),
                            "class"       => "zn_input_xs"
                        ),
                        array(
                            'id'          => 'source_vd_controls',
                            'name'        => 'Video controls',
                            'description' => 'Enable video controls?',
                            'type'        => 'select',
                            'std'         => 'yes',
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                            "options"     => array (
                                "yes" => __( "Yes", 'zn_framework' ),
                                "no"  => __( "No", 'zn_framework' )
                            ),
                            "class"       => "zn_input_xs"
                        ),
                        array(
                            'id'          => 'source_vd_controls_pos',
                            'name'        => 'Video controls position',
                            'description' => 'Video controls position in the slide',
                            'type'        => 'select',
                            'std'         => 'bottom-right',
                            "dependency"  => array( 'element' => 'source_type' , 'value'=> array('video_self','video_youtube') ),
                            "options"     => array (
                                "top-right" => __( "top-right", 'zn_framework' ),
                                "top-left" => __( "top-left", 'zn_framework' ),
                                "top-center"  => __( "top-center", 'zn_framework' ),
                                "bottom-right"  => __( "bottom-right", 'zn_framework' ),
                                "bottom-left"  => __( "bottom-left", 'zn_framework' ),
                                "bottom-center"  => __( "bottom-center", 'zn_framework' ),
                                "middle-right"  => __( "middle-right", 'zn_framework' ),
                                "middle-left"  => __( "middle-left", 'zn_framework' ),
                                "middle-center"  => __( "middle-center", 'zn_framework' )
                            ),
                            "class"       => "zn_input_sm"
                        ),

                        array(
                            'id'          => 'source_overlay',
                            'name'        => 'Background colored overlay',
                            'description' => 'Add slide color overlay over the image or video to darken or enlight?',
                            'type'        => 'select',
                            'std'         => '0',
                            "options"     => array (
                                "1" => __( "Yes (Normal color)", 'zn_framework' ),
                                "2" => __( "Yes (Horizontal gradient)", 'zn_framework' ),
                                "3" => __( "Yes (Vertical gradient)", 'zn_framework' ),
                                "0"  => __( "No", 'zn_framework' )
                            )
                        ),

                        array(
                            'id'          => 'source_overlay_color',
                            'name'        => 'Overlay background color',
                            'description' => 'Pick a color',
                            'type'        => 'colorpicker',
                            'std'         => '#353535',
                            "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
                        ),
                        array(
                            'id'          => 'source_overlay_opacity',
                            'name'        => 'Overlay\'s opacity.',
                            'description' => 'Overlay background colors opacity level.',
                            'type'        => 'slider',
                            'std'         => '30',
                            "helpers"     => array (
                                "step" => "5",
                                "min" => "0",
                                "max" => "100"
                            ),
                            "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('1', '2', '3') ),
                        ),

                        array(
                            'id'          => 'source_overlay_color_gradient',
                            'name'        => 'Overlay Gradient 2nd Bg. Color',
                            'description' => 'Pick a color',
                            'type'        => 'colorpicker',
                            'std'         => '#353535',
                            "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
                        ),
                        array(
                            'id'          => 'source_overlay_color_gradient_opac',
                            'name'        => 'Gradient Overlay\'s 2nd Opacity.',
                            'description' => 'Overlay gradient 2nd background color opacity level.',
                            'type'        => 'slider',
                            'std'         => '30',
                            "helpers"     => array (
                                "step" => "5",
                                "min" => "0",
                                "max" => "100"
                            ),
                            "dependency"  => array( 'element' => 'source_overlay' , 'value'=> array('2', '3') ),
                        ),

                        // Bottom masks
                        array (
                            "name"        => __( "Bottom masks override", 'zn_framework' ),
                            "description" => __( "The new masks are svg based, vectorial and color adapted. <br> <strong>Disclaimer:</strong> may now work perfectly for all elements!", 'zn_framework' ),
                            "id"          => "hm_header_bmasks",
                            "std"         => "none",
                            "type"        => "select",
                            "options"     => array (
                                'none' => __( 'None, just rely on Background style.', 'zn_framework' ),
                                'shadow' => __( 'Shadow Up', 'zn_framework' ),
                                'shadow_ud' => __( 'Shadow Up and down', 'zn_framework' ),
                                'mask1' => __( 'Raster Mask 1 (Old, not recommended)', 'zn_framework' ),
                                'mask2' => __( 'Raster Mask 2 (Old, not recommended)', 'zn_framework' ),
                                'mask3' => __( 'Vector Mask 3 CENTER (New! From v4.0)', 'zn_framework' ),
                                'mask3 mask3l' => __( 'Vector Mask 3 LEFT (New! From v4.0)', 'zn_framework' ),
                                'mask3 mask3r' => __( 'Vector Mask 3 RIGHT (New! From v4.0)', 'zn_framework' ),
                                'mask4' => __( 'Vector Mask 4 CENTER (New! From v4.0)', 'zn_framework' ),
                                'mask4 mask4l' => __( 'Vector Mask 4 LEFT (New! From v4.0)', 'zn_framework' ),
                                'mask4 mask4r' => __( 'Vector Mask 4 RIGHT (New! From v4.0)', 'zn_framework' ),
                                'mask5' => __( 'Vector Mask 5 (New! From v4.0)', 'zn_framework' ),
                                'mask6' => __( 'Vector Mask 6 (New! From v4.0)', 'zn_framework' ),
                            ),
                        ),
                    ),
                ),

                'other' => array(
                    'title' => 'Other Options',
                    'options' => array(

                        array(
                            'id'          => 'css_class',
                            'name'        => 'CSS class',
                            'description' => 'Enter a css class that will be applied to this element. You can than edit the custom css, either in the Page builder\'s CUSTOM CSS (which is loaded only into that particular page), or in Kallyas options > Advanced > Custom CSS which will load the css into the entire website.',
                            'type'        => 'text',
                            'std'         => '',
                        ),

                    ),
                ),

                'help' => array(
                    'title' => '<span class="dashicons dashicons-editor-help"></span> HELP',
                    'options' => array(

                        array (
                            "name"        => __( 'Video Tutorial', 'zn_framework' ),
                            "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#SzrfcgtYDTo" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                            "id"          => "video_link",
                            "std"         => "",
                            "type"        => "zn_title",
                            "class"       => "zn_full zn_nomargin"
                        ),

                        array (
                            "name"        => __( 'Written Documentation', 'zn_framework' ),
                            "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/circular-catalogue-carousel/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
                            "id"          => "docs_link",
                            "std"         => "",
                            "type"        => "zn_title",
                            "class"       => "zn_full zn_nomargin"
                        ),

                        array (
                            "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
                            "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
                            "id"          => "id_element",
                            "std"         => "",
                            "type"        => "zn_title",
                            "class"       => "zn_full zn_nomargin"
                        ),

                        array (
                            "name"        => __( '<a href="http://support.hogash.com/support/forum/wordpress-themes/kallyas-wordpress-theme/" target="_blank">Support Forums</a> &nbsp; | &nbsp; <a href="http://support.hogash.com/kallyas-help/" target="_blank">Kallyas Video Tutorials & Documentation</a> &nbsp; | &nbsp; <a href="http://themeforest.net/downloads?sort_by=Recent+Updates&filter_by=themeforest.net#item-4091658" target="_blank" class="stars-yellow">Rate Kallyas <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></a>', 'zn_framework' ),
                            "id"          => "otherlinks",
                            "std"         => "",
                            "type"        => "zn_title",
                            "class"       => "zn_full zn-custom-title-sm zn_nomargin"
                        ),
                    ),
                ),
            );

            return $options;

        }
    }
