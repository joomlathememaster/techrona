<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param  KNG_Post_Metabox $metabox
 */


add_action( 'kng_post_metabox_register', 'techrona_page_options_register' );
function techrona_page_options_register( $metabox ) {
	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            => techrona_get_page_opt_name(),
			'display_name'        => esc_html__( 'Page Settings', 'techrona' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	$menus = ['-1' => esc_html__('Theme Options','techrona')] + techrona_get_nav_menu();

	/**
	 * Config page meta options
	 *
	 */
 
	// Main Header
	$metabox->add_section( 
		'page',  
		array(
		    'title'  => esc_html__('Header', 'techrona'),
		    'icon'   => 'el-icon-website',
		    'fields' => array_merge(
		        techrona_header_opts([
					'default'         => true,
					'default_value'   => '-1'
				])
		    )
		)
	);
	$metabox->add_section( 
		'page',  
		array(
		    'title'  => esc_html__('Header Mobile', 'techrona'),
	        'icon'       => 'el-icon-website',
		    'fields' => array_merge(
		        techrona_header_mobile_opts([
					'default'         => true,
					'default_value'   => '-1'
				])
		    )
		)
	);
	 
  
	// Page title
	$metabox->add_section( 'page', techrona_page_title_opts(['default' => true, 'default_value' => '-1']));
	// Sidebar
	$metabox->add_section('page', techrona_page_layout_opts(['default' => true, 'subsection' => false]));
	// Footer 
	$metabox->add_section('page', techrona_footer_opts(['default' => true, 'default_value'=>'-1', 'subsection' => false]));
}

function techrona_get_option_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option( techrona_get_opt_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}