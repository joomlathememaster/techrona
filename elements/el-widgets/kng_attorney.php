<?php
// Register Fancy Box Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_attorney',
        'title'      => esc_html__( 'KNG Attorney', 'techrona' ),
        'icon'       => 'eicon-icon-box',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(),
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_attorney-1.jpg'
                                ] 
                            ],
                            'prefix_class' => 'kng-attorney-layout-'
                        )
                    )
                ),
                  
                array(
                    'name'     => 'content',
                    'label'    => esc_html__( 'Content', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'    => 'selected_img',
                            'label'   => esc_html__('Image','techrona'),
                            'type'    => 'media',
                            'default' => [
                                'url' => get_template_directory_uri().'/assets/images/placeholder/placeholder.png'
                            ],
                        ),
                        array(
                            'name'         => 'thumbnail_size',
                            'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                            'label'        => esc_html__('Image Size','techrona'), 
                            'control_type' => 'group',
                            'default' => 'techrona-attorney'
                        ),
                        array(
                            'name'     => 'attorney_name',
                            'label'    => esc_html__('Attorney Name', 'techrona'),
                            'type'     => 'text',
                            'default'  => esc_html__('Your Attorney Name', 'techrona')
                        ),
                        array(
                            'name'     => 'attorney_position',
                            'label'    => esc_html__('Attorney Position', 'techrona'),
                            'type'     => 'text',
                            'default'  => esc_html__('Family Lawyer', 'techrona')
                        ),
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
                            'name' => 'content_padding',
                            'label' => esc_html__('Content Padding(px)', 'techrona' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .kng-attorney-wrap .attorney-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'     => 'social_list',
                            'label'    => esc_html__( 'Social Lists', 'techrona' ),
                            'type'     => 'repeater',
                            'controls' => array_merge(
                                array(
                                    array(
                                        'name'        => 'social_name',
                                        'label'       => esc_html__( 'Name', 'techrona' ),
                                        'type'        => 'text',
                                        'label_block' => true,
                                    ),
                                    array(
                                        'name'        => 'social_link',
                                        'label'       => esc_html__( 'Link', 'techrona' ),
                                        'type'        => 'url',
                                        'placeholder' => esc_html__('https://your-link.com', 'techrona' ),
                                        'label_block' => true,
                                    ),
                                    array(
                                        'name'             => 'social_icon',
                                        'label'            => esc_html__( 'Icon', 'techrona' ),
                                        'type'             => 'icons',
                                        'fa4compatibility' => 'social',
                                        'default'          => [],
                                    )
                                )
                            ),
                            'default' => [
                                [
                                    'social_name' => 'Facebook',
                                    'social_link' => [
                                        'url'         => 'https://facebook.com',
                                        'is_external' => 'on'
                                    ],
                                    'social_icon' => [
                                        'value'   => 'kngi-facebook-f',
                                        'library' => 'kngi',
                                    ]
                                ],
                                [
                                    'social_name' => 'Twitter',
                                    'social_link' => [
                                        'url'         => 'https://twitter.com',
                                        'is_external' => 'on'
                                    ],
                                    'social_icon' => [
                                        'value'   => 'kngi-twitter',
                                        'library' => 'kngi',
                                    ]
                                ],
                                [
                                    'social_name' => 'Linkedin',
                                    'social_link' => [
                                        'url'         => 'https://linkedin.com',
                                        'is_external' => 'on'
                                    ],
                                    'social_icon' => [
                                        'value'   => 'kngi-linkedin-in',
                                        'library' => 'kngi',
                                    ]
                                ],
                                [
                                    'social_name' => 'Pinterest',
                                    'social_link' => [
                                        'url'         => 'https://pinterest.com',
                                        'is_external' => 'on'
                                    ],
                                    'social_icon' => [
                                        'value'   => 'kngi-pinterest-p',
                                        'library' => 'kngi',
                                    ]
                                ]
                            ],
                            'title_field' => '{{{ elementor.helpers.renderIcon( this, social_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ social_name }}}'
                        )
                    )
                ),
                     
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);