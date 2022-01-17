<?php
// Register Fancy Box Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_custom_text',
        'title'      => esc_html__( 'KNG Custom Text', 'techrona' ),
        'icon'       => 'eicon-text',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                // array(
                //     'name'     => 'layout_section',
                //     'label'    => esc_html__( 'Layout', 'techrona' ),
                //     'tab'      => 'layout',
                //     'controls' => array(
                //         techrona_elementor_text_align(['default' => '']),
                //         array(
                //             'name'    => 'layout',
                //             'label'   => esc_html__( 'Templates', 'techrona' ),
                //             'type'    => 'layoutcontrol',
                //             'default' => '1',
                //             'options' => [
                //                 '1' => [
                //                     'label' => esc_html__( 'Layout 1', 'techrona' ),
                //                     'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_block_quote-1.jpg'
                //                 ]
                //             ],
                //             'prefix_class' => 'kng-blockquote-layout-'
                //         )
                //     )
                // ),
                array(
                    'name'     => 'text_section',
                    'label'    => esc_html__( 'Text', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'text_1',
                            'label'    => esc_html__('Text 1', 'techrona'),
                            'type'     => 'textarea',
                            'default'  => esc_html__('Call Us Today', 'techrona')
                        ),
                        array(
                            'name'     => 'text_2',
                            'label'    => esc_html__('Text 2', 'techrona'),
                            'type'     => 'textarea',
                            'default'  => esc_html__('+1 (800) 456 789', 'techrona')
                        )
                    )
                ),
                array(
                    'name'     => 'style_general_section',
                    'label'    => esc_html__( 'General', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'item_space',                
                                'type'     => 'slider',
                                'label' => esc_html__('Bottom Spacing', 'sunix'),
                                'control_type' => 'responsive',
                                'selectors' => [
                                    '{{WRAPPER}} .text-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                                ]                                    
                            )
                        )    
                    )
                ),
                array(
                    'name'     => 'text_1_section',
                    'label'    => esc_html__( 'Text 1', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'text_1_typo',                
                                'type'     => 'typography',
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .text-1'
                            )
                        ),
                        techrona_elementor_color([
                            'name' => 'text_1_color',
                            'selector' => [
                                '{{WRAPPER}} .text-1' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Color', 'techrona'),
                            'condition' => [],
                        ]),
                    )
                ),
                array(
                    'name'     => 'text_2_section',
                    'label'    => esc_html__( 'Text 2', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'     => 'text_2_typo',                
                                'type'     => 'typography',
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .text-2'
                            )
                        ),
                        techrona_elementor_color([
                            'name' => 'text_2_color',
                            'selector' => [
                                '{{WRAPPER}} .text-2' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Color', 'techrona'),
                            'condition' => [],
                        ]),
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);