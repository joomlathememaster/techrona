<?php
// Register Image Galleries Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_galleries',
        'title'      => esc_html__('KNG Galleries', 'techrona' ),
        'icon'       => 'eicon-gallery-grid',
        'categories' => array('kngtheme-core'),
        'scripts'    => [
            'kng-galleries'
        ],
        'params'     => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'techrona' ),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'techrona' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_galleries-1.jpg'
                                ]
                            ],
                        ),
                    ),
                ),
                array(
                    'name'     => 'grid_section',
                    'label'    => esc_html__('Image Gallery', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'       => 'wp_gallery',
                            'label'      => esc_html__( 'Add Images', 'techrona' ),
                            'type'       => 'gallery',
                            'show_label' => false,
                            'dynamic'    => [
                                'active' => true,
                            ],
                        ),
                        array(
                            'name'         => 'thumbnail',
                            'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default'      => 'large',
                        ),
                        array(
                            'name'         => 'gallery_col',
                            'label'        => esc_html__('Columns', 'techrona' ),
                            'type'         => 'select',
                            'default'      => '3',
                            'control_type' => 'responsive',
                            'options'      => [
                                '1' => esc_html__('1', 'techrona' ),
                                '2' => esc_html__('2', 'techrona' ),
                                '3' => esc_html__('3', 'techrona' ),
                                '4' => esc_html__('4', 'techrona' ),
                                '6' => esc_html__('6', 'techrona' ),
                            ],
                        ),
                        array(
                            'name'    => 'gallery_rand',
                            'label'   => esc_html__( 'Order By', 'techrona' ),
                            'type'    => 'select',
                            'options' => [
                                ''     => esc_html__( 'Default', 'techrona' ),
                                'rand' => esc_html__( 'Random', 'techrona' ),
                            ],
                            'default' => '',
                        ),
                        array(
                            'name'    => 'gallery_show',
                            'label'   => esc_html__( 'Number of item to show', 'techrona' ),
                            'type'    => 'number',
                            'default' => '6',
                        ),
                        array(
                            'name'    => 'gallery_loadmore_show',
                            'label'   => esc_html__( 'Number of item to show on load more', 'techrona' ),
                            'type'    => 'number',
                            'default' => '6',
                        ),
                        array(
                            'name'    => 'load_more_text',
                            'label'   => esc_html__( 'Load More Text', 'techrona' ),
                            'type'    => 'text'
                        )
                    ),
                ),
                array(
                    'name'     => 'gallery_images_section',
                    'label'    => esc_html__('Images', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array(
                        array(
                            'name'         => 'gap',
                            'label'        => esc_html__('Image Gap', 'techrona' ),
                            'type'         => 'number',
                            'control_type' => 'responsive',
                            'default'      => 30
                        ),
                    ),
                ),
                array(
                    'name'     => 'caption_section',
                    'label'    => esc_html__('Caption', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array(
                        array(
                            'name'    => 'gallery_display_caption',
                            'label'   => esc_html__( 'Display', 'techrona' ),
                            'type'    => 'select',
                            'default' => 'none',
                            'options' => [
                                'none' => esc_html__( 'Hide', 'techrona' ),
                                ''     => esc_html__( 'Show', 'techrona' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .image-caption' => 'display: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'    => 'caption_align',
                            'label'   => esc_html__( 'Alignment', 'techrona' ),
                            'type'    => 'choose',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'techrona' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'techrona' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'techrona' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .image-caption' => 'text-align: {{VALUE}};',
                            ],
                            'default'   => 'center',
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name'      => 'caption_color',
                            'label'     => esc_html__( 'Text Color', 'techrona' ),
                            'type'      => 'color',
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .kng-image-caption' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name'      => 'desc_color',
                            'label'     => esc_html__( 'Description Color', 'techrona' ),
                            'type'      => 'color',
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .kng-image-desc' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name'         => 'caption_typography',
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .image-caption',
                            'condition'    => [
                                'gallery_display_caption' => '',
                            ]
                        )
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);