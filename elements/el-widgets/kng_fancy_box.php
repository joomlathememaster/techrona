<?php
// Register Fancy Box Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_fancy_box',
        'title'      => esc_html__( 'KNG Fancy Box', 'techrona' ),
        'icon'       => 'eicon-icon-box',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'swiper',
            'kng-swiper'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'techrona' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_fancy_box-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_fancy_box-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_fancy_box-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_fancy_box-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_fancy_box-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_fancy_box-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_fancy_box-7.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-fancybox-layout-'
                        )
                    )
                ),
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Icons', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'             => 'icon_type',
                            'label'            => esc_html__( 'Icon Type', 'techrona' ),
                            'type'             => 'select',
                            'options'          => [
                                'icon' => esc_html__('Icon','techrona'),
                                'img'  => esc_html__('Image','techrona'),
                            ],
                            'default' => 'icon'
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'techrona' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'flaticon',
                                'value'   => 'flaticon-001-broom'  
                            ],
                            'condition' => [
                                'icon_type'    => ['icon']                            
                            ],
                        ),
                        array(
                            'name'             => 'selected_img',
                            'label'            => esc_html__( 'Image', 'techrona' ),
                            'type'             => 'media',
                            'default'          => '',
                            'condition' => [
                                'icon_type'    => ['img']                            
                            ],
                        )
                    ),
                    'condition' => [
                        'layout'      => ['1','2','3','5','6','7']  
                    ]
                ),
                array(
                    'name'     => 'text_section',
                    'label'    => esc_html__( 'Title & Description', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'sub_title',
                            'label'    => __('Sub Title', 'techrona'),
                            'type'     => 'textarea',
                            'default'  => __('Sub Title', 'techrona'),
                            'condition' => [
                                'layout'      => ['4']  
                            ]
                        ),
                        array(
                            'name'     => 'title',
                            'label'    => __('Title', 'techrona'),
                            'type'     => 'textarea',
                            'default'  => __('Your Title', 'techrona')
                        ),
                        array(
                            'name'     => 'description',
                            'label'    => __('Description', 'techrona'),
                            'type'     => 'textarea',
                            'default'  => __('Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'techrona')
                        )
                    )
                ),
                array(
                    'name'     => 'link_section',
                    'label'    => esc_html__( 'Hyperlink', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'        => 'hyper_link',
                                'label'       => esc_html__( 'Custom Link', 'techrona' ),
                                'type'        => 'url',
                                'placeholder' => esc_html__( 'https://your-link.com', 'techrona' ),
                                'default'     => [
                                    'url'         => '#',
                                    'is_external' => 'on'
                                ] 
                            ),
                            array(
                                'name'     => 'link_text',
                                'label'    => __('Link Text', 'techrona'),
                                'type'     => 'text',
                                'default'  => __('Apply with us', 'techrona'),
                                'condition' => [
                                    'layout'      => ['4']  
                                ]
                            )
                        )
                    ),
                ),
                // Style
                array(
                    'name'     => 'advanced_section',
                    'label'    => esc_html__( 'Advanced', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            techrona_elementor_text_align(['default' => '']),
                            array(
                                'name' => 'fancy_padding',
                                'label' => esc_html__('Padding(px)', 'techrona' ),
                                'type' => 'dimensions',
                                'control_type' => 'responsive',
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .kng-fancybox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                        )
                    ),
                ),
                array(
                    'name'     => 'background_section',
                    'label'    => esc_html__( 'Background', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array(
                        array(
                            'name'         => 'bg_img_overlay',
                            'title'        => __( 'Background Image Hover Overlay', 'techrona' ),
                            'type'         => 'media',
                            'default' => [
                                'url' => get_template_directory_uri().'/assets/images/placeholder/placeholder.png'
                            ],
                        ),
                        array(
                            'name'        => 'bg_color_overlay',
                            'label'       => esc_html__( 'Background Color Hover Overlay', 'techrona' ),
                            'type'        => 'color',
                            'selectors'  => [
                                '{{WRAPPER}} .kng-overlay:before' => 'background-color:{{VALUE}};'
                            ]
                        ),
                         
                    ),
                    'condition' => [
                        'layout' => ['4']
                    ]
                ),
                array(
                    'name'     => 'icon_section_style',
                    'label'    => __('Icons', 'techrona'),
                    'tab'      => 'style',
                    'controls' => array(
                        array(
                            'name'         => 'thumbnail_size',
                            'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                            'label'        => __('Icon Size','techrona'), 
                            'control_type' => 'group',
                            'condition'    => [
                                'icon_type'    => 'img'                            
                            ],
                            'default' => 'custom'
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size', 'techrona' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition'    => [
                                'icon_type' => 'icon'                          
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .kng-fancy-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ]
                        ),
                        array(
                            'name'        => 'icon_color',
                            'label'       => esc_html__( 'Icon Color', 'techrona' ),
                            'type'        => 'select',
                            'options'     => techrona_elementor_theme_color_opts(['custom' => false]),  
                            'default'     => '',
                            'condition'    => [
                                'icon_type'    => 'icon'                            
                            ]
                        )
                    ),
                    'condition' => [
                        'layout' => ['1','2','3','5','6','7']
                    ]
                ),
                array(
                    'name'     => 'color_section',
                    'label'    => __( 'Color', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        techrona_elementor_theme_colors([
                            'name'                => 'sub_title_color',
                            'label'               => __('Sub Title Color', 'techrona'),
                            'custom_label'        => __('Custom Title Color', 'techrona'),
                            'custom_selector'     => '.kng-fancy-sub-title,.kng-fancy-sub-title:before,.kng-fancy-sub-title:after',
                            'custom_selector_tag' => 'color',
                            'condition'           => ['layout' => ['4']],
                        ]),
                        array(
                            array(
                                'name' => 'sub_title_divider_bg',
                                'label' => esc_html__('Sub Title divider background', 'techrona' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .kng-fancy-sub-title:before' => 'background-color: {{VALUE}};',
                                    '{{WRAPPER}} .kng-fancy-sub-title:after' => 'background-color: {{VALUE}};',
                                ],
                            ),
                        ),
                        techrona_elementor_theme_colors([
                            'name'                => 'title_color',
                            'label'               => __('Title Color', 'techrona'),
                            'custom_label'        => __('Custom Title Color', 'techrona'),
                            'custom_selector'     => '.kng-fancy-title',
                            'custom_selector_tag' => 'color',
                        ]),
                        techrona_elementor_theme_colors([
                            'name'                => 'desc_color',
                            'label'               => __('Description Color', 'techrona'),
                            'custom_label'        => __('Custom Description Color', 'techrona'),
                            'custom_selector'     => '.kng-fancy-description',
                            'custom_selector_tag' => 'color',
                        ])
                    )
                ),
                array(
                    'name'     => 'animation_section',
                    'label'    => __( 'Animation', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        techrona_elementor_animation_opts([
                            'name'   => 'sub_title',
                            'label' => esc_html__('Sub Title', 'techrona'),
                        ]),
                        techrona_elementor_animation_opts([
                            'name'   => 'title',
                            'label' => esc_html__('Title', 'techrona'),
                        ]),
                        techrona_elementor_animation_opts([
                            'name'   => 'description',
                            'label' => esc_html__('Description', 'techrona'),
                        ]) 
                    )
                ),
                
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);