<?php

	global $sidebar_option;
	$zn_meta_locations = array(
		array( 	'title' =>  __( 'Post Options', 'zn_framework' ), 'slug'=>'post_options', 'page'=>array('post'), 'context'=>'side', 'priority'=>'default' ),
		array( 	'title' =>  __( 'Page Options', 'zn_framework' ), 'slug'=>'page_options', 'page'=>array('page', 'product'), 'context'=>'side', 'priority'=>'default' ),
		array( 	'title' =>  __( 'Portfolio Options', 'zn_framework' ), 'slug'=>'portfolio_options', 'page'=>array('portfolio', 'showcase'), 'context'=>'side', 'priority'=>'default' ),
		array( 	'title' =>  __( 'General Options', 'zn_framework' ), 'slug'=>'portfolio_g_options', 'page'=>array('portfolio'), 'context'=>'normal', 'priority'=>'high' ),
	);

	$general_options_slug = array( 'page_options' , 'portfolio_options' , 'post_options', 'woocommerce_options');


	$zn_meta_elements[] = array (
						'slug' 			=> array( 'post_options', 'page_options' ),
						'name'        => __( 'Post Layout Options', 'zn_framework' ),
						'description' => __( 'Select your desired layout', 'zn_framework' ),
						'id'          => 'zn_page_layout',
						'std'         => 'default',
						'type'        => 'select',
						'class'        => 'zn_full',
						'options'     => array (
							'left_sidebar'  => __( 'Left Sidebar', 'zn_framework' ),
							'right_sidebar' => __( 'Right sidebar', 'zn_framework' ),
							'no_sidebar'    => __( 'No sidebar', 'zn_framework' ),
							'default'       => __( 'Default - Set from theme options', 'zn_framework' ),
						)

					);

	if(!isset($sidebar_option) || empty($sidebar_option)){
		$sidebar_option = WpkZn::getThemeSidebars();
	}
	$page_sidebar = array_merge( $sidebar_option, array( 'default' => __( 'Default - Set from theme options', 'zn_framework')));
	$zn_meta_elements[] = array (
						'slug' 			=> array( 'post_options', 'page_options'),
						'name'        => __( 'Select sidebar', 'zn_framework' ),
						'description' => __( 'Select your desired sidebar to be used on this post', 'zn_framework' ),
						'id'          => 'zn_sidebar_select',
						'std'         => 'default',
						'type'        => 'select',
						'class'        => 'zn_full',
						'options'     => $page_sidebar,
					);

/** POST OPTIONS **/

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'post_options'),
						'name'        => __( 'Show Social Share Buttons?', 'zn_framework' ),
						'description' => __( 'Choose if you want to show the social share buttons bellow the post\'s content.', 'zn_framework' ),
						'id'          => 'zn_show_social',
						'std'         => 'default',
						'type'        => 'select',
						'options'     => array (
							'show'    => __( 'Show social buttons', 'zn_framework' ),
							'hide'    => __( 'Do not show social buttons', 'zn_framework' ),
							'default' => __( 'Default - Set from theme options', 'zn_framework' )
						),
						'class'        => 'zn_full',

					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'post_options', 'page_options', 'portfolio_options' ),
						'name'        => __( 'Hide page subheader?', 'zn_framework' ),
						'description' => __( 'Chose yes if you want to hide the page sub-header ( including sliders ). Please note that this option will overwrite the option set in the admin panel', 'zn_framework' ),
						'id'          => 'zn_zn_disable_subheader',
						'std'         => '',
						'options'     => array ( '' => __( 'Default - Set from theme options', 'zn_framework' ), 'yes' => __( 'Yes', 'zn_framework' ), 'no' => __( 'No', 'zn_framework' ) ),
						'type'        => 'select',
						'class'        => 'zn_full',
					);

	$zn_meta_elements[] = array (
		'slug' 			=> array( 'post_options', 'page_options', 'portfolio_options' ),
		'name'        => __( 'Sub-header style', 'zn_framework' ),
		'description' => __( 'Choose what sub-header style to use.', 'zn_framework' ),
		'id'          => 'zn_subheader_style',
		'std'         => 'no',
		'options'     => WpkZn::getThemeHeaders(true),
		'type'        => 'select',
		'class'        => 'zn_full',
	);


/** END POST OPTIONS **/

/** PAGE OPTIONS **/
	$zn_meta_elements[] = array (
						'slug' 			=> array( 'page_options'),
						"name"        => __( "Show Page Title?", 'zn_framework' ),
						"description" => __( "Choose yes if you want to show the page title above the content.", 'zn_framework' ),
						"id"          => "zn_page_title_show",
						"std"         => "yes",
						"options"     => array ( "yes" => __( "Yes", 'zn_framework' ), "no" => __( "No", 'zn_framework' ) ),
						"type"        => "zn_radio",
						'class'        => 'zn_full',
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'page_options'),
						"name"        => __( "Alternative Page Title", 'zn_framework' ),
						"description" => __( "Enter your desired title for this page. Please note that this title will appear on the
						top-right of your header if you choose to use a page header.If this field is not completed, the normal page title
						 will appear in both top-right part of the header as well as the normal location of page title.", 'zn_framework' ),
						"id"          => "zn_page_title",
						"std"         => "",
						"type"        => "text",
						'class'        => 'zn_full',
					);

	$zn_meta_elements[] = array (
					'slug' 			=> array( 'page_options'),
					"name"        => __( "Page Subtitle", 'zn_framework' ),
					"description" => __( "Enter your desired subtitle for this page.Please note that the appearance of this subtitle is subject of default or custom options of the header part.", 'zn_framework' ),
					"id"          => "zn_page_subtitle",
					"std"         => "",
					"type"        => "text",
					'class'        => 'zn_full',
				);

/** END PAGE OPTIONS **/

/** PORTFOLIO GENERAL OPTIONS **/

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_options'),
						"name"        => __( "Show Title?", 'zn_framework' ),
						"description" => __( "Choose yes if you want to show the title above the content.", 'zn_framework' ),
						"id"          => "zn_page_title_show",
						"std"         => "yes",
						"type"        => "zn_radio",
						"options"     => array ( "yes" => __( "Yes", 'zn_framework' ), "no" => __( "No", 'zn_framework' ) ),
						'class'        => 'zn_full',
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_options'),
						"name"        => __( "Alternative Title", 'zn_framework' ),
						"description" => __( "Enter your desired title for this page. Please note that this title will appear on the
						top-right of your header if you choose to use a page header.If this field is not completed, the normal page title
						will appear in both top-right part of the header as well as the normal location of page title.", 'zn_framework' ),
						"id"          => "zn_page_title",
						"std"         => "",
						"type"        => "text",
						'class'        => 'zn_full',
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_options'),
						"name"        => __( "Subtitle", 'zn_framework' ),
						"description" => __( "Enter your desired subtitle for this page.Please note that the appearance of this subtitle is subject of default or custom options of the header part.", 'zn_framework' ),
						"id"          => "zn_page_subtitle",
						"std"         => "",
						"type"        => "text",
						'class'        => 'zn_full',
					);


/** END PORTFOLIO GENERAL OPTIONS **/

/** PORTFOLIO OPTIONS **/
	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Project Live Link", 'zn_framework' ),
						"description" => __( "Please choose the live url for this project.", 'zn_framework' ),
						"id"          => "zn_sp_link",
						"std"         => "",
						"type"        => "link",
						"options"     => array ( '_blank' => __( "New window", 'zn_framework' ), '_self' => __( "Same window", 'zn_framework' ) )
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Live link button text", 'zn_framework' ),
						"description" => __( "Enter your default text that will appear on the Live link. The default text is Project live preview", 'zn_framework' ),
						"id"          => "zn_sp_link_text",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "eg: PROJECT LIVE PREVIEW"
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Client", 'zn_framework' ),
						"description" => __( "Add the client that this project was made for.", 'zn_framework' ),
						"id"          => "zn_sp_client",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "eg: The Mega Company"
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Project year", 'zn_framework' ),
						"description" => __( "Please add the year the project was made", 'zn_framework' ),
						"id"          => "zn_sp_year",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "eg: 2015"
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Project services/role", 'zn_framework' ),
						"description" => __( "Please add more details on what service you provided for this client, or what was your role. Separate with comma", 'zn_framework' ),
						"id"          => "zn_sp_services",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "eg: design mockups, seo, marketing"
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Project Collaborators", 'zn_framework' ),
						"description" => __( "Please enter the collaborators for this project", 'zn_framework' ),
						"id"          => "zn_sp_col",
						"std"         => "",
						"type"        => "text",
						"placeholder" => "eg: John Doe, Big Agency Inc."
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Show social sharing icons?", 'zn_framework' ),
						"description" => __( "Select yes if you want to show the social share icons or no if you want to
										 hide them.", 'zn_framework' ),
						"id"          => "zn_sp_show_social",
						"std"         => "yes",
						"options"     => array ( "yes" => __( "Yes", 'zn_framework' ), "no" => __( "No", 'zn_framework' ) ),
						"type"        => "zn_radio"
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Enable Sticky content?", 'zn_framework' ),
						"description" => __( "Select yes if you want the left side content to be sticked when scrolling.", 'zn_framework' ),
						"id"          => "zn_sp_show_affix",
						"std"         => "yes",
						"options"     => array ( "yes" => __( "Yes", 'zn_framework' ), "no" => __( "No", 'zn_framework' ) ),
						"type"        => "zn_radio"
					);

	$zn_meta_elements[] = array (
						'slug' 			=> array( 'portfolio_g_options'),
						"name"        => __( "Portfolio Item Media", 'zn_framework' ),
						"description" => __( "Portfolio Item Media", 'zn_framework' ),
						"id"          => "zn_port_media",
						"std"         => '',
						"type"        => "group",
						"use_name"    => "port_med_name",
						"add_text"    => __( "Item", 'zn_framework' ),
						"remove_text" => __( "Item", 'zn_framework' ),
            			"element_title" => "port_med_name",
						"subelements" => array (
							array (
								"name"        => __( "Media Name", 'zn_framework' ),
								"description" => __( "Here you can enter a name for this image/video. It will only appear in the edit page.", 'zn_framework' ),
								"id"          => "port_med_name",
								"std"         => "",
								"type"        => "text"
							),
							array (
								"name"        => __( "Select image", 'zn_framework' ),
								"description" => __( "Select the desired image that you want to use.", 'zn_framework' ),
								"id"          => "port_media_image_comb",
								"std"         => "",
								"type"        => "media",
								'class'		  => 'zn_full'
							),
							array (
								"name"        => __( "Video URL", 'zn_framework' ),
								"description" => __( "Please enter the Youtube or Vimeo URL for your video.", 'zn_framework' ),
								"id"          => "port_media_video_comb",
								"std"         => "",
								"type"        => "text",
								"class"       => "port_media_type-combined"
							)
						)
					);

/** END PORTFOLIO OPTIONS **/
