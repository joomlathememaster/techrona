<?php
// Register Call to Action Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_cta',
        'title'      => esc_html__( 'KNG Call to Action', 'techrona' ),
        'icon'       => 'eicon-image-rollover',
        'categories' => array('kngtheme-core'),
        'scripts'    => [
            'kng-animation'
        ],
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_cta-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_cta-2.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-cta-layout-',
                        )
                    ),
                ),
                array(
                    'name'     => 'heading_section',
                    'label'    => esc_html__( 'Heading Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_text_settings([
                            'name'      => 'heading_text',
                            'label'     => __('Heading Text', 'techrona'),
                            'selector'  => '.kng-cta-title',
                            'separator' => 'before'
                        ]),
                        techrona_elementor_button_settings([
                            'prefix'       => 'cta_link1',
                            'effect'       => true,
                            'separator'    => 'before'
                        ]),
                        techrona_elementor_button_settings([
                            'prefix'       =>  'cta_link2',
                            'effect'       => true,
                            'condition'    => ['layout' => ['1']],
                            'separator'    => 'before'
                        ])
                    )
                ),
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);