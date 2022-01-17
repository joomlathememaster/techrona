<?php
// Register Video Player Widget
kng_add_custom_widget(
    array(
        'name'       => 'kng_video',
        'title'      => esc_html__('KNG Video', 'techrona' ),
        'icon'       => 'eicon-play',
        'categories' => array('kngtheme-core'),
        'scripts'    => array(
            'jquery',
            'magnific-popup'
        ),
        'styles'     => array(
            'magnific-popup'
        ),
        'params'     => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'techrona' ),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__('Templates', 'techrona' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'techrona' ),
                                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/video-layout-1.jpg'
                                ]
                            ],
                            'prefix_class' => 'kng-video-layout-'
                        )
                    )
                ),
                array(
                    'name'     => 'video_section',
                    'label'    => esc_html__('Video', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array_merge(                        
                        array(   
                            array(
                                'name'        => 'video_link',
                                'label'       => esc_html__( 'Video URL', 'techrona' ),
                                'description' => '(https://www.youtube.com/watch?v=F_7ZoAQ3aJM)',
                                'type'        => \Elementor\Controls_Manager::URL,
                                'default'     => [
                                    'url'         => 'https://www.youtube.com/watch?v=F_7ZoAQ3aJM',
                                    'is_external' => 'on'
                                ]                    
                            ),                      
                            array(
                                'name'             => 'play_icon_icon',
                                'label'            => esc_html__( 'Play Icon', 'techrona' ),
                                'type'             => 'icons',
                                'default'          => [
                                    'library'   => 'techrona',
                                    'value'     => 'icon-play'
                                ] 
                            )
                        )
                    )
                ),
                array(
                    'name'     => 'image_section',
                    'label'    => esc_html__('Image Overlay', 'techrona' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'    => 'video_image_overlay',
                            'label'   => esc_html__( 'Choose Image', 'techrona' ),
                            'type'    => 'media',
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src()
                            ]
                        ),
                        array(
                            'name'         => 'video_image_overlay_size',
                            'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default'      => 'full',
                            'separator'    => 'none',
                        ),
                        array(
                            'name'        => 'bg_color',
                            'label'       => esc_html__( 'Background Color', 'techrona' ),
                            'type'        => 'color',
                            'selectors'  => [
                                '{{WRAPPER}} .kng-video-player .kng-overlay' => 'background-color:{{VALUE}};'
                            ]
                        ),
                    )
                ),
                array(
                    'name'     => 'style_section',
                    'label'    => esc_html__('General', 'techrona' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name'    => 'label_button',
                                'label'   => esc_html__( 'Button', 'techrona' ),
                                'type'    => 'heading',                         
                            )
                        ),
                        techrona_elementor_color([
                            'name' => 'button_color',
                            'selector' => [
                                '{{WRAPPER}} .kng-video-btn' => 'background-color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Color', 'techrona'),
                            'condition' => [],
                        ]),
                        techrona_elementor_color([
                            'name' => 'button_color_hover',
                            'selector' => [
                                '{{WRAPPER}} .kng-video-btn:hover' => 'background-color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Hover Color', 'techrona'),
                            'condition' => [],
                        ]),
                        array(
                            array(
                                'name'    => 'label_icon',
                                'label'   => esc_html__( 'icon', 'techrona' ),
                                'type'    => 'heading', 
                                'separator' => 'before'                           
                            )
                        ),
                        techrona_elementor_color([
                            'name' => 'icon_color',
                            'selector' => [
                                '{{WRAPPER}} .video-icon' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Color', 'techrona'),
                            'condition' => [],
                        ]),
                        techrona_elementor_color([
                            'name' => 'icon_color_hover',
                            'selector' => [
                                '{{WRAPPER}} .kng-video-btn:hover .video-icon' => 'color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Hover Color', 'techrona'),
                            'condition' => [],
                        ]),
                        array(
                            array(
                                'name'    => 'label_ripple',
                                'label'   => esc_html__( 'Ripple', 'techrona' ),
                                'type'    => 'heading', 
                                'separator' => 'before'                        
                            )
                        ),
                        techrona_elementor_color([
                            'name' => 'ripple_color',
                            'selector' => [
                                '{{WRAPPER}} .kng-video-btn:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .kng-video-btn:after' => 'background-color: {{VALUE}};',
                            ],
                            'label' => esc_html__('Ripple Color', 'techrona'),
                            'condition' => [],
                        ]),
                    )
                ) 
            )
        )
    ),
    get_template_directory() . '/elements/classes/'
);