<?php
// Register Heading Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_heading',
        'title'      => esc_html__( 'KNG Heading', 'techrona' ),
        'icon'       => 'eicon-t-letter',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'kng-animation'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'techrona' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => techrona_text_align_opts(),
                        ),
                    )
                ),
                array(
                    'name' => 'title_section',
                    'label' => esc_html__('Title', 'techrona' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'techrona' ),
                            'type' => 'textarea',
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('Heading HTML Tag', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'span' => 'span',
                                'p' => 'p',
                            ],
                            'default' => 'h3',
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-heading-wrap .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'techrona' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .kng-heading-wrap .item-title',
                        ),
                        array(
                            'name'      => 'heading_animate',
                            'label'     => esc_html__( 'Motion Effect', 'techrona' ),
                            'type'      => 'animation'
                        ),
                        array(
                            'name'      => 'heading_animation_delay',
                            'label'     => esc_html__( 'Transition Delay', 'techrona' ),
                            'type'      => 'text'
                        ),     
                    ),
                ),
                array(
                    'name' => 'sub_title_section',
                    'label' => esc_html__('Sub Title', 'techrona' ),
                    'tab' => 'content',
                    'controls' => array(
                        
                        array(
                            'name' => 'sub_title',
                            'label' => esc_html__('Sub Title', 'techrona' ),
                            'type' => 'textarea',
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'techrona' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .kng-heading-wrap .item-sub-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .kng-heading-wrap .item-sub-title span:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .kng-heading-wrap .item-sub-title span:after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_title_typography',
                            'label' => esc_html__('Sub Title Typography', 'techrona' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .kng-heading-wrap .item-sub-title',
                        ),
                        array(
                            'name'         => 'sub_title_ontop',
                            'label'        => esc_html__( 'On Top', 'techrona' ),
                            'type'         => 'switcher',
                            'default'      => '',
                            'label_on'     => 'Hide',
                            'label_off'    => 'Show',
                            'condition'    => ['layout' => '1']
                        ),
                        array(
                            'name' => 'sub_title_space',
                            'label' => esc_html__('Margin(px)', 'techrona' ),
                            'type' => 'dimensions',
                            'allowed_dimensions' => 'vertical',
                            'default' => ['top' => '', 'right' => '', 'bottom' => '', 'left' => ''],
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .kng-heading-wrap .item-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_title_style',
                            'label' => esc_html__('Style', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                'style-default' => 'Default',
                                'style-divider' => 'Divider',
                            ],
                            'default' => 'style-default',
                            'condition'    => ['layout' => '2']
                        ),
                        array(
                            'name'      => 'sub_heading_animate',
                            'label'     => esc_html__( 'Motion Effect', 'techrona' ),
                            'type'      => 'animation'
                        ),
                        array(
                            'name'      => 'sub_heading_animation_delay',
                            'label'     => esc_html__( 'Transition Delay', 'techrona' ),
                            'type'      => 'text'
                        ),
                    ),
                ),
                 
            ),
        ),
    ),
    get_template_directory() . '/elements/classes/'
);