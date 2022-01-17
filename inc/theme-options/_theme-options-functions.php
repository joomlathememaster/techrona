<?php
 
/**
 * Header 
**/
if(!function_exists('techrona_header_opts')){
	function techrona_header_opts($args=[]){
		$args = wp_parse_args($args,[
			'default'         => false,
			'default_value'   => ''
		]);
		 
		$opt_lists = techrona_list_post_header('kng-header', 'default', $args['default']);
		$opt_lists_sticky = techrona_list_post_header('kng-header', 'sticky', $args['default']);
		 
		if($args['default']){  
			$options = [
				'-1' => esc_html__('Default','techrona'),
                '1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			$default_value = '-1';
		} else {
			 
			$options = [
				'1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			$default_value = '0';
		}
   
		$opts = array(
	        array(
	            'id'       => 'header_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Header Layout', 'techrona'),
	            'subtitle' => esc_html__('Select a layout for header.', 'techrona'),
	            'options'  => $opt_lists,
	            'default'  => $args['default_value']  
	        ),
	        array(
	            'id'       => 'header_ontop',
	            'title'    => esc_html__('Header OnTop (Transparent)', 'techrona'),
	            'subtitle' => esc_html__('Header will be overlay on next content when applicable.', 'techrona'),
	            'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
	        ), 
	        array(
                'id'       => 'header_is_sticky',
                'title'    => esc_html__('Header Sticky', 'techrona'),
                'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
            ),
            array(
	            'id'       => 'header_sticky_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Header Sticky Layout', 'techrona'),
	            'subtitle' => esc_html__('Select a layout for header sticky.', 'techrona'),
	            'options'  => $opt_lists_sticky,
	            'default'  => $args['default_value'],
	            'required'  => ['header_is_sticky', '=' ,'1']  
	        )
	    );
 
		return $opts;
	}
}
 
 
if(!function_exists('techrona_header_logo_opts')){
	function techrona_header_mobile_opts($args = []){
		$args = wp_parse_args($args, [
			'default'    => false,
			'default_value'   => '',
		]);
		$hm_lists = techrona_list_post_header('kng-header', 'mobile', $args['default']);
		 
		if($args['default']){
			$options = [
				'-1' => esc_html__('Default','techrona'),
                '1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			$default_value = '-1';
			
		} else {
			$options = [
				'1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			$default_value = '0';
		}

		return array(
			array(
	            'id'       => 'header_mobile_layout',
	            'type'     => 'select',
	            'title'    => esc_html__('Header Mobile Layout', 'techrona'),
	            'subtitle' => esc_html__('Select a layout for header.', 'techrona'),
	            'options'  => $hm_lists,
	            'default'  => $args['default_value']  
	        ),
            array(
	            'id'       => 'mobile_header_ontop',
	            'title'    => esc_html__('Header Mobile OnTop', 'techrona'),
	            'subtitle' => esc_html__('Header will be overlay on next content when applicable on mobile.', 'techrona'),
	            'type'     => 'button_set',
                'options'  => $options,
                'default'  => $default_value,
	        ),  
	        array(
	            'id'       => 'logo_m',
	            'type'     => 'media',
	            'title'    => esc_html__('Logo Mobile', 'techrona'),
	            'default' => array(
	                'url'=>''
	            ),
	            'required' => array( 'header_mobile_layout' , '=', '' )
	        ),
	        array(
	            'id'       => 'logo_mobile_size',
	            'type'     => 'dimensions',
	            'title'    => esc_html__('Logo Size', 'techrona'),
	            'subtitle' => esc_html__('Enter demensions for your logo', 'techrona'),
	            'height'    => false,
	            'unit'     => 'px',
	            'required' => array( 'header_mobile_layout' , '=', '' )
	        ),
	    );
	}
}
 
 
/**
 * Header Navigation 
**/
if(!function_exists('techrona_navigation_opts')){
	function techrona_navigation_opts($args=[]){
		$args = wp_parse_args($args, [
			'default'       => false,
			'default_value' => '1'
		]);
		if($args['default']){
			$menus = ['-1' => esc_html__('Theme Options','techrona')] + techrona_get_nav_menu();
			$default_menu  = '-1';
		} else {
			$menus = techrona_get_nav_menu();
			$default_menu  = '0';
		}
		$opts = array(
		    'title'      => esc_html__('Navigation', 'techrona'),
		    'icon'       => 'el el-lines',
		    'subsection' => true,
		    'fields'     => array(
		    	 
		        
		        
		        
		    )
		);
		return $opts;
	}
}
 
/**
 * Page Title
***/
if(!function_exists('techrona_page_title_opts')){
	function techrona_page_title_opts($args = []){
		$args = wp_parse_args($args, [
			'prefix'		 => '',	
			'default'        => '',
			'default_value'  => '1',
			'default_layout' => '',
			'subsection'     => ''
		]);		
		return array(
			'title'      => esc_html__('Page Title', 'techrona'),
			'icon'       => 'el-icon-map-marker',
			'subsection' => $args['subsection'],
			'fields'     => techrona_page_title_opts_fields($args)
		);
	}
}
if(!function_exists('techrona_page_title_opts_fields')){
	function techrona_page_title_opts_fields($args = []){
		$args = wp_parse_args($args, [
			'prefix'         => '',
			'default'        => false,
			'default_value'  => '1',
			'default_layout' => '',
			'subsection'     => false
		]);
		if($args['default']){
			$options = [
				'-1' => esc_html__('Default','techrona'),
                '1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			// Default Layout 
			$ptitle_layout = !empty($args['default_layout']) ? $args['default_layout'] : '-1';
		} else {
			$options = [
				'1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			// Default Layout 
			$ptitle_layout = !empty($args['default_layout']) ? $args['default_layout'] : techrona_configs('ptitle')['layout'];
		}
		// layout
		$layout_default = [
			'-1' => get_template_directory_uri() . '/assets/images/default.jpg',
		];
		$layout_list = [
			'1' => get_template_directory_uri() . '/assets/images/ptitle-layout/p1.jpg',
			'2' => get_template_directory_uri() . '/assets/images/ptitle-layout/p2.jpg',
			'3' => get_template_directory_uri() . '/assets/images/ptitle-layout/p3.jpg',
			'4' => get_template_directory_uri() . '/assets/images/ptitle-layout/p4.jpg',
		];
		
		if($args['default']){
			$layout_opts = $layout_default +  $layout_list;
		} else {
			$layout_opts = $layout_list;
		}
		// Show/Hide
		if($args['default']){
			$sh_options = [
				'-1' => esc_html__('Default','techrona'),
                '1'  => esc_html__('Show','techrona'),
                '0'  => esc_html__('Hide','techrona'),
			];
		} else {
			$sh_options = [
				'1'  => esc_html__('Show','techrona'),
                '0'  => esc_html__('Hide','techrona'),
			];
		}
		  
		$args['layout_opts']   = $layout_opts;
		$args['sh_options']    = $sh_options;
		$args['ptitle_layout'] = $ptitle_layout;
 
		return array(
	        array(
	            'id'           => $args['prefix'].'pagetitle',
	            'type'         => 'button_set',
	            'title'        => esc_html__( 'Page Title', 'techrona' ),
	            'subtitle'     => esc_html__('Show/Hide page title?', 'techrona'),
	            'options'      => $args['sh_options'],
	            'default'      => $args['default_value'],
	        ),
	        array(
	            'id'       => $args['prefix'].'ptitle_layout',
	            'type'     => 'image_select',
	            'title'    => esc_html__('Layout', 'techrona'),
	            'subtitle' => esc_html__('Select a layout for page title.', 'techrona'),
	            'options'  => $args['layout_opts'],
	            'default'  => $args['ptitle_layout'],
	            'required' => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
	        ),
	        array(
				'id'             => $args['prefix'].'ptitle_padding',
				'type'           => 'spacing',
				'title'          => esc_html__( 'Page title padding', 'techrona' ),
				'desc'           => esc_html__( 'Page title padding top and bottom ', 'techrona' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				),
				'required' => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
			),
			array(
				'id'             => $args['prefix'].'ptitle_padding_mobile',
				'type'           => 'spacing',
				'title'          => esc_html__( 'Page title padding mobile', 'techrona' ),
				'desc'           => esc_html__( 'Page title padding top and bottom mobile', 'techrona' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				),
				'required' => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
			),
	        array(
				'id'                    => $args['prefix'].'ptitle_bg',
				'type'                  => 'background',
				'title'                 => esc_html__('Background', 'techrona'),
				'subtitle'              => esc_html__('Page title background.', 'techrona'),
				'required'              => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
	        ),
	        array(
				'id'           => $args['prefix'].'ptitle_overlay_color',
				'type'         => 'color_rgba',
				'title'        => esc_html__('Overlay Background Color', 'techrona'),
				'required'     => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
	        ),
	        array(
				'id'           => $args['prefix'].'ptitle_gradient_bg_from',
				'type'         => 'color_rgba',
				'title'        => esc_html__('Overlay Background Gradient From', 'techrona'),
				'required'     => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
	        ),
	        array(
				'id'           => $args['prefix'].'ptitle_gradient_bg_to',
				'type'         => 'color_rgba',
				'title'        => esc_html__('Overlay Background Gradient To', 'techrona'),
				'required'     => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
	        ),
	         
	        array(
	            'id'       => $args['prefix'].'ptitle_title_on',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Show Title', 'techrona'),
	            'options'  => $args['sh_options'],
	            'default'  => $args['default_value'],
	            'required' => array($args['prefix'].'pagetitle', '=', '1' ) 
	        ),
	        techrona_page_title_custom_text_opts($args['default']),
	        techrona_page_title_custom_sub_text_opts($args['default']),
	        array(
				'id'          => $args['prefix'].'ptitle_color',
				'type'        => 'color_rgba',
				'title'       => esc_html__('Title Color', 'techrona'),
				'subtitle'    => esc_html__('Page title color.', 'techrona'),
				'required'    => array( 0 => $args['prefix'].'ptitle_title_on', 1 => 'equals', 2 => '1' ),
	        ),
	        array(
	            'id'       => $args['prefix'].'ptitle_title_align',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Title Align', 'techrona'),
	            'options'  => array(
	            	''	=> esc_html__('Default', 'techrona'),
	            	'center'=> esc_html__('Center', 'techrona'),
	            	'right'	=> esc_html__('Right', 'techrona'),
	            ),
	            'default'  => '',
	            'required' => array($args['prefix'].'ptitle_title_on', '=', '1' )  
	        ),
	        array(
	            'id'       => $args['prefix'].'ptitle_breadcrumb_on',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Show Breadcrumb', 'techrona'),
	            'options'  => $args['sh_options'],
	            'default'  => $args['default_value'],
	            'required' => array( 0 => $args['prefix'].'pagetitle', 1 => 'equals', 2 => '1' ),
	        ),
	        array(
	            'id'      => $args['prefix'].'ptitle_breadcrumb_link_color',
	            'type'    => 'link_color',
	            'title'   => esc_html__('Breadcrumb Color', 'techrona'),
	            'default' => array(
	                'regular' => '',
	                'hover'   => '',
	                'active'  => '',
	            ),
	            'required' => array( 0 => $args['prefix'].'ptitle_breadcrumb_on', 1 => 'equals', 2 => '1' ),
	        ),
	        array(
	            'id'       => $args['prefix'].'ptitle_breadcrumb_align',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Breadcrumb Align', 'techrona'),
	            'options'  => array(
	            	'start'	=> esc_html__('Start', 'techrona'),
	            	'center'=> esc_html__('Center', 'techrona'),
	            	'end'	=> esc_html__('End', 'techrona'),
	            ),
	            'default'  => '',
	            'required' => array($args['prefix'].'ptitle_breadcrumb_on', '=', '1' )  
	        ),
	    );
	}
}
if(!function_exists('techrona_page_title_custom_text_opts')){
	function techrona_page_title_custom_text_opts($show){
		if(!$show) return [];
		return array(
			'id'           => 'custom_title',
			'type'         => 'textarea',
			'title'        => esc_html__( 'Custom Title', 'techrona' ),
			'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'techrona' ),
			'required' 	   => array( 
				array(0 => 'ptitle_title_on', 1 => 'equals', 2 => '1' )
			)
		);
	}
}
if(!function_exists('techrona_page_title_custom_sub_text_opts')){
	function techrona_page_title_custom_sub_text_opts($show){
		if(!$show) return [];
		return array(
			'id'           => 'custom_sub_title',
			'type'         => 'textarea',
			'title'        => esc_html__( 'Custom Sub Title', 'techrona' ),
			'subtitle'     => esc_html__( 'Add short description for page title', 'techrona' ),
			'required' 	   => array( 
				array(0 => 'ptitle_title_on', 1 => 'equals', 2 => '1' )
			)
		);
	}
}
/**
 * Page Options 
*/ 
if(!function_exists('techrona_page_layout_opts')){
	function techrona_page_layout_opts($args = []){
		$args = wp_parse_args($args, [
			'name'          => 'page_sidebar_pos',	
			'title'         => esc_html__('Single Page', 'techrona'),
			'default'       => false,
			'default_value' => techrona_configs('blog')['archive_sidebar_pos'],
			'subsection'    => true,
			'fields_only'   => false
		]);
		$params = array(
		    'title'      => $args['title'],
		    'icon'       => 'el-icon-file-edit',
		    'subsection' => $args['subsection'],
		    'fields'     => array(
		        techrona_sidebar_opts([
		            'name'          => $args['name'],
		            'default'		=> $args['default'],
		            'default_value' => $args['default_value'],
		            'subsection'    => $args['subsection'],
		            'fields_only'   => $args['fields_only']
		        ]),
		        array(
		            'id'            => 'page_content_col',
		            'title'         => esc_html__('Content Columns', 'techrona'),
		            'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
		            'type'          => 'slider',
		            'default'       => techrona_configs('blog')['single_content_col'],
		            'min'           => 1,
		            'step'          => 1,
		            'max'           => 11,
		            'display_value' => 'label',
		            'required'      => [ 
		                [$args['name'], '!=', '0'],
		                [$args['name'], '!=', 'bottom']
		            ],
		        )
		    )
		);
		if($args['default']){
			array_push(
				$params['fields'], 
				array(
					'id'             => 'content_padding',
					'type'           => 'spacing',
					'output'         => array( '#kng-main' ),
					'right'          => false,
					'left'           => false,
					'mode'           => 'padding',
					'units'          => array( 'px' ),
					'units_extended' => 'false',
					'title'          => esc_html__( 'Content Padding', 'techrona' ),
					'desc'           => esc_html__( 'Default: Theme Option.', 'techrona' ),
					'default'        => array(
						'padding-top'    => '',
						'padding-bottom' => '',
						'units'          => 'px',
					)
				)
			);
		}

		return $params;

	}
}
if(!function_exists('techrona_product_single_opts_wishlist_compare')){
	function techrona_product_single_opts_wishlist_compare(){
		$arr = [];
		if(class_exists('WPCleverWoosw'))
			$arr[] = array(
	            'id'       => 'product_wishlist',
	            'title'    => esc_html__('Show Wishlist', 'techrona'),
	            'type'     => 'switch',
	            'default'  => '1',
	        );
		if(class_exists('WPCleverWoosc'))
			$arr[] = array(
	            'id'       => 'product_compare',
	            'title'    => esc_html__('Show compare', 'techrona'),
	            'type'     => 'switch',
	            'default'  => '1',
	        );
		return $arr;
	}
}
/**
 * Footer Options
**/
if(!function_exists('techrona_footer_opts')){
	function techrona_footer_opts($args=[]){
		$args = wp_parse_args($args, [
			'default'       => false,
			'default_value' => '1',
			'subsection'    => false
		]);
		if($args['default']){
			$footer_fixed_options = [
				'-1' => esc_html__('Default','techrona'),
                '1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			$footer_layout_default = '-1';
			$footer_fixed_default_value = '-1';
		} else {
			$footer_fixed_options = [
				'1'  => esc_html__('Yes','techrona'),
                '0'  => esc_html__('No','techrona'),
			];
			$footer_layout_default = '';
			$footer_fixed_default_value = '0';
		}
		
		// Return
		return array(
		    'title'      => esc_html__('Footer', 'techrona'),
		    'icon'       => 'el-icon-website',
		    'subsection' => $args['subsection'],
		    'fields'     => array(
		        array(
                    'id'          => 'footer_layout',
                    'type'        => 'select',
                    'title'       => esc_html__('Layout', 'techrona'),
                    'subtitle'    => esc_html__('Select a layout for upper footer area.', 'techrona'),
                    'desc'        => sprintf(esc_html__('%sClick Here%s to add your custom footer layout.','techrona'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=kng-footer' ) ) . '" target="_blank">','</a>'),
                    'placeholder' => esc_html__('Default','techrona'),
                    'options'     => techrona_list_post('kng-footer', $args['default']),
                    'default'     => $footer_layout_default
                ),
                array(
		            'id'          => 'footer_text_color',
		            'type'        => 'color',
		            'title'       => esc_html__('Text Color', 'techrona'),
		            'transparent' => false,
		            'default'     => ''
		        ),
	            array(
                    'title'    => esc_html__('Footer Fixed', 'techrona'),
                    'subtitle' => esc_html__('Make footer fixed at bottom?', 'techrona'),
                    'id'       => 'footer_fixed',
                    'type'     => 'button_set',
                    'options'  => $footer_fixed_options,
                    'default'  => $footer_fixed_default_value,
                )
            )
		);
	}
}
 
/**
 * Sidebar
*/
if(!function_exists('techrona_sidebar_opts')){
	function techrona_sidebar_opts($args = []){
		$args = wp_parse_args($args, [
			'name'          => 'sidebar_page_pos',
			'default'       => false,
			'default_value' => techrona_configs('blog')['archive_sidebar_pos'],
			'subsection'    => true,
			'fields_only'	=> false
		]);
		if($args['default']){
			$options = [
				'-1'    => esc_html__('Default','techrona'),
				'0'     => esc_html__('No Sidebar','techrona'),
				'left'  => esc_html__('Left','techrona'),
				'right' => esc_html__('Right','techrona'),
				'bottom' => esc_html__('Bottom','techrona'),
			];
			$default_value = '0';
		} else {
			$options = [
				'0'     => esc_html__('No Sidebar','techrona'),
				'left'  => esc_html__('Left','techrona'),
				'right' => esc_html__('Right','techrona'),
				'bottom' => esc_html__('Bottom','techrona'),
			];
			$default_value = $args['default_value'];
		}
		// Return
		return array(
            'title'    => esc_html__('Sidebar Position', 'techrona'),
            'subtitle' => esc_html__('Choose position for sidebar', 'techrona'),
            'id'       => $args['name'],
            'type'     => 'button_set',
            'options'  => $options,
            'default'  => $default_value,
        );
	}
}
 
 