<?php if(! defined('ABSPATH')){ return; }
/*
Name: STATIC CONTENT - Video Background
Description: Create and display a STATIC CONTENT - Video Background element
Class: TH_StaticContentVideoBackground
Category: headers, Fullwidth
Level: 1
*/
/**
 * Class TH_StaticContentVideoBackground
 *
 * Create and display a STATIC CONTENT - Video Background element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StaticContentVideoBackground extends ZnElements
{
    public static function getName(){
        return __( "STATIC CONTENT - Video Background", 'zn_framework' );
    }

    /**
     * Load dependant resources
     */
    function scripts(){
        wp_enqueue_style( 'static_content', THEME_BASE_URI . '/sliders/static_content/sc_styles.css', '', ZN_FW_VERSION );

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

        $scheight = (int)$this->opt('ww_height', '600');

        if(!empty($scheight)){
            if( $this->opt('sc_fullscreen', '0') != 1 ) {
                $css .= '@media only screen and (min-width : 1200px){ .'.$uid.' .static-content--height{height:'.$scheight.'px;} } ';
            }
        }

        return $css;
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {

        $options = $this->data['options'];
        if( empty( $options ) ) { return; }

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

<div class="kl-slideshow static-content__slideshow <?php echo $this->data['uid']; ?> <?php echo $scr_main_class; ?> <?php echo $this->opt('css_class',''); ?>">

    <div class="bgback"></div>

    <div class="kl-slideshow-inner static-content__wrapper sc--videobg <?php echo ( $this->opt('sc_fullscreen', '0') ? 'static-content--fullscreen' : '' ); ?> <?php echo ( (int)$this->opt('ww_height',600) ? 'static-content--height':'' ) ?>">

        <div class="static-content__source  <?php echo $scr_effect_class; ?>" <?php echo $scr_effect_attribs; ?> >

            <?php
                $sourcetype = $this->opt('sc_vb_video_type');
                if($sourcetype == 'self'){
                    $sourcetype = 'video_self';
                } else if($sourcetype == 'iframe'){
                    $sourcetype = 'embed_iframe';
                }

                WpkPageHelper::zn_background_source( array(
                    'source_type' => $sourcetype,
                    'source_background_image' => $this->opt('background_image'),
                    'source_vd_yt' => $this->opt('source_vd_yt'),
                    'source_vd_self_mp4' => $this->opt('sc_vb_sh_video1'),
                    'source_vd_self_ogg' => $this->opt('sc_vb_sh_video2'),
                    'source_vd_self_webm' => $this->opt('source_vd_self_webm'),
                    'source_vd_embed_iframe' => $this->opt('sc_vb_embed'),
                    'source_vd_vp' => $this->opt('sc_vb_sh_video_cover'),
                    'source_vd_autoplay' => $this->opt('source_vd_autoplay','yes'),
                    'source_vd_loop' => $this->opt('source_vd_loop','yes'),
                    'source_vd_muted' => $this->opt('source_vd_muted','yes'),
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

        <div class="static-content__inner container sc--captpos-<?php echo $this->opt('sc_caption_pos','middle'); ?>">

            <div class="kl-slideshow-safepadding  sc__container <?php echo $scr_effect_class; ?>" <?php echo $scr_effect_attribs_fade; ?>>

                    <?php
                    echo '<div class="sc__video-captions">';

                    if ( ! empty ( $options['sc_vb_line1'] ) ) {
                        echo '<span class="sc__video-line">' . do_shortcode( $options['sc_vb_line1'] ) . '</span>';
                    }
                    if ( ! empty ( $options['sc_vb_line2'] ) ) {
                        echo '<span class="sc__video-line">' . do_shortcode( $options['sc_vb_line2'] ) . '</span>';
                    }

                    echo '</div>';
                    ?>

            </div><!-- /.container -->
        </div><!-- /.static-content__inner -->
    </div><!-- /.static-content__wrapper -->
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
                    array(
                        "name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
                        "description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use a  <strong>Section element</strong> and have tons of options.', 'zn_framework' ),
                        'type'  => 'zn_message',
                        'id'    => 'zn_error_notice',
                        'show_blank'  => 'true',
                        'supports'  => 'warning'
                    ),
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
                        "name"        => __( "Line 1 Title", 'zn_framework' ),
                        "description" => __( "Please enter a title that will appear on the first line.", 'zn_framework' ),
                        "id"          => "sc_vb_line1",
                        "std"         => "",
                        "type"        => "textarea"
                    ),
                    array (
                        "name"        => __( "Line 2 Title", 'zn_framework' ),
                        "description" => __( "Please enter a title that will appear on the second line.", 'zn_framework' ),
                        "id"          => "sc_vb_line2",
                        "std"         => "",
                        "type"        => "textarea"
                    ),
                    array (
                        "name"        => __( "Caption align", 'zn_framework' ),
                        "description" => __( "Select where to align the captions.", 'zn_framework' ),
                        "id"          => "sc_caption_pos",
                        "std"         => "middle",
                        "type"        => "select",
                        "options"     => array (
                            'middle'  => __( "Middle (default)", 'zn_framework' ),
                            'top' => __( "Top", 'zn_framework' ),
                            'bottom' => __( "Bottom", 'zn_framework' )
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
                        "id"          => "sc_vb_video_type",
                        "std"         => "",
                        "type"        => "select",
                        "options"     => array (
                            ''  => __( "None (Will just rely on the background color (if any) )", 'zn_framework' ),
                            'image'  => __( "Image", 'zn_framework' ),
                            'self' => __( "Self Hosted Video", 'zn_framework' ),
                            'video_youtube' => __( "Youtube Video", 'zn_framework' ),
                            'iframe' => __( "Embed Iframe", 'zn_framework' )
                        )
                    ),

                    array (
                        "name"        => __( "Video link", 'zn_framework' ),
                        "description" => __( "Please enter the video link as seen in the browser address bar for the desired video.", 'zn_framework' ),
                        "id"          => "sc_vb_embed",
                        "std"         => "",
                        "type"        => "text",
                        'dependency'  => array ( 'element' => 'sc_vb_video_type', 'value' => array ( 'iframe' ) ),
                    ),

                    array(
                        'id'          => 'background_image',
                        'name'        => 'Background image',
                        'description' => 'Please choose a background image for this section.',
                        'type'        => 'background',
                        'options' => array( "repeat" => true , "position" => true , "attachment" => true, "size" => true ),
                        'class'       => 'zn_full',
                        'dependency' => array( 'element' => 'sc_vb_video_type' , 'value'=> array('image') )
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
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('video_youtube') )
                    ),
                    /* LOCAL VIDEO */
                    array(
                        'id'          => 'sc_vb_sh_video1',
                        'name'        => 'Mp4 video source',
                        'description' => 'Add the MP4 video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/mp4',
                            'button_title' => 'Add / Change mp4 video',
                        ),
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self') )
                    ),
                    array(
                        'id'          => 'sc_vb_sh_video2',
                        'name'        => 'Ogg/Ogv video source',
                        'description' => 'Add the OGG video source for your local video',
                        'type'        => 'media_upload',
                        'std'         => '',
                        'data'  => array(
                            'type' => 'video/ogg',
                            'button_title' => 'Add / Change ogg video',
                        ),
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self') )
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
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self') )
                    ),
                    array(
                        'id'          => 'sc_vb_sh_video_cover',
                        'name'        => 'Video poster',
                        'description' => 'Using this option you can add your desired video poster that will be shown on unsuported devices.',
                        'type'        => 'media',
                        'std'         => '',
                        'class'       => 'zn_full',
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self','video_youtube') )
                    ),
                    array(
                        'id'          => 'source_vd_autoplay',
                        'name'        => 'Autoplay video?',
                        'description' => 'Enable autoplay for video?',
                        'type'        => 'select',
                        'std'         => 'yes',
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self','video_youtube') ),
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
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self','video_youtube') ),
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
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self','video_youtube') ),
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
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self','video_youtube') ),
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
                        "dependency"  => array( 'element' => 'sc_vb_video_type' , 'value'=> array('self','video_youtube') ),
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#QemCMBG4R90" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/static-content-video-background/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
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
