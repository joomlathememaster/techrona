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

$elementor_library = techrona_list_post('elementor_library', false);

$side_panel = techrona_configs('side_panel'); 
 
kng_add_custom_widget(
    array(
        'name'       => 'kng_anchor',
        'title'      => esc_html__( 'KNG Anchor', 'techrona' ),
        'icon'       => 'eicon-anchor',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'techrona' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options'      => techrona_text_align_opts(),
                            'default'      => 'start'
                        ),
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'techrona' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_anchor-1.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-anchor-layout-'
                        )
                    )
                ),
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'side_panel',
                                'label' => esc_html__('Select Side Panel', 'techrona'),
                                'type' => 'select',
                                'options' => $side_panel,
                                'default' => 'side-mobile' 
                            ),
                            array(
                                'name' => 'icon_type',
                                'label' => esc_html__('Select Icon Type', 'techrona'),
                                'type' => 'select',
                                'options' => [
                                    'none' => esc_html__('None', 'techrona'),
                                    'lib' => esc_html__('Library', 'techrona'),
                                    'custom' => esc_html__('custom', 'techrona'),
                                ],
                                'default' => 'lib' 
                            ),
                            array(
                                'name'             => 'selected_icon',
                                'label'            => esc_html__( 'Icon', 'techrona' ),
                                'type'             => 'icons',
                                'default'          => [
                                    'library' => 'awesome',
                                    'value'   => 'fas fa-bars'
                                ],
                                'condition' => ['icon_type' => 'lib']
                            ),
                            array(
                                'name'  => 'icon_size',
                                'label' => esc_html__( 'Icon Size(px)', 'techrona' ),
                                'type'  => 'slider',
                                'range' => [
                                    'px' => [
                                        'min' => 15,
                                        'max' => 300,
                                    ],
                                ],
                                'condition' => ['icon_type' => 'lib'],
                                'selectors' => [
                                    '{{WRAPPER}} .kng-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                ],

                            ),
                            array(
                                'name' => 'icon_margin',
                                'label' => esc_html__('Icon Margin(px)', 'techrona' ),
                                'type' => 'dimensions',
                                'control_type' => 'responsive',
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .kng-anchor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'condition' => ['icon_type!' => 'none'],
                            ),
                            array(
                                'name'        => 'title',
                                'label'       => esc_html__( 'Title', 'techrona' ),
                                'type'        => 'textarea',
                                'placeholder' => esc_html__( 'Menu', 'techrona' ),
                            ),
                            array(
                                'name'         => 'title_typo',
                                'label'        => esc_html__( 'Title Typography', 'techrona' ),
                                'type'         => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector'     => '{{WRAPPER}} .anchor-title',
                                'condition'    => ['title!' => '']
                            ),
                        ),
                        array(
                            array(
                                'name' => 'icon_color',
                                'label' => esc_html__('Color', 'techrona' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .kng-anchor' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .kng-anchor-wrap .kng-anchor-icon.custom.kng-bars span' => 'background-color: {{VALUE}};'
                                ],
                            ), 
                            array(
                                'name' => 'icon_color_hover',
                                'label' => esc_html__('Hover Color', 'techrona' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .kng-anchor:hover' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .kng-anchor-wrap .kng-anchor-icon.custom.kng-bars:hover span' => 'background-color: {{VALUE}};'
                                ],
                            )
                        )
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);