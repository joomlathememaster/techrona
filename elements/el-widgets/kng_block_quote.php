<?php
// Register Fancy Box Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_block_quote',
        'title'      => esc_html__( 'KNG Block Quote', 'techrona' ),
        'icon'       => 'eicon-blockquote',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'techrona' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        techrona_elementor_text_align(['default' => '']),
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'techrona' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_block_quote-1.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-blockquote-layout-'
                        )
                    )
                ),
                array(
                    'name'     => 'text_section',
                    'label'    => esc_html__( 'Content & Client Name', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'bq_content',
                            'label'    => esc_html__('Content', 'techrona'),
                            'type'     => 'textarea',
                            'default'  => esc_html__('“When you think ‘I know’ and ‘it is,’ you have the illusion of knowing, the illusion of certainty, and then you’re mindless”', 'techrona')
                        ),
                        array(
                            'name'     => 'bq_client_name',
                            'label'    => esc_html__('Client Name', 'techrona'),
                            'type'     => 'text',
                            'label_block' => true,
                            'default'  => 'Kristoffer Nolan'
                        ) 
                    )
                ), 
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);