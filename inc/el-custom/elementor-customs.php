<?php
 
if(!function_exists('techrona_add_cpt_support')){
    add_action( 'after_switch_theme', 'techrona_add_cpt_support');
    function techrona_add_cpt_support() {
        $cpt_support = get_option( 'elementor_cpt_support' );
        if( ! $cpt_support ) {
            $cpt_support = [ 'page', 'post', 'case', 'attorney', 'practice', 'gallery', 'kng-header', 'kng-footer', 'kng-mega-menu' ];
            update_option( 'elementor_cpt_support', $cpt_support );
        } else if( ! in_array( 'case', $cpt_support ) ) {
            $cpt_support[] = 'case';
            update_option( 'elementor_cpt_support', $cpt_support );
        } else if( ! in_array( 'attorney', $cpt_support ) ) {
            $cpt_support[] = 'attorney';
            update_option( 'elementor_cpt_support', $cpt_support );
        } else if( ! in_array( 'practice', $cpt_support ) ) {
            $cpt_support[] = 'practice';
            update_option( 'elementor_cpt_support', $cpt_support );
        }else if( ! in_array( 'gallery', $cpt_support ) ) {
            $cpt_support[] = 'gallery';
            update_option( 'elementor_cpt_support', $cpt_support );
        } else if( ! in_array( 'kng-header', $cpt_support ) ) {
            $cpt_support[] = 'kng-header';
            update_option( 'elementor_cpt_support', $cpt_support );
        } else if( ! in_array( 'kng-footer', $cpt_support ) ) {
            $cpt_support[] = 'kng-footer';
            update_option( 'elementor_cpt_support', $cpt_support );
        } else if( ! in_array( 'kng-mega-menu', $cpt_support ) ) {
            $cpt_support[] = 'kng-mega-menu';
            update_option( 'elementor_cpt_support', $cpt_support );
        }
    }
}
// Add custom field to section
if(!function_exists('techrona_custom_section_params')){
    add_filter('kng-custom-section/custom-params', 'techrona_custom_section_params'); 
    function techrona_custom_section_params(){
        return array(
            'sections' => array(
                array(
                    'name'     => 'kng_custom_layout',
                    'label'    => esc_html__( 'Custom Settings', 'techrona' ),
                    'tab'      => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name'         => 'stretched_with_space',
                            'label'        => esc_html__( 'Stretched with space from?', 'techrona' ),
                            'type'         => \Elementor\Controls_Manager::SELECT,
                            'prefix_class' => 'kng-section-stretched-with-space-',
                            'options'      => array(
                                'none'    => esc_html__( 'None', 'techrona'),
                                'start'   => esc_html__( 'Start', 'techrona'),
                                'end'     => esc_html__( 'End', 'techrona')
                            ),
                            'default'      => 'none',
                            'condition' => [
                                'stretch_section' => 'section-stretched'
                            ]
                        ),
                        // make section full content with a space on start / end
                        array(
                            'name'         => 'full_content_with_space',
                            'label'        => esc_html__( 'Full Content with space from?', 'techrona' ),
                            'type'         => \Elementor\Controls_Manager::SELECT,
                            'prefix_class' => 'kng-full-content-with-space-',
                            'options'      => array(
                                'none'    => esc_html__( 'None', 'techrona' ),
                                'start'   => esc_html__( 'Start', 'techrona' ),
                                'end'     => esc_html__( 'End', 'techrona' ),
                                /*'start-wide'   => esc_html__( 'Start (Container Wide)', 'techrona' ),
                                'end-wide'     => esc_html__( 'End (Container Wide)', 'techrona' ),*/
                            ),
                            'default'      => 'none',
                            'condition' => [
                                'layout' => 'full_width'
                            ]
                        ),
                        // this field hasn't config prefix_class
                        // its value will be handled at techrona_custom_section_classes function
                        // screen shot - http://prntscr.com/tjco9g
                        array(
                            'name'    => 'column_hori_align',
                            'label'   => esc_html__( 'Horizontal Align', 'techrona' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'options' => array(
                                ''        => esc_html__( 'Default', 'techrona' ),
                                'start'   => esc_html__( 'Start', 'techrona' ),
                                'center'  => esc_html__( 'Center', 'techrona' ),
                                'end'     => esc_html__( 'End', 'techrona' ),
                                'around'  => esc_html__( 'Space Around', 'techrona' ),
                                'between' => esc_html__( 'Space Between', 'techrona' )
                            ),
                            'prefix_class' => 'kng-justify-content-',
                            'default'      => '',
                        ),
                        array(
                            'name'         => 'kng_boxed_bg',
                            'label'        => esc_html__( 'Boxed Background', 'techrona' ),
                            'type'         => \Elementor\Controls_Manager::SWITCHER,
                            'prefix_class' => 'kng-boxed-bg-',
                            'default'      => 'false',
                            'separator'    => 'before'
                        ),
                        array(
                            'name'      => 'kng_boxed_overlay',
                            'label'     => esc_html__( 'Overlay Color','techrona' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} > .kng-section-boxed-bg:before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'kng_boxed_bg' => 'true'
                            ], 
                        ),
                        array(
                            'name'           => 'kng_boxed_overlay_gradient',
                            'label'          => esc_html__( 'Overlay Gradient Color','techrona' ),
                            'type'           => \Elementor\Group_Control_Background::get_type(),
                            'control_type'   => 'group',
                            'types'          => [ 'gradient' ],
                            'fields_options' => [
                                'background' => [
                                    'frontend_available' => true,
                                ],
                            ],
                            'selector' => '{{WRAPPER}} > .kng-section-boxed-bg:after',
                            'condition' => [
                                'kng_boxed_bg' => 'true'
                            ]
                        ),
                        array(
                            'name'         => 'kng_boxed_bg_background',
                            'title'        => esc_html__( 'Boxed Background', 'techrona' ),
                            'type'         => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types'         => [ 'classic' ],
                            'fields_options' => [
                                'background' => [
                                    'frontend_available' => true,
                                ],
                            ],
                            'selector'  => '{{WRAPPER}} > .kng-section-boxed-bg',
                            'condition'    => [
                                'kng_boxed_bg' => ['true']
                            ]
                        ),
                        array(
                            'name'         => 'kng_boxed_divider',
                            'label'        => esc_html__( 'Boxed Divider', 'techrona' ),
                            'type'         => \Elementor\Controls_Manager::SWITCHER,
                            'prefix_class' => 'kng-section-boxed-divider-',
                            'default'      => 'false',
                            'separator'    => 'before'
                        ),
                        array(
                            'name'         => 'kng_boxed_divider_pos',
                            'label'        => esc_html__( 'Boxed Divider Position', 'techrona' ),
                            'type'         => \Elementor\Controls_Manager::SELECT,
                            'prefix_class' => 'kng-section-boxed-divider-',
                            'options'      => [
                                'top'    => esc_html__('Top', 'techrona'),
                                'bottom' => esc_html__('Bottom', 'techrona')
                            ],
                            'default'      => 'top',
                            'condition' => [
                                'kng_boxed_divider' => 'true'
                            ],
                        ),
                        array(
                            'name'      => 'kng_boxed_divider_color',
                            'label'     => esc_html__( 'Divider Color','techrona' ),
                            'type'      => \Elementor\Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} > .kng-section-boxed-divider' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'kng_boxed_divider' => 'true'
                            ], 
                        ),
                        array(
                            'name'      => 'kng_boxed_divider_h',
                            'label'     => esc_html__( 'Divider Height', 'techrona' ),
                            'type'      => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min'  => 1,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'size' => '1',
                            ],
                            'size_units' => [ 'px'],
                            'selectors' => [
                                '{{WRAPPER}} > .kng-section-boxed-divider' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'kng_boxed_divider' => 'true'
                            ] 
                        ),
                        array(
                            'name'       => 'kng_boxed_radius',
                            'label'      => esc_html__( 'Boxed Radius', 'techrona' ),
                            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%' ],
                            'selectors'  => [
                                '{{WRAPPER}}.kng-boxed-bg-true > .kng-section-boxed-bg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        )      
                    ),
                    array(
                        'name'     => 'kng_custom_layout_background_overlay',
                        'label'    => esc_html__( 'Custom Background Overlay', 'techrona' ),
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name'         => 'kng_overlay_background_position',
                                'label'        => esc_html__( 'Overlay position', 'techrona' ),
                                'type'         => \Elementor\Controls_Manager::SELECT,
                                'prefix_class' => 'kng-section-overvlay-with-space kng-section-overvlay-with-space-',
                                'options'      => array(
                                    'full'    => esc_html__( 'Full', 'techrona'),
                                    'start'   => esc_html__( 'Full - Space Start', 'techrona'),
                                    'end'     => esc_html__( 'Full - Space End', 'techrona'),
                                    'between' => esc_html__( 'Full - Space Between', 'techrona')
                                ),
                                'default'      => 'full'
                            ),
                            array(
                                'name'      => 'kng_overlay_background_color',
                                'label'     => esc_html__( 'Background Overlay Color','techrona' ),
                                'type'      => \Elementor\Controls_Manager::COLOR,
                                'default'   => '',
                                'selectors' => [
                                    '{{WRAPPER}} > .elementor-background-overlay:before' => 'background-color: {{VALUE}};',
                                ]
                            ),
                            array(
                                'name'    => 'kng_overlay_background_color_opacity',
                                'label'   => esc_html__( 'Opacity', 'techrona' ),
                                'type'    => \Elementor\Controls_Manager::SLIDER,
                                'default' => [
                                    'size' => 0.85,
                                ],
                                'range' => [
                                    'px' => [
                                        'max' => 1,
                                        'step' => 0.01,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} > .elementor-background-overlay:before' => 'opacity: {{SIZE}};',
                                ]
                            ),
                            array(
                                'name'       => 'kng_overlay_background_radius',
                                'label'      => esc_html__( 'Border Radius', 'techrona' ),
                                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px', '%' ],
                                'selectors'  => [
                                    '{{WRAPPER}} > .elementor-background-overlay, {{WRAPPER}} > .elementor-background-overlay:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ]
                            )
                        ),
                        'condition' => [
                            'background_overlay_background' => [ 'classic', 'gradient' ],
                        ]
                    ),
                    array(
                        'name'     => 'kng_default_row_overlay',
                        'tab'      => \Elementor\Controls_Manager::TAB_STYLE,
                        'label'    => esc_html__( 'Default Overlay', 'techrona' ),
                        'controls' => array(
                            array(
                                'name'         => 'kng_overlay_gradient',
                                'label'        => esc_html__( 'Overlay Gradient', 'techrona' ),
                                'type'         => \Elementor\Controls_Manager::SELECT,
                                'prefix_class' => 'kng-overlay-gradient-',
                                'options'      => array(
                                    ''    => __( 'None', 'techrona'),
                                    '1'   => __( 'Gradient 01', 'techrona')
                                ),
                                'default' => ''
                            )
                        )
                    )
                )
            )
        );
    }
}

// add html to before row
if(!function_exists('techrona_boxed_bg')){
    //add_filter('kng-custom-section/before-elementor-row', 'techrona_boxed_bg', 10 , 2);
    function techrona_boxed_bg( $html, $settings){
        $html .= '<div class="kng-overlay-gradient"></div>';
        $html .= '<div class="kng-section-boxed-bg"></div>';
        return $html;
    }
}
if(!function_exists('techrona_boxed_divider')){
    //add_filter('kng-custom-section/before-elementor-row', 'techrona_boxed_divider', 11 , 2);
    function techrona_boxed_divider( $html, $settings){
        $html .= '<div class="kng-section-boxed-divider"></div>';
        return $html;
    }
}
// add html to after row
if(!function_exists('techrona_elementor_section_carousel_arrows')){
    //add_filter('kng-custom-section/after-elementor-row', 'techrona_elementor_section_carousel_arrows', 11 , 2);
    function techrona_elementor_section_carousel_arrows( $html, $settings){
        $html .= '<div class="kng-elementor-section-carousel-arrows"></div>';
        $html .= '<div class="kng-elementor-section-carousel-dots"></div>';
        return $html;
    }
}

 