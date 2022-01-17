<?php
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
$custom_menus = array(
    '' => esc_html__('Default', 'techrona')
);
if ( is_array( $menus ) && ! empty( $menus ) ) {
    foreach ( $menus as $single_menu ) {
        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
            $custom_menus[ $single_menu->slug ] = $single_menu->name;
        }
    }
} else {
    $custom_menus = '';
}
kng_add_custom_widget(
    array(
        'name' => 'kng_menu',
        'title' => esc_html__('Kng Menu', 'techrona'),
        'icon' => 'eicon-nav-menu',
        'categories' => array('kngtheme-core'),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__('Type', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'type',
                            'label' => esc_html__('Type', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Primary Menu', 'techrona'),
                                '2' => esc_html__('Menu Inner', 'techrona'),
                                '3' => esc_html__('Mobile Menu', 'techrona'),
                            ],
                            'default' => '1',
                        ),
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__('Layout', 'techrona' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_menu-1.jpg'
                                ]
                            ],
                            'condition' => [
                                'type' => ['1'],
                            ],
                            'prefix_class' => 'kng-menu-template-'
                        )
                    ),
                ),
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'techrona'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'menu',
                            'label' => esc_html__('Select Menu', 'techrona'),
                            'type' => 'select',
                            'options' => $custom_menus,
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'techrona' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options'      => techrona_text_align_opts(),
                            'default'      => 'start',
                            'condition' => [
                                'type' => ['1','3'],
                            ]
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'first_section',
                    'label' => esc_html__('Style First Level', 'techrona'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'color',
                            'label' => esc_html__('Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-nav-menu .kng-primary-menu > li > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-mobile-menu > li > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-primary-menu > li .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-mobile-menu > li .main-menu-toggle:before' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'color_hover',
                            'label' => esc_html__('Color Hover', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-nav-menu .kng-primary-menu > li > a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-mobile-menu > li > a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-primary-menu > li:hover .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-mobile-menu > li:hover .main-menu-toggle:before' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography', 'techrona' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .kng-nav-menu .kng-primary-menu > li > a, {{WRAPPER}} .kng-nav-menu .kng-mobile-menu > li > a',
                        ),
                        array(
                            'name'  => 'show_arrow',
                            'label' => esc_html__('Show Arrow', 'techrona'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'layout' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'item_space',
                            'label' => esc_html__('Item Space', 'techrona' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', 'em', '%', 'rem' ],
                            'selectors' => [
                                '{{WRAPPER}} .kng-primary-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .kng-mobile-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'sub_section',
                    'label' => esc_html__('Style Sub Level', 'techrona'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'sub_color',
                            'label' => esc_html__('Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-nav-menu .kng-primary-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-mobile-menu li .sub-menu a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_color_hover',
                            'label' => esc_html__('Color Hover', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-nav-menu .kng-primary-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-nav-menu .kng-mobile-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_typography',
                            'label' => esc_html__('Typography', 'techrona' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .kng-nav-menu .kng-primary-menu li .sub-menu a, {{WRAPPER}} .kng-nav-menu .kng-mobile-menu li .sub-menu a',
                        ),
                    ),
                ),

                array(
                    'name' => 'nav_section',
                    'label' => esc_html__('Style', 'techrona'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['2'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'nav_color',
                            'label' => esc_html__('Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-nav-menu .kng-nav-inner a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'nav_color_hover',
                            'label' => esc_html__('Color Hover', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-nav-menu .kng-nav-inner a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'nav_typography',
                            'label' => esc_html__('Typography', 'techrona' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .kng-nav-menu .kng-nav-inner a',
                        ),
                        array(
                            'name' => 'nav_item_space',
                            'label' => esc_html__('Item Space', 'techrona' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .kng-nav-menu .kng-nav-inner li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elements/classes/'
);