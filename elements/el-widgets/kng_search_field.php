<?php
// Register Button Widget
kng_add_custom_widget(
    array(
        'name' => 'kng_search_field',
        'title' => esc_html__('Kng Search Field', 'techrona' ),
        'icon' => 'eicon-search',
        'categories' => array('kngtheme-core'),
        'params' => array(
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_search-1.jpg'
                                ]             
                            ]      
                        ),
                        array(
                            'name' => 'search_type',
                            'label' => esc_html__('Search Type', 'techrona' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Default', 'techrona'),
                                '2' => esc_html__('Product', 'techrona'),
                            ],
                            'default' => '1',
                        )
                    )
                ),
                array(
                    'name'     => 'text_section',
                    'label'    => esc_html__( 'Setting', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'         => 'content_align',
                            'label'        => esc_html__( 'Content Alignment', 'techrona' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options'      => techrona_text_align_opts(),
                            'default'      => 'start'
                        ),
                        array(
                            'name'     => 'placeholder',
                            'label'    => esc_html__('Placeholder text', 'techrona'),
                            'type'     => 'text',
                            'label_block' => true,
                            'default'  => 'Search for items...'
                        ),
                        array(
                            'name'    => 'search_text_width',
                            'label'   => esc_html__( 'Search text width', 'techrona' ),
                            'type'    => 'slider',
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px' ],
                            'default' => [
                                'unit' => 'px'
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 200,
                                    'max' => 1200,
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .search-field' => 'width: {{SIZE}}{{UNIT}}'
                            ],
                        ), 
                    )
                ),  
            ),
        ),
    ),
    get_template_directory() . '/elements/classes/'
);