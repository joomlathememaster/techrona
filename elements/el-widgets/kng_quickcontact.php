<?php
// Register Quick Contact Widget
kng_add_custom_widget(
    array(
		'name'       => 'kng_quickcontact',
		'title'      => esc_html__( 'KNG Quick Contact', 'techrona' ),
		'icon'       => 'eicon-mail',
		'categories' => array('kngtheme-core'),
		'scripts'    => [],
		'params'     => array(
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_quickcontact-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_quickcontact-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_quickcontact-3.jpg'
                                ]  
                            ],
                            'prefix_class' => 'kng-quick-contact-layout-'
                        ),
                    ),
                ),
                  
				array(
					'name'     => 'content_section',
					'label'    => esc_html__( 'Content Settings', 'techrona' ),
					'tab'      => 'content',
					'controls' => array(
                        array(
                            'name'        => 'qc_image',
                            'label'       => esc_html__('Image', 'techrona'),
                            'type'        => 'media',
                            'label_block' => true,
                            'condition'   => ['layout' => '1']
                        ),
                        array(
                            'name'        => 'heading_text',
                            'label'       => esc_html__( 'Heading', 'techrona' ),
                            'type'        => 'textarea',
                            'placeholder' => esc_html__( 'Enter Heading', 'techrona' ),
                            'default'     => 'Heading Text',    
                            'label_block' => true
                        ),
						array(
							'name'     => 'contact_list',
							'label'    => esc_html__( 'Contact Lists', 'techrona' ),
							'type'     => 'repeater',
							'controls' => array(
                                array(
                                    'name' => 'kng_icon',
                                    'label' => esc_html__('Icon', 'techrona' ),
                                    'type' => 'icons',
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'kngi kngi-marker-alt',
                                        'library' => 'kngi-icon',
                                    ],
                                ), 
                                array(
                                    'name'        => 'item_title',
                                    'label'       => esc_html__( 'Item Title', 'techrona' ),
                                    'type'        => 'textarea',
                                    'placeholder' => esc_html__( 'Enter item title', 'techrona' ),
                                    'default'     => '59 Main Street, USA',  
                                    'label_block' => true
                                ),
                            ),
                            'default' => [
                                [
									'kng_icon' => ['value' => 'kngi kngi-phone-alt1','library' => 'kngi-icon'],
                                    'item_title' => '+012 (345) 56 998',
                                ],
                                [
                                    'kng_icon' => ['value' => 'kngi kngi-envelope-regular','library' => 'kngi-icon'],
                                    'item_title' => 'support@gmail.com',
                                ],
                                [
                                    'kng_icon' => ['value' => 'kngi kngi-marker-alt','library' => 'kngi-icon'],
                                    'item_title' => '59 Main Street, USA',
                                ]
                            ],
                              
                        ) 
                    )
				),
				array(
                    'name' => 'qc_style',
                    'label' => esc_html__('Style', 'techrona'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'heading_text_color',
                            'label' => esc_html__('Heading Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .qc-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'item_text_color',
                            'label' => esc_html__('Content item Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .qc-desc-wrap' => 'color: {{VALUE}};',
                            ],
                        ), 
                        array(
                            'name' => 'heading_typography',
                            'label' => esc_html__('Heading Typography', 'techrona' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .qc-title',
                        ),
                        array(
                            'name' => 'item_typography',
                            'label' => esc_html__('Item text Typography', 'techrona' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .qc-desc-wrap',
                        ),
                    ),
                ),
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);