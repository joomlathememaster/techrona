<?php
// Register Accordion Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_faq',
        'title'      => esc_html__( 'KNG FAQ', 'techrona' ),
        'icon'       => 'eicon-faq',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'kng-accordion'
        ),
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_faq-1.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-faq-layout-'
                        ),
                    ),
                ),
                array(
                    'name'     => 'source_section',
                    'label'    => esc_html__( 'Source Settings', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'    => 'number_faq_case',
                            'label'   => esc_html__('Number of Cases','techrona'),
                            'type'    => 'select',
                            'options' => [
                                '1' => '1',
                                '2' => '2',
                                '3' => '3',
                                '4' => '4'
                            ],
                            'default' => '4'
                        ),
                        array(
                            'name' => 'filter_top_align',
                            'label' => esc_html__('Filter Top Alignment', 'techrona' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => techrona_text_align_opts(),
                            'default'      => 'start'
                        ),
                        array(
                            'name'      => 'case1_heading',
                            'label'     => esc_html__( 'Heading 1', 'techrona' ),
                            'type'      => 'text',
                            'separator' => 'before',
                            'condition'    => [ 'number_faq_case' => ['1','2','3','4'] ]
                        ),
                        array(
                            'name'      => 'case1_active_section',
                            'label'     => esc_html__( 'Active section', 'techrona' ),
                            'type'      => 'number',
                            'condition'    => [ 'number_faq_case' => ['1','2','3','4'] ]
                        ),
                        array(
                            'name'    => 'case1_faq_items',
                            'label'   => esc_html__( 'FAQ Items', 'techrona' ),
                            'type'    => 'repeater',
                            'default' => [
                                [
                                    'faq_title'   => esc_html__( 'FAQ #1', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                                [
                                    'faq_title'   => esc_html__( 'FAQ #2', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name'  => 'faq_title',
                                    'label' => esc_html__( 'Title', 'techrona' ),
                                    'type'  => 'text',
                                    'label_block' => true
                                ),
                                array(
                                    'name'  => 'faq_content',
                                    'label' => esc_html__( 'Content', 'techrona' ),
                                    'type'  => 'textarea',
                                    'rows'  => 10,
                                ),
                            ),
                            'title_field' => '{{{ faq_title }}}',
                            'condition'    => [ 'number_faq_case' => ['1','2','3','4'] ]
                        ),

                        array(
                            'name'      => 'case2_heading',
                            'label'     => esc_html__( 'Heading 2', 'techrona' ),
                            'type'      => 'text',
                            'separator' => 'before',
                            'condition'    => [ 'number_faq_case' => ['2','3','4'] ]
                        ),
                        array(
                            'name'      => 'case2_active_section',
                            'label'     => esc_html__( 'Active section', 'techrona' ),
                            'type'      => 'number',
                            'condition'    => [ 'number_faq_case' => ['2','3','4'] ]
                        ),
                        array(
                            'name'    => 'case2_faq_items',
                            'label'   => esc_html__( 'FAQ Items', 'techrona' ),
                            'type'    => 'repeater',
                            'default' => [
                                [
                                    'faq_title'   => esc_html__( 'FAQ #1', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                                [
                                    'faq_title'   => esc_html__( 'FAQ #2', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name'  => 'faq_title',
                                    'label' => esc_html__( 'Title', 'techrona' ),
                                    'type'  => 'text',
                                    'label_block' => true
                                ),
                                array(
                                    'name'  => 'faq_content',
                                    'label' => esc_html__( 'Content', 'techrona' ),
                                    'type'  => 'textarea',
                                    'rows'  => 10,
                                ),
                            ),
                            'title_field' => '{{{ faq_title }}}',
                            'condition'    => [ 'number_faq_case' => ['2','3','4'] ]
                        ),

                        array(
                            'name'      => 'case3_heading',
                            'label'     => esc_html__( 'Heading 3', 'techrona' ),
                            'type'      => 'text',
                            'separator' => 'before',
                            'condition'    => [ 'number_faq_case' => ['3','4'] ]
                        ),
                        array(
                            'name'      => 'case3_active_section',
                            'label'     => esc_html__( 'Active section', 'techrona' ),
                            'type'      => 'number',
                            'condition'    => [ 'number_faq_case' => ['3','4'] ]
                        ),
                        array(
                            'name'    => 'case3_faq_items',
                            'label'   => esc_html__( 'FAQ Items', 'techrona' ),
                            'type'    => 'repeater',
                            'default' => [
                                [
                                    'faq_title'   => esc_html__( 'FAQ #1', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                                [
                                    'faq_title'   => esc_html__( 'FAQ #2', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name'  => 'faq_title',
                                    'label' => esc_html__( 'Title', 'techrona' ),
                                    'type'  => 'text',
                                    'label_block' => true
                                ),
                                array(
                                    'name'  => 'faq_content',
                                    'label' => esc_html__( 'Content', 'techrona' ),
                                    'type'  => 'textarea',
                                    'rows'  => 10,
                                ),
                            ),
                            'title_field' => '{{{ faq_title }}}',
                            'condition'    => [ 'number_faq_case' => ['3','4'] ]
                        ),

                        array(
                            'name'      => 'case4_heading',
                            'label'     => esc_html__( 'Heading 4', 'techrona' ),
                            'type'      => 'text',
                            'separator' => 'before',
                            'condition'    => [ 'number_faq_case' => ['4'] ]
                        ),
                        array(
                            'name'      => 'case4_active_section',
                            'label'     => esc_html__( 'Active section', 'techrona' ),
                            'type'      => 'number',
                            'condition'    => [ 'number_faq_case' => ['4'] ]
                        ),
                        array(
                            'name'    => 'case4_faq_items',
                            'label'   => esc_html__( 'FAQ Items', 'techrona' ),
                            'type'    => 'repeater',
                            'default' => [
                                [
                                    'faq_title'   => esc_html__( 'FAQ #1', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                                [
                                    'faq_title'   => esc_html__( 'FAQ #2', 'techrona' ),
                                    'faq_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'techrona' ),
                                ],
                            ],
                            'controls' => array(
                                array(
                                    'name'  => 'faq_title',
                                    'label' => esc_html__( 'Title', 'techrona' ),
                                    'type'  => 'text',
                                    'label_block' => true
                                ),
                                array(
                                    'name'  => 'faq_content',
                                    'label' => esc_html__( 'Content', 'techrona' ),
                                    'type'  => 'textarea',
                                    'rows'  => 10,
                                ),
                            ),
                            'title_field' => '{{{ faq_title }}}',
                            'condition'    => [ 'number_faq_case' => ['4'] ]
                        )
                    )
                )
                
            ),
        ),
    ),
    get_template_directory() . '/elements/classes/'
);