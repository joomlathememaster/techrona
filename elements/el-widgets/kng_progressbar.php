<?php
// Register Progress Bar Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_progressbar',
        'title'      => esc_html__( 'KNG Progress Bar', 'techrona' ),
        'icon'       => 'eicon-skill-bar',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'kng-progressbar'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'source_section',
                    'label'    => esc_html__( 'Source Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'progressbar_list',
                            'label'    => esc_html__( 'Progress Bar Lists', 'techrona' ),
                            'type'     => 'repeater',
                            'controls' => array_merge(
                                array(
                                    array(
                                        'name'        => 'title',
                                        'label'       => __( 'Title', 'techrona' ),
                                        'type'        => 'text',
                                        'placeholder' => __( 'Enter your title', 'techrona' ),
                                        'default'     => __( 'My Skill', 'techrona' ),
                                        'label_block' => true
                                    ),
                                    array(
                                        'name'        => 'inner_text',
                                        'label'       => esc_html__( 'Inner Text', 'techrona' ),
                                        'type'        => 'text',
                                        'placeholder' => __( 'e.g: Web Designer', 'techrona' ),
                                        'default'     => __( 'Web Designer', 'techrona' ),
                                        'label_block' => true
                                    ),
                                    array(
                                        'name'    => 'percent',
                                        'label'   => esc_html__( 'Percentage', 'techrona' ),
                                        'type'    => 'slider',
                                        'default' => [
                                            'size' => 50,
                                            'unit' => '%',
                                        ],
                                        'label_block' => true
                                    )
                                ),
                                techrona_elementor_theme_colors([
                                    'name'                => 'percent_color',
                                    'label'               => __( 'Percentage Color', 'techrona' ),
                                    'custom_selector'     => '.kng-progress-bar',
                                    'custom_selector_tag' => 'background-color',
                                    'output'              => false    
                                ])
                            ),
                            'title_field' => '{{title}} {{inner_text}}'
                        )
                    )
                ),
                array(
                    'name'     => 'title_style_section',
                    'label'    => esc_html__( 'Title', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => techrona_elementor_typo_settings([
                        'name'     => 'title_typo',
                        'selector' => '.kng-heading'
                    ]),
                ),
                array(
                    'name'     => 'percent_style',
                    'label'    => esc_html__( 'Percentage', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        techrona_elementor_typo_settings([
                            'name'     => 'percent_typo',
                            'selector' => '.kng-progress-bar'
                        ])
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);