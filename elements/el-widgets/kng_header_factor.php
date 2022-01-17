<?php
// Register Button Widget
kng_add_custom_widget(
    array(
        'name' => 'kng_header_factor',
        'title' => esc_html__('Kng Header factor', 'techrona' ),
        'icon' => 'eicon-cart',
        'categories' => array('kngtheme-core'),
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_header_factor-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_header_factor-2.jpg'
                                ]
                            ],     
                        )
                    )
                ),
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Setting', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'         => 'content_align',
                            'label'        => esc_html__( 'Content Alignment', 'techrona' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options'      => techrona_text_align_opts(),
                            'default'      => 'start',
                            'condition'    => ['layout' => '1']
                        ),
                        array(
                            'name' => 'on_search',
                            'label' => esc_html__('Show Search', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                'inline-flex' => esc_html__('Show', 'techrona'),
                                'none' => esc_html__('Hide', 'techrona'),
                                '' => esc_html__('Removed', 'techrona'),
                            ],
                            'default' => 'inline-flex',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .kng-header-factor.layout-1 .kng-search' => 'display: {{VALUE}}!important;',
                            ] 
                        ),
                        array(
                            'name' => 'search_type',
                            'label' => esc_html__('Search Type', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                'normal' => esc_html__('Search Normal', 'techrona'),
                                'product' => esc_html__('Search Product', 'techrona'),
                            ],
                            'default' => 'normal',
                            'condition' => ['on_search' => ['inline-flex','none']],
                        ),
                        // array(
                        //     'name' => 'on_user',
                        //     'label' => esc_html__('Show User', 'techrona' ),
                        //     'type' => 'select',
                        //     'options' => [
                        //         'inline-flex' => esc_html__('Show', 'techrona'),
                        //         'none' => esc_html__('Hide', 'techrona'),
                        //         '' => esc_html__('Removed', 'techrona'),
                        //     ],
                        //     'default' => 'inline-flex',
                        //     'control_type' => 'responsive',
                        //     'selectors'    => [
                        //         '{{WRAPPER}} .kng-header-factor.layout-1 .kng-user' => 'display: {{VALUE}}!important;',
                        //     ] 
                        // ),
                         
                        // array(
                        //     'name' => 'on_wishlist',
                        //     'label' => esc_html__('Show Wishlist', 'techrona' ),
                        //     'type' => 'select',
                        //     'options' => [
                        //         'inline-flex' => esc_html__('Show', 'techrona'),
                        //         'none' => esc_html__('Hide', 'techrona'),
                        //         '' => esc_html__('Removed', 'techrona'),
                        //     ],
                        //     'default' => 'inline-flex',
                        //     'control_type' => 'responsive',
                        //     'selectors'    => [
                        //         '{{WRAPPER}} .kng-header-factor.layout-1 .kng-wishlist' => 'display: {{VALUE}}!important;',
                        //     ] 
                        // ),  
                        array(
                            'name' => 'on_cart',
                            'label' => esc_html__('Show Cart', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                'inline-flex' => esc_html__('Show', 'techrona'),
                                'none' => esc_html__('Hide', 'techrona'),
                                '' => esc_html__('Removed', 'techrona'),
                            ],
                            'default' => 'inline-flex',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .kng-header-factor.layout-1 .kng-cart' => 'display: {{VALUE}}!important;',
                            ] 
                        ),
                        array(
                            'name' => 'on_btn_more',
                            'label' => esc_html__('Show Button More', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                'inline-flex' => esc_html__('Show', 'techrona'),
                                'none' => esc_html__('Hide', 'techrona'),
                                '' => esc_html__('Removed', 'techrona'),
                            ],
                            'default' => '',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .kng-header-factor.layout-1 .kng-cart' => 'display: {{VALUE}}!important;',
                            ] 
                        ), 
                        array(
                            'name' => 'ft_color',
                            'label' => esc_html__('Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-factor' => 'color: {{VALUE}};'
                            ]
                        ), 
                        array(
                            'name' => 'ft_color_hover',
                            'label' => esc_html__('Hover Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-factor:hover' => 'color: {{VALUE}};'
                            ]
                        ),
                        array(
                            'name'      => 'class',
                            'label'     => esc_html__( 'Class', 'techrona' ),
                            'type'      => 'text',
                            'separator' => 'after',
                        ),
                    )
                ), 
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Icon', 'techrona'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'icon_size',
                            'type' => 'slider',
                            'label' => esc_html__('Icon Size', 'techrona'),
                            'range' => [
                                'px' => [
                                    'min' => 10,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'size' => 24
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .kng-factor-item' => 'font-size: {{SIZE}}{{UNIT}}',
                            ]
                        )
                    )
                ) 
            ),
        ),
    ),
    get_template_directory() . '/elements/classes/'
);