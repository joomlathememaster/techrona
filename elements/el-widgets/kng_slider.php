<?php
// Register KNG Sliders
kng_add_custom_widget(
    array(
        'name'       => 'kng_slider',
        'title'      => esc_html__('KNG Slider', 'techrona'),
        'icon'       => 'eicon-slides',
        'categories' => array('kngtheme-core'),
        'scripts'    => [
            'swiper',
            'kng-swiper'
        ],
        'styles'     => ['techrona-local-font'],
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__('Layout', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__('Templates', 'techrona' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_slider-1.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-slider-layout-'
                        )
                    ),
                ),
                array(
                    'name'     => 'slider_settings',
                    'label'    => esc_html__('Slider Settings', 'techrona'),
                    'tab'      => 'settings',
                    'controls' => array(
                        array(
                            'label'        => esc_html__('Slider Height', 'techrona'), 
                            'name'         => 'slider_height',
                            'type'         => 'number',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .kng-slider-container, {{WRAPPER}} .kng-slider-item' => 'height:{{VALUE}}px'
                            ],
                            'default'      => '640' 
                        ),
                        array(
                            'label'        => esc_html__('Content Width', 'techrona'), 
                            'name'         => 'content_width',
                            'type'         => 'select',
                            'options'      => [
                                ''                => esc_html__('Default','techrona'),
                                'container'       => esc_html__('Boxed','techrona'),
                                'container-wide'  => esc_html__('Wide','techrona'),
                                'container-fluid' => esc_html__('Full Width','techrona')
                            ] 
                        ),
                        array(
                            'name'        => 'slide_direction',
                            'label'       => esc_html__('Slides Direction', 'techrona'),
                            'description' => esc_html__('Defines how slides Direction, \'horizontal\' | \'vertical\'', 'techrona'),
                            'type'        => 'select',
                            'options'     => [
                                'horizontal' => esc_html__('Horizontal', 'techrona'),
                                'vertical'   => esc_html__('Vertical', 'techrona')
                            ],
                            'default'      => 'horizontal'
                        ),
                        array(
                            'name'    => 'slide_mode',
                            'label'   => esc_html__('Slide Effect', 'techrona'),
                            'type'    => 'select',
                            'options' => [
                                'slide'     => esc_html__('Slide', 'techrona'),
                                'fade'      => esc_html__('Fade', 'techrona'),
                                'cube'      => esc_html__('Cube', 'techrona'),
                                'flip'      => esc_html__('Flip', 'techrona')
                            ],
                            'default' => 'slide'
                        ),
                        array(
                            'name'       => 'slider_radius',
                            'label'      => esc_html__( 'Border Radius', 'techrona' ),
                            'type'       => 'dimensions',
                            'size_units' => [ 'px', '%' ],
                            'selectors'  => [
                                '{{WRAPPER}} .kng-sliders-wrap .kng-slider-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        )
                    )
                ),
                array(
                    'name'     => 'slider_arrow_settings',
                    'label'    => esc_html__('Arrows', 'techrona'),
                    'tab'      => 'settings',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'         => 'arrows',
                                'label'        => esc_html__('Show Arrows', 'techrona'),
                                'type'         => 'select',
                                'options'      => [
                                    'true'  => esc_html__('Yes', 'techrona'),
                                    'false' => esc_html__('No','techrona')
                                ], 
                                'default'      => 'true', 
                                'control_type' => 'responsive',
                                'prefix_class' => 'kng-swiper-arrows%s-'
                            ),
                            array(
                                'name'        => 'arrow_prev',
                                'label'       => esc_html__('Previous Icon','techrona'),
                                'type'        => 'icons',
                                'label_block' => true,
                                'separator'   => 'before' 
                            ),
                            array(
                                'name'        => 'arrow_next',
                                'label'       => esc_html__('Next Icon','techrona'),
                                'type'        => 'icons',
                                'label_block' => true,
                                'separator'   => 'before' 
                            ),
                            array(
                                'name'         => 'arrows_pos',
                                'label'        => esc_html__('Arrows Position', 'techrona'),
                                'type'         => 'select',
                                'default'      => 'in-vertical',
                                'options'      => [
                                    'in-vertical'    => esc_html__('Inside Vertical','techrona'),
                                    'out-vertical'   => esc_html__('Outside Vertical','techrona'),
                                    'top-left'       => esc_html__('Top Left','techrona'),
                                    'top-right'      => esc_html__('Top Right','techrona'),
                                    'top-center'     => esc_html__('Top Center','techrona'),
                                    'top-between'    => esc_html__('Top between','techrona'),
                                    'bottom-left'    => esc_html__('Bottom Left','techrona'),
                                    'bottom-right'   => esc_html__('Bottom Right','techrona'),
                                    'bottom-center'  => esc_html__('Bottom Center','techrona'),
                                    'bottom-between' => esc_html__('Bottom between','techrona'),
                                    'custom'         => esc_html__('Custom','techrona'),
                                ],
                                'prefix_class' => 'kng-swiper-nav-',
                            ),
                            array(
                                'name'         => 'arrows_style',
                                'label'        => esc_html__('Arrows Styles', 'techrona'),
                                'type'         => 'select',
                                'default'      => 'default',
                                'options'      => [
                                    'default'  => esc_html__('Default','techrona'),
                                    'round'  => esc_html__('Round Border','techrona'),
                                    'round-in-dark'  => esc_html__('Round In Dark','techrona'),
                                ],
                                'prefix_class' => 'kng-swiper-nav-style-',
                            )
                        ),
                        techrona_elementor_theme_colors([
                            'name'         => 'arrows_color',
                            'label'        => esc_html__('Arrows Color', 'techrona'),
                            'custom_label'        => esc_html__('Custom Arrows Color', 'techrona'),
                            'custom_selector'     => '.kng-swiper-nav-color-custom .kng-swiper-arrow',
                            'custom_selector_tag' => 'color',
                            'prefix_class'        => 'kng-swiper-nav-color-',
                            'relation'            => 'and'
                        ]),
                        techrona_elementor_theme_colors([
                            'name'         => 'arrows_color_hover',
                            'label'        => esc_html__('Arrows Color Hover', 'techrona'),
                            'custom_label'        => esc_html__('Custom Arrows Color Hover', 'techrona'),
                            'custom_selector'     => '.kng-swiper-nav-color-hover-custom .kng-swiper-arrow:hover',
                            'custom_selector_tag' => 'color',
                            'prefix_class'        => 'kng-swiper-nav-color-hover-',
                            'relation'            => 'and'
                        ])
                    )
                ),
                array(
                    'name'     => 'slider_dots_settings',
                    'label'    => esc_html__('Dots Navigation', 'techrona'),
                    'tab'      => 'settings',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'         => 'dots',
                                'label'        => esc_html__('Show Dots', 'techrona'),
                                'type'         => 'select',
                                'options'      => [
                                    'true'  => esc_html__('Yes', 'techrona'),
                                    'false' => esc_html__('No','techrona')
                                ],
                                'control_type' => 'responsive',
                                'default'      => 'true',
                                'prefix_class' => 'kng-swiper-dots%s-'
                            ),
                            array(
                                'name'         => 'dots_style',
                                'label'        => esc_html__('Dots Style', 'techrona'),
                                'type'         => 'select',
                                'default'      => 'bullets',
                                'options'      => [
                                    'bullets'     => esc_html__('Bullets','techrona'),
                                ]
                            ),
                            array(
                                'name'      => 'dots_style_notice',
                                'type'      => 'raw_html',
                                'raw'       => sprintf( esc_html__( 'How to custom pagination, readmore at <a href="%s" target="_blank">swiper.js</a>', 'techrona' ), 'https://swiperjs.com/swiper-api#pagination' ),
                                'condition' => [
                                    'dots_style'  => 'custom'
                                ],
                                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning'
                            ),
                            array(
                                'name'      => 'dots_style_custom',
                                'type'      => 'textarea',
                                'label'     => esc_html__('Enter your code here','techrona'),
                                'condition' => [
                                    'dots_style'  => 'custom'
                                ],
                                'description' => esc_html__('Default','techrona').': function (swiper, current, total) { return current + \' of \' + total;}'
                            ),
                            array(
                                'name'         => 'dots_in_nav',
                                'label'        => esc_html__('Dots In Nav', 'techrona'),
                                'type'         => 'switcher',
                                'default'      => '',
                                'separator'    => 'before',
                                'condition'    => [
                                    'arrows'     => 'true',
                                    'arrows_pos' => ['top-left', 'top-right', 'top-center','bottom-left', 'bottom-right', 'bottom-center']
                                ] 
                            ),
                            array(
                                'name'         => 'dots_pos',
                                'label'        => esc_html__('Dots Position', 'techrona'),
                                'type'         => 'select',
                                'default'      => 'bottom-out',
                                'options'      => [
                                    'middle-left'     => esc_html__('Middle Left','techrona'), 
                                    'middle-right'    => esc_html__('Middle Right','techrona'),  
                                    'bottom-in'  => esc_html__('Bottom Inside Center','techrona'),
                                    'bottom-in-left'  => esc_html__('Bottom Inside Left','techrona'),
                                    'bottom-in-right'  => esc_html__('Bottom Inside Right','techrona'),
                                    'bottom-out' => esc_html__('Bottom Outside Center','techrona'), //
                                    'bottom-out-left' => esc_html__('Bottom Outside Left','techrona'), //
                                    'bottom-out-right' => esc_html__('Bottom Outside Right','techrona') //
                                ],
                                'condition' => [
                                    'dots_in_nav' => ''
                                ],
                                'prefix_class' => 'kng-swiper-dots-'
                            ),
                            array(
                                'name' => 'dots_margin',
                                'label' => esc_html__('Margin(px)', 'techrona' ),
                                'type' => 'dimensions',
                                'control_type' => 'responsive',
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .kng-swiper-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            )
                        ),
                        techrona_elementor_theme_colors([
                            'name'                => 'dots_color',
                            'label'               => esc_html__('Dots Color', 'techrona'),
                            'custom_label'        => esc_html__('Custom Dots Color', 'techrona'),
                            'custom_selector'     => '.kng-swiper-dots-color-custom ul.kng-swiper-dot li:not(.slick-active):not(:hover) button:before',
                            'custom_selector_tag' => 'background',
                            'prefix_class'        => 'kng-swiper-dots-color-',
                            'relation'            => 'and'
                        ]),
                        techrona_elementor_theme_colors([
                            'name'                => 'dots_color_hover',
                            'label'               => esc_html__('Dots Color Hover', 'techrona'),
                            'custom_label'        => esc_html__('Custom Dots Color Hover', 'techrona'),
                            'custom_selector'     => '.kng-swiper-dots-color-hover-custom ul.kng-swiper-dot li.slick-active button:before, .kng-swiper-dots-color-hover-custom ul.kng-swiper-dot li:hover button:before',
                            'custom_selector_tag' => 'background',
                            'prefix_class'        => 'kng-swiper-dots-color-hover-',
                            'relation'            => 'and'
                        ])
                    )
                ), 

                array(
                    'name'     => 'slider_general',
                    'label'    => esc_html__('Number of Slider (Max 5 slides)', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'    => 'number_of_slider',
                            'label'   => esc_html__('Number of Slider','techrona'),
                            'type'    => 'select',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4',
                                '5' => '5',
                            ],
                            'default' => ''
                        )
                    )
                ),
                array(
                    'name'     => 'content_slide_1',
                    'label'    => esc_html__('Content slide 1', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_content_slider_settings([
                            'prefix' => 'content_slide_1_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['1','2','3','4','5']
                    ]
                ),
                array(
                    'name'     => 'content_slide_2',
                    'label'    => esc_html__('Content slide 2', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_content_slider_settings([
                            'prefix' => 'content_slide_2_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['2','3','4','5']
                    ]
                ),
                array(
                    'name'     => 'content_slide_3',
                    'label'    => esc_html__('Content slide 3', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_content_slider_settings([
                            'prefix' => 'content_slide_3_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['3','4','5']
                    ]
                ),
                array(
                    'name'     => 'content_slide_4',
                    'label'    => esc_html__('Content slide 4', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_content_slider_settings([
                            'prefix' => 'content_slide_4_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['4','5']
                    ]
                ),
                array(
                    'name'     => 'content_slide_5',
                    'label'    => esc_html__('Content slide 5', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_content_slider_settings([
                            'prefix' => 'content_slide_5_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['5']
                    ]
                ),
                array(
                    'name'     => 'static_slide_1',
                    'label'    => esc_html__('Image Layers in slide 1', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_1_img_layer_1_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_1_img_layer_2_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_1_img_layer_3_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_1_img_layer_4_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_1_img_layer_5_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['1','2','3','4','5']
                    ]
                ),
                array(
                    'name'     => 'static_slide_2',
                    'label'    => esc_html__('Image Layers in slide 2', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_2_img_layer_1_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_2_img_layer_2_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_2_img_layer_3_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_2_img_layer_4_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_2_img_layer_5_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['2','3','4','5']
                    ]
                ),
                array(
                    'name'     => 'static_slide_3',
                    'label'    => esc_html__('Image Layers in slide 3', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_3_img_layer_1_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_3_img_layer_2_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_3_img_layer_3_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_3_img_layer_4_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_3_img_layer_5_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['3','4','5']
                    ]
                ),
                array(
                    'name'     => 'static_slide_4',
                    'label'    => esc_html__('Image Layers in slide 4', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_4_img_layer_1_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_4_img_layer_2_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_4_img_layer_3_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_4_img_layer_4_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_4_img_layer_5_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['4','5']
                    ]
                ),
                array(
                    'name'     => 'static_slide_5',
                    'label'    => esc_html__('Image Layers in slide 5', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_5_img_layer_1_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_5_img_layer_2_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_5_img_layer_3_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_5_img_layer_4_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'static_slide_5_img_layer_5_'
                        ])
                    ),
                    'condition'    => [
                        'number_of_slider' => ['5']
                    ]
                ),     
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);