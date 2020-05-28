<?php if(! defined('ABSPATH')){ return; }
/*
Name: ICarousel
Description: Create and display an ICarousel element
Class: TH_ICarousel
Category: header, Fullwidth
Level: 1
Scripts: true
*/
/**
 * Class TH_ICarousel
 *
 * Create and display an ICarousel element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_ICarousel extends ZnElements
{
    public static function getName(){
        return __( "ICarousel", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        // css
        wp_enqueue_style( 'icarousel-styles', THEME_BASE_URI . '/sliders/icarousel/css/icarousel.css', false, ZN_FW_VERSION );
        // js
        wp_enqueue_script( 'icarousel-packed', THEME_BASE_URI . '/sliders/icarousel/js/icarousel.packed.js', array ( 'jquery' ), ZN_FW_VERSION, true );
        wp_enqueue_script( 'icarouselmousewheel', THEME_BASE_URI . '/sliders/icarousel/js/jquery.mousewheel.js', array ( 'jquery' ), ZN_FW_VERSION, true );
        wp_enqueue_script( 'icarousel-raphael_min', THEME_BASE_URI . '/sliders/icarousel/js/raphael-min.js', array ( 'jquery' ), ZN_FW_VERSION, true );
    }

    #icarousel'.$modID.' .sgicarousel__img {height: '.($height-40).'px;}

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];
        $height = (int)$this->opt('ic_height', 680);
        $carousel_width = (int)$this->opt('ic_car_width', 490);
        $carousel_height = (int)$this->opt('ic_car_height', 320);

        if(!empty($height) && $height != 680){
            $css .= '@media only screen and (min-width : 1200px){ .'.$uid.'{height:'.$height.'px;} } ';
        }
        if(!empty($carousel_height) && $carousel_height != 490){
            $css .= '.'.$uid.' .kl-icarousel__wrapper{height:'.$carousel_height.'px;}';
            $css .= '.'.$uid.' .kl-icarousel__slide, .'.$uid.' .kl-icarousel__img {height:'.($carousel_height-40).'px;}';
        }
        if(!empty($carousel_width) && $carousel_width != 490){
            $css .= '.'.$uid.'{width:'.$carousel_width.'px;}';
            $css .= '.'.$uid.' .kl-icarousel__slide, .'.$uid.' .kl-icarousel__img {width:'.($carousel_width-10).'px;}';
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
        $options = $this->data['options'];

        if( empty( $options['single_icarousel'] ) ){
            return;
        }


        $style = 'zn_def_header_style';
        if ( isset ( $options['ic_header_style'] ) && ! empty ( $options['ic_header_style'] ) && $options['ic_header_style'] != 'zn_def_header_style' ) {
            $style = 'uh_' . $options['ic_header_style'];
        }

        $bottom_mask = $this->opt('hm_header_bmasks','none');
        $bm_class = $bottom_mask != 'none' ? 'maskcontainer--'.$bottom_mask : '';

        // Slider Options
        $data_attrs = array();
        $data_attrs[] = 'data-autoplay="'.$this->opt('ic_autoplay','true').'"';
        $data_attrs[] = 'data-timeout="'.$this->opt('ic_timeout','5000').'"';
        $data_attrs[] = 'data-perspective="'.$this->opt('ic_perspective','75').'"';
        $data_attrs[] = 'data-slidespaces="'.$this->opt('ic_slidesspaces','300').'"';
        $data_attrs[] = 'data-slides="'.$this->opt('ic_slides','7').'"';
        $data_attrs[] = 'data-direction="'.$this->opt('ic_direction','ltr').'"';
        $data_attrs[] = 'data-keyboard="'.$this->opt('ic_keyboard','true').'"';
        $data_attrs[] = 'data-mousewheel="'.$this->opt('ic_mousewheel','true').'"';
        $data_attrs[] = 'data-timer="'.$this->opt('ic_timer','Bar').'"';
        $data_attrs[] = 'data-timeropc="'.$this->opt('ic_timer_opacity','40').'"';
        $data_attrs[] = 'data-timerdim="'.$this->opt('ic_timer_diameter','220').'"';
        $data_attrs[] = 'data-timercolor="'.$this->opt('ic_timercolor','#fff').'"';
        $data_attrs[] = 'data-timerpos="'.$this->opt('ic_timerposition','bottom-center').'"';
        $data_attrs[] = 'data-timeroffx="'.$this->opt('ic_timer_offset_x','15').'"';
        $data_attrs[] = 'data-timeroffy="'.$this->opt('ic_timer_offset_y','-5').'"';

        ?>
        <div class="kl-slideshow kl-icarousel <?php echo $style; ?> <?php echo $bm_class ?> <?php echo $this->data['uid']; ?> <?php echo $this->opt('css_class',''); ?>" >

            <div class="fake-loading loading-1s"></div>

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

            <div class="kl-icarousel-container kl-slideshow-safepadding">

                    <?php

                    if ( isset ( $options['single_icarousel'] ) && is_array( $options['single_icarousel'] ) ) {

                        echo '<div class="th-icarousel kl-icarousel__wrapper" data-count="'.count($options['single_icarousel']).'" '.implode(' ', $data_attrs).'>';

                        foreach ( $options['single_icarousel'] as $slide ) {

                            echo '<div class="kl-icarousel__slide">';

                                $link_start  = '';
                                $link_end    = '';

                                if ( isset ( $slide['ic_slide_link']['url'] ) && ! empty ( $slide['ic_slide_link']['url'] ) ) {
                                    // Set defaults
                                    $target = $slide['ic_slide_link']['target'] != 'lightbox' ? 'target="'.$slide['ic_slide_link']['target'].'"' : 'data-lightbox="iframe"';
                                    $link_start  = '<a class="slide kl-icarousel__link" href="' . $slide['ic_slide_link']['url'] . '" ' .$target
                                         . '>';
                                    $link_end    = '</a>';
                                }

                                echo $link_start;

                                if ( isset ( $slide['ic_slide_image'] ) && ! empty ( $slide['ic_slide_image'] ) ) {
                                    $image = vt_resize( '', $slide['ic_slide_image'], '480', '360', true );
                                    echo '<div style="background-image:url(' . $image['url'] . ')" class="kl-icarousel__img"></div>';
                                }

                                if ( isset ( $slide['ic_slide_title'] ) && ! empty ( $slide['ic_slide_title'] ) ) {
                                    echo '<h5 class="kl-icarousel__title ff-alternative"><span>' . $slide['ic_slide_title'] . '</span></h5>';
                                }
                                echo $link_end;

                            echo '</div>';
                        }

                        echo '</div>';
                    }
                    ?>
            </div>
            <?php
                WpkPageHelper::zn_bottommask_markup($bottom_mask);
            ?>
        </div><!-- end kl-slideshow -->
        <?php
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Slides", 'zn_framework' ),
            "description"    => __( "Here you can create your iCarousel Slides.", 'zn_framework' ),
            "id"             => "single_icarousel",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Slide", 'zn_framework' ),
            "remove_text"    => __( "Slide", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "ic_slide_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Slide image", 'zn_framework' ),
                    "description" => __( "Select an image for this Slide", 'zn_framework' ),
                    "id"          => "ic_slide_image",
                    "std"         => "",
                    "type"        => "media"
                ),
                array (
                    "name"        => __( "Slide title", 'zn_framework' ),
                    "description" => __( "This title will appear over the image", 'zn_framework' ),
                    "id"          => "ic_slide_title",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Slide link", 'zn_framework' ),
                    "description" => __( "Here you can add a link to your slide", 'zn_framework' ),
                    "id"          => "ic_slide_link",
                    "std"         => "",
                    "type"        => "link",
                    "options"     => array (
                        '_self'  => __( "Same window", 'zn_framework' ),
                        '_blank' => __( "New window", 'zn_framework' ),
                        'lightbox' => __( "Lightbox popup (iframe)", 'zn_framework' )
                    )
                )
            )
        );

        $uid = $this->data['uid'];

        return  array (
            'has_tabs'  => true,
            'general' => array(
                'title' => 'General options',
                'options' => array(

                    array (
                        "name"        => __( "Element Height (container)", 'zn_framework' ),
                        "description" => __( "Custom height (px)", 'zn_framework' ),
                        "id"          => "ic_height",
                        "std"         => "680",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Carousel Height (front img)", 'zn_framework' ),
                        "description" => __( "Carousel's height. The height is only for the main image (px)", 'zn_framework' ),
                        "id"          => "ic_car_height",
                        "std"         => "320",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Carousel Width (front img)", 'zn_framework' ),
                        "description" => __( "Carousel's wid. The width is only for the main image (px)", 'zn_framework' ),
                        "id"          => "ic_car_width",
                        "std"         => "490",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Autoplay?", 'zn_framework' ),
                        "description" => __( "Autoplay the carousel?", 'zn_framework' ),
                        "id"          => "ic_autoplay",
                        "std"         => "true",
                        "type"        => "select",
                        "options" => array(
                            "true" => "Yes",
                            "false" => "No",
                        )
                    ),

                    array (
                        "name"        => __( "Timeout duration", 'zn_framework' ),
                        "description" => __( "Timeout duration in miliseconds. The time between slides", 'zn_framework' ),
                        "id"          => "ic_timeout",
                        "std"         => "5000",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Perspective", 'zn_framework' ),
                        "description" => __( "The 3D perspective option. (Min 0 & Max 100);", 'zn_framework' ),
                        "id"          => "ic_perspective",
                        "std"         => "75",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Slides Spaces", 'zn_framework' ),
                        "description" => __( "Spaces between slides", 'zn_framework' ),
                        "id"          => "ic_slidesspaces",
                        "std"         => "300",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Visible Slides", 'zn_framework' ),
                        "description" => __( "How many slides will be shown (Must be an odd number)", 'zn_framework' ),
                        "id"          => "ic_slides",
                        "std"         => "7",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Direction", 'zn_framework' ),
                        "description" => __( "Carousel direction when change", 'zn_framework' ),
                        "id"          => "ic_direction",
                        "std"         => "ltr",
                        "type"        => "select",
                        "options" => array(
                            "ltr" => "Left to Right",
                            "rtl" => "Right to left"
                        )
                    ),

                    array (
                        "name"        => __( "Keyboard navigation", 'zn_framework' ),
                        "description" => __( "Enable keyboard navigation?", 'zn_framework' ),
                        "id"          => "ic_keyboard",
                        "std"         => "true",
                        "type"        => "select",
                        "options" => array(
                            "true" => "Yes",
                            "false" => "No",
                        )
                    ),

                    array (
                        "name"        => __( "Mousewheel navigation", 'zn_framework' ),
                        "description" => __( "Enable mousewheel navigation?", 'zn_framework' ),
                        "id"          => "ic_mousewheel",
                        "std"         => "true",
                        "type"        => "select",
                        "options" => array(
                            "true" => "Yes",
                            "false" => "No",
                        )
                    ),

                    array (
                        "name"        => __( "Timer Type", 'zn_framework' ),
                        "description" => __( "Timer Style", 'zn_framework' ),
                        "id"          => "ic_timer",
                        "std"         => "Bar",
                        "type"        => "select",
                        "options" => array(
                            "Bar" => "Bar",
                            "Pie" => "Pie",
                            "360Bar" => "360 Bar"
                        )
                    ),

                    array(
                        'id'          => 'ic_timer_opacity',
                        'name'        => 'Timer Opacity.',
                        'description' => 'Timer\'s Opacity.',
                        'type'        => 'slider',
                        'std'         => '40',
                        "helpers"     => array (
                            "step" => "10",
                            "min" => "0",
                            "max" => "100"
                        )
                    ),

                    array (
                        "name"        => __( "Timer diameter/width", 'zn_framework' ),
                        "description" => __( "Timer diameter or width for the bar type. For example by default it's a 220px width for Bar style", 'zn_framework' ),
                        "id"          => "ic_timer_diameter",
                        "std"         => "220",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Timer Color", 'zn_framework' ),
                        "description" => __( "Set a color for the timer", 'zn_framework' ),
                        "id"          => "ic_timercolor",
                        "std"         => "#fff",
                        "type"        => "colorpicker"
                    ),

                    array (
                        "name"        => __( "Timer position", 'zn_framework' ),
                        "description" => __( "Set the timer's position?", 'zn_framework' ),
                        "id"          => "ic_timerposition",
                        "std"         => "bottom-center",
                        "type"        => "select",
                        "options" => array(
                            "top-left" => "Top Left",
                            "top-right" => "Top Center",
                            "top-center" => "Top Right",
                            "middle-left" => "Middle Left",
                            "middle-center" => "Middle Center",
                            "middle-right" => "Middle Right",
                            "bottom-left" => "Bottom Left",
                            "bottom-center" => "Bottom Center",
                            "bottom-right" => "Bottom Right",
                        )
                    ),

                    array(
                        'id'          => 'ic_timer_offset_x',
                        'name'        => 'Timer X position threshold.',
                        'description' => 'Timer X position offset.',
                        'type'        => 'slider',
                        'std'         => '0',
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "-100",
                            "max" => "100"
                        )
                    ),

                    array(
                        'id'          => 'ic_timer_offset_y',
                        'name'        => 'Timer Y position threshold.',
                        'description' => 'Timer Y position offset.',
                        'type'        => 'slider',
                        'std'         => '-20',
                        "helpers"     => array (
                            "step" => "5",
                            "min" => "-100",
                            "max" => "100"
                        )
                    ),

                )
            ),

            'items' => array(
                'title' => 'Add slides',
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
                        "id"          => "ic_header_style",
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#-1o-k4VQNXo" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/icarousel/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
    }
}
