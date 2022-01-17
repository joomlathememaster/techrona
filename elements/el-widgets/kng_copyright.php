<?php
//Register Counter Widget
 kng_add_custom_widget(
    array(
        'name'       => 'kng_copyright',
        'title'      => esc_html__('KNG copyright', 'techrona'),
        'icon'       => 'eicon-text',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'section_style',
                    'label'    => esc_html__('General', 'techrona'),
                    'tab'      => 'style',
                    'controls' => array(
                        array(
                            'name'    => 'copyright_alignment',
                            'label'   => esc_html__('Text Alignment', 'techrona'),
                            'type'    => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
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
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .kng-copyright' => 'text-align: {{VALUE}};'
                            ]
                        ),
                        array(
                            'name'    => 'copyright_typo',            
                            'type'    => 'typography',
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .kng-copyright'
                        ),
                        array(
                            'name'    => 'copyright_color',            
                            'type'    => 'color',
                            'label' => esc_html__('Color', 'techrona'),
                            'selectors' => [
                                '{{WRAPPER}} .kng-copyright' => 'color: {{VALUE}};'
                            ]
                        ),
                        array(
                            'name'    => 'copyright_link_color',            
                            'type'    => 'color',
                            'label' => esc_html__('Link Color', 'techrona'),
                            'selectors' => [
                                '{{WRAPPER}} .kng-copyright a' => 'color: {{VALUE}};'
                            ]
                        )
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);