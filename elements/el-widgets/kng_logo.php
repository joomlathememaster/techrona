<?php
// Register Video Player Widget
kng_add_custom_widget(
    array(
        'name' => 'kng_logo',
        'title' => esc_html__('Kng Logo', 'techrona' ),
        'icon' => 'eicon-image',
        'categories' => array('kngtheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Content', 'techrona' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'logo',
                            'label' => esc_html__('Logo', 'techrona' ),
                            'type' => 'media',
                        ),
                        array(
                            'name' => 'logo_max_width',
                            'label' => esc_html__('Max Width', 'techrona' ),
                            'type' => 'slider',
                            'description' => esc_html__('Enter number.', 'techrona' ),
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .kng-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'logo_align',
                            'label'        => esc_html__( 'Alignment', 'techrona' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options'      => techrona_text_align_opts(),
                            'default'      => 'start'
                        ),
                        array(
                            'name' => 'logo_link',
                            'label' => esc_html__('Link', 'techrona' ),
                            'type' => 'url',
                        ),
                        array(
                            'name' => 'kng_animate',
                            'label' => esc_html__('Kng Animate', 'techrona' ),
                            'type' => 'select',
                            'options' => techrona_animate(),
                            'default' => '',
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elements/classes/'
);