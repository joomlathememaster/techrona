<?php
// Register Testimonial List Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_clients',
        'title'      => esc_html__('KNG Clients', 'techrona'),
        'icon'       => 'eicon-slider-push',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'swiper',
            'kng-swiper'
        ),
        'params' => array(
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_clients-1.png'
                                ]
                            ],
                            'prefix_class' => 'kng-clients-layout-'
                        )
                    ),
                ),
                techrona_elementor_swiper_slider_settings([
                    'tab'       => 'settings',
                ]),
                
                array(
                    'name'     => 'clients_list',
                    'label'    => esc_html__('Clients', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'clients',
                            'label'    => esc_html__('Add Client', 'techrona'),
                            'type'     => 'repeater',
                            'controls' => array(
                                array(
                                    'name'        => 'selected_img',
                                    'label'       => esc_html__('Client Image', 'techrona'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'name',
                                    'label'       => esc_html__('Client Name', 'techrona'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'description',
                                    'label'       => esc_html__('Client Description', 'techrona'),
                                    'type'        => 'textarea',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'image_link',
                                    'label'       => esc_html__( 'Client Link', 'techrona' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'techrona' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                )
                            ),
                            'default' => [],
                            'title_field' => '{{{ name }}}',
                        ),
                        array(
                            'name'         => 'thumbnail_size',
                            'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                            'label'        => esc_html__('Images Size','techrona'),
                            'control_type' => 'group',
                            'default'      => 'full',
                        )
                    )
                ),
                array(
                    'name'     => 'hover_section',
                    'label'    => esc_html__( 'Hover Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'        => 'hover_style',
                            'label'       => esc_html__( 'Hover Style', 'techrona' ),
                            'type'        => 'select',
                            'options'     => [
                                ''      => esc_html__('Default', 'techrona')
                            ],
                            'default'   => '',
                            'prefix_class' => 'kng-img-hover'
                        ),
                        array(
                            'name'       => 'item_opacity',
                            'label'      => __( 'Item Opacity', 'techrona' ),
                            'type'       => 'slider',
                            'size_units' => [ '%' ],
                            'range' => [
                                '%' => [
                                    'min' => 1,
                                    'max' => 100,
                                ]
                            ],
                            'default'    => [
                                'unit' => '%'
                            ],
                            'selectors' => [
                                '{{WRAPPER}} a:hover' => 'opacity: {{SIZE}}{{UNIT}};',
                            ]
                        )
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);