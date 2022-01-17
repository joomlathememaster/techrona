<?php
// Register Button Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_button',
        'title'      => esc_html__( 'KNG Button', 'techrona' ),
        'icon'       => 'eicon-button',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'kng-animation'
        ),
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_button-1.jpg'
                                ],
                            ],
                        ),
                    ),
                ),
                array(
                    'name'     => 'source_section',
                    'label'    => esc_html__( 'Source Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        techrona_elementor_button_settings([
                            'btn_text' => 'Click Here'
                        ])
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);