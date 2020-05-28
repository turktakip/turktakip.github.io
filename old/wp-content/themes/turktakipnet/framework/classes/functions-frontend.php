<?php
/*--------------------------------------------------------------------------------------------------

	File: functions-frontend.php

	Description: This file contains various functions that can be used for all themes
	Please be carefull when editing this file

--------------------------------------------------------------------------------------------------*/


/*--------------------------------------------------------------------------------------------------
	Logo SEO function
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_logo' ) ) {
	function zn_logo( $logo = null , $use_transparent = false , $tag = null , $class = null ) {

		$transparent_logo = '';

		if ( !$tag ) {
			if ( is_front_page() ) {
				$tag = 'h1';
			}
			else{
				$tag = 'h3';
			}
		}

		if ( 'transparent_header' == get_post_meta( zn_get_the_id() , 'header_style', true ) && $use_transparent ) {
			$transparent_logo = zget_option( 'transparent_logo', 'general_options' );
		}

		if ( $logo || $logo = zget_option('logo', 'general_options') ) {

			// TODO: remove this as it is slow withouth the full path
			$logo_size = array( '300','100' );
			//print_z($logo_size);
			$hwstring = image_hwstring( $logo_size[0], $logo_size[1] );
			$logo = '<img class="non-transparent" src="'.set_url_scheme( $logo ).'" '.$hwstring.' alt="'.get_bloginfo('name').'" title="'.get_bloginfo('description').'" />';

			if ( $transparent_logo && $transparent_logo != ' ' ){
				$logo .= '<img class="only-transparent" src="'.set_url_scheme( $transparent_logo ).'" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('description').'" />';

			}
			
			$logo = "<$tag class='logo $class' id='logo'><a href='".home_url('/')."'>".$logo."</a></$tag>";
		}
		else{
			$logo = '<img src="'.THEME_BASE_URI.'/images/logo.png" alt="'.get_bloginfo('name').'" title="'.get_bloginfo('description').'" />';
			$logo = "<$tag class='logo $class' id='logo'><a href='".home_url('/')."'>".$logo."</a></$tag>";
		}

		return $logo;

	}
}

/*--------------------------------------------------------------------------------------------------
	Page title function - USED IN HEAD SECTION OF THE PAGE FOR SEO REASONS
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_page_title' ) ) {
	function zn_page_title() { 

		if (!defined('WPSEO_VERSION')) { 
			$title =  bloginfo( 'name') . wp_title( '|',true, ''); 
		}  
		else { 
			$title = wp_title(); 
		}

		return $title;	
	
	}
}

/*--------------------------------------------------------------------------------------------------
	GET THE HTML TITLE
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_head_title' ) ) {
	function zn_head_title()
	{
		$title = get_bloginfo('name').' | ';
		$title .= (is_front_page()) ? get_bloginfo('description') : wp_title('', false);

		return $title;
	}
}

/*--------------------------------------------------------------------------------------------------
	CHECK TO SEE WHAT ARCHIVE TITLE WE NEED TO DISPLAY ( a better alternative for post_type_archive_title(); )
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'get_the_archive_title' ) ) {
	function get_the_archive_title(){
		return zn_archive_title();
	}
}


if ( ! function_exists( 'zn_archive_title' ) ) {
	function zn_archive_title()
	{
		$title = '';
		if ( is_category() ) {
			$title = sprintf( __( 'Category: %s', 'zn_framework'  ), single_cat_title( '', false ) );
		} elseif ( is_tag() ) {
			$title = sprintf( __( 'Tag: %s', 'zn_framework'  ), single_tag_title( '', false ) );
		} elseif ( is_author() ) {
			$title = sprintf( __( 'Author: %s', 'zn_framework'  ), '<span class="vcard">' . get_the_author() . '</span>' );
		} elseif ( is_year() ) {
			$title = sprintf( __( 'Year: %s', 'zn_framework'  ), get_the_date( _x( 'Y', 'yearly archives date format', 'zn_framework'  ) ) );
		} elseif ( is_month() ) {
			$title = sprintf( __( 'Month: %s', 'zn_framework'  ), get_the_date( _x( 'F Y', 'monthly archives date format', 'zn_framework'  ) ) );
		} elseif ( is_day() ) {
			$title = sprintf( __( 'Day: %s', 'zn_framework'  ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'zn_framework' ) ) );
		} elseif ( is_tax( 'post_format' ) ) {
			if ( is_tax( 'post_format', 'post-format-aside' ) ) {
				$title = _x( 'Asides', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
				$title = _x( 'Galleries', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
				$title = _x( 'Images', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
				$title = _x( 'Videos', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
				$title = _x( 'Quotes', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
				$title = _x( 'Links', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
				$title = _x( 'Statuses', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
				$title = _x( 'Audio', 'post format archive title', 'zn_framework' );
			} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
				$title = _x( 'Chats', 'post format archive title', 'zn_framework' );
			}
		} elseif ( is_post_type_archive() ) {
			$title = sprintf( __( 'Archives: %s', 'zn_framework' ), post_type_archive_title( '', false ) );
		} elseif ( is_tax() ) {
			$tax = get_taxonomy( get_queried_object()->taxonomy );
			/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
			$title = sprintf( __( '%1$s: %2$s', 'zn_framework' ), $tax->labels->singular_name, single_term_title( '', false ) );
		} else {
			$title = __( 'Archives', 'zn_framework' );
		}

		/**
		 * Filter the archive title.
		 *
		 * @since 4.1.0
		 *
		 * @param string $title Archive title to be displayed.
		 */
		return apply_filters( 'get_the_archive_title', $title );

	}
}

/*--------------------------------------------------------------------------------------------------
	Remove duplicate content for search engines
--------------------------------------------------------------------------------------------------*/
if(!function_exists('zn_follow'))
{

	function zn_follow()
	{
		if ((is_single() || is_page() || is_home() ) && ( !is_paged() ))
		{
			return '<meta name="robots" content="index, follow" />' . "\n";
		}
		else
		{
			return '<meta name="robots" content="noindex, follow" />' . "\n";
		}
	}
}

/*--------------------------------------------------------------------------------------------------
	Remove duplicate content for search engines
--------------------------------------------------------------------------------------------------*/
if(!function_exists('zn_favicon'))
{
	function zn_favicon()
	{
		$favicon = "";
		// Default favicon
		if( $default = zget_option('favicon', 'general_options') )
		{
			$favicon .= '<link rel="shortcut icon" href="'.$default.'"/>';
		}

		// iPhone favicon
		if( $iphone = zget_option('iphonefavicon', 'general_options') )
		{
			$favicon .= '<link rel="apple-touch-icon" href="'.$iphone.'">';
		}

		// iPhone Hi-Res
		if( $iphonehr = zget_option('iphonehrfavicon', 'general_options') )
		{
			$favicon .= '<link rel="apple-touch-icon" sizes="114x114" href="'.$iphonehr.'">';
		}

		// iPad favicon
		if( $ipad = zget_option('ipadfavicon', 'general_options') )
		{
			$favicon .= '<link rel="apple-touch-icon" sizes="72x72" href="'.$ipad.'">';
		}

		// iPad Hi-Res favicon
		if( $ipadhr = zget_option('ipadhrfavicon', 'general_options') )
		{
			$favicon .= '<link rel="apple-touch-icon" sizes="144x144" href="'.$ipadhr.'">';
		}

		return $favicon;
	}
}

/*--------------------------------------------------------------------------------------------------
	zn_calculate_layout ?????
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_calculate_layout' ) ) {
	function zn_calculate_layout($value) { 

		$return = array();

		$return['first'] = $value;
		$return['last'] = 12-$value;

		return $return;	
	
	}
}





if( !function_exists('zn_load_google_fonts') ) {
	function zn_load_google_fonts( $return = false ) {

		$google_fonts = zget_option('zn_google_fonts_setup', 'google_font_options');
		$subsets = '';

		if( $google_subsets = zget_option('zn_google_fonts_subsets', 'google_font_options') ) {
			$subsets = '&subset=' . implode(',', $google_subsets);
		}

		if ( !empty( $google_fonts ) && is_array( $google_fonts ) ) {

			$all_final_fonts = array();

			foreach ($google_fonts as $key => $font) {

				if ( isset($font['font_variants']) ) {
					$variants = implode(',', array_values($font['font_variants']) );
					$all_final_fonts[] = $key.':'.$variants;
				}
				else{
					$all_final_fonts[] = $key;
				}
				
			}

			$gfont = implode('|', $all_final_fonts);

			if ( $return ) 
			{
				return '//fonts.googleapis.com/css?family='.$gfont.''.$subsets;
			}
			else 
			{
				wp_enqueue_style( 'zn_all_g_fonts', '//fonts.googleapis.com/css?family='.$gfont.''.$subsets);
			}

		}
		return false;
	}
}
add_action( 'wp_enqueue_scripts', 'zn_load_google_fonts', 5);

/*--------------------------------------------------------------------------------------------------
	Show the menu by location
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_show_nav' ) ) {
	function zn_show_nav( $location, $class = null , $args = array() ) {

		$defaults = array(
					'theme_location' => $location,
					'link_before'=> '',
					'link_after' => '',
					'container' => '',
					'menu_class'      => $class,
					'fallback_cb' => '',
					'echo' => true
				);

		$args = wp_parse_args( $args, $defaults );
		$args = apply_filters( 'zn_menu_location', $args );

		return wp_nav_menu( $args );

	}
}


/* Returns sidebar position 
*  @type : the sidebar position id from theme options panel 
*  @sidebar_pos : If set, it will be used to calculate the sidebar css classes
*/
function zn_get_content_class( $type , $sidebar_pos = false ) {

	if ( !$sidebar_pos ){
		$sidebar_pos = get_post_meta( zn_get_the_id(), 'zn_page_sidebar_layout', true );
	}

	if ( $sidebar_pos == 'default' || !$sidebar_pos ) {
		$sidebar_data = zget_option( $type, 'unlimited_sidebars' , false , array('layout' => 'sidebar_right' , 'sidebar' => 'default_sidebar' ) );
		$sidebar_pos = $sidebar_data['layout'];
	}

	if ( $sidebar_pos != 'no_sidebar' ) {
		$sidebar_pos .= ' col-md-9 ';
	}
	else{
		$sidebar_pos = 'col-md-12';
	}

	
	return $sidebar_pos;
}

/*--------------------------------------------------------------------------------------------------
	Pagination Functions
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_pagination' ) ) {	
/* PAGINATION */
	function zn_pagination( $args = array() )
	{

		global $paged,$wp_query;

		$defaults = array(
			'range' => 3,
			'showitems' => 7,
			'paged' => empty( $paged ) ? 1 : $paged,
			'method' => 'get_pagenum_link',
			'pages' => !$wp_query->max_num_pages ? 1 : $wp_query->max_num_pages,
			'previous_text' => __('Newer posts', 'zn_framework'),
			'older_text' => __('Older posts', 'zn_framework'),
        );

		$output = '';

		// LET THE THEME FILTER THE DEFAULTS
		$defaults = apply_filters( 'zn_pagination', $defaults );
		$args = wp_parse_args( $args, $defaults );

		if( 1 != $args['pages'] )
		{

			$output .= '<ul class="pagination">';
			
			if ( false !== $args['previous_text'] ) {
				if( 1 != $args['paged'] ) {
					//$output .= '<li class="pagination-prev"><a href="'.$method($paged-1).'">'. $previous_text .'</a></li>';
					$output .= '<li class="pagination-prev">'. get_previous_posts_link($args['previous_text']).'</li>';
				}
				else{
					$output .= '<li class="pagination-prev"><span>'. $args['previous_text'] .'</span></li>';

				}
			}

			for ( $i=1; $i <= $args['pages']; $i++)
			{

				if ( !($i >= $args['paged']+$args['range']+1 || $i <= $args['paged']-$args['range']-1) || $args['pages'] <= $args['showitems']  )
				{
					$output .= ($args['paged'] == $i)? '<li class="active"><span>'.$i.'</span></li>':'<li><a href="'.$args['method']($i).'"><span>'.$i.'</span></a></li>';
				}

			}
			
			if ( false !== $args['older_text'] ) {
				if ( $args['paged'] < $args['pages'] ) {
					// $output .= '<li class="pagination-next"><a href="'.$method($paged+1).'">'.$older_text.'</a></li>';
					$output .= '<li class="pagination-next">' . get_next_posts_link( $args['older_text'] ) . '</li>';
				} else {
					$output .= '<li class="pagination-next"><span>' . $args['older_text'] . '</span></li>';
				}
			}

			$output .= '</ul>';

		}

		echo $output;
	}
}

add_action( 'wp', 'zn_fw_custom_js' );
function zn_fw_custom_js(){

	$custom_js = get_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_js' );

	if( ! empty( $custom_js ) ){
		$custom_js = array( 'theme_custom_js' => $custom_js );
		ZN()->add_inline_js( $custom_js );
	}

	
}