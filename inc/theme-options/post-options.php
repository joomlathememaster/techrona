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

add_action( 'kng_post_metabox_register', 'techrona_post_options_register' );
function techrona_post_options_register( $metabox ) {
	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'techrona' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	if ( ! $metabox->isset_args( 'kng_pf_audio' ) ) {
		$metabox->set_args( 'kng_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'techrona' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	if ( ! $metabox->isset_args( 'kng_pf_link' ) ) {
		$metabox->set_args( 'kng_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'techrona' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	if ( ! $metabox->isset_args( 'kng_pf_quote' ) ) {
		$metabox->set_args( 'kng_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'techrona' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	if ( ! $metabox->isset_args( 'kng_pf_video' ) ) {
		$metabox->set_args( 'kng_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'techrona' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	if ( ! $metabox->isset_args( 'kng_pf_gallery' ) ) {
		$metabox->set_args( 'kng_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'techrona' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}
	  
	// Sidebar
	$metabox->add_section('post', 
		array(
		    'title'      => esc_html__('Sidebar Position', 'techrona'),
		    'icon'       => 'el-icon-list',
		    'subsection' => true,
		    'fields'     => array(
				techrona_sidebar_opts(['name' => 'single_sidebar_pos', 'default' => true, 'subsection' => true])
			)
		)
	);
	 
	/**
	 * Config post format meta options
	 *
	*/
	$metabox->add_section( 'kng_pf_video', array(
		'title'  => esc_html__( 'Video', 'techrona' ),
		'fields' => array(
			array(
				'id'    => 'post-video-url',
				'type'  => 'text',
				'title' => esc_html__( 'Video URL', 'techrona' ),
				'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'techrona' )
			),

			array(
				'id'             => 'post-video-file',
				'type'           => 'media',
				'title'          => esc_html__( 'Video Upload', 'techrona' ),
				'desc'           => esc_html__( 'Upload video file', 'techrona' ),
				'library_filter' => array('mp4', 'mov', 'mp3'),
				'mode'           => false,
			),

			array(
				'id'    => 'post-video-html',
				'type'  => 'textarea',
				'title' => esc_html__( 'Embadded video', 'techrona' ),
				'desc'  => esc_html__( 'Use this option when the video does not come from YouTube or Vimeo', 'techrona' )
			)
		)
	) );

	$metabox->add_section( 'kng_pf_gallery', array(
		'title'  => esc_html__( 'Gallery', 'techrona' ),
		'fields' => array(
			array(
				'id'       => 'post-gallery-lightbox',
				'type'     => 'select',
				'title'    => esc_html__( 'Lightbox?', 'techrona' ),
				'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'techrona' ),
				'default'  => 'yes',
				'options' => [
					'yes' => __('Yes', 'techrona'),
					'no'  => __('No', 'techrona')
				]
			),
			array(
				'id'       => 'post-gallery-images',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Gallery Images ', 'techrona' ),
				'subtitle' => esc_html__( 'Upload images or add from media library.', 'techrona' )
			)
		)
	) );

	$metabox->add_section( 'kng_pf_audio', array(
		'title'  => esc_html__( 'Audio', 'techrona' ),
		'fields' => array(
			array(
				'id'          => 'post-audio-url',
				'type'        => 'text',
				'title'       => esc_html__( 'Audio URL', 'techrona' ),
				'description' => esc_html__( 'Audio file URL in format: mp3, ogg, wav.', 'techrona' ),
				'validate'    => 'url',
				'msg'         => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'kng_pf_link', array(
		'title'  => esc_html__( 'Link', 'techrona' ),
		'fields' => array(
			array(
				'id'       => 'post-link-url',
				'type'     => 'text',
				'title'    => esc_html__( 'URL', 'techrona' ),
				'validate' => 'url',
				'msg'      => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'kng_pf_quote', array(
		'title'  => esc_html__( 'Quote', 'techrona' ),
		'fields' => array(
			array(
				'id'    => 'post-quote-cite',
				'type'  => 'text',
				'title' => esc_html__( 'Cite', 'techrona' )
			)
		)
	) );
 
}