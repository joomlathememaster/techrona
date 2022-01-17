<?php
// Add custom field to column
if(!function_exists('techrona_custom_column_params')){
    add_filter('kng-custom-column/custom-params', 'techrona_custom_column_params');
    function techrona_custom_column_params(){
        return array(
            'sections' => array(
                array(
					'name'     => 'custom_section',
					'label'    => esc_html__( 'Custom Settings', 'techrona' ),
					'tab'      => \Elementor\Controls_Manager::TAB_LAYOUT,
					'controls' => array(
                        array(
                            'name'    => 'element_auto_width',
                            'label'   => esc_html__( 'Element Auto Width', 'techrona' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'options' => array(
                                'default'           => esc_html__( 'Default', 'techrona' ),
                                'auto'   => esc_html__( 'Auto', 'techrona' ),
                                'col-12 col-lg-10 col-xl-8'   => esc_html__( 'Col xl 8', 'techrona' )
                            ),
                            'control_type' => 'responsive',
                            'label_block'  => true, 
                            'default'      => 'default',
                            'prefix_class' => 'kng-column-element%s-'
                        ),
                        array(
                            'name'    => 'element_column_align',
                            'label'   => esc_html__( 'Elements Align', 'techrona' ),
                            'type'    => \Elementor\Controls_Manager::CHOOSE,
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
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'techrona' ),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'control_type' => 'responsive',
                            'default'      => '',
                            'selectors'  => [
                                '{{WRAPPER}} > .elementor-widget-wrap' => 'justify-content: {{value}}',
                            ]
                            //'prefix_class' => 'justify-content-%s-'
                        )
                    )
                )
            )
        );
    }
}