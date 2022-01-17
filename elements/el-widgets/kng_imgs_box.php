<?php
// Register KNG Banner
kng_add_custom_widget(
    array(
        'name'       => 'kng_imgs_box',
        'title'      => esc_html__('KNG Images Box', 'techrona'),
        'icon'       => 'eicon-gallery-grid',
        'categories' => array('kngtheme-core'),
        'scripts'    => [
            'kng-animation'
        ],
        'styles'     => [],
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__('Layout', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__('Templates', 'techrona' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_imgs_box-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'kng-imgs-box-layout-'
                        )
                    ),
                ),
                 
                array(
                    'name'     => 'image_section',
                    'label'    => esc_html__('Images Position', 'techrona'),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'label'        => esc_html__('Box Height (300px,auto)', 'techrona'), 
                                'name'         => 'box_height',
                                'type'         => 'text',
                                'control_type' => 'responsive',
                                'selectors'    => [
                                    '{{WRAPPER}} .kng-imgs-box-content' => 'height:{{VALUE}}'
                                ],
                                'default'      => '' 
                            ),
                        ),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'img_box_1_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'img_box_2_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'img_box_3_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'img_box_4_'
                        ]),
                        techrona_elementor_layers_img_settings([
                            'prefix' => 'img_box_5_'
                        ])
                    ),
                     
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);