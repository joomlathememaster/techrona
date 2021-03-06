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

add_action( 'kng_post_metabox_register', 'techrona_post_type_options_register' );
function techrona_post_type_options_register( $metabox ) {
	if ( ! $metabox->isset_args( 'kng-header' ) ) {
		$metabox->set_args( 'kng-header', array(
			'opt_name'            => 'kng_header_option',
			'display_name'        => esc_html__( 'Header Type', 'techrona' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	if ( ! $metabox->isset_args( 'service' ) ) {
		$metabox->set_args( 'service', array(
			'opt_name'            => 'service_option',
			'display_name'        => esc_html__( 'Service Options', 'techrona' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	if ( ! $metabox->isset_args( 'elementor_library' ) ) {
		$metabox->set_args( 'elementor_library', array(
			'opt_name'            => 'elementor_library_option',
			'display_name'        => esc_html__( 'Panel Type', 'techrona' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	   
	$metabox->add_section( 'kng-header', array(
		'title'  => esc_html__( 'Header Type', 'techrona' ),
		'fields' => array(
			array(
				'id'       => 'kng_header_type',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Header Type', 'techrona' ),
				'default'  => 'default',
				'options' => [
					'default' => esc_html__('Desktop', 'techrona'),
					'sticky' => esc_html__('Sticky Desktop', 'techrona'),
					'mobile' => esc_html__('Mobile', 'techrona')
				]
			)   
		)
	) );
  
	$metabox->add_section( 'service', array(
		'title'  => esc_html__( 'Icon', 'techrona' ),
		'fields' => array(
            array(
	            'id'       => 'service_icon',
	            'type'     => 'kng_iconpicker',
	            'title'    => esc_html__( 'Choose the icon', 'techrona' ),
	            'default'  => 'kngi-auction',
	        ),
	        array(
	            'id'       => 'service_img',
				'type'     => 'media',
				'title'    => esc_html__( 'Images ', 'techrona' ),
				'subtitle' => esc_html__( 'Upload your images', 'techrona' )
        	)
		)
	) );

	$side_panel_df = ['df' => esc_html__( 'Default', 'techrona' )];
	$side_panel_cf = techrona_configs('side_panel'); 
	$side_panel = array_merge($side_panel_df,$side_panel_cf);

	$metabox->add_section( 'elementor_library', array(
		'title'  => esc_html__( 'Panel Type', 'techrona' ),
		'fields' => array(
            array(
				'id'       => 'kng_panel_type',
				'type'     => 'select',
				'title'    => esc_html__( 'Panel Type', 'techrona' ),
				'default'  => '',
				'options' => $side_panel
			)  
		)
	) );
}