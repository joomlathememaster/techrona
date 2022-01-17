<?php
// Register Testimonial List Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_icon_list',
        'title'      => esc_html__('KNG Icon List', 'techrona'),
        'icon'       => 'eicon-bullet-list',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Icon List', 'techrona' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'view',                        
                            'label' => esc_html__( 'Layout', 'techrona' ),
                            'type' => 'choose',
                            'default' => 'traditional',
                            'options' => [
                                'traditional' => [
                                    'title' => esc_html__( 'Default', 'techrona' ),
                                    'icon' => 'eicon-editor-list-ul',
                                ],
                                'inline' => [
                                    'title' => esc_html__( 'Inline', 'techrona' ),
                                    'icon' => 'eicon-ellipsis-h',
                                ],
                            ],
                            // 'render_type' => 'template',
                            // 'classes' => 'elementor-control-start-end',
                            // 'style_transfer' => true,
                            // 'prefix_class' => 'elementor-icon-list--layout-',                        
                        ),
                        array(
                            'name' => 'icon_list',                        
                            'label' => esc_html__( 'Items', 'techrona' ),
                            'type' => 'repeater',
                            'controls' => array(
                                array(
                                    'name' => 'text',                                
                                    'label' => esc_html__( 'Text', 'techrona' ),
                                    'type' => 'text',
                                    'label_block' => true,
                                    'placeholder' => esc_html__( 'List Item', 'techrona' ),
                                    'default' => esc_html__( 'List Item', 'techrona' ),
                                    // 'dynamic' => [
                                    //     'active' => true,
                                    // ]                               
                                ),
                                array(
                                    'name' => 'selected_icon',                                
                                    'label' => esc_html__( 'Icon', 'techrona' ),
                                    'type' => 'icons',
                                    'default' => [
                                        'value' => 'fas fa-check',
                                        'library' => 'fa-solid',
                                    ],
                                    'fa4compatibility' => 'icon',                                
                                ),
                                array(
                                    'name' => 'link',                                
                                    'label' => esc_html__( 'Link', 'techrona' ),
                                    'type' => 'url',
                                    'dynamic' => [
                                        'active' => true,
                                    ],
                                    'placeholder' => esc_html__( 'https://your-link.com', 'techrona' ),                                
                                )
                            ),
                            'default' => [
                                [
                                    'text' => esc_html__( 'List Item #1', 'techrona' ),
                                    'selected_icon' => [
                                        'value' => 'fas fa-check',
                                        'library' => 'fa-solid',
                                    ],
                                ],
                                [
                                    'text' => esc_html__( 'List Item #2', 'techrona' ),
                                    'selected_icon' => [
                                        'value' => 'fas fa-times',
                                        'library' => 'fa-solid',
                                    ],
                                ],
                                [
                                    'text' => esc_html__( 'List Item #3', 'techrona' ),
                                    'selected_icon' => [
                                        'value' => 'fas fa-dot-circle',
                                        'library' => 'fa-solid',
                                    ],
                                ],
                            ],
                            'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
                        )
                    )
                ),
                array(
                    'name' => 'section_icon_list',
                    'label' => esc_html__('List', 'techrona' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'space_between',                        
                                'label' => esc_html__( 'Space Between', 'techrona' ),
                                'type' => 'slider',
                                'range' => [
                                    'px' => [
                                        'max' => 50,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .el-list-items:not(.el-inline-items) .el-icon-list-item:not(:last-child)' => 'padding-bottom: calc({{SIZE}}{{UNIT}}/2)',
                                    '{{WRAPPER}} .el-list-items:not(.el-inline-items) .el-icon-list-item:not(:first-child)' => 'margin-top: calc({{SIZE}}{{UNIT}}/2)',
                                    '{{WRAPPER}} .el-list-items.el-inline-items .el-icon-list-item' => 'margin-right: calc({{SIZE}}{{UNIT}}/2); margin-left: calc({{SIZE}}{{UNIT}}/2);',
                                    '{{WRAPPER}} .el-list-items.el-inline-items .el-icon-list-item:after' => 'right: calc(-{{SIZE}}{{UNIT}}/2);',
                                    '{{WRAPPER}} .el-list-items.el-inline-items' => 'margin-right: calc(-{{SIZE}}{{UNIT}}/2); margin-left: calc(-{{SIZE}}{{UNIT}}/2);',
                                ],                        
                            ),
                            array(
                                'name' => 'icon_align',                        
                                'label' => esc_html__( 'Alignment', 'techrona' ),
                                'type' => 'choose',
                                'options' => [
                                    'left' => [
                                        'title' => esc_html__( 'Left', 'techrona' ),
                                        'icon' => 'eicon-h-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__( 'Center', 'techrona' ),
                                        'icon' => 'eicon-h-align-center',
                                    ],
                                    'right' => [
                                        'title' => esc_html__( 'Right', 'techrona' ),
                                        'icon' => 'eicon-h-align-right',
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .el-list-items.el-inline-items' => 'justify-content: {{VALUE}};',
                                    '{{WRAPPER}} .el-list-items' => 'text-align: {{VALUE}};'
                                ]                      
                            ),
                            array(
                                'name' => 'divider',                    
                                'label' => esc_html__( 'Divider', 'techrona' ),
                                'type' => 'switcher',
                                'label_off' => esc_html__( 'Off', 'techrona' ),
                                'label_on' => esc_html__( 'On', 'techrona' ),
                                'return_value' => 'yes',
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .el-icon-list-item:not(:last-child):after' => 'content: ""',
                                ],
                                'separator' => 'before',
                            ),
                            array(
                                'name' => 'divider_style',                        
                                'label' => esc_html__( 'Style', 'techrona' ),
                                'type' => 'select',
                                'options' => [
                                    'solid' => esc_html__( 'Solid', 'techrona' ),
                                    'double' => esc_html__( 'Double', 'techrona' ),
                                    'dotted' => esc_html__( 'Dotted', 'techrona' ),
                                    'dashed' => esc_html__( 'Dashed', 'techrona' ),
                                ],
                                'default' => 'solid',
                                'condition' => [
                                    'divider' => 'yes',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .el-list-items:not(.el-inline-items) .el-icon-list-item:not(:last-child):after' => 'border-top-style: {{VALUE}}',
                                    '{{WRAPPER}} .el-list-items.el-inline-items .el-icon-list-item:not(:last-child):after' => 'border-left-style: {{VALUE}}',
                                ],                        
                            ),
                            array(
                                'name' => 'divider_weight',                        
                                'label' => esc_html__( 'Weight', 'techrona' ),
                                'type' => 'slider',
                                'default' => [
                                    'size' => 1,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 1,
                                        'max' => 20,
                                    ],
                                ],
                                'condition' => [
                                    'divider' => 'yes',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .el-list-items:not(.el-inline-items) .el-icon-list-item:not(:last-child):after' => 'border-top-width: {{SIZE}}{{UNIT}}',
                                    '{{WRAPPER}} .el-inline-items .el-icon-list-item:not(:last-child):after' => 'border-left-width: {{SIZE}}{{UNIT}}',
                                ],                        
                            ),
                            array(
                                'name' => 'divider_width',                        
                                'label' => esc_html__( 'Width', 'techrona' ),
                                'type' => 'slider',
                                'default' => [
                                    'unit' => '%',
                                ],
                                'condition' => [
                                    'divider' => 'yes',
                                    'view!' => 'inline',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .el-icon-list-item:not(:last-child):after' => 'width: {{SIZE}}{{UNIT}}',
                                ],                        
                            ),
                            array(
                                'name' => 'divider_height',                        
                                'label' => esc_html__( 'Height', 'techrona' ),
                                'type' => 'slider',
                                'size_units' => [ '%', 'px' ],
                                'default' => [
                                    'unit' => '%',
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                    '%' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                ],
                                'condition' => [
                                    'divider' => 'yes',
                                    'view' => 'inline',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .el-icon-list-item:not(:last-child):after' => 'height: {{SIZE}}{{UNIT}}',
                                ],                        
                            )                 
                        ),
                        techrona_elementor_color([
                            'name' => 'divider_color',
                            'selector' => [
                                '{{WRAPPER}} .el-icon-list-item:not(:last-child):after' => 'border-color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Color', 'techrona'),
                            'condition' => [
                                'divider' => 'yes',
                            ],
                        ])
                    )
                ),
                array(
                    'name' => 'section_icon_style',
                    'label' => esc_html__('Icon', 'techrona' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        techrona_elementor_color([
                            'name' => 'icon_color',
                            'selector' => [
                                '{{WRAPPER}} .el-icon-list-icon i' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Color', 'techrona'),
                        ]),
                        techrona_elementor_color([
                            'name' => 'icon_color_hover',
                            'selector' => [
                                '{{WRAPPER}} .el-icon-list-item:hover .el-icon-list-icon i' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Color', 'techrona'),
                        ]),
                        array(
                            array(
                                'name' => 'icon_size',                            
                                'label' => esc_html__( 'Size', 'techrona' ),
                                'type' => 'slider',
                                'default' => [
                                    'size' => 14,
                                ],
                                'range' => [
                                    'px' => [
                                        'min' => 6,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .el-icon-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                ],                            
                            )
                        )
                    )
                ),
                array(
                    'name' => 'section_text_style',
                    'label' => esc_html__('Text', 'techrona' ),
                    'tab' => 'style',
                    'controls' => array_merge(
                        techrona_elementor_color([
                            'name' => 'text_color',
                            'selector' => [
                                '{{WRAPPER}} .el-icon-list-text' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Text Color', 'techrona'),
                        ]),
                        techrona_elementor_color([
                            'name' => 'text_color_hover',
                            'selector' => [
                                '{{WRAPPER}} .el-icon-list-item:hover .el-icon-list-text' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Hover Color', 'techrona'),
                        ]),
                        array(
                            array(
                                'name' => 'text_indent',                            
                                'label' => esc_html__( 'Text Indent', 'techrona' ),
                                'type' => 'slider',
                                'range' => [
                                    'px' => [
                                        'max' => 50,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .el-icon-list-text' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
                                ],                                                    
                            ),
                            array(
                                'name' => 'icon_typography',
                                'selector' => '{{WRAPPER}} .el-icon-list-text',
                                'type' => 'typography',
                                'control_type' => 'group'                                                    
                            )
                        )
                    )
                )                
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);