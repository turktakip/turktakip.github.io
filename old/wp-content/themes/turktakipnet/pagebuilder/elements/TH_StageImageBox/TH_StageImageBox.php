<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Stage Image Box
 Description: Create and display an Stage Image Box element. To be used with Icon Boxes.
 Class: TH_StageImageBox
 Category: content, media
 Level: 3
*/
/**
 * Class TH_StageImageBox
 *
 * Create and display an Stage Image Box element containing an image with tooltips. To be used with Icon Boxes.
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    4.0.0
 */
class TH_StageImageBox extends ZnElements
{
    public static function getName(){
        return __( "Stage Image Box", 'zn_framework' );
    }

    /**
     * Output the inline css to head or after the element in case it is loaded via ajax
     */
    function css(){
        $css = '';
        $uid = $this->data['uid'];

        $tpadding = $this->opt('top_padding') || $this->opt('top_padding') === '0' ? 'padding-top : '.$this->opt('top_padding').'px;' : '';
        $bpadding = $this->opt('bottom_padding') || $this->opt('bottom_padding') === '0' ? 'padding-bottom:'.$this->opt('bottom_padding').'px;' : '';
        $css .= ".$uid .stage-ibx__stage { $tpadding $bpadding }";

        $ibstg_points_color = $this->opt('ibstg_points_color', '#FFFFFF');
        $css .= ".$uid .stage-ibx__point:after {background: ".zn_hex2rgba_str($ibstg_points_color, 60)."; box-shadow: 0 0 0 3px ".$ibstg_points_color."; }
        .$uid .stage-ibx__point:hover:after, .$uid .stage-ibx__point.is-hover:after { box-shadow: 0 0 0 5px ".$ibstg_points_color.", 0 4px 10px #000; } ";

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

?>

<div class="stage-ibx <?php echo $uid; ?> <?php echo $this->opt('css_class',''); ?>">

    <?php if($img = $this->opt('ibstg_stageimg')){ ?>
    <div class="stage-ibx__stage">
        <img src="<?php echo $img ?>" alt="<?php echo $this->opt('ibstg_stageimg_alt','') ?>" class="stage-ibx__stage-img img-responsive">
    </div><!-- /.stage-ibx__stage -->
    <?php } ?>

    <div class="clearfix"></div>

</div><!-- /.stage-ibx -->

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
                        "name"        => sprintf(__( '<span data-clipboard-text="%s" data-tooltip="Click to copy ID to clipboard">Unique ID: %s</span> ', 'zn_framework' ), $uid, $uid),
                        "description" => __( 'In case you need some custom styling use as a css class selector <span class="u-code" data-clipboard-text=".'.$uid.' {  }" data-tooltip="Click to copy CSS class to clipboard">.'.$uid.'</span> .', 'zn_framework' ),
                        "id"          => "id_element",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( "Stage Image", 'zn_framework' ),
                        "description" => __( "Upload an image that will be placed in the middle", 'zn_framework' ),
                        "id"          => "ibstg_stageimg",
                        "std"         => "",
                        "type"        => "media"
                    ),

                    array (
                        "name"        => __( "Img Alt", 'zn_framework' ),
                        "description" => __( "Add an alternative text for the image (SEO purposes)", 'zn_framework' ),
                        "id"          => "ibstg_stageimg_alt",
                        "std"         => "",
                        "type"        => "text"
                    ),

                    array (
                        "name"        => __( "Point Color", 'zn_framework' ),
                        "description" => __( "The color of the points.", 'zn_framework' ),
                        "id"          => "ibstg_points_color",
                        "std"         => "#FFFFFF",
                        "type"        => "colorpicker",
                    ),

                    array(
                        'id'          => 'top_padding',
                        'name'        => 'Top padding',
                        'description' => 'Select the top padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '0',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '150',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$uid.' .stage-ibx__stage',
                            'css_rule'  => 'padding-top',
                            'unit'      => 'px'
                        )
                    ),
                    array(
                        'id'          => 'bottom_padding',
                        'name'        => 'Bottom padding',
                        'description' => 'Select the bottom padding ( in pixels ) for this section.',
                        'type'        => 'slider',
                        'std'         => '0',
                        'class'       => 'zn_full',
                        'helpers'     => array(
                            'min' => '0',
                            'max' => '150',
                            'step' => '1'
                        ),
                        'live' => array(
                            'type'      => 'css',
                            'css_class' => '.'.$uid.' .stage-ibx__stage',
                            'css_rule'  => 'padding-bottom',
                            'unit'      => 'px'
                        )
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
                        "description" => __( '<span class="dashicons dashicons-video-alt3 u-v-mid"></span> <a href="http://support.hogash.com/kallyas-videos/#Gyo1FWwBpzI" target="_blank">Click here to access video tutorial for this element.</a>', 'zn_framework' ),
                        "id"          => "video_link",
                        "std"         => "",
                        "type"        => "zn_title",
                        "class"       => "zn_full zn_nomargin"
                    ),

                    array (
                        "name"        => __( 'Written Documentation', 'zn_framework' ),
                        "description" => __( '<span class="dashicons dashicons-format-aside u-v-mid"></span> <a href="http://support.hogash.com/documentation/stage-image-box/" target="_blank">Click here to access documentation for this element.</a>', 'zn_framework' ),
                        "id"          => "docs_link",
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
