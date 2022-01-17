<?php
// Register Testimonial List Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_testimonial',
        'title'      => esc_html__('KNG Testimonial', 'techrona'),
        'icon'       => 'eicon-testimonial',
        'categories' => array('kngtheme-core'),
        'scripts'    => [
            'swiper',
            'kng-swiper',
            'kng-animation'
        ],
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_testimonial-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_testimonial-2.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-testimonial-layout-'
                        ),
                        array(
                            'name'    => 'color_mode',
                            'label'   => esc_html__('Color Mode', 'techrona'),
                            'type'    => 'select',
                            'options' => [
                                ''     => esc_html__('Default', 'techrona'),
                                'light'  =>  esc_html__('Light', 'techrona'),
                            ],
                            'condition' => ['layout' => '2']
                        )
                    ),
                ),
                techrona_elementor_swiper_slider_settings([
                    'tab'                  => 'settings',
                    'slide_to_show'              => '1',
                    'slide_to_show_widescreen'   => '1',
                    'slide_to_show_laptop'       => '1',
                    'slide_to_show_tablet_extra' => '1',
                    'slide_to_show_tablet'       => '1',
                    'slide_to_show_mobile_extra' => '1',
                    'slide_to_show_mobile'       => '1'
                ]),
                 
                array(
                    'name'     => 'quote_icon_section',
                    'label'    => esc_html__( 'Quote Icon', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'         => 'text_align',
                                'label'        => esc_html__( 'Content Alignment', 'techrona' ),
                                'type'         => 'choose',
                                'control_type' => 'responsive',
                                'options'      => [
                                    'start' => [
                                        'title' => esc_html__( 'Start', 'techrona' ),
                                        'icon' => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__( 'Center', 'techrona' ),
                                        'icon' => 'eicon-text-align-center',
                                    ],
                                    'end' => [
                                        'title' => esc_html__( 'End', 'techrona' ),
                                        'icon' => 'eicon-text-align-right',
                                    ],
                                    'justify' => [
                                        'title' => esc_html__( 'Justified', 'techrona' ),
                                        'icon' => 'eicon-text-align-justify',
                                    ],
                                ],
                                'default'      => '',
                                'condition' => ['layout' => '2']
                            ),
                            array(
                                'name'             => 'quote_icon',
                                'label'            => esc_html__( 'Icon', 'techrona' ),
                                'type'             => 'icons',
                            ),
                            array(
                                'name'        => 'avatar_img_1',
                                'label'       => esc_html__('Avatar corner 1', 'techrona'),
                                'type'        => 'media',
                                'label_block' => true,
                                'condition' => ['layout' => '1']
                            ),
                            array(
                                'name'        => 'avatar_img_2',
                                'label'       => esc_html__('Avatar corner 2', 'techrona'),
                                'type'        => 'media',
                                'label_block' => true,
                                'condition' => ['layout' => '1']
                            ),
                            array(
                                'name'        => 'avatar_img_3',
                                'label'       => esc_html__('Avatar corner 3', 'techrona'),
                                'type'        => 'media',
                                'label_block' => true,
                                'condition' => ['layout' => '1']
                            ),
                            array(
                                'name'        => 'avatar_img_4',
                                'label'       => esc_html__('Avatar corner 4', 'techrona'),
                                'type'        => 'media',
                                'label_block' => true,
                                'condition' => ['layout' => '1']
                            ),
                        )
                    ),

                ),

                array(
                    'name'     => 'testimonial_list',
                    'label'    => esc_html__('Testimonial', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'testimonial',
                            'label'    => esc_html__('Add Item', 'techrona'),
                            'type'     => 'repeater',
                            'controls' => array(
                                array(
                                    'name'        => 'author',
                                    'label'       => esc_html__('Author Name', 'techrona'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'author_img',
                                    'label'       => esc_html__('Author Avatar', 'techrona'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'position',
                                    'label'       => esc_html__('Position', 'techrona'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'description',
                                    'label'       => esc_html__('Description', 'techrona'),
                                    'type'        => 'textarea',
                                    'label_block' => true,
                                )
                            ),
                            'default' => [
                                [
                                    'author'      => 'Louis H. Sanders',
                                    'position'    => 'CEO & Founder',
                                    'description' => __( 'On the other hand denounce with righteousy indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the Sed ut perspiciatis unde moment', 'techrona' )
                                ],
                                [
                                    'author'      => 'John Doe',
                                    'position'    => 'Sale Manager',
                                    'description' => __( 'On the other hand denounce with righteousy indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the Sed ut perspiciatis unde moment', 'techrona' )
                                ]
                            ],
                            'title_field' => '{{{ description }}}',
                        ),
                        array(
                            'name'         => 'thumbnail_size',
                            'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                            'label'        => esc_html__('Images Size','techrona'),
                            'control_type' => 'group',
                            'default'      => 'thumbnail',
                        )
                    ),
                     
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);