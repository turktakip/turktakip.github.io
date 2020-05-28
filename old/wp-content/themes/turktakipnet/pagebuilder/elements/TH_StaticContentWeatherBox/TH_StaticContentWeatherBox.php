<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Weather Box
Description: Create and display a STATIC CONTENT - Weather Box element
Class: TH_StaticContentWeatherBox
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_StaticContentWeatherBox
 *
 * Create and display a STATIC CONTENT - Weather box element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentWeatherBox extends ZnElements
{
    public static function getName(){
        return __( "STATIC CONTENT - Weather Box", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_style( 'static_content', THEME_BASE_URI . '/sliders/static_content/sc_styles.css', '', ZN_FW_VERSION );
        wp_enqueue_style( 'weather_font', THEME_BASE_URI . '/addons/sc_weather/weather-font.css', '', ZN_FW_VERSION );
        wp_enqueue_script('simpleweather', THEME_BASE_URI . '/addons/sc_weather/jquery.simpleWeather.min.js', array('jquery'), ZN_FW_VERSION);

        if($this->opt('sc_scrolling',0 ) == 1){
            wp_enqueue_script( 'scrollme', THEME_BASE_URI . '/addons/scrollme/jquery.scrollme.min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
        }
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];

        $scheight = (int)$this->opt('ww_height');

        if(!empty($scheight)){
            if( $this->opt('sc_fullscreen', '0') != 1 ) {
                $css .= '@media only screen and (min-width : 1200px){ .'.$uid.' .static-content--height{height:'.$scheight.'px;} } ';
            }
        }

        return $css;
    }

    /**
     * This method is used to display the output of the element.
     *
     * @return void
     */
    function element()
    {
        $uid = $this->data['uid'];
        $options = $this->data['options'];

        if( empty( $options ) ){ return; }

        $style = '';
        if ( isset ( $options['ww_header_style'] ) && ! empty ( $options['ww_header_style'] ) ) {
            $style = 'uh_' . $options['ww_header_style'];
        }

        $bottom_mask = $this->opt('hm_header_bmasks','none');
        $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

        // Scrolling Effect
        $is_screffect = $this->opt('sc_scrolling',0 ) == 1;
        $scrolling_type = $this->opt('sc_scrolling_type','translate_op_scale' );
        $scr_main_class = '';
        $scr_effect_class = '';
        $scr_effect_attribs = '';
        $scr_effect_attribs_fade = '';
        if( $is_screffect ){
            $scr_main_class = 'scrollme';
            $scr_effect_class = 'animateme';

            $scr_effect_attribs_split = '';
            if($scrolling_type == 'translate_op_scale'){
                $scr_effect_attribs_split = 'data-translatey="300" data-opacity="0.1" data-scale="1.5"';
            }
            elseif($scrolling_type == 'translate_op'){
                $scr_effect_attribs_split = 'data-translatey="300" data-opacity="0.1"';
            }
            elseif($scrolling_type == 'translate'){
                $scr_effect_attribs_split = 'data-translatey="300"';
            }
            $scr_effect_attribs = ' data-when="span" data-from="0" data-to="0.75" data-easing="linear" '.$scr_effect_attribs_split;
            $scr_effect_attribs_fade = ' data-when="span" data-from="0" data-to="0.75" data-translatey="200" data-opacity="0.1" data-easing="linear"';
        }
        ?>
        <div class="kl-slideshow static-content__slideshow sc--weatherbox <?php echo $style; ?> <?php echo $uid; ?> <?php echo $bm_class ?> <?php echo $scr_main_class; ?> <?php echo $this->opt('css_class',''); ?>">

            <div class="bgback"></div>

            <div class="kl-slideshow-inner static-content__wrapper <?php echo ( $this->opt('sc_fullscreen', '0') ? 'static-content--fullscreen' : '' ); ?> <?php echo ( (int)$this->opt('ww_height') ? 'static-content--height':'' ) ?>">

                <?php if( $this->opt('source_type','') != ''  || $this->opt('source_overlay','') != 0 ){ ?>
                <div class="static-content__source  <?php echo $scr_effect_class; ?>" <?php echo $scr_effect_attribs; ?> >

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

                </div><!-- /.static-content__source -->
                <?php } ?>

                <div class="static-content__inner container">
                    <div class="kl-slideshow-safepadding  sc__container <?php echo $scr_effect_class; ?>" <?php echo $scr_effect_attribs_fade; ?>>

                        <div class="static-content sc--wb-style">
                            <?php
                            // TITLE
                            if ( isset ( $options['ww_slide_title'] ) && ! empty ( $options['ww_slide_title'] ) ) {
                                echo '<h2 class="static-content__title text-center">' . do_shortcode( $options['ww_slide_title'] ) . '</h2>';
                            }

                            // SUBTITLE
                            if ( isset ( $options['ww_slide_subtitle'] ) && ! empty ( $options['ww_slide_subtitle'] ) ) {
                                echo '<h3 class="static-content__subtitle text-center">' . do_shortcode( $options['ww_slide_subtitle'] ) . '</h3>';
                            }

                            // BUTTON
                            if ( isset($options['ww_slide_m_button']) || !empty($options['ww_slide_l_text']) ) {
                                echo '<div class="sc__actionarea">';

                                if ( isset ( $options['ww_slide_link']['url'] ) && ! empty ( $options['ww_slide_link']['url'] ) ) {
                                    echo '<a class="btn btn-fullcolor btn-lg btn-third" href="' . $options['ww_slide_link']['url'] . '" target="' . $options['ww_slide_link']['target'] . '">' . $options['ww_slide_l_text'] . '</a>';
                                }

                                // BUTTON LEFT TEXT
                                if ( isset ( $options['ww_slide_m_button'] ) && ! empty ( $options['ww_slide_m_button'] ) ) {
                                    echo '<h5 class="sc-infopop__text">' . $options['ww_slide_m_button'] . '</h5>';
                                }

                                echo '<div class="clear"></div>';
                                echo '</div>';
                            }
                            ?>

<?php if($this->opt('scw_enable','1') && $this->opt('scw_woeid') != ''): ?>

    <div class="sc__weather" id="sc__weather_<?php echo $uid; ?>" data-woeid="<?php echo $this->opt('scw_woeid',''); ?>" data-location="<?php echo $this->opt('scw_location',''); ?>" data-unit="<?php echo $this->opt('scw_unit','f'); ?>">
        <div class="fake-loading loading4s fl--nobg"></div>
    </div><!-- /.sc__weather -->

<?php endif; ?>
                        </div>
                    </div>
                </div><!-- /.kl-slideshow-inner__inner -->

                <?php if ( $this->opt('sc_fullscreen', '0') ): ?>
                <a class="tonext-btn js-tonext-btn" href="#" data-endof=".kl-slideshow-inner">
                    <span class="mouse-anim-icon"></span>
                </a>
                <?php endif; ?>

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

        $options = array(
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(
                    array (
                        "name"        => __( "Element Height", 'zn_framework' ),
                        "description" => __( "<strong><em>Please read!</em></strong><br>Enter a numeric value for the slider height. This option works if Fullscreen is disabled. If you don't add any height, the height will be automatically rely on the content inside the element. ", 'zn_framework' ),
                        "id"          => "ww_height",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: 600px",
                        "class"       => "zn_input_xs",
                        'dependency' => array( 'element' => 'sc_fullscreen' , 'value'=> array('0') )
                    ),
                    array (
                        "name"        => __( "Enable fullscreen?", 'zn_framework' ),
                        "description" => __( "Do you want to display the static content as fullscreen?", 'zn_framework' ),
                        "id"          => "sc_fullscreen",
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => array (
                            '1'  => __( "Yes", 'zn_framework' ),
                            '0' => __( "No", 'zn_framework' )
                        )
                    ),
                    array (
                        "name"        => __( "Enable scrolling effect?", 'zn_framework' ),
                        "description" => __( "Do you want to enable the scrolling effects? Might cause performance issues.<br> <strong style=' color: #9B4F4F;'>This options works only if the slider is positioned at the very top opf the page!!</strong>", 'zn_framework' ),
                        "id"          => "sc_scrolling",
                        "std"         => "0",
                        "type"        => "select",
                        "options"     => array (
                            '1'  => __( "Yes", 'zn_framework' ),
                            '0' => __( "No", 'zn_framework' )
                        )
                    ),
                    array (
                        "name"        => __( "Parallax Scrolling effect type?", 'zn_framework' ),
                        "description" => __( "Select the effect type", 'zn_framework' ),
                        "id"          => "sc_scrolling_type",
                        "std"         => "translate_op_scale",
                        "type"        => "select",
                        "options"     => array (
                            'translate_op_scale'  => __( "Translate + Fade + Scale", 'zn_framework' ),
                            'translate_op' => __( "Translate + Fade", 'zn_framework' ),
                            'translate' => __( "Translate", 'zn_framework' )
                        ),
                        'dependency' => array( 'element' => 'sc_scrolling' , 'value'=> array('1') )
                    ),

                    array (
                        "name"        => __( "Main title", 'zn_framework' ),
                        "description" => __( "Please enter a main title.", 'zn_framework' ),
                        "id"          => "ww_slide_title",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Subtitle", 'zn_framework' ),
                        "description" => __( "Please enter a subtitle", 'zn_framework' ),
                        "id"          => "ww_slide_subtitle",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Button Main Text", 'zn_framework' ),
                        "description" => __( "Please enter a main text for this button", 'zn_framework' ),
                        "id"          => "ww_slide_m_button",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Button Link Text", 'zn_framework' ),
                        "description" => __( "Please enter a text that will appear on the right side of the button", 'zn_framework' ),
                        "id"          => "ww_slide_l_text",
                        "std"         => "",
                        "type"        => "text"
                    ),
                    array (
                        "name"        => __( "Button link", 'zn_framework' ),
                        "description" => __( "Please enter a link that will appear on the right side of the button", 'zn_framework' ),
                        "id"          => "ww_slide_link",
                        "std"         => "",
                        "type"        => "link",
                        "options"     => array (
                            '_self'  => __( "Same window", 'zn_framework' ),
                            '_blank' => __( "New window", 'zn_framework' )
                        )
                    ),

                    array(
                        'id'          => 'scw_enable',
                        'name'        => 'Enable Weather?',
                        'description' => 'Enable displaying the weather forecast?',
                        'type'        => 'select',
                        'std'         => '1',
                        "options"     => array (
                            "1" => __( "Yes", 'zn_framework' ),
                            "0"  => __( "No", 'zn_framework' )
                        ),
                        "class"       => "zn_input_xs"
                    ),
                    array (
                        "name"        => __( "Location WOEID", 'zn_framework' ),
                        "description" => __( "Add the location WOEID. You can get one <a href='http://woeid.rosselliot.co.nz/' target='_blank'>here</a>, or search Google for WOEID to find where to get one.", 'zn_framework' ),
                        "id"          => "scw_woeid",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: 12478595"
                    ),
                    array (
                        "name"        => __( "Real Location", 'zn_framework' ),
                        "description" => __( "Add the real location to improve accuracy. City, County, Country etc.", 'zn_framework' ),
                        "id"          => "scw_location",
                        "std"         => "",
                        "type"        => "text",
                        "placeholder" => "ex: Santa Cruz de Tenerife, Canary Islands, Spain"
                    ),
                    array(
                        'id'          => 'scw_unit',
                        'name'        => 'Display unit',
                        'description' => 'Choose what unit to display the weather info',
                        'type'        => 'select',
                        'std'         => 'f',
                        "options"     => array (
                            "f" => __( "Farenheit", 'zn_framework' ),
                            "c"  => __( "Celsius", 'zn_framework' )
                        )
                    ),

                )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#tm9d8ltPNFo" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/static-content-weather-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
