<?php
// Register Quick Contact Widget
kng_add_custom_widget(
    array(
		'name'       => 'kng_socials',
		'title'      => esc_html__( 'KNG Social', 'techrona' ),
		'icon'       => 'eicon-social-icons',
		'categories' => array('kngtheme-core'),
		'scripts'    => array(),
		'params'     => array(
            'sections' => array(
                array(
					'name'     => 'layout_section',
					'label'    => esc_html__( 'Layout', 'techrona' ),
					'tab'      => 'layout',
					'controls' => array(
						techrona_elementor_row_align(),
						array(
	                        'name'    => 'layout',
	                        'label'   => esc_html__('Templates', 'techrona' ),
	                        'type'    => 'layoutcontrol',
	                        'default' => '1',
	                        'options' => [
	                            '1' => [
	                                'label' => esc_html__('Layout 1', 'techrona' ),
	                                'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_slider-1.jpg'
	                            ],
	                            '2' => [
	                                'label' => esc_html__('Layout 2', 'techrona' ),
	                                'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_slider-1.jpg'
	                            ]
	                        ]
	                    )
                    )
                ),
                array(
					'name'     => 'social_section',
					'label'    => esc_html__( 'Socials Settings', 'techrona' ),
					'tab'      => 'content',
					'controls' => array_merge(
						array(
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
	                                        'value'   => 'fab fa-facebook-f',
	                                        'library' => 'fa-brands',
	                                    ]
	                                ],
	                                [
	                                    'social_name' => 'Twitter',
	                                    'social_link' => [
	                                        'url'         => 'https://twitter.com',
	                                        'is_external' => 'on'
	                                    ],
	                                    'social_icon' => [
	                                        'value'   => 'fab fa-twitter',
	                                        'library' => 'fa-brands',
	                                    ]
	                                ],
	                                [
	                                    'social_name' => 'Linkedin',
	                                    'social_link' => [
	                                        'url'         => 'https://linkedin.com',
	                                        'is_external' => 'on'
	                                    ],
	                                    'social_icon' => [
	                                        'value'   => 'fab fa-linkedin-in',
	                                        'library' => 'fa-brands',
	                                    ]
	                                ],
	                                [
	                                    'social_name' => 'Pinterest',
	                                    'social_link' => [
	                                        'url'         => 'https://pinterest.com',
	                                        'is_external' => 'on'
	                                    ],
	                                    'social_icon' => [
	                                        'value'   => 'fab fa-pinterest-p',
	                                        'library' => 'fa-brands',
	                                    ]
	                                ]
	                            ],
	                            'title_field' => '{{{ elementor.helpers.renderIcon( this, social_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ social_name }}}'
	                        ),
	                        array(
	                        	'name' => 'social_size',
	                        	'label'   => esc_html__( 'Size', 'techrona' ),
	                        	'type'    => 'slider',
	                        	'range' => [
				                    'px' => [
				                        'min' => 20,
				                        'max' => 100,
				                    ],
				                ],
				                'default' => [
				                	'size' => 30
				                ],
				                'control_type' => 'responsive',
	                        	'selectors' => [
	                        		'{{WRAPPER}} .kng-socials .kng-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
	                        		'{{WRAPPER}} .kng-socials .kng-icon:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
	                        		'{{WRAPPER}} .kng-socials .kng-icon:hover:before' => 'box-shadow: inset 0 0 0 {{SIZE}}{{UNIT}} var(--e-shadow-hover-color)',	                        		
	                        		'{{WRAPPER}} .kng-socials.layout-2 .kng-icon:hover:before' => 'box-shadow: inset 0 0 0 {{SIZE}}{{UNIT}} var(--e-shadow-hover-color)',	                        		
	                        	]
	                        ),
	                        array(
	                        	'name' => 'icon_size',
	                        	'label'   => esc_html__( 'Icon Size', 'techrona' ),
	                        	'type'    => 'slider',
	                        	'range' => [
				                    'px' => [
				                        'min' => 10,
				                        'max' => 100,
				                    ],
				                ],
				                'default' => [
				                	'size' => 12
				                ],
				                'control_type' => 'responsive',
	                        	'selectors' => [
	                        		'{{WRAPPER}} .kng-socials .kng-icon' => 'font-size: {{SIZE}}{{UNIT}}',
	                        	]
	                        ),
	                        array(
	                        	'name' => 'icon_spacing',
	                        	'label'   => esc_html__( 'Icon Spacing', 'techrona' ),
	                        	'type'    => 'slider',
	                        	'range' => [
				                    'px' => [
				                        'min' => 0,
				                        'max' => 50,
				                    ],
				                ],
				                'default' => [
				                	'size' => 0
				                ],
				                'control_type' => 'responsive',
	                        	'selectors' => [
	                        		'{{WRAPPER}} .kng-socials .kng-social:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',

	                        	]
	                        )
						)						
                    )
                ),
				array(
					'name' => 'style_section',
					'label' => esc_html__('Icon', 'techrona'),
					'tab' => 'style',
					'controls' => array_merge(
						array(						
							array(
								'name' => 'icon_tabs',
								'control_type' => 'tab',
								'tabs' => array(
									array(
										'name' => 'tab_normal',
										'label' => esc_html__('Normal', 'techrona'),
										'controls' => array_merge(
											techrona_elementor_color([
												'name' => 'icon',
									            'selector' => [
									            	'{{WRAPPER}} .kng-socials .kng-icon' => 'color: {{VALUE}};',
									            	'{{WRAPPER}} .kng-socials .kng-icon:before' => 'box-shadow: inset 0 0 0 1px {{VALUE}}',
									            	'{{WRAPPER}} .kng-socials.layout-2 .kng-icon:before' => 'box-shadow: inset 0 0 0 0 {{VALUE}}',
									            ],
									            'label' => esc_html__('Icon Color', 'techrona'),
									            'condition' => [],
											]),
										)
									),
									array(
										'name' => 'tab_hover',
										'label' => esc_html__('Hover', 'techrona'),
										'controls' => array_merge(
											techrona_elementor_color([
												'name' => 'icon_hover',
									            'selector' => [
									            	'{{WRAPPER}} .kng-socials .kng-icon:hover' => 'color: {{VALUE}};',
									            ],
									            'label' => esc_html__('Icon Color', 'techrona'),
									            'condition' => [],
											]),
											techrona_elementor_color([
												'name' => 'background_hover',
									            'selector' => [
									            	'{{WRAPPER}}' => '--e-shadow-hover-color: {{VALUE}}',
									            ],
									            'label' => esc_html__('Background Color', 'techrona'),
									            'condition' => [],
									            'default' => 'var(--primary-color)'
											]),
										)
									)
								)
							)
						)						
					)
				)
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);