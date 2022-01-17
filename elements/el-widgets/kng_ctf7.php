<?php
// Register Contact Form 7 Widget
if(class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->ID] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'techrona')] = 0;
    }

    kng_add_custom_widget(
        array(
            'name'       => 'kng_ctf7',
            'title'      => esc_html__('KNG Contact Form 7', 'techrona'),
            'icon'       => 'eicon-form-horizontal',
            'categories' => array('kngtheme-core'),
            'scripts'    => array(),
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
                                        'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_ctf7-1.jpg'
                                    ],
                                    '2' => [
                                        'label' => esc_html__( 'Layout 2', 'techrona' ),
                                        'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_ctf7-2.jpg'
                                    ],
                                    '3' => [
                                        'label' => esc_html__( 'Layout 3', 'techrona' ),
                                        'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_ctf7-3.jpg'
                                    ],
                                    '4' => [
                                        'label' => esc_html__( 'Layout 4', 'techrona' ),
                                        'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_ctf7-4.jpg'
                                    ]
                                ],
                                'prefix_class' => 'kng-cf7-layout-'
                            )
                        )
                    ),
                    array(
                        'name'     => 'source_section',
                        'label'    => esc_html__('Source Settings', 'techrona'),
                        'tab'      => 'content',
                        'controls' => array(
                            array(
                                'name'        => 'bg_color',
                                'label'       => esc_html__( 'Background Color', 'techrona' ),
                                'type'        => 'color',
                                'selectors'  => [
                                    '{{WRAPPER}} .kng-cf7-inner' => 'background-color:{{VALUE}};'
                                ]
                            ),
                            array(
                                'name'        => 'form_title',
                                'label'       => esc_html__( 'Form Title', 'techrona' ),
                                'type'        => 'text',
                                'default'     => esc_html__( 'Request An Estimate', 'techrona' ),
                                'label_block' => true,
                            ),
                            array(
                                'name'        => 'form_desc',
                                'label'       => esc_html__( 'Form Description', 'techrona' ),
                                'type'        => 'textarea',
                                'default'     => __( 'For a cleaning that meets your highest standards, you need a dedicated team of trained specialists with all supplies needed to thoroughly clean your home.', 'techrona' ),
                                'label_block' => true
                            ),
                            array(
                                'name'    => 'ctf7_id',
                                'label'   => esc_html__('Select Form', 'techrona'),
                                'type'    => 'select',
                                'options' => $contact_forms,
                            )
                        )
                    ) 
                )
            )
        ),
        get_template_directory() . '/elements/classes/'
    );
}