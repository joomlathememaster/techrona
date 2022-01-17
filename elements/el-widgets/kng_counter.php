<?php
//Register Counter Widget
 kng_add_custom_widget(
    array(
        'name'       => 'kng_counter',
        'title'      => esc_html__('KNG Counter', 'techrona'),
        'icon'       => 'eicon-counter-circle',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'jquery-numerator',
            'kng-counter',
            'kng-animation'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        techrona_elementor_text_align(),
                        array(
                            'name'         => 'layout',
                            'label'        => esc_html__( 'Templates', 'techrona' ),
                            'type'         => 'layoutcontrol',
                            'prefix_class' => 'kng-counter-layout',
                            'default'      => '1',
                            'options'      => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_counter-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_counter-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_counter-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_counter-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_counter-5.jpg'
                                ]
                            ],
                        ) 
                    ),
                ),
                array(
                    'name'     => 'section_counter',
                    'label'    => esc_html__('Counter', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'    => 'starting_number',
                            'label'   => esc_html__('Starting Number', 'techrona'),
                            'type'    => 'number',
                            'default' => 1,
                        ),
                        array(
                            'name'    => 'ending_number',
                            'label'   => esc_html__('Ending Number', 'techrona'),
                            'type'    => 'number'
                        ),
                        array(
                            'name'        => 'prefix',
                            'label'       => esc_html__('Number Prefix', 'techrona'),
                            'type'        => 'text'
                        ),
                        array(
                            'name'        => 'suffix',
                            'label'       => esc_html__('Number Suffix', 'techrona'),
                            'type'        => 'text'
                        ),
                        array(
                            'name'        => 'number_color',
                            'label'       => esc_html__( 'Number Color', 'techrona' ),
                            'type'        => 'select',
                            'options'     => techrona_elementor_theme_color_opts(),  
                        ),
                        array(
                            'name'        => 'number_custom_color',
                            'label'       => esc_html__( 'Custom Number Color', 'techrona' ),
                            'type'        => 'color',
                            'condition'   => [
                                'number_color'      => 'custom'
                            ],
                            'selectors'    => [
                                '{{WRAPPER}} .kng-counter-number-wrapper' => 'color:{{VALUE}};',
                                '{{WRAPPER}} .kng-counter-number' => 'color:{{VALUE}};'
                            ]
                        ),
                        array(
                            'name'    => 'duration',
                            'label'   => esc_html__('Animation Duration', 'techrona'),
                            'type'    => 'number',
                            'default' => 2000,
                            'min'     => 100,
                            'step'    => 100,
                        ),
                        array(
                            'name'    => 'thousand_separator',
                            'label'   => esc_html__('Thousand Separator', 'techrona'),
                            'type'    => 'switcher',
                            'default' => 'true',
                        ),
                        array(
                            'name'      => 'thousand_separator_char',
                            'label'     => esc_html__('Separator', 'techrona'),
                            'type'      => 'select',
                            'condition' => [
                                'thousand_separator' => 'true',
                            ],
                            'options' => [
                                ''  => 'Default',
                                '.' => 'Dot',
                                ' ' => 'Space',
                            ],
                            'default' => '',
                        )
                    )
                ),
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Icon', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'    => 'icon_type',
                                'label'   => esc_html__( 'Icon Type', 'techrona' ),
                                'type'    => 'select',
                                'options' => [
                                    'icon' => esc_html__('Icon', 'techrona'),
                                    'image' => esc_html__('Image', 'techrona'),
                                ],
                                'default'   => 'icon'
                            ),
                            array(
                                'name'             => 'counter_icon',
                                'label'            => esc_html__( 'Icon', 'techrona' ),
                                'type'             => 'icons',
                                'default'          => [
                                    'library' => 'kngi',
                                    'value'   => 'kngi-clock'  
                                ],
                                'condition'        => [
                                    'icon_type' => 'icon'
                                ]
                            )
                        ),
                        techrona_elementor_typo_settings([
                            'name'     => 'icon_text',
                            'selector' => '.kng-counter-icon',
                            'condition' => [
                                'icon_type' => 'icon'
                            ]
                        ]),
                        array(
                            array(
                                'name'      => 'icon_image',
                                'label'     => esc_html__( 'Icon Image', 'techrona' ),
                                'type'      => 'media',
                                'default'   => [
                                    'url' => \Elementor\Utils::get_placeholder_image_src()
                                ],
                                'condition' => [
                                    'icon_type' => 'image'
                                ]
                            ),
                            array(
                                'name'         => 'thumbnail_size',
                                'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                                'label'        => esc_html__('Images Size','techrona'),
                                'control_type' => 'group',
                                'default'      => 'thumbnail',
                                'condition'    => [
                                    'icon_type' => 'image'
                                ]
                            )
                        )
                    ),
                    'condition'        => [
                        'layout' => ['1','3','4']
                    ]
                ),
                array(
                    'name'     => 'title_section',
                    'label'    => esc_html__( 'Title', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_text_settings([
                            'name'     => 'title',
                            'selector' => '.kng-counter-title'
                        ])
                    )
                ),
                array(
                    'name'     => 'desc_section',
                    'label'    => esc_html__( 'Description', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_text_settings([
                            'name'     => 'description',
                            'selector' => '.kng-counter-desc',
                            'default'  => ''
                        ])
                    ),
                    'condition'        => [
                        'layout' => ['1','2','3','5']
                    ]
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);