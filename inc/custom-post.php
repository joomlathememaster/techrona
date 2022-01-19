<?php

if(!function_exists('techrona_cpt_header_top')){
	add_filter( 'kng_extra_post_types', 'techrona_cpt_header_top' );
	function techrona_cpt_header_top( $postypes ) {
		$postypes['kng-header'] = array(
			'status'     => true,
			'item_name'  => esc_html__( 'Header Builder', 'techrona' ),
			'items_name' => esc_html__( 'Header Builder', 'techrona' ),
			'args'       => array(
				'menu_icon'          => 'dashicons-editor-insertmore',
				'supports'           => array(
					'title',
					'editor',
					'thumbnail',
				),
				'public'             => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true
			),
			'labels'     => array()
		);
		$postypes['kng-footer'] = array(
			'status'     => true,
			'item_name'  => esc_html__( 'Footer Builder', 'techrona' ),
			'items_name' => esc_html__( 'Footer Builder', 'techrona' ),
			'args'       => array(
				'menu_icon'          => 'dashicons-editor-insertmore',
				'supports'           => array(
					'title',
					'editor',
					'thumbnail',
				),
				'public'             => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true
			),
			'labels'     => array()
		);
 
		$postypes['service'] = array(
			'status'     => true,
			'item_name'  => esc_html__( 'Service', 'techrona' ),
			'items_name' => esc_html__( 'Services', 'techrona' ),
			'args'       => array(
				'menu_icon'          => 'dashicons-hourglass',
				'supports'           => array(
					'title',
					'thumbnail',
					'editor'
				),
				'public'             => true,
				'publicly_queryable' => true,
				'rewrite'             => array(
	                'slug'       => 'service'
	 		 	),
			),
			'labels'     => array()
		);		 
		$postypes['project'] = array(
			'status'     => true,
			'item_name'  => esc_html__( 'Project', 'techrona' ),
			'items_name' => esc_html__( 'Projects', 'techrona' ),
			'args'       => array(
				'menu_icon'          => 'dashicons-hammer', //dashicons-layout
				'supports'           => array(
					'title',
					'thumbnail',
					'editor',
					'excerpt'
				),
				'public'             => true,
				'publicly_queryable' => true,
				'rewrite'             => array(
	                'slug'       => 'project'
	 		 	),
			),
			'labels'     => array()
		);
		$postypes['portfolio'] = array(
			'status'     => false
		);
		 
		return $postypes;
	}
}

// Add/Remove support Mega Menu
if(!function_exists('techrona_enable_megamenu')){
	add_filter( 'kng_enable_megamenu', 'techrona_enable_megamenu' );
	function techrona_enable_megamenu() {
		return true;
	}
}
// Add/Remove Menu One Page
if(!function_exists('techrona_enable_onepage')){
	add_filter( 'kng_enable_onepage', 'techrona_enable_onepage' );
	function techrona_enable_onepage() {
		return false;
	}
}

add_filter( 'kng_extra_taxonomies', 'techrona_add_tax' );
function techrona_add_tax( $taxonomies ) {
 
	$taxonomies['service-category'] = array(
		'status'     => true,
		'post_type'  => array( 'service' ),
		'taxonomy' => esc_html__('Service Categories', 'techrona'),
		'taxewcomy'   => esc_html__('Service Categories', 'techrona'),
		'taxonomies' => esc_html__('Service Categories', 'techrona'),
		'args'       => array(
			'rewrite'             => array(
                'slug'       => 'service-category'
 		 	),
		),
		'labels'     => array()
	);
	$taxonomies['project-category'] = array(
		'status'     => true,
		'post_type'  => array( 'project' ),
		'taxonomy' => esc_html__('Project Categories', 'techrona'),
		'taxewcomy'   => esc_html__('Project Categories', 'techrona'),
		'taxonomies' => esc_html__('Project Categories', 'techrona'),
		'args'       => array(
			'rewrite'             => array(
                'slug'       => 'project-category'
 		 	),
		),
		'labels'     => array()
	);
	 
	return $taxonomies;
} 