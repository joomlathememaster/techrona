<?php
if(!class_exists('Newsletter')) return;
// Register KNG Newsletter
kng_add_custom_widget(
    array(
		'name'       => 'kng_newsletter',
		'title'      => esc_html__( 'KNG Newsletter', 'techrona' ),
		'icon'       => 'eicon-mail',
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
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/newletter-1.jpg'
                                ]                 
                            ]    
                        )
                    )
                ),
                array(
					'name'     => 'content_section',
					'label'    => esc_html__( 'Content', 'techrona' ),
					'tab'      => 'content',
					'controls' => array(
                        array(
                            'name'        => 'email_text',
                            'label'       => esc_html__( 'Email Text', 'techrona' ),
                            'type'        => 'text',
                            'placeholder' => esc_html__( 'Enter placeholder text', 'techrona' ),
                            'label_block' => true
                        )
                    )
                )
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);