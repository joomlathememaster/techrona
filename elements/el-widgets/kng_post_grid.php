<?php
// Register Post Grid Widget
 
kng_add_custom_widget(
    array(
        'name'       => 'kng_post_grid',
        'title'      => esc_html__( 'KNG Post Grid', 'techrona' ),
        'icon'       => 'eicon-posts-grid',
        'categories' => array('kngtheme-core'),
        'scripts'    => [
            'imagesloaded',
            'isotope',
            'kng-post-grid',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'post_type',
                                'label'    => esc_html__( 'Select Post Type', 'techrona' ),
                                'type'     => 'select',
                                'multiple' => true,
                                'options'  => kng_get_post_type_options(),
                                'default'  => 'post'
                            ) 
                        ),
                        techrona_get_post_grid_layout()
                    ),
                ),
                techrona_elementor_masonry_settings(),
                techrona_elementor_masonry_filter_settings(),
                techrona_elementor_masonry_column_settings(),
                techrona_elementor_masonry_custom_column_settings(), //['condition' => ['post_type' => 'case','layout_case' => '3-case']]
                techrona_elementor_masonry_pagination_settings(),
                array(
                    'name'     => 'source_section',
                    'label'    => esc_html__( 'Source Options', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_get_grid_term_by_post_type_options(),
                        array(
                            array(
                                'name'    => 'post_ids',
                                'label'   => esc_html__( 'post ids (123,234,...)', 'techrona' ),
                                'type'    => 'text',
                                'default' => ''
                            ),
                            array(
                                'name'    => 'orderby',
                                'label'   => esc_html__( 'Order By', 'techrona' ),
                                'type'    => 'select',
                                'default' => 'date',
                                'options' => [
                                    'date'   => esc_html__( 'Date', 'techrona' ),
                                    'ID'     => esc_html__( 'ID', 'techrona' ),
                                    'author' => esc_html__( 'Author', 'techrona' ),
                                    'title'  => esc_html__( 'Title', 'techrona' ),
                                    'rand'   => esc_html__( 'Random', 'techrona' ),
                                ],
                            ),
                            array(
                                'name'    => 'order',
                                'label'   => esc_html__( 'Sort Order', 'techrona' ),
                                'type'    => 'select',
                                'default' => 'desc',
                                'options' => [
                                    'desc' => esc_html__( 'Descending', 'techrona' ),
                                    'asc'  => esc_html__( 'Ascending', 'techrona' ),
                                ],
                            ),
                            array(
                                'name'    => 'limit',
                                'label'   => esc_html__( 'Items to show', 'techrona' ),
                                'type'    => 'number',
                                'default' => '6',
                            )
                        )
                    )
                ),
                array(
                    'name'     => 'thumbnail_section',
                    'label'    => esc_html__( 'Thumbnail Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'thumbnail_size',
                            'label' => esc_html__('Image Size', 'techrona' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'medium',
                            'options' => techrona_get_thumbnail_size(),
                        ),
                        array(
                            'name' => 'thumbnail_size_custom',
                            'label' => esc_html__('Image Size Custom', 'techrona' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' => 'Enter size in pixels (Default: 370x300 (Width x Height)).',
                            'condition' => ['thumbnail_size' => 'custom']
                        ),
                    )
                ),
                array(
                    'name'     => 'excerpt_section',
                    'label'    => esc_html__( 'Excerpt Options', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'  => 'show_excerpt',
                            'label' => esc_html__('Show Excerpt', 'techrona'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => '',
                        ),
                        array(
                            'name'      => 'excerpt_lenght',
                            'label'     => esc_html__( 'Excerpt lenght', 'techrona' ),
                            'type'      => 'number',
                            'default'   => 25,
                            'condition' => ['show_excerpt' => 'yes'],
                        ),
                        array(
                            'name'      => 'excerpt_more_text',
                            'label'     => esc_html__( 'Excerpt more text', 'techrona' ),
                            'type'      => 'text',
                            'default'   => '...',
                            'condition' => ['show_excerpt' => 'yes'],
                        )
                    ),
                    'condition' => [
                        'post_type' => ['post','service']
                    ]
                ),
                array(
                    'name'     => 'readmore_section',
                    'label'    => esc_html__( 'Read More Options', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => [
                        array(
                            'name'  => 'show_readmore',
                            'label' => esc_html__('Show Read More', 'techrona'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                        ),
                        array(
                            'name'      => 'readmore_text',
                            'label'     => esc_html__( 'Read More Text', 'techrona' ),
                            'type'      => 'text',
                            'default'   => esc_html__('Read More','techrona'),
                            'condition' => ['show_readmore' => 'yes'],
                            'separator' => 'after',

                        ),
                    ] 
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);