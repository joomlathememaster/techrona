<?php

/**
 * Extra Elementor Icons
*/
if(!function_exists('techrona_register_custom_icon_library')){
    add_filter('elementor/icons_manager/native', 'techrona_register_custom_icon_library');
    function techrona_register_custom_icon_library($tabs){
        $custom_tabs = [
            // 'kngi_icon' => [
            //     'name'          => 'kngi-icon',
            //     'label'         => esc_html__( 'KNG Icons', 'techrona' ),
            //     'url'           => get_template_directory_uri() . '/assets/fonts/font-kngi/style.css',
            //     'enqueue'       => [],
            //     'prefix'        => 'icon-',
            //     'displayPrefix' => '',
            //     'labelIcon'     => 'kngi-arrow-circle-right',
            //     'ver'           => '1.0.0',
            //     'fetchJson'     => get_template_directory_uri() . '/assets/fonts/font-techrona.js',
            //     'native'        => true,
            // ],
            'techrona-icon' => [
                'name'          => 'techrona-icon',
                'label'         => esc_html__( 'Techrona Icons', 'techrona' ),
                'url'           => get_template_directory_uri() . '/assets/fonts/font-kngi/style.css',
                'enqueue'       => [],
                'prefix'        => 'icon-',
                'displayPrefix' => '',
                'ver'           => '1.0.0',
                'fetchJson'     => get_template_directory_uri() . '/assets/fonts/font-techrona.js',
                'native'        => true,
            ]
            // 'kngf_icon' => [
            //     'name'          => 'kngf-icon',
            //     'label'         => esc_html__( 'KNG Flat Icons', 'techrona' ),
            //     'url'           => get_template_directory_uri() . '/assets/fonts/font-kngf/flaticon.css',
            //     'enqueue'       => [],
            //     'prefix'        => 'kngf-',
            //     'displayPrefix' => '',
            //     'labelIcon'     => 'kngi-arrow-circle-right',
            //     'ver'           => '1.0.0',
            //     'fetchJson'     => get_template_directory_uri() . '/assets/fonts/font-kngf.js',
            //     'native'        => true,
            // ],
            // 'kngfi_icon' => [
            //     'name'          => 'kngfi-icon',
            //     'label'         => esc_html__( 'KNG Flat Icons 1', 'techrona' ),
            //     'url'           => get_template_directory_uri() . '/assets/fonts/font-kngfi/flaticon1.css',
            //     'enqueue'       => [],
            //     'prefix'        => 'kngfi-',
            //     'displayPrefix' => '',
            //     'labelIcon'     => 'kngi-arrow-circle-right',
            //     'ver'           => '1.0.0',
            //     'fetchJson'     => get_template_directory_uri() . '/assets/fonts/font-kngfi.js',
            //     'native'        => true,
            // ],
        ];
        $tabs = array_merge($custom_tabs, $tabs);
        return $tabs;
    }
}

// Exclude Post type 
function techrona_excluded_post_type(){
    $DefaultExcludedPostTypes = [
        'page',
        'attachment',
        'revision',
        'nav_menu_item',
        'vc_grid_item',
        'custom_css',
        'customize_changeset',
        'oembed_cache',
        'kng-mega-menu',
        'elementor_library'
    ];
    $ExtraExcludedPostTypes = apply_filters('kng_get_post_types', []);
    $excludedPostTypes      = array_merge($DefaultExcludedPostTypes, $ExtraExcludedPostTypes );
    return $excludedPostTypes;
}

function techrona_get_thumbnail_size(){
    $thumbnail_size = techrona_configs('thumbnails'); 
    $custom_sizes = techrona_configs('custom_sizes');
    $list = [];
    foreach ($thumbnail_size as $option => $values) {
        $sizes = array_values($values);
        $list[$option] = ucfirst($option).' - '. $sizes[0].' X '.$sizes[1];
    } 
    foreach ($custom_sizes as $option => $values) {
        $list[$option] = ucfirst($option).' - '. $values[0].' X '.$values[1];
    }
    $list['full'] = esc_html__( 'Full', 'techrona' );
    $list['custom'] = esc_html__( 'Custom', 'techrona' );
    return $list;
}
/**
 * Get Page List 
 * @return array 
*/
if(!function_exists('techrona_elementor_list_page_opts')){
    function techrona_elementor_list_page_opts($post_type = 'page', $default = ['value' => '', 'label' => 'None'] ){
        $page_list = array();
        if(!empty($default))
            $page_list[$default['value']] = $default['label'];
        $pages = get_pages(array('post_type' => $post_type, 'hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->ID] = $page->post_title;
        }
        return $page_list;
    }
}
/**
 * Get post List 
 * @return array 
*/
if(!function_exists('techrona_elementor_list_post_opts')){
    function techrona_elementor_list_post_opts($post_type = 'post', $default = []){
        $page_list = array();
        if(!empty($default))
            $page_list[$default['value']] = $default['label'];
        $pages = get_posts(array('post_type' => $post_type, 'hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->ID] = $page->post_title;
        }
        return $page_list;
    }
}
function techrona_get_post_carousel_layout(){
    $post_types = get_post_types([
        'public'   => true,
        //'_builtin' => false
    ], 'objects');
    $excludedPostTypes      = techrona_excluded_post_type();
    $result = [];
    if (!is_array($post_types))
        return $result;


    foreach ($post_types as $post_type) {
        if (!$post_type instanceof WP_Post_Type)
            continue;
        if (in_array($post_type->name, $excludedPostTypes))
            continue;
 
        $result[] = array(
            'name'     => 'layout_'.$post_type->name,
            'label'    => sprintf(esc_html__( 'Select Templates of %s', 'techrona' ), $post_type->labels->singular_name),
            'type'     => 'layoutcontrol',
            'default' => '1',
            'options'  => techrona_get_carousel_layout_options($post_type->name),
            'prefix_class' => 'kng-post-layout-',
            'condition' => [
                'post_type' => [$post_type->name]
            ]
        );
    }

    return $result;
}
function techrona_get_post_grid_layout(){
    $post_types = get_post_types([
        'public'   => true,
        //'_builtin' => false
    ], 'objects');
    $excludedPostTypes      = techrona_excluded_post_type();

    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $post_type) {
        if (!$post_type instanceof WP_Post_Type)
            continue;
        if (in_array($post_type->name, $excludedPostTypes))
            continue;
 
        $result[] = array(
            'name'     => 'layout_'.$post_type->name,
            'label'    => sprintf(esc_html__( 'Select Templates of %s', 'techrona' ), $post_type->labels->singular_name),
            'type'     => 'layoutcontrol',
            'default' => '1',
            'options'  => techrona_get_grid_layout_options($post_type->name),         
            'condition' => [
                'post_type' => [$post_type->name]
            ]
        );
    }

    return $result;     
}
function techrona_get_grid_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'service':
            $option_layouts = [
                '1-service' => [
                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/service-1.jpg'
                ],
                '2-service' => [
                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/service-2.jpg'
                ]      
            ];
            break;
        // case 'practice':
        //     $option_layouts = [
        //         '1-practice' => [
        //             'label' => esc_html__( 'Layout 1', 'techrona' ),
        //             'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-1-practice.jpg'
        //         ],
        //         '2-practice' => [
        //             'label' => esc_html__( 'Layout 2', 'techrona' ),
        //             'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-2-practice.jpg'
        //         ],
        //         '3-practice' => [
        //             'label' => esc_html__( 'Layout 3', 'techrona' ),
        //             'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-3-practice.jpg'
        //         ]
        //     ];
        //     break;
        default: // post type = post
            $option_layouts = [
                '1' => [
                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-1.jpg'
                ],
                '2' => [
                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-2.jpg'
                ],
                '3' => [
                    'label' => esc_html__( 'Layout 3', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-3.jpg'
                ],
                '4' => [
                    'label' => esc_html__( 'Layout 4', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-4.jpg'
                ],
                '5' => [
                    'label' => esc_html__( 'Layout 5', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-5.jpg'
                ]
            ];
            break;
    }
    return $option_layouts;
}
function techrona_get_carousel_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'case':
            $option_layouts = [
                '1-case' => [
                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-1-case.jpg'
                ],
                '2-case' => [
                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-2-case.jpg'
                ]
            ];
            break;
        case 'practice':
            $option_layouts = [
                '1-practice' => [
                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-1-practice.jpg'
                ],
                '2-practice' => [
                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-2-practice.jpg'
                ],
                '3-practice' => [
                    'label' => esc_html__( 'Layout 3', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-3-practice.jpg'
                ]
            ];
            break;
        default: // post type = post
            $option_layouts = [
                '1' => [
                    'label' => esc_html__( 'Layout 1', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-1.jpg'
                ],
                '2' => [
                    'label' => esc_html__( 'Layout 2', 'techrona' ),
                    'image' => get_template_directory_uri() . '/elements/el-widgets/layouts/kng_post_grid-2.jpg'
                ]
            ];
            break;
    }
    return $option_layouts;
}
/**
 * Term option for post type
 * make option for elementor element option 
*/
if(!function_exists('techrona_get_grid_term_by_post_type_options')){
    function techrona_get_grid_term_by_post_type_options($args=[]){
        $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
        $post_types = get_post_types([
            'public'   => true,
            //'_builtin' => false
        ], 'objects');
        $excludedPostTypes      = techrona_excluded_post_type();

        

        $result = [];
        if (!is_array($post_types))
            return $result;
        foreach ($post_types as $post_type) {
            if (!$post_type instanceof WP_Post_Type)
                continue;
            if (in_array($post_type->name, $excludedPostTypes))
                continue;

            $taxonomy = get_object_taxonomies($post_type->name, 'names');
            
            if($post_type->name == 'post') $taxonomy = ['category'];
            if($post_type->name == 'product') $taxonomy = ['product_cat'];

            $result[] = array(
                'name'     => 'source_'.$post_type->name,
                'label'    => sprintf(esc_html__( 'Select Term of %s', 'techrona' ), $post_type->labels->singular_name),
                'type'     => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => kng_get_grid_term_options($post_type->name,$taxonomy),
                'condition' => array_merge(
                    [
                        $args['condition'] => [$post_type->name]
                    ],
                    $args['custom_condition']
                )
            );
        }

        return $result;
    }
}
if(!function_exists('kng_get_term_options')){
    function kng_get_term_options($args=[]){
        $args = wp_parse_args($args, ['taxonomy' => 'post_tag', 'hide_empty' => false]);
        $term_options = get_terms( $args );
         
        $options = array();
        if(!empty($term_options) && count($term_options) > 0){
            foreach($term_options as $term){
                $options[$term->slug] = $term->name;
            }
        }
        return $options;
    }
}
if(!function_exists('kng_get_product_grid_term_options')){
    function kng_get_product_grid_term_options($args=[]){
        $product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
        $options = array();
        foreach($product_categories as $category){
            $options[$category->slug] = $category->name;
        }
        return $options;
    }
}

if(!function_exists('techrona_elementor_link_to_post_opts')){
    function techrona_elementor_link_to_post_opts($args=[]){
        $args = wp_parse_args($args, [
            'prefix'           => '',
            'condition'        => '',
            'custom_condition' => []
        ]);
        $post_types = get_post_types([
            'public'   => true,
            //'_builtin' => false
        ], 'objects');
        $excludedPostTypes = techrona_excluded_post_type();
        $result = [];
        if (!is_array($post_types))
            return $result;
        foreach ($post_types as $post_type) {
            if (!$post_type instanceof WP_Post_Type)
                continue;
            if (in_array($post_type->name, $excludedPostTypes))
                continue;
            $result[] = array(
                'name'     => $args['prefix'].'link_'.$post_type->name,
                'label'    => sprintf(esc_html__( '%s Link', 'techrona' ), $post_type->labels->singular_name),
                'type'     => \Elementor\Controls_Manager::SELECT,
                'options'  => techrona_elementor_list_post_opts($post_type->name),
                'condition' => array_merge(
                    [
                        $args['condition'] => [$post_type->name]
                    ],
                    $args['custom_condition']
                )
            );
        }
        return $result;
    }
}
 

/**
 * Elementor Default Image
*/
function techrona_elementor_opt_default_image($name){
    return get_template_directory_uri() .'/assets/images/'.$name;
}
/**
 * Elementor Text Settings
*/
function techrona_elementor_text_settings($args){
    $args = wp_parse_args($args, [
        'label'     => esc_html__( 'Heading', 'techrona' ),
        'name'      => 'text',
        'selector'  => '.text',
        'separator' => '',
        'default'   => __('Your Heading','techrona'),
        'effect'    => true
    ]);
    $default = array(
        array(
            'name'        => $args['name'],
            'label'       => $args['label'],
            'type'        => \Elementor\Controls_Manager::TEXTAREA,
            'placeholder' => esc_html__( 'Enter your text', 'techrona' ),
            'default'     => $args['default'],  
            'label_block' => true,
            'separator'   => $args['separator'],
            'dynamic' => [
                'active' => true,
            ],
        ),
        array(
            'name'        => $args['name'].'_tag',
            'label'       => $args['label'].' '.__('Tag','techrona'),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'options'     => [
                'h1' => 'H1',
                'h2'   => 'H2',
                'h3'   => 'H3',
                'h4'   => 'H4',
                'h5'   => 'H5',
                'h6'   => 'H6',
                'div'  => 'div',
                'span' => 'span',
                'p'    => 'p',
                ''     => __('Default','techrona')
            ],  
            'description' => esc_html__( 'Choose HTML tag use for this element', 'techrona' ),
            'default'     => '',  
            'label_block' => true,
            'separator'   => $args['separator'],
            'condition'    => [
                $args['name'].'!' => ''
            ],
        ),
        array(
            'name'         => $args['name'].'_typo',
            'type'         => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector'     => '{{WRAPPER}} '.$args['selector'],
            'condition'    => [
                $args['name'].'!' => ''
            ],
        ),
        array(
            'name'         => $args['name'].'_shadow',
            'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
            'control_type' => 'group',
            'selector'     => '{{WRAPPER}} '.$args['selector'],
            'condition'    => [
                $args['name'].'!' => ''
            ],
        ),
        array(
            'name'      => $args['name'].'_extra_space',
            'label'     => esc_html__( 'Extra bottom Space', 'techrona' ),
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'selectors'  => [
                '{{WRAPPER}} '.$args['selector'].' + .extra-space' => 'margin-bottom:{{VALUE}}px;'
            ],
            'condition' => [
                $args['name'].'!' => '',
            ],
        ),
        array(
            'name'        => $args['name'].'_color',
            'label'       => esc_html__( 'Color', 'techrona' ),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'options'     => techrona_elementor_theme_color_opts(),  
            'default'     => '',
            'condition'   => [
                $args['name'].'!' => ''
            ],
        ),
        array(
            'name'        => $args['name'].'_custom_color',
            'label'       => esc_html__( 'Custom Color', 'techrona' ),
            'type'        => \Elementor\Controls_Manager::COLOR,
            'condition'   => [
                $args['name'].'!'      => '',
                $args['name'].'_color' => 'custom'
            ],
            'selectors'  => [
                '{{WRAPPER}} '.$args['selector'] => 'color:{{VALUE}};'
            ]
        )
    );
    if($args['effect']){
        $effect = [
            array(
                'name'      => $args['name'].'_animation',
                'label'     => esc_html__( 'Motion Effect', 'techrona' ),
                'type'      => \Elementor\Controls_Manager::ANIMATION,
                'condition' => [
                    $args['name'].'!' => ''
                ]
            ),
            array(
                'name'    => $args['name'].'_animation_duration', 
                'label'   => __( 'Animation Duration', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'slow'   => __( 'Slow', 'techrona' ),
                    'normal' => __( 'Normal', 'techrona' ),
                    'fast'   => __( 'Fast', 'techrona' ),
                ],
                'condition' => [
                    $args['name'].'_animation!' => '',
                ]
            ),
            array(
                'name'      => $args['name'].'_animation_delay',
                'label'     => esc_html__( 'Animation Delay', 'techrona' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'min'       => 0,
                'step'      => 100,
                'condition' => [
                    $args['name'].'_animation!' => ''
                ]
            )
        ];
    } else {
        $effect = [];
    }
    return array_merge($default, $effect);
}
/**
 * Elementor Typo Settings
*/
function techrona_elementor_typo_settings($args){
    $args = wp_parse_args($args, [
        'name'     => 'typo_text',
        'selector' => '.typo-text',
        'condition'=> []
    ]);
    return array(
        array(
            'name'         => $args['name'].'_typo',
            'type'         => \Elementor\Group_Control_Typography::get_type(),
            'control_type' => 'group',
            'selector'     => '{{WRAPPER}} '.$args['selector'],
            'condition'    => $args['condition']
        ),
        array(
            'name'         => $args['name'].'_shadow',
            'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
            'control_type' => 'group',
            'selector'     => '{{WRAPPER}} '.$args['selector'],
            'condition'    => $args['condition']
        ),
        array(
            'name'        => $args['name'].'_color',
            'label'       => esc_html__( 'Text Color', 'techrona' ),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'options'     => techrona_elementor_theme_color_opts(),
            'condition'    => $args['condition'] 
        ),
        array(
            'name'        => $args['name'].'_custom_color',
            'label'       => esc_html__( 'Custom Text Color', 'techrona' ),
            'type'        => \Elementor\Controls_Manager::COLOR,
            'condition'   => array_merge(
                [
                    $args['name'].'_color'      => 'custom'
                ],
                $args['condition']
            ),
            'selectors'  => [
                '{{WRAPPER}} '.$args['selector'] => 'color:{{VALUE}};'
            ]
        )
    );
}
 
function techrona_animate_name() {
    $kng_animate = array(
        ''                       => 'None',
        'wow bounce'             => 'bounce',
        'wow flash'              => 'flash',
        'wow pulse'              => 'pulse',
        'wow rubberBand'         => 'rubberBand',
        'wow shake'              => 'shake',
        'wow swing'              => 'swing',
        'wow tada'               => 'tada',
        'wow wobble'             => 'wobble',
        'wow bounceIn'           => 'bounceIn',
        'wow bounceInDown'       => 'bounceInDown',
        'wow bounceInLeft'       => 'bounceInLeft',
        'wow bounceInRight'      => 'bounceInRight',
        'wow bounceInUp'         => 'bounceInUp',
        'wow bounceOut'          => 'bounceOut',
        'wow bounceOutDown'      => 'bounceOutDown',
        'wow bounceOutLeft'      => 'bounceOutLeft',
        'wow bounceOutRight'     => 'bounceOutRight',
        'wow bounceOutUp'        => 'bounceOutUp',
        'wow fadeIn'             => 'fadeIn',
        'wow fadeInDown'         => 'fadeInDown',
        'wow fadeInDownBig'      => 'fadeInDownBig',
        'wow fadeInLeft'         => 'fadeInLeft',
        'wow fadeInLeftBig'      => 'fadeInLeftBig',
        'wow fadeInRight'        => 'fadeInRight',
        'wow fadeInRightBig'     => 'fadeInRightBig',
        'wow fadeInUp'           => 'fadeInUp',
        'wow fadeInUpBig'        => 'fadeInUpBig',
        'wow fadeOut'            => 'fadeOut',
        'wow fadeOutDown'        => 'fadeOutDown',
        'wow fadeOutDownBig'     => 'fadeOutDownBig',
        'wow fadeOutLeft'        => 'fadeOutLeft',
        'wow fadeOutLeftBig'     => 'fadeOutLeftBig',
        'wow fadeOutRight'       => 'fadeOutRight',
        'wow fadeOutRightBig'    => 'fadeOutRightBig',
        'wow fadeOutUp'          => 'fadeOutUp',
        'wow fadeOutUpBig'       => 'fadeOutUpBig',
        'wow flip'               => 'flip',
        'wow flipInX'            => 'flipInX',
        'wow flipInY'            => 'flipInY',
        'wow flipOutX'           => 'flipOutX',
        'wow flipOutY'           => 'flipOutY',
        'wow lightSpeedIn'       => 'lightSpeedIn',
        'wow lightSpeedOut'      => 'lightSpeedOut',
        'wow rotateIn'           => 'rotateIn',
        'wow rotateInDownLeft'   => 'rotateInDownLeft',
        'wow rotateInDownRight'  => 'rotateInDownRight',
        'wow rotateInUpLeft'     => 'rotateInUpLeft',
        'wow rotateInUpRight'    => 'rotateInUpRight',
        'wow rotateOut'          => 'rotateOut',
        'wow rotateOutDownLeft'  => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft'    => 'rotateOutUpLeft',
        'wow rotateOutUpRight'   => 'rotateOutUpRight',
        'wow hinge'              => 'hinge',
        'wow rollIn'             => 'rollIn',
        'wow rollOut'            => 'rollOut',
        'wow zoomIn'             => 'zoomIn',
        'wow zoomInDown'         => 'zoomInDown',
        'wow zoomInLeft'         => 'zoomInLeft',
        'wow zoomInRight'        => 'zoomInRight',
        'wow zoomInUp'           => 'zoomInUp',
        'wow zoomOut'            => 'zoomOut',
        'wow zoomOutDown'        => 'zoomOutDown',
        'wow zoomOutLeft'        => 'zoomOutLeft',
        'wow zoomOutRight'       => 'zoomOutRight',
        'wow zoomOutUp'          => 'zoomOutUp',
    );
    return $kng_animate;
}
 
if(!function_exists('techrona_elementor_animation_opts')){
    function techrona_elementor_animation_opts($args = []){
        $args = wp_parse_args($args, [
            'name'   => '',
            'label' => '',
            'prefix' => ''
        ]);
        return array(
            array(
                'name'      => $args['name'].'_animation',
                'label'     => $args['label'].' '.esc_html__( 'Motion Effect', 'techrona' ),
                'type'      => \Elementor\Controls_Manager::ANIMATION,
                'condition' => [
                    $args['name'].'!' => ''
                ]
            ),
            array(
                'name'    => $args['name'].'_animation_duration', 
                'label'   => $args['label'].' '.esc_html__( 'Animation Duration', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'normal',
                'options' => [
                    'slow'   => __( 'Slow', 'techrona' ),
                    'normal' => __( 'Normal', 'techrona' ),
                    'fast'   => __( 'Fast', 'techrona' ),
                ],
                'condition' => [
                    $args['name'].'_animation!' => ''
                ]
            ),
            array(
                'name'      => $args['name'].'_animation_delay',
                'label'     => $args['label'].' '.esc_html__( 'Animation Delay', 'techrona' ),
                'type'      => \Elementor\Controls_Manager::NUMBER,
                'min'       => 0,
                'step'      => 100,
                'condition' => [
                    $args['name'].'_animation!' => ''
                ]
            )
        );
    }
}
// Theme Colors
if(!function_exists('techrona_get_theme_color_opts')){
    function techrona_get_theme_color_opts($args = []){
        $args = wp_parse_args($args, [
            'custom' => true
        ]);
        $theme_colors = wp_parse_args(techrona_custom_colors(), techrona_configs('theme_colors'));
        $option = ['' => esc_html('Default', 'techrona')];
        foreach ($theme_colors as $key => $color) {
            $value = 'var(--'.$key.'-color)';
            $option[$value] = ucfirst($key);
        }

        if($args['custom']) $option['custom'] = esc_html('Custom', 'techrona');
        return $option;
    }
}

// Elementor Color
if(!function_exists('techrona_elementor_color')){
    function techrona_elementor_color($args = []){
        $args = wp_parse_args($args, [
            'name' => '',
            'selector' => [],
            'label' => '',
            'condition' => [],
            'default' => ''
        ]); 
        return array(
            array(
                'name' => $args['name'].'_color',
                'label' => $args['label'],
                'type' => 'select',
                'options' => techrona_get_theme_color_opts(),
                'default' => $args['default'],
                'selectors' => $args['selector'],
                'condition' => $args['condition']
            ),
            array(
                'name' => $args['name'].'_custom_color',
                'label' => esc_html__('Custom Color', 'techrona'),
                'type' => 'color', 
                'separator' => 'after',
                'condition' => array_merge(
                    array(
                        $args['name'].'_color' => 'custom'
                    ),
                    $args['condition']
                ),
                'selectors' => $args['selector']
            ),
        );
    }
}
if(!function_exists('techrona_elementor_theme_color_opts')){
    function techrona_elementor_theme_color_opts($args = []){
        $args = wp_parse_args($args, [
            'custom' => true
        ]);
        $theme_colors = wp_parse_args(techrona_custom_colors(), techrona_configs('theme_colors'));
        $option = ['' => esc_html('Default', 'techrona')];
        foreach ($theme_colors as $key => $color) {
            $option[$key] = $color['title'];
        }
        if($args['custom']) $option['custom'] = esc_html('Custom', 'techrona');
        return $option;
    }
}

if(!function_exists('techrona_elementor_theme_colors')){
    function techrona_elementor_theme_colors($args = []){
        $args = wp_parse_args($args, [
            'name'                => 'main_color',
            'label'               => esc_html__('Main Color', 'techrona'),
            'custom'              => true,
            'custom_selector'     => '',
            'custom_selector_tag' => 'color',
            'prefix_class'        => '',
            'relation'            => '',
            'condition'           => [],
            'default'             => '',
            'output'              => true     
        ]);
        $custom_selector = [];
        if(!empty($args['custom_selector']) && $args['output'] === true){
            if($args['relation'] === 'and'){
                $custom_selector = [
                    '{{WRAPPER}}'.$args['custom_selector'] => $args['custom_selector_tag'].': {{VALUE}};' //$custom_selector
                ];
            } else {
                $custom_selector = [
                    '{{WRAPPER}} '.$args['custom_selector'] => $args['custom_selector_tag'].': {{VALUE}};' //$custom_selector
                ];
            }
        } 
        $color = [
            [
                'name'        => $args['name'],
                'label'       => $args['label'],
                'type'        => \Elementor\Controls_Manager::SELECT,
                'options'     => techrona_elementor_theme_color_opts(),  
                'default'     => $args['default'],
                'prefix_class'=> $args['prefix_class'],
                'condition'   => $args['condition']
            ]
        ];
        if($args['custom']){
            $color[] = [
                'name'        => 'custom_'.$args['name'],
                'label'       => __('Custom','techrona'). ' '.$args['label'],
                'type'        => \Elementor\Controls_Manager::COLOR,
                'condition'   => [
                    $args['name'] => 'custom'
                ],
                'selectors'    => $custom_selector,
            ];
        }
        return  $color;
    }
}

// Alignment options
if(!function_exists('techrona_elementor_text_align')){
    function techrona_elementor_text_align($args = []) {
        $args = wp_parse_args($args, [
            'default' => '',
            'label'   => esc_html__( 'Content Alignment', 'techrona' ),
            'label_block' => false
        ]);
        return array(
            'name'         => 'text_align',
            'label'        => $args['label'],
            'label_block'  => $args['label_block'],
            'type'         => \Elementor\Controls_Manager::CHOOSE,
            'control_type' => 'responsive',
            'options'      => techrona_text_align_opts(),
            'default'      => $args['default'],
        );
    }
}
if(!function_exists('techrona_text_align_opts')){
    function techrona_text_align_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => '',
        ]);
        return [
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
        ];
    }
}
// Alignment css class
// Text Align
if(!function_exists('techrona_elementor_align_class')){
    function techrona_elementor_align_class($settings, $args = []){
        $args = wp_parse_args($args, [
            'id'          => 'text_align',
            'extra_class' => '',
            'default'     => '',
            'prefix'      => 'text-'  
        ]);
        if(empty($args['default'])) $args['default'] = $settings[$args['id']];
        $align_class = [];
        $align_class[] = empty($settings[$args['id'].'_mobile']) ? $args['prefix'].$args['default'] : $args['prefix'].$settings[$args['id'].'_mobile'];
        $align_class[] = empty($settings[$args['id'].'_tablet']) ? '' : $args['prefix'].'md-'.$settings[$args['id'].'_tablet'];
        $align_class[] = empty($settings[$args['id']]) ? '' : $args['prefix'].'lg-'.$settings[$args['id']];
        
        $align_class[] = $args['extra_class'];
        return trim(implode(' ', $align_class));
    }
}

if(!function_exists('techrona_elementor_justify_class')){
    function techrona_elementor_justify_class($settings, $args = []){
        $args = wp_parse_args($args, [
            'id'          => 'text_align',
            'extra_class' => '',
            'default'     => '',
            'prefix'      => 'justify-content-'  
        ]);
        if(empty($args['default'])) $args['default'] = $settings[$args['id']];
        $align_class = [];
        $align_class[] = empty($settings[$args['id'].'_mobile']) ? $args['prefix'].$args['default'] : $args['prefix'].$settings[$args['id'].'_mobile'];
        $align_class[] = empty($settings[$args['id'].'_tablet']) ? '' : $args['prefix'].'md-'.$settings[$args['id'].'_tablet'];
        $align_class[] = empty($settings[$args['id']]) ? '' : $args['prefix'].'lg-'.$settings[$args['id']];
        
        $align_class[] = $args['extra_class'];
        return trim(implode(' ', $align_class));
    }
}

if(!function_exists('techrona_content_position_opts')){
    function techrona_content_position_opts($args = []){
        $args = wp_parse_args($args, [
            'default' => '',
        ]);
        return [
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
            ] 
        ];
    }
}

// Row content align
if(!function_exists('techrona_elementor_row_align')){
    function techrona_elementor_row_align($args = []) {
        $args = wp_parse_args($args, [
            'name'      => 'row_align',  
            'label'     => esc_html__( 'Justify Content', 'techrona' ),    
            'default'   => '',
            'condition' => [],
            'prefix_class' => ''
        ]);
        return array(
            'name'         => $args['name'],
            'label'        => $args['label'],
            'type'         => \Elementor\Controls_Manager::CHOOSE,
            'control_type' => 'responsive',
            'options'      => [
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
                'around' => [
                    'title' => esc_html__( 'Around', 'techrona' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'between' => [
                    'title' => esc_html__( 'Between', 'techrona' ),
                    'icon' => 'eicon-text-align-justify',
                ],
            ],
            'default'      => $args['default'],
            'condition'    => $args['condition'],
            'prefix_class' => $args['prefix_class']
        );
    }
}
// Row Content Alignment
if(!function_exists('techrona_elementor_row_justify_class')){
    function techrona_elementor_row_justify_class($settings, $args = []){
        $args = wp_parse_args($args, [
            'id'          => 'row-align',
            'default'     => '',
            'extra_class' => '',
            'prefix'      => 'justify-content-'
        ]);

        if(empty($args['default'])) $args['default'] = $settings[$args['id']];
        $align_class = [];
        $align_class[] = empty($settings[$args['id'].'_mobile']) ? $args['prefix'].$args['default'] : $args['prefix'].$settings[$args['id'].'_mobile'];
        $align_class[] = empty($settings[$args['id'].'_tablet']) ? '' : $args['prefix'].'md-'.$settings[$args['id'].'_tablet'];
        $align_class[] = empty($settings[$args['id']]) ? '' : $args['prefix'].'lg-'.$settings[$args['id']];
        return trim(implode(' ', $align_class));
    }
}

// Swiper Slider Settings
if(!function_exists('techrona_elementor_swiper_slider_settings')){
    function techrona_elementor_swiper_slider_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => \Elementor\Controls_Manager::TAB_LAYOUT,
            'condition' => [],
            'slide_to_show'              => '4',
            'slide_to_show_widescreen'   => '4',
            'slide_to_show_laptop'       => '3',
            'slide_to_show_tablet_extra' => '3',
            'slide_to_show_tablet'       => '2',
            'slide_to_show_mobile_extra' => '1',
            'slide_to_show_mobile'       => '1',
        ]);
         
        $slides_to_show = range( 1, 10 );
        $slides_to_show = array_combine( $slides_to_show, $slides_to_show );
        return array(
            'name'     => 'section_swiper_slider_settings',
            'label'    => esc_html__('Carousel Settings', 'techrona'),
            'tab'      => $args['tab'],
            'controls' => array_merge(
                array(
                    array(
                        'name'        => 'slide_direction',
                        'label'       => esc_html__('Slides Direction', 'techrona'),
                        'description' => esc_html__('Defines how slides Direction, \'horizontal\' | \'vertical\'', 'techrona'),
                        'type'        => \Elementor\Controls_Manager::SELECT,
                        'options'     => [
                            'horizontal' => esc_html__('Horizontal', 'techrona'),
                            'vertical'   => esc_html__('Vertical', 'techrona')
                        ],
                        'default'      => 'horizontal',
                        'condition' => [
                            'slide_to_show' => '1',
                        ],
                    ),
                    array(
                        'name'    => 'slide_mode',
                        'label'   => esc_html__('Slide Effect', 'techrona'),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'slide'     => esc_html__('Slide', 'techrona'),
                            'fade'      => esc_html__('Fade', 'techrona'),
                            'cube'      => esc_html__('Cube', 'techrona'),
                            'flip'      => esc_html__('Flip', 'techrona'),
                            //'coverflow' => esc_html__('Coverflow', 'techrona'),
                        ],
                        'default' => 'slide',
                    ),
                    array(
                        'name'                 => 'slide_to_show',
                        'label'                => esc_html__('Slides to Show', 'techrona'),
                        'type'                 => \Elementor\Controls_Manager::SELECT,
                        'control_type'         => 'responsive',
                        'widescreen_default'   => $args['slide_to_show_widescreen'],
                        'desktop_default'      => $args['slide_to_show'],
                        'laptop_default'       => $args['slide_to_show_laptop'],
                        'tablet_extra_default' => $args['slide_to_show_tablet_extra'],
                        'tablet_default'       => $args['slide_to_show_tablet'],
                        'mobile_extra_default' => $args['slide_to_show_mobile_extra'],
                        'mobile_default'       => $args['slide_to_show_mobile'],
                        'options'              => [
                                '' => esc_html__('Default', 'techrona' ),
                            ] + $slides_to_show,
                        'condition' => [
                            'slide_mode' => ['slide']
                        ]
                    ),
                    array(
                        'name'         => 'slide_to_scroll',
                        'label'        => esc_html__('Slides to Scroll', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'control_type' => 'responsive',
                        'default'      => '',
                        'options'      => [
                                '' => esc_html__('Default', 'techrona' ),
                            ] + $slides_to_show,
                        'condition' => [
                            'slide_mode'      => ['slide'],
                            'slide_to_show!' => '1',
                        ],
                    ),
                    array(
                        'name'        => 'slide_percolumn',
                        'label'       => esc_html__('Slides Per Column', 'techrona'),
                        'description' => esc_html__('Number of slides per column, for multirow layout', 'techrona'),
                        'type'        => \Elementor\Controls_Manager::SELECT,
                        'options'     => [
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4'
                        ],
                        'default'      => '1',
                        'condition'    => [
                            'slide_mode'       => 'slide',
                            'slide_to_show!'   => '1',
                            'slide_to_scroll!' => '1' 
                        ] 
                    ),
                    array(
                        'name'        => 'slide_percolumnfill',
                        'label'       => esc_html__('Slides Per Column Fill', 'techrona'),
                        'description' => esc_html__('Defines how slides should fill rows, by column or by row', 'techrona'),
                        'type'        => \Elementor\Controls_Manager::SELECT,
                        'options'     => [
                            'row'    => __('Row', 'techrona'),
                            'column' => __('Column', 'techrona')
                        ],
                        'default'      => 'column',
                        'condition'    => [
                            'slide_mode'       => 'slide',
                            'slide_to_show!'   => '1',
                            'slide_to_scroll!' => '1',
                            'slide_percolumn!' => '1'
                        ]
                    ),
                    array(
                        'name'        => 'gap',
                        'label'       => __('Gap', 'techrona'),
                        'description' => __('Distance between slides in px', 'techrona'),
                        'type'        => \Elementor\Controls_Manager::NUMBER,
                        'default'     => 30
                    ),
                    array(
                        'name'         => 'gap_extra',
                        'label'        => esc_html__( 'Extra Gap Bottom', 'techrona' ),
                        'description'  => esc_html__( 'Add extra space at bottom of each items','techrona'),
                        'type'         => \Elementor\Controls_Manager::NUMBER,
                        'default'      => 0,
                    ),
                    array(
                        'name'         => 'arrows',
                        'label'        => esc_html__('Show Arrows', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'true'  => __('Yes', 'techrona'),
                            'false' => __('No', 'techrona')
                        ],
                        'default'      => 'true', 
                        'control_type' => 'responsive',
                        'separator'    => 'before',
                        'prefix_class' => 'kng-swiper-arrows%s-'
                    ),
                    array(
                        'name'        => 'arrow_prev',
                        'label'       => esc_html__('Previous Icon','techrona'),
                        'type'        => 'icons',
                        'label_block' => true,
                        'separator'   => 'before' 
                    ),
                    array(
                        'name'        => 'arrow_next',
                        'label'       => esc_html__('Next Icon','techrona'),
                        'type'        => 'icons',
                        'label_block' => true,
                        'separator'   => 'before' 
                    ),
                    array(
                        'name'         => 'arrows_pos',
                        'label'        => esc_html__('Arrows Position', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'default'      => 'in-vertical',
                        'options'      => [
                            'in-vertical'   => esc_html__('Inside Vertical','techrona'),
                            'out-vertical'  => esc_html__('Outside Vertical','techrona'),
                            'top-left'      => esc_html__('Top Left','techrona'),
                            'top-right'     => esc_html__('Top Right','techrona'),
                            'top-center'    => esc_html__('Top Center','techrona'),
                            'bottom-left'   => esc_html__('Bottom Left','techrona'),
                            'bottom-right'  => esc_html__('Bottom Right','techrona'),
                            'bottom-center' => esc_html__('Bottom Center','techrona'),
                            'left-side'     => esc_html__('Left Side','techrona'),
                            'right-side'    => esc_html__('Right Side','techrona')
                        ],
                        'prefix_class' => 'kng-swiper-nav-',
                    ),
                    
                    array(
                        'name'         => 'arrows_style',
                        'label'        => esc_html__('Arrows Styles', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'default'      => 'default',
                        'options'      => [
                            'default'  => __('Default','techrona'),
                            'round'  => __('Round Border','techrona'),
                            'round-in-dark'  => esc_html__('Round In Dark','techrona'),
                            'square-in-dark'  => esc_html__('Square In Dark','techrona'),
                        ],
                        'prefix_class' => 'kng-swiper-nav-style-',
                    ),
                    array(
                        'name'         => 'pos_top',
                        'label'        => esc_html__( 'Top Position', 'techrona' ),
                        'type'         => 'slider',
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .kng-swiper-arrows' => 'top: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['arrows_pos' => ['top-left','top-right','top-center']]
                    ),
                    array(
                        'name'         => 'pos_bot',
                        'label'        => esc_html__( 'Bottom Position', 'techrona' ),
                        'type'         => 'slider',
                        'control_type' => 'responsive',
                        'size_units'   => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .kng-swiper-arrows' => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                        'condition' => ['arrows_pos' => ['bottom-left','bottom-right','bottom-center']]
                    ),
                    array(
                        'name'         => 'arrows_color',
                        'label'        => esc_html__('Arrows Color', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'default'      => '',
                        'options'      => techrona_elementor_theme_color_opts(['custom' =>  false]),
                        'prefix_class' => 'kng-swiper-nav-color-',
                    ),
                    array(
                        'name'         => 'arrows_color_hover',
                        'label'        => esc_html__('Arrows Color Hover', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'default'      => '',
                        'options'      => techrona_elementor_theme_color_opts(['custom' =>  false]),
                        'prefix_class' => 'kng-swiper-nav-color-hover-',
                    ),
                    array(
                        'name'    => 'arrow_link',
                        'label'   => esc_html__('Additional arrow link?','techrona'),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'options' => [  
                            ''          => __('None', 'techrona'),
                            'text_link' => __('Text Link','techrona'),
                            'button'    => __('Button','techrona'),
                        ],
                        'default' => '',
                        'condition' => [
                            'arrows_pos' =>  ['left-side', 'right-side']
                        ],
                        'separator'   => 'before',
                        'label_block' => true
                    )
                ),
                techrona_elementor_hyperlink_settings([
                    'prefix'    => 'arrow_hyperlink',
                    'condition' => [
                        'arrow_link' => 'text_link',
                        'arrows_pos' =>  ['left-side', 'right-side']                         
                    ]
                ]),
                techrona_elementor_button_settings([
                    'prefix'   => 'arrow_btnlink',
                    'btn_text' => 'Read More',
                    'condition' => [
                        'arrow_link' => 'button',
                        'arrows_pos' =>  ['left-side', 'right-side']                            
                    ]
                ]),
                array(
                    array(
                        'name'         => 'dots',
                        'label'        => esc_html__('Show Dots', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'control_type' => 'responsive',
                        'options' => [
                            'true'  => __('Yes', 'techrona'),
                            'false' => __('No', 'techrona')
                        ],
                        'default'      => 'true',
                        'separator'    => 'before',
                        'prefix_class' => 'kng-swiper-dots%s-'
                    ),
                    array(
                        'name'         => 'dots_style',
                        'label'        => esc_html__('Dots Style', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'default'      => 'bullets',
                        'options'      => [
                            'bullets'     => __('Bullets','techrona'),
                            //'dynamic'   => __('Dynamic','techrona'),
                            'progressbar' => __('Progressbar','techrona'),
                            'fraction'    => __('Fraction','techrona'),
                            //'custom'    => __('Custom','techrona')
                        ]
                    ),
                    array(
                        'name'      => 'dots_style_notice',
                        'type'      => \Elementor\Controls_Manager::RAW_HTML,
                        'raw'       => sprintf( __( 'How to custom pagination, readmore at <a href="%s" target="_blank">swiper.js</a>', 'techrona' ), 'https://swiperjs.com/swiper-api#pagination' ),
                        'condition' => [
                            'dots_style'  => 'custom'
                        ],
                        'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning'
                    ),
                    array(
                        'name'      => 'dots_style_custom',
                        'type'      => \Elementor\Controls_Manager::TEXTAREA,
                        'label'     => esc_html__('Enter your code here','techrona'),
                        'condition' => [
                            'dots_style'  => 'custom'
                        ],
                        'description' => __('Default','techrona').': function (swiper, current, total) { return current + \' of \' + total;}'
                    ),

                    array(
                        'name'         => 'dots_in_nav',
                        'label'        => esc_html__('Dots In Nav', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SWITCHER,
                        'default'      => '',
                        'separator'    => 'before',
                        'condition'    => [
                            'arrows'     => 'true',
                            'arrows_pos' => ['top-left', 'top-right', 'top-center','bottom-left', 'bottom-right', 'bottom-center']
                        ] 
                    ),
                    array(
                        'name'         => 'dots_pos',
                        'label'        => esc_html__('Dots Position', 'techrona'),
                        'type'         => \Elementor\Controls_Manager::SELECT,
                        'default'      => 'out',
                        'options'      => [
                            'in'  => esc_html__('Inside','techrona'),
                            'out' => esc_html__('Outside','techrona'),
                            'middle-left-in'   => esc_html__('Middle Left Inside','techrona'),
                            'middle-left-out'  => esc_html__('Middle Left Outside','techrona'),
                            'middle-right-in'  => esc_html__('Middle Right Inside','techrona'),
                            'middle-right-out' => esc_html__('Middle Right Outside','techrona'),
                        ],
                        'condition' => [
                            'dots_in_nav' => ''
                        ],
                        'prefix_class' => 'kng-swiper-dots-'
                    )
                ),
                techrona_elementor_theme_colors([
                    'name'                => 'dots_color',
                    'label'               => esc_html__('Dots Color', 'techrona'),
                    'custom_label'        => esc_html__('Custom Dots Color', 'techrona'),
                    'custom_selector'     => '.kng-swiper-dots .kng-swiper-pagination-bullet:before',
                    'custom_selector_tag' => 'border-color',
                    'prefix_class'        => 'kng-swiper-dots-color-',
                    'relation'            => 'and'
                ]),
                techrona_elementor_theme_colors([
                    'name'                => 'dots_color_hover',
                    'label'               => esc_html__('Dots Color Hover', 'techrona'),
                    'custom_label'        => esc_html__('Custom Dots Color Hover', 'techrona'),
                    'custom_selector'     => '.kng-swiper-dots-color-hover-custom .kng-swiper-dots .swiper-pagination-bullet-active:before, .kng-swiper-dots-color-hover-custom .kng-swiper-dots .kng-swiper-pagination-bullet:hover:before',
                    'custom_selector_tag' => 'border-color',
                    'prefix_class'        => 'kng-swiper-dots-color-hover-',
                    'relation'            => 'and'
                ]),
                array(
                    techrona_elementor_row_align([
                        'name'      => 'dots_align',
                        'label'     => esc_html__('Dots Align', 'techrona'),
                        'prefix_class' => 'kng-swiper-dots-align%s-'
                    ]),
                    array(
                        'name'      => 'autoplay',
                        'label'     => esc_html__('Autoplay', 'techrona'),
                        'type'      => \Elementor\Controls_Manager::SELECT,
                        'options'   => [
                            'true' => __('Yes','techrona'),
                            'false' => __('No', 'techrona')
                        ],
                        'default'   => 'false',
                        'separator' => 'before'
                    ),
                    array(
                        'name'    => 'pause_on_hover',
                        'label'   => esc_html__('Pause on Hover', 'techrona'),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'options'   => [
                            'true' => __('Yes','techrona'),
                            'false' => __('No', 'techrona')
                        ],
                        'default' => 'true',
                        'condition' => [
                            'autoplay' => 'true'
                        ]
                    ),
                    array(
                        'name'      => 'pause_on_interaction',
                        'label'     => esc_html__('Pause on Interaction', 'techrona'),
                        'type'      => \Elementor\Controls_Manager::SELECT,
                        'options'   => [
                            'true' => __('Yes','techrona'),
                            'false' => __('No', 'techrona')
                        ],
                        'default'   => 'true',
                        'condition' => [
                            'autoplay' => 'true'
                        ]
                    ),
                    array(
                        'name'      => 'autoplay_speed',
                        'label'     => esc_html__('Autoplay Speed', 'techrona'),
                        'type'      => \Elementor\Controls_Manager::NUMBER,
                        'default'   => 5000,
                        'condition' => [
                            'autoplay' => 'true'
                        ]
                    ),
                    array(
                        'name'    => 'loop',
                        'label'   => esc_html__('Infinite Loop', 'techrona'),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'options'   => [
                            'true'  => __('Yes','techrona'),
                            'false' => __('No', 'techrona')
                        ],
                        'default' => 'false',
                    ),
                    array(
                        'name'    => 'speed',
                        'label'   => esc_html__('Animation Speed', 'techrona'),
                        'type'    => \Elementor\Controls_Manager::NUMBER,
                        'default' => 300,
                    )
                )
            ),
            'condition' => $args['condition']
        );
    }
}
if(!function_exists('techrona_swiper_slider_arrows')){
    function techrona_swiper_slider_arrows($settings){
        if(in_array($settings['arrows_pos'], ['in-vertical', 'out-vertical'])): ?>
            <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-prev"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_prev']) ?></div>
            <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-next"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_next']) ?></div>
        <?php endif;
    }
}
if(!function_exists('techrona_swiper_slider_arrows_side')){
    function techrona_swiper_slider_arrows_side($settings){
        if(in_array($settings['arrows_pos'], ['left-side', 'right-side'])): 
        ?>
            <div class="kng-swiper-arrows">
                <div class="kng-swiper-arrows-arrow">
                    <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-prev"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_prev']) ?></div>
                    <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-next"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_next']) ?></div>
                </div>
                <div class="kng-swiper-arrows-additional empty-none"><?php
                        // Link
                        if($settings['arrow_link'] === 'button'){
                            // Button
                            techrona_elementor_button_render($settings,[
                                'prefix'     => 'arrow_link',
                                'icon_class' => '',
                                'class'      => ''
                            ]);
                        } elseif($settings['arrow_link'] === 'text_link') {
                            // Custom Link 
                            techrona_elementor_hyperlink_render($settings,[
                                'prefix'           => 'arrow_link', 
                                'link_type'        => $settings['arrow_link'],
                                'wrap_class'       => '',
                                'class'            => '',
                                'link_color'       => '',
                                'link_hover_color' => '',
                                'default_icon'     => [],
                                'icon_class'       => ''
                            ]);
                        }
                ?></div>
            </div>
            <?php
        endif;
    }
}
if(!function_exists('techrona_swiper_slider_arrows_side2')){
    function techrona_swiper_slider_arrows_side2($settings){
        if(in_array($settings['arrows_pos'], ['left-side2', 'right-side2'])): 
        ?>
            <div class="kng-swiper-arrows">
                <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-prev"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_prev']) ?></div>
                <?php  techrona_swiper_slider_dots_in_nav($settings); ?>
                <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-next"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_next']) ?></div>
            </div>
        <?php
        endif;
    }
}
if(!function_exists('techrona_swiper_slider_arrows_top')){
    function techrona_swiper_slider_arrows_top($settings){
        if(in_array($settings['arrows_pos'], ['top-left', 'top-right', 'top-center', 'top-between'])): ?>
            <div class="<?php echo implode(' ', ['kng-swiper-arrows','top',$settings['arrows_pos']]);?>">
                <div class="container">
                    <div class="kng-swiper-arrows-inner">
                        <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-prev"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_prev']) ?></div>
                        <?php  techrona_swiper_slider_dots_in_nav($settings); ?>
                        <div class="kng-swiper-arrow rtl-flip kng-swiper-arrow-next"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_next']) ?></div>
                    </div>
                </div>
            </div>
        <?php endif;
    }
}
if(!function_exists('techrona_swiper_slider_arrows_bottom')){
    function techrona_swiper_slider_arrows_bottom($settings, $args = []){
        if(!in_array($settings['arrows_pos'], ['bottom-left', 'bottom-right', 'bottom-center', 'bottom-between'])) return;
        $args = wp_parse_args($args, [
            'class'     => '',
            'icon_prev' => '',
            'icon_next' => ''
        ]);
        ?>
        <div class="<?php echo implode(' ', ['kng-swiper-arrows','bottom',$settings['arrows_pos'], $args['class']]);?>">
            <div class="container">
                <div class="kng-swiper-arrows-inner">
                    <div class="<?php echo implode(' ', ['kng-swiper-arrow rtl-flip kng-swiper-arrow-prev', $args['icon_prev']]);?>"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_prev']) ?></div>
                    <?php  techrona_swiper_slider_dots_in_nav($settings); ?>
                    <div class="<?php echo implode(' ', ['kng-swiper-arrow rtl-flip kng-swiper-arrow-next', $args['icon_next']]); ?>"><?php techrona_elementor_icon_render($settings,['id'=>'arrow_next']) ?></div>
                </div>
            </div>
        </div>
    <?php
    }
}
if(!function_exists('techrona_swiper_slider_dots')){
    function techrona_swiper_slider_dots($settings, $args=[]){
        $args = wp_parse_args($args, [
            'class' => ''
        ]); 
        $classes = ['kng-swiper-dots empty-none', $args['class']];
        if($settings['layout'] == '4') echo '<div class="container relative">';
        ?>
            <div class="<?php echo implode(' ', $classes)?>"></div>
        <?php
        if($settings['layout'] == '4') echo '</div>';
    }
}
if(!function_exists('techrona_swiper_slider_dots_in_nav')){
    function techrona_swiper_slider_dots_in_nav($settings){
        if( $settings['dots_in_nav'] === 'true') {
        ?>
            <div class="kng-swiper-dots empty-none"></div>
        <?php
        }
    }
}
if(!function_exists('techrona_swiper_slider_settings')){

    function techrona_swiper_slider_settings($widget, $args = []){
        $args = wp_parse_args($args, [
            'swiper_container' => 'kng-swiper-container',
            'class'            => '',
            'slide_to_show'    => $widget->get_setting('slide_to_show', '4'),
            'slide_to_show_laptop'    => $widget->get_setting('slide_to_show_laptop', '3'),
            'slide_to_show_tablet_extra'    => $widget->get_setting('slide_to_show_tablet_extra', '3'),
            'slide_to_show_tablet'    => $widget->get_setting('slide_to_show_tablet', '2'),
            'slide_to_show_mobile_extra'    => $widget->get_setting('slide_to_show_mobile_extra', '1'),
            'slide_to_show_mobile'    => $widget->get_setting('slide_to_show_mobile', '1'),
        ]);

        $args['slide_to_show_widescreen'] = $widget->get_setting('slide_to_show_widescreen', $args['slide_to_show']);

        $slide_direction         = $widget->get_setting('slide_direction', 'horizontal');
        $slide_percolumn         = (int) $widget->get_setting('slide_percolumn', '1');
        $slide_percolumnfill     = $widget->get_setting('slide_percolumnfill', 'column');
        $slide_mode              = $widget->get_setting('slide_mode', 'slide');
        
        
        $slides_to_show          = (int) $args['slide_to_show'];  
        $slides_to_show_widescreen  = (int) $args['slide_to_show_widescreen'];  
        $slides_to_show_laptop   = (int) $args['slide_to_show_laptop'];  
        $slides_to_show_tablet_extra   = (int) $args['slide_to_show_tablet_extra'];  
        $slides_to_show_tablet   = (int) $args['slide_to_show_tablet'];  
        $slides_to_show_mobile_extra   = (int) $args['slide_to_show_mobile_extra'];  
        $slides_to_show_mobile   = (int) $args['slide_to_show_mobile'];  
 
        
        $slides_to_scroll        = (int) $widget->get_setting('slide_to_scroll', $slides_to_show );
        $slides_to_scroll_widescreen        = (int) $widget->get_setting('slide_to_scroll_widescreen', $slides_to_scroll );
        $slides_to_scroll_laptop = (int) $widget->get_setting('slide_to_scroll_laptop', $slides_to_show_laptop);
        $slides_to_scroll_tablet_extra = (int) $widget->get_setting('slide_to_scroll_tablet_extra', $slides_to_show_tablet_extra);
        $slides_to_scroll_tablet = (int) $widget->get_setting('slide_to_scroll_tablet', $slides_to_show_tablet);
        $slides_to_scroll_mobile_extra = (int) $widget->get_setting('slide_to_scroll_mobile_extra', $slides_to_show_mobile_extra);
        $slides_to_scroll_mobile = (int) $widget->get_setting('slide_to_scroll_mobile', $slides_to_show_mobile);

        // show one item
        if(in_array($slide_mode, ['fade', 'cube', 'flip'])){
            $slides_to_show_widescreen = $slides_to_show = $slides_to_show_laptop = $slides_to_show_tablet_extra = $slides_to_show_tablet = $slides_to_show_mobile_extra = $slides_to_show_mobile = $slides_to_scroll_widescreen = $slides_to_scroll =  $slides_to_scroll_laptop = $slides_to_scroll_tablet_extra = $slides_to_scroll_tablet = $slides_to_scroll_mobile_extra = $slides_to_scroll_mobile = 1;
        } elseif($slide_mode === 'coverflow'){
            $slides_to_show_widescreen = $slides_to_show = $slides_to_show_laptop = $slides_to_show_tablet_extra = $slides_to_show_tablet = $slides_to_show_mobile_extra = $slides_to_show_mobile = $slides_to_scroll_widescreen = $slides_to_scroll =  $slides_to_scroll_laptop = $slides_to_scroll_tablet_extra = $slides_to_scroll_tablet = $slides_to_scroll_mobile_extra = $slides_to_scroll_mobile = 'auto';
        }

        $slides_gutter        = $widget->get_setting('gap');
        $arrows               = $widget->get_setting('arrows', 'true');
        $arrows_tablet        = $widget->get_setting('arrows_tablet', $arrows);
        $arrows_mobile        = $widget->get_setting('arrows_mobile', $arrows_tablet);
        $dots                 = $widget->get_setting('dots');
        $dots_tablet          = $widget->get_setting('dots_tablet', $dots);
        $dots_mobile          = $widget->get_setting('dots_mobile', $dots);
        $dots_style           = $widget->get_setting('dots_style', 'bullets');
        $dots_style_custom    = $widget->get_setting('dots_style_custom', 'function (swiper, current, total) { return current + \' of \' + total;}');
        $dots_pos             = $widget->get_setting('dots_pos','out');
        $autoplay             = $widget->get_setting('autoplay', 'false');
        $pause_on_hover       = $widget->get_setting('pause_on_hover', 'true');
        $pause_on_interaction = $widget->get_setting('pause_on_interaction', 'true');
        $autoplay_speed       = $widget->get_setting('autoplay_speed', 500);
        $loop                 = $widget->get_setting('loop', 'false');
        $speed                = $widget->get_setting('speed', 300);
        $titlenext            = $widget->get_setting('nav_title_next', 'Next');
        $titleprev            = $widget->get_setting('nav_title_prev', 'Prev');
        $opts = [
            'slide_direction'               => $slide_direction,
            'slide_percolumn'               => $slide_percolumn, 
            'slide_percolumnfill'           => $slide_percolumnfill, 
            'slide_mode'                    => $slide_mode, 
            'slides_to_show_widescreen'     => $slides_to_show_widescreen, 
            'slides_to_show'                => $slides_to_show, 
            'slides_to_show_laptop'         => $slides_to_show_laptop, 
            'slides_to_show_tablet_extra'   => $slides_to_show_tablet_extra, 
            'slides_to_show_tablet'         => $slides_to_show_tablet, 
            'slides_to_show_mobile_extra'   => $slides_to_show_mobile_extra, 
            'slides_to_show_mobile'         => $slides_to_show_mobile, 
            'slides_to_scroll_widescreen'   => $slides_to_scroll_widescreen, 
            'slides_to_scroll'              => $slides_to_scroll, 
            'slides_to_scroll_laptop'       => $slides_to_scroll_laptop, 
            'slides_to_scroll_tablet_extra' => $slides_to_scroll_tablet_extra, 
            'slides_to_scroll_tablet'       => $slides_to_scroll_tablet, 
            'slides_to_scroll_mobile_extra' => $slides_to_scroll_mobile_extra, 
            'slides_to_scroll_mobile'       => $slides_to_scroll_mobile, 
            'slides_gutter'                 => $slides_gutter, 
            'arrow'                         => $arrows,
            'arrow_tablet'                  => $arrows_tablet,
            'arrow_mobile'                  => $arrows_mobile,
            'dots'                          => $dots,
            'dots_tablet'                   => $dots_tablet,
            'dots_mobile'                   => $dots_mobile,
            'dots_style'                    => $dots_style,
            'dots_style_custom'             => $dots_style_custom,
            'autoplay'                      => $autoplay,
            'pause_on_hover'                => $pause_on_hover,
            'pause_on_interaction'          => $pause_on_interaction,
            'delay'                         => $autoplay_speed,
            'loop'                          => $loop,
            'speed'                         => $speed,
        ];
        $widget->add_render_attribute( 'kng-swiper-settings', [
            'class'         => implode(' ', [$args['swiper_container'], $args['class']]),
            'dir'           => is_rtl() ? 'rtl' : 'ltr',
            'data-settings' => wp_json_encode($opts),
            'data-customdot' => $dots_style_custom
        ]);
        kng_print_html($widget->get_render_attribute_string( 'kng-swiper-settings' ));
        //echo 'data-settings='.wp_json_encode($opts).'';
    }
}
// Grid settings
if(!function_exists('techrona_column_settings')){
    function techrona_column_settings(){
        $options = [
            '12' => '12',
            '6'  => '6',
            '5'  => '5',
            '4'  => '4',
            '3'  => '3',
            '2'  => '2',
            '1'  => '1'
        ];
        return array(
            array(
                'name'    => 'col_xs',
                'label'   => esc_html__( 'Extra Small', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => $options
            ),
            array(
                'name'    => 'col_sm',
                'label'   => esc_html__( 'Small', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => $options
            ),
            array(
                'name'    => 'col_md',
                'label'   => esc_html__( 'Medium', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '2',
                'options' => $options
            ),
            array(
                'name'    => 'col_lg',
                'label'   => esc_html__( 'Large', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => $options
            ),
            array(
                'name'    => 'col_xl',
                'label'   => esc_html__( 'Large Desktop', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => $options
            ),
            array(
                'name'    => 'col_xxl',
                'label'   => esc_html__( 'Extra Large Desktop', 'techrona' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => $options
            ),
            array(
                'name'         => 'gap',
                'label'        => esc_html__( 'Item Gap', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::NUMBER,
                'control_type' => 'responsive',
                'default'      => 30,
            ),
            array(
                'name'         => 'gap_extra',
                'label'        => esc_html__( 'Extra Gap Bottom', 'techrona' ),
                'description'  => esc_html__( 'Add extra space at bottom of each items','techrona'),
                'type'         => \Elementor\Controls_Manager::NUMBER,
                'default'      => 0,
            )
        );
    }
}
if(!function_exists('techrona_grid_column_settings')){
    function techrona_grid_column_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => \Elementor\Controls_Manager::TAB_LAYOUT,
            'condition' => [],
            'extra'     => []    
        ]);
        return array(
            'name'     => 'section_grid_settings',
            'label'    => esc_html__('Grid Columns Settings', 'techrona'),
            'tab'      => $args['tab'],
            'controls' => array_merge(
                techrona_column_settings(),
                $args['extra']
            ),
            'condition' => $args['condition']
        );
    }
}

// get column width
if(!function_exists('techrona_elementor_grid_column_class')){
    function techrona_elementor_grid_column_class($widget, $settings){
        $class = [];
        $class[] = 'col-xl-'.round(12/$settings['col_xl']);
        $class[] = 'col-lg-'.round(12/$settings['col_lg']);
        $class[] = 'col-md-'.round(12/$settings['col_md']);
        $class[] = 'col-sm-'.round(12/$settings['col_sm']);

        echo trim(implode(' ', $class));
    }
}

/**
 * Masonry Settings
*/
if(!function_exists('techrona_elementor_masonry_settings')){
    function techrona_elementor_masonry_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => 'settings',
            'condition' => []
        ]);
        
        return array(
            'name'      => 'section_masonry_settings',
            'label'     => esc_html__('Masonry Settings', 'techrona'),
            'tab'       => $args['tab'],
            'condition' => $args['condition'],
            'controls'  => array_merge(
                array(
                    array(
                        'name'    => 'masonry_mode',
                        'label'   => esc_html__( 'Masonry Mode', 'techrona' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'fitRows' => esc_html__( 'Basic Grid', 'techrona' ),
                            'masonry' => esc_html__( 'Masonry Grid', 'techrona' ),
                        ],
                        'default'   => 'fitRows'
                    )
                )
            )
        );
    }
}
if(!function_exists('techrona_elementor_masonry_filter_settings')){
    function techrona_elementor_masonry_filter_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => 'settings',
            'condition' => []
        ]);
        return array(
            'name'      => 'section_filter_settings',
            'label'     => esc_html__('Filter Settings', 'techrona'),
            'tab'       => $args['tab'],
            'condition' => $args['condition'],
            'controls'  => array_merge(
                array(
                    array(
                        'name'    => 'filter',
                        'label'   => esc_html__( 'Show Filter', 'techrona' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'true'  => esc_html__( 'Enable', 'techrona' ),
                            'false' => esc_html__( 'Disable', 'techrona' ),
                        ]
                    ),
                    array(
                        'name'      => 'filter_default_title',
                        'label'     => esc_html__( 'Default Title', 'techrona' ),
                        'type'      => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__( 'All', 'techrona' ),
                        'condition' => [
                            'filter' => 'true',
                        ],
                    ),
                    array(
                        'name'    => 'filter_alignment',
                        'label'   => esc_html__( 'Alignment', 'techrona' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => 'center',
                        'options' => [
                            'start'  => esc_html__( 'Start', 'techrona' ),
                            'center' => esc_html__( 'Center', 'techrona' ),
                            'end'    => esc_html__( 'End', 'techrona' ),
                        ],
                        'condition' => [
                            'filter' => 'true',
                        ],
                    )
                )
            )
        );
    }
}
if(!function_exists('techrona_elementor_masonry_pagination_settings')){
    function techrona_elementor_masonry_pagination_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => 'settings',
            'condition' => []
        ]);
        
        return array(
            'name'      => 'section_pagination_settings',
            'label'     => esc_html__('Pagination Settings', 'techrona'),
            'tab'       => $args['tab'],
            'condition' => $args['condition'],
            'controls'  => array_merge(
                array(
                    array(
                        'name'    => 'pagination_type',
                        'label'   => esc_html__( 'Pagination Type', 'techrona' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => 'false',
                        'options' => [
                            'pagination' => esc_html__( 'Pagination', 'techrona' ),
                            'loadmore'   => esc_html__( 'Loadmore', 'techrona' ),
                            'false'      => esc_html__( 'Disable', 'techrona' ),
                        ]
                    ),
                    array(
                        'name'      => 'loadmore_text',
                        'label'     => esc_html__( 'Load More text', 'techrona' ),
                        'type'      => \Elementor\Controls_Manager::TEXT,
                        'default'   => esc_html__('Load More','techrona'),
                        'condition' => [
                            'pagination_type' => 'loadmore'
                        ]
                    ),
                    array(
                        'name'    => 'pagination_align',
                        'label'   => esc_html__( 'Pagination alignment', 'techrona' ),
                        'type'    => \Elementor\Controls_Manager::SELECT,
                        'default' => 'start',
                        'options' => [
                            'start'  => esc_html__( 'Start', 'techrona' ),
                            'center' => esc_html__( 'Center', 'techrona' ),
                            'end'    => esc_html__( 'End', 'techrona' ),
                        ],
                        'condition' => [
                            'pagination_type' => ['pagination','loadmore']
                        ]
                    ),
                )
            )
        );
    }
}
if(!function_exists('techrona_elementor_masonry_column_settings')){
    function techrona_elementor_masonry_column_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => 'settings',
            'condition' => []
        ]);
        return techrona_grid_column_settings([
            'tab'       => $args['tab'],
            'condition' => $args['condition']
        ]);
    }
}
if(!function_exists('techrona_elementor_masonry_custom_column_settings')){
    function techrona_elementor_masonry_custom_column_settings($args = []){
        $args = wp_parse_args($args, [
            'tab'       => 'settings',
            'condition' => []
        ]);
        $options = [
            '12' => '12',
            '6'  => '6',
            '5'  => '5',
            '4'  => '4',
            '3'  => '3',
            '2'  => '2',
            '1.5' => '2/3',
            '1'  => '1'
        ];
        return array(
            'name'     => 'section_grid_custom_masonry_settings',
            'label'    => esc_html__('Custom Items Columns Settings', 'techrona'),
            'tab'      => $args['tab'],
            'controls' => array_merge(
                array(
                    array(
                        'name' => 'grid_custom_columns',
                        'label' => esc_html__('Grid Custom items Columns', 'techrona'),
                        'type' => \Elementor\Controls_Manager::REPEATER,
                        'controls' => array(
                            array(
                                'name' => 'col_xs_c',
                                'label' => esc_html__('Extra Small (XS)', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '1',
                                'options' => $options,
                            ),
                            array(
                                'name' => 'col_sm_c',
                                'label' => esc_html__('Small (SM - 576px)', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '2',
                                'options' => $options,
                            ),
                            array(
                                'name' => 'col_md_c',
                                'label' => esc_html__('Medium (MD - 768px)', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '3',
                                'options' => $options,
                            ),
                            array(
                                'name' => 'col_lg_c',
                                'label' => esc_html__('Large (LG - 992px)', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '3',
                                'options' => $options,
                            ),
                            array(
                                'name' => 'col_xl_c',
                                'label' => esc_html__('Large Desktop (XL - 1200px)', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '3',
                                'options' => $options,
                            ),
                            array(
                                'name' => 'col_xxl_c',
                                'label' => esc_html__('Extra Large Desktop (XL - 1366px)', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '3',
                                'options' => $options,
                            ), 
                            array(
                                'name' => 'thumbnail_size_c',
                                'label' => esc_html__('Image Size', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => [],
                                'options' => techrona_get_thumbnail_size(),
                            ),
                            array(
                                'name' => 'thumbnail_size_custom_c',
                                'label' => esc_html__('Image Size Custom', 'techrona' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'description' => 'Enter size in pixels (Default: 370x300 (Width x Height)).',
                                'condition' => ['thumbnail_size_c' => 'custom']
                            ) 
                        ),
                    ),
                )
            ),
            'condition' => $args['condition']
        );
    }
}

if(!function_exists('techrona_elementor_masonry_settings_render_attrs')){
    function techrona_elementor_masonry_settings_render_attrs($widget, $settings, $_args = []){
        $_args = wp_parse_args($_args,[
            'post_type' => 'post',
            'class'     => ''
        ]);
        $html_id   = kng_get_element_id($settings);
        extract(kng_get_posts_of_grid($_args['post_type'], [
            'source'   => $widget->get_setting('source_'.$_args['post_type'], ''),
            'orderby'  => $widget->get_setting('orderby', 'date'),
            'order'    => $widget->get_setting('order', 'desc'),
            'limit'    => $widget->get_setting('limit', 6),
            'post_ids' => $widget->get_setting('post_ids', ''),
        ]));
        $widget->add_render_attribute( 'wrapper', [
            'id'              => $html_id,
            'class'           => trim('kng-grid '.$_args['class']),
            'data-layoutmode' => $settings['masonry_mode'],
            'data-layout'     => 'masonry',
            'data-start-page' => $paged,
            'data-max-pages'  => $max,
            'data-total'      => $total,
            'data-perpage'    => $widget->get_setting('limit', 6),
            'data-next-link'  => $next_link
        ]);
        kng_print_html($widget->get_render_attribute_string( 'wrapper' ));
    }
}
/**
 * Hyperlink Settings
**/
if(!function_exists('techrona_elementor_hyperlink_settings')){
    function techrona_elementor_hyperlink_settings($args = []){
        $args = wp_parse_args($args, [
            'options'           => [],
            'condition'         => [],
            'prefix'            => '',
            'link_type'         => '',
            'link_type_default' => 'custom',
            'link_page'         => true,
            'link_post'         => true,
            'link_text'         => __('Read More','techrona'),
            'default_icon'      => [
                'library' => 'kngi',
                'value'   => 'kngi-arrow-right'
            ],
            'default_icon_align'=> 'left'
        ]);
        $_link_type = [
            'custom'   => esc_html__('Custom','techrona')
        ];  
        if($args['link_page']){
            $_link_type['page'] =  esc_html__('Internal Page','techrona');
        }
        if($args['link_post']){
            $_link_type = array_merge($_link_type, kng_get_post_type_options());
        }
        $post_type_link_opts = [];

        $default = array_merge(
            array(
                array(
                    'name'        => $args['prefix'].'link_type',
                    'label'       => esc_html__( 'Link Type', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => $args['link_type_default'],
                    'options'     => array_merge(
                        $_link_type, 
                        $args['options']
                    ),
                    'condition'   => array_merge($args['condition']),
                ),
                array(
                    'name'        => $args['prefix'].'link_page',
                    'label'       => esc_html__( 'Page Link', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => '',
                    'options'     => techrona_elementor_list_page_opts(),
                    'condition'   => array_merge($args['condition'], [$args['prefix'].'link_type' => 'page']),
                ), 
                array(
                    'name'        => $args['prefix'].'hyper_link',
                    'label'       => esc_html__( 'Custom Link', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://your-link.com', 'techrona' ),
                    'default'     => [
                        'url'         => '#',
                        'is_external' => 'on'
                    ],
                    'condition'   => array_merge($args['condition'], [$args['prefix'].'link_type' => 'custom']),
                )
            ),
            techrona_elementor_link_to_post_opts([
                'prefix'    => $args['prefix'],
                'condition' => $args['prefix'].'link_type'
            ]),
            array(
                array(
                    'name'      => $args['prefix'].'link_text',
                    'label'     => __( 'Link Text', 'techrona' ),
                    'type'      => \Elementor\Controls_Manager::TEXT,
                    'condition' => array_merge($args['condition']),
                    'dynamic'   => [
                        'active' => true,
                    ],
                    'default'    => $args['link_text']
                ),
                array(
                    'name'        => $args['prefix'].'link_color',
                    'label'       => __( 'Color', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'options'     => techrona_elementor_theme_color_opts(['custom' =>  false]),
                    'condition'   => array_merge($args['condition']),
                ),
                array(
                    'name'        => $args['prefix'].'link_hover_color',
                    'label'       => __( 'Hover Color', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'options'     => techrona_elementor_theme_color_opts(['custom' =>  false]),
                    'condition'   => array_merge($args['condition']),
                ),
                array(
                    'name'         => $args['prefix'].'link_align',
                    'label'        => __( 'Alignment', 'techrona' ),
                    'type'         => \Elementor\Controls_Manager::CHOOSE,
                    'control_type' => 'responsive',
                    'options'      => techrona_text_align_opts(),
                    'condition'    => array_merge($args['condition'])
                ),
                array(
                    'name'        => $args['prefix'].'link_icon',
                    'label'       => __( 'Icon', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::ICONS,
                    'label_block' => true,
                    'default'     => $args['default_icon'], 
                    'condition'   => array_merge($args['condition'])
                ),
                array(
                    'name'    => $args['prefix'].'link_icon_align',
                    'label'   => __( 'Icon Position', 'techrona' ),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => $args['default_icon_align'],
                    'options' => [
                        'left'  => __( 'Before', 'techrona' ),
                        'right' => __( 'After', 'techrona' ),
                    ],
                    'condition' => array_merge([
                            $args['prefix'].'link_icon[value]!' => ''
                        ],
                        $args['condition']
                    )
                ),
                array(
                    'name'  => $args['prefix'].'link_icon_size',
                    'label' => __( 'Icon Size', 'techrona' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 200,
                        ],
                    ],
                    'condition' => array_merge([
                            $args['prefix'].'link_icon[value]!' => ''
                        ],
                        $args['condition']
                    ),
                    'selectors' => [
                        '{{WRAPPER}} .kng-link .kng-icon' => 'font-size: {{SIZE}}{{UNIT}};'
                    ]
                ),
                array(
                    'name'  => $args['prefix'].'link_icon_indent',
                    'label' => esc_html__( 'Icon Spacing', 'techrona' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 200,
                        ],
                    ],
                    'condition' => array_merge([
                            $args['prefix'].'link_icon[value]!' => ''
                        ],
                        $args['condition']
                    ),
                    'selectors' => [
                        '{{WRAPPER}} .kng-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .kng-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ]
                )
            )
        );
        return wp_parse_args($args['options'], $default);
    }
}
if(!function_exists('techrona_elementor_custom_link_attrs')){
    function techrona_elementor_custom_link_attrs($settings, $args = []){
        $args = wp_parse_args($args, [
            'name'   => 'hyper_link',
            'prefix' => '',
            'class'  => '',
            'echo'   => false
        ]);
        if(empty($settings[$args['prefix'].$args['name']]['url'])) return;
        
        $settings[$args['prefix'].$args['name']]['custom_attributes'] =  empty($settings[$args['prefix'].$args['name']]['custom_attributes']) ? 'class|' : $settings[$args['prefix'].$args['name']]['custom_attributes'];

        $link_attrs = [];
        if ( ! empty( $settings[$args['prefix'].$args['name']]['url'] ) ) {
            $link_attrs[] = 'href="'.$settings[$args['prefix'].$args['name']]['url'].'"';
        }
        if ( ! empty($settings[$args['prefix'].$args['name']]['is_external'] )) {
            $link_attrs[] = 'target="_blank"';
        }
        if ( ! empty($settings[$args['prefix'].$args['name']]['nofollow'] )) {
            $link_attrs[] = 'rel="nofollow"';
        }
        if( ! empty($settings[$args['prefix'].$args['name']]['custom_attributes'])){
            $custom_attributes = explode(',', $settings[$args['prefix'].$args['name']]['custom_attributes']);
            foreach ($custom_attributes as $atts_value) {
                $_custom_attributes = explode('|', $atts_value);
                if($_custom_attributes[0] === 'class') $_custom_attributes[1] .= ' '.$args['class'];
                $link_attrs[] = $_custom_attributes[0].'="'.$_custom_attributes[1].'"';
            }
        }
        if($args['echo']){
            return trim(implode(' ', $link_attrs));
        } else {
            return $link_attrs;
        }
    }
}
if(!function_exists('techrona_elementor_page_link_attrs')){
    function techrona_elementor_page_link_attrs($settings, $args = []){
        $args = wp_parse_args($args, [
            'prefix'    => '',
            'class'     => '',
            'echo'      => false,
            'post_type' => 'page'
        ]);
        $page_link_attrs = [];
        $page_link_attrs[] = 'href="'.get_permalink($settings[$args['prefix'].'link_'.$args['post_type']]).'"';
        //$page_link_attrs[] = 'target="_blank"';
        $page_link_attrs[] = 'class="'.$args['class'].'"';
        if($args['echo']){
            return trim(implode(' ',$page_link_attrs));
        } else {
            return $page_link_attrs;
        }
    }
}

if(!function_exists('techrona_elementor_hyperlink_render')){
    function techrona_elementor_hyperlink_render($settings, $args = []){
        $args = wp_parse_args($args, [
            'prefix'           => '',
            'tag'              => 'div',
            'link_type'        => 'custom',
            'link_text'        => esc_html__('Read More','techrona'),
            'link_color'       => '',
            'link_hover_color' => '',
            'wrap_class'       => '',    
            'class'            => '',
            'default_icon'     => [
                'value'   => 'kngi-arrow-right',
                'library' => 'kngi'
            ],
            'icon_class' => '',
            'icon_align' => 'left', 
            'before'     => '',
            'after'      => '',
            'echo'       => true,
        ]);
        
        $link_text = !empty($settings[$args['prefix'].'link_text']) ? $settings[$args['prefix'].'link_text'] : $args['link_text'];
        $link_attrs = '';
        $link_color = !empty($settings[$args['prefix'].'link_color']) ? $settings[$args['prefix'].'link_color'] : $args['link_color'];
        $link_hover_color = !empty($settings[$args['prefix'].'link_hover_color']) ? $settings[$args['prefix'].'link_hover_color'] : $args['link_hover_color'];
        $args['class'] .= ' d-inline-block text-'.$link_color.' text-hover-'.$link_hover_color;

        if($settings[$args['prefix'].'link_type'] === 'custom'){
            $link_attrs = techrona_elementor_custom_link_attrs($settings, $args);
        } else {
            $link_attrs = techrona_elementor_page_link_attrs($settings, array_merge($args, ['post_type' => $settings[$args['prefix'].'link_type']]));
        }
        if(empty($link_attrs)) return;

        $settings[$args['prefix'].'link_icon_align'] = empty($settings[$args['prefix'].'link_icon_align']) ? $args['icon_align'] : $settings[$args['prefix'].'link_icon_align'];
        if($settings[$args['prefix'].'link_icon_align'] === 'left'){
            $icon_class = 'order-first';
        } else {
            $icon_class = 'order-last';
        }
        ?>
            <<?php printf('%s', $args['tag']);?> class="<?php echo trim(implode(' ', ['kng-link', $args['wrap_class']]));?>">
                <?php printf('%s', $args['before']); ?>
                <a <?php printf('%s', $link_attrs) ;?>>
                    <span class="kng-btn-content"><?php 
                        techrona_elementor_icon_render($settings, [
                            'id'           => $args['prefix'].'link_icon',
                            'loop'         => false,
                            'tag'          => 'span',   
                            'wrap_class'   => 'kng-btn-icon '.$icon_class,
                            'class'        => 'kng-link-icon kng-align-icon-'.$settings[$args['prefix'].'link_icon_align'].' '.$args['icon_class'].' rtl-flip',
                            'style'        => '',
                            'before'       => '',
                            'after'        => '',
                            'atts'         => [],
                            'default_icon' => $args['default_icon']
                        ]);
                        printf('%s', '<span class="kng-btn-text">'.$link_text.'</span>');
                    ?></span>
                </a>
                <?php printf('%s', $args['after']); ?>
            </<?php printf('%s', $args['tag']);?>>
        <?php
    }
}
/**
 * Buttons Settings
**/
if(!function_exists('techrona_elementor_button_settings')){
    function techrona_elementor_button_settings($args = []){
        $args = wp_parse_args($args, [
            'options'               => [],
            'condition'             => [],
            'prefix'                => '',
            'btn_text'              => '',
            'btn_type'              => [],
            'btn_type_default'      => 'btn btn-fill',
            'btn_link_type'         => [],
            'btn_link_type_default' => 'custom',
            'btn_color'             => 'accent',
            'btn_hover_color'       => 'secondary',
            'btn_size'              => '',
            'btn_align'             => '',
            'icon_default'          => [
                'value'             => '',
                'library'           => 'kngi'
            ],
            'icon_align'            => 'right',
            'separator'             => '',
            'effect'                => true
        ]);
        $prefix_cls = !empty($args['prefix']) ? '.'.$args['prefix'] : '';
        $default = array_merge(
            array(
                array(
                    'name'        => $args['prefix'].'btn_text',
                    'label'       => __( 'Button Text', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => $args['btn_text'],
                    'placeholder' => __('Your Text', 'techrona'),
                    'condition'   => $args['condition'],
                    'separator'   => $args['separator']
                ),
                array(
                    'name'        => $args['prefix'].'show_btn_text',
                    'label'       => __( 'Show Button Text', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SWITCHER,
                    'default'     => 'true',
                    'condition'   => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition']),
                ),
                array(
                    'name'        => $args['prefix'].'btn_link_type',
                    'label'       => __( 'Link Type', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => $args['btn_link_type_default'],
                    'options'     => array_merge(
                        [
                            'custom'   => __('Custom','techrona'),
                            'page'     => __('Internal Page','techrona'),
                        ],
                        kng_get_post_type_options(),
                        $args[ 'btn_link_type']
                    ),
                    'condition' => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition']),
                ),
                array(
                    'name'        => $args['prefix'].'link_page',
                    'label'       => __( 'Page Link', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => '',
                    'options'     => techrona_elementor_list_page_opts(),
                    'condition'   => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition'], [$args['prefix'].'btn_link_type' => 'page'])
                ),
                array(
                    'name'        => $args['prefix'].'btn_link',
                    'label'       => __( 'Custom Link', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::URL,
                    'placeholder' => __( 'https://your-link.com', 'techrona' ),
                    'default'     => [
                        'url' => '#',
                    ],
                    'condition' => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition'], [$args['prefix'].'btn_link_type' => 'custom'])
                )
            ),
            techrona_elementor_link_to_post_opts([
                'prefix'           => $args['prefix'],
                'condition'        => $args['prefix'].'btn_link_type',
                'custom_condition' => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition'])
            ]),
            array(
                array(
                    'name'        => $args['prefix'].'btn_type',
                    'label'       => __( 'Mode', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => $args['btn_type_default'],
                    'options'     => array_merge(
                        [
                            'btn btn-fill'              => esc_html__('Default','techrona'),
                            'btn btn-primary'           => esc_html__('Primary','techrona'),
                            'btn btn-secondary'         => esc_html__('Secondary','techrona'),
                            'btn btn-black'             => esc_html__('black','techrona'),
                            'btn btn-outline'           => esc_html__('Outline Default','techrona'),
                            'btn btn-outline primary'   => esc_html__('Outline primary','techrona'),
                            'btn btn-outline secondary' => esc_html__('Outline secondary','techrona'),
                            'btn btn-outline third'     => esc_html__('Outline third','techrona'),
                            'btn btn-outline white'     => esc_html__('Outline white','techrona'),
                            'btn btn-outline white opacity'     => esc_html__('Outline white opacity','techrona'),
                            'btn btn-outline black'     => esc_html__('Outline black','techrona'),
							'btn-link'            		=> esc_html__('Link','techrona'),
                            'btn btn-custom'            => esc_html__('Custom','techrona')
                        ],
                        $args['btn_type']
                    ),
                    'condition' => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition'])
                ),
				array(
                    'name'        => $args['prefix'].'btn_bg_color',
                    'label'       => esc_html__( 'Background Color', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts(),
                    'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], $args['condition'])
                ),
				array(
                    'name'        => $args['prefix'].'btn_bg_color_custom',
                    'label'       => esc_html__( 'Custom Bg Color', 'techrona' ),
                    'type'        => 'color',
					'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], [$args['prefix'].'btn_bg_color' => 'custom'], $args['condition']),
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' .btn' => 'background-color:{{VALUE}};'
                    ]
                ),
				array(
                    'name'        => $args['prefix'].'btn_bg_color_hover',
                    'label'       => esc_html__( 'Background Color Hover', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts(),
                    'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], $args['condition'])
                ),
				array(
                    'name'        => $args['prefix'].'btn_bg_color_custom_hover',
                    'label'       => esc_html__( 'Custom Bg Hover Color', 'techrona' ),
                    'type'        => 'color',
					'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], [$args['prefix'].'btn_bg_color_hover' => 'custom'], $args['condition']),
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' .btn:hover' => 'background-color:{{VALUE}} !important;'
                    ]
                ),
				array(
                    'name'        => $args['prefix'].'btn_border_color',
                    'label'       => esc_html__( 'Border Color', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts(),
                    'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], $args['condition'])
                ),
				array(
                    'name'        => $args['prefix'].'btn_border_color_custom',
                    'label'       => esc_html__( 'Custom Border Color', 'techrona' ),
                    'type'        => 'color',
					'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], [$args['prefix'].'btn_border_color' => 'custom'], $args['condition']),
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' .btn' => 'border-color:{{VALUE}};'
                    ]
                ),
				array(
                    'name'        => $args['prefix'].'btn_border_color_hover',
                    'label'       => esc_html__( 'Border Color Hover', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts(),
                    'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], $args['condition'])
                ),
				array(
                    'name'        => $args['prefix'].'btn_border_color_custom_hover',
                    'label'       => esc_html__( 'Custom Border Hover Color', 'techrona' ),
                    'type'        => 'color',
					'condition'   => array_merge([$args['prefix'].'btn_type' => 'btn btn-custom'], [$args['prefix'].'btn_border_color_hover' => 'custom'], $args['condition']),
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' .btn:hover' => 'border-color:{{VALUE}} !important;'
                    ]
                ),
                array(
                    'name'        => $args['prefix'].'btn_color',
                    'label'       => __( 'Color', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => $args['btn_color'],
                    'options'     => techrona_elementor_theme_color_opts(),
                    'condition'   => array_merge([$args['prefix'].'btn_type' => ['btn-link','btn btn-custom']], $args['condition'])
                ),
				array(
                    'name'        => $args['prefix'].'btn_color_custom',
                    'label'       => esc_html__( 'Custom Color', 'techrona' ),
                    'type'        => 'color',
					'condition'   => array_merge([$args['prefix'].'btn_type' => ['btn-link','btn btn-custom']], [$args['prefix'].'btn_color' => 'custom'], $args['condition']),
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' a' => 'color:{{VALUE}};'
                    ]
                ),
                array(
                    'name'        => $args['prefix'].'btn_hover_color',
                    'label'       => __( 'Hover Color', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => $args['btn_hover_color'],
                    'options'     => techrona_elementor_theme_color_opts(),
                    'condition'   => array_merge([$args['prefix'].'btn_type' => ['btn-link','btn btn-custom']], $args['condition']),
                ),
				array(
                    'name'        => $args['prefix'].'btn_hover_color_custom',
                    'label'       => esc_html__( 'Custom Hover Color', 'techrona' ),
                    'type'        => 'color',
					'condition'   => array_merge([$args['prefix'].'btn_type' => ['btn-link','btn btn-custom']], [$args['prefix'].'btn_hover_color' => 'custom'], $args['condition']),
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' a:hover' => 'color:{{VALUE}} !important;'
                    ]
                ),
				array(
					'name'       => $args['prefix'].'btn_radius',
					'label'      => esc_html__( 'Border Radius', 'techrona' ),
					'type'       => 'dimensions',
					'size_units' => [ 'px', '%' ],
					'condition' => array_merge([$args['prefix'].'btn_text!' => ''],[$args['prefix'].'btn_type!' => ['btn-link']], $args['condition']), 
					'selectors'  => [
						'{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					]
				),
                array(
                    'name'        => $args['prefix'].'btn_size',
                    'label'       => __( 'Size', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'default'     => $args['btn_size'],
                    'options'     => [
                        'xsmall'  => __('Extra Small','techrona'),  
                        'small'  => __('Small','techrona'),  
                        ''    => __('Default','techrona'),
                        'medium'  => __('Medium','techrona'),
                        'large'  => __('Large','techrona'),
                        'xlarge'  => __('Extra Large','techrona')
                    ],
                    'condition' => array_merge([$args['prefix'].'btn_text!' => ''],[$args['prefix'].'btn_type!' => ['btn-link']], $args['condition']), 
                ),
                array(
                    'name' => $args['prefix'].'button_padding',
                    'label' => esc_html__('Button Padding(px)', 'techrona' ),
                    'type' => 'dimensions',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls.' .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition'   => array_merge([$args['prefix'].'btn_text!' => ''],[$args['prefix'].'btn_type!' => ['btn-link']], $args['condition']),
                ),
                array(
                    'name' => $args['prefix'].'button_margin',
                    'label' => esc_html__('Button Margin(px)', 'techrona' ),
                    'type' => 'dimensions',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .kng-btn-wraps'.$prefix_cls => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition'   => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition']),
                ),
				array(
                    'name'         => $args['prefix'].'align',
                    'label'        => __( 'Button Alignment', 'techrona' ),
                    'type'         => \Elementor\Controls_Manager::CHOOSE,
                    'control_type' => 'responsive',
                    'options'      => techrona_text_align_opts(),
                    'default'      => $args['btn_align'],
                    'condition'    => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition'])
                ),
                array(
                    'name'             => $args['prefix'].'btn_icon',
                    'label'            => __( 'Icon', 'techrona' ),
                    'type'             => \Elementor\Controls_Manager::ICONS,
                    'label_block'      => true,
                    'fa4compatibility' => 'icon',
                    'condition'        => array_merge([$args['prefix'].'btn_text!' => ''], $args['condition']),
                    'default'          => $args['icon_default']
                ),
                array(
                    'name'        => $args['prefix'].'show_btn_icon',
                    'label'       => __( 'Show Button Icon', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::SWITCHER,
                    'default'     => 'true',
                    'condition' =>  array_merge([
                            $args['prefix'].'btn_text!' => '',
                            $args['prefix'].'btn_icon[value]!' => ''
                        ],
                        $args['condition']
                    ),
                ),
                array(
                    'name'    => $args['prefix'].'icon_align',
                    'label'   => __( 'Icon Position', 'techrona' ),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => $args['icon_align'],
                    'options' => [
                        'left'  => __( 'Before', 'techrona' ),
                        'right' => __( 'After', 'techrona' ),
                    ],
                    'condition' => array_merge([
                            $args['prefix'].'btn_text!' => '',
                            $args['prefix'].'btn_icon[value]!' => '',
                            $args['prefix'].'show_btn_icon' => 'true'
                        ],
                        $args['condition']
                    )
                ),
                array(
                    'name'  => $args['prefix'].'btn_icon_size',
                    'label' => __( 'Icon Size', 'techrona' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'condition' => array_merge([
                            $args['prefix'].'btn_text!' => '',
                            $args['prefix'].'btn_icon[value]!' => '',
                            $args['prefix'].'show_btn_icon' => 'true'
                        ],
                        $args['condition']
                    ),
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .kng-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .'.$args['prefix'].'item .kng-btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ]
                ),
                array(
                    'name'  => $args['prefix'].'icon_indent',
                    'label' => __( 'Icon Spacing', 'techrona' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'control_type' => 'responsive',
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 200,
                        ],
                    ],
                    'condition' => array_merge([
                            $args['prefix'].'btn_text!' => '',
                            $args['prefix'].'btn_icon[value]!' => '',
                            $args['prefix'].'show_btn_icon' => 'true'
                        ],
                        $args['condition']
                    ),
                    'selectors' => [
                        '{{WRAPPER}} '.$prefix_cls.'item .kng-btn-content-'.$args['prefix'].' .kng-btn-icon.kng-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} '.$prefix_cls.'item .kng-btn-content-'.$args['prefix'].' .kng-btn-icon.kng-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ]
                ),
                array(
                    'name'        => $args['prefix'].'btn_css_class',
                    'label'       => __( 'Custom CSS Class', 'techrona' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'condition' => array_merge([
                            $args['prefix'].'btn_text!' => ''
                        ],
                        $args['condition']
                    )
                )
            )
        );
        if($args['effect']){
            $effect = [
                array(
                    'name'      => $args['prefix'].'btn_animation',
                    'label'     => esc_html__( 'Button Motion Effect', 'techrona' ),
                    'type'      => \Elementor\Controls_Manager::ANIMATION,
                    'condition' => [
                        $args['prefix'].'btn_text!' => ''
                    ]
                ),
                array(
                    'name'    => $args['prefix'].'btn_animation_duration', 
                    'label'   => __( 'Animation Duration', 'techrona' ),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => 'normal',
                    'options' => [
                        'slow'   => __( 'Slow', 'techrona' ),
                        'normal' => __( 'Normal', 'techrona' ),
                        'fast'   => __( 'Fast', 'techrona' ),
                    ],
                    'condition' => [
                        $args['prefix'].'btn_animation!' => '',
                    ]
                ),
                array(
                    'name'      => $args['prefix'].'btn_animation_delay',
                    'label'     => esc_html__( 'Animation Delay', 'techrona' ),
                    'type'      => \Elementor\Controls_Manager::NUMBER,
                    'min'       => 0,
                    'step'      => 100,
                    'default'   => 300,
                    'condition' => [
                        $args['prefix'].'btn_animation!' => ''
                    ]
                )
            ];
        } else {
            $effect = [];
        }
        $default = wp_parse_args($args['options'], $default);
        return array_merge($default, $effect);
    }
}
// Button Render
if(!function_exists('techrona_elementor_button_render')){
    function techrona_elementor_button_render( $settings, $args = []){
        $args = wp_parse_args($args, [
            'post_id'     => '',
            'tag'         => 'div',
            'overwrite'   => false,
            'prefix'      => '',
            'wrap'        => true,
            'class'       => '',
            'btn_class'   => '',
            'icon_before' => '',
            'icon_after'  => '',
            'icon_class'  => '',
            'custom_link' => '',
            'default'     => [
                'btn_text' => '',
                'btn_type' => ''
            ],
            'align'        => '',
            'attrs'        => 'data-url="#"'  
        ]);
        if(empty($settings[$args['prefix'].'btn_text'])) return;
        $button_attrs = [];
        $button_class = [$settings[$args['prefix'].'btn_type']];

        if(empty($settings[$args['prefix'].'btn_type'])) $settings[$args['prefix'].'btn_type'] = $args['default']['btn_type'];
        if( !in_array($settings[$args['prefix'].'btn_type'], ['btn-link']) ){
            if($settings[$args['prefix'].'btn_type'] == 'btn btn-custom'){
                if ( ! empty( $settings[$args['prefix'].'btn_bg_color'] ) ) {
                    $button_class[] = 'bg-'.$settings[$args['prefix'].'btn_bg_color'];
                }
                if ( ! empty( $settings[$args['prefix'].'btn_bg_color_hover'] ) ) {
                    $button_class[] = 'bg-hover-'.$settings[$args['prefix'].'btn_bg_color_hover'];
                }
                if ( ! empty( $settings[$args['prefix'].'btn_border_color'] ) ) {
                    $button_class[] = 'bd-'.$settings[$args['prefix'].'btn_border_color'];
                }
                if ( ! empty( $settings[$args['prefix'].'btn_border_color_hover'] ) ) {
                    $button_class[] = 'bd-hover-'.$settings[$args['prefix'].'btn_border_color_hover'];
                }
                if ( ! empty( $settings[$args['prefix'].'btn_color'] ) ) {
                    $button_class[] = 'text-' . $settings[$args['prefix'].'btn_color'];
                }
                if ( ! empty( $settings[$args['prefix'].'btn_hover_color'] ) ) {
                    $button_class[] = 'text-hover-' . $settings[$args['prefix'].'btn_hover_color'];
                }
            }
            if ( ! empty( $settings[$args['prefix'].'btn_size'] ) ) {
                $button_class[] = 'btn-' . $settings[$args['prefix'].'btn_size'];
            }
        }else {
            if ( ! empty( $settings[$args['prefix'].'btn_color'] ) ) {
                $button_class[] = 'text-' . $settings[$args['prefix'].'btn_color'];
            }
            if ( ! empty( $settings[$args['prefix'].'btn_hover_color'] ) ) {
                $button_class[] = 'text-hover-' . $settings[$args['prefix'].'btn_hover_color'];
            }
        }
        //$button_class[] = 'text-'.$settings[$args['prefix'].'align'];
        if( !empty($settings[$args['prefix'].'align'.'_mobile']) && $settings[$args['prefix'].'align'.'_mobile'] === 'justify' ){
            $button_class[] = 'd-sm-block';
        }
        if( !empty($settings[$args['prefix'].'align'.'_tablet']) && $settings[$args['prefix'].'align'.'_tablet'] === 'justify'){
            $button_class[] = 'd-md-block';
        }
        if( !empty($settings[$args['prefix'].'align']) && $settings[$args['prefix'].'align'] === 'justify' && ($settings[$args['prefix'].'align'.'_mobile'] !== 'justify' && $settings[$args['prefix'].'align'.'_tablet'] !== 'justify' ) ) {
            $button_class[] = 'd-block';
        } elseif( !empty($settings[$args['prefix'].'align']) && $settings[$args['prefix'].'align'] === 'justify'){
            $button_class[] = 'd-lg-block';
        }

        $button_class[] = $args['btn_class'];
        if(empty($settings[$args['prefix'].'btn_icon']['value'])) $button_class[] = 'btn-no-icon';
        $button_class[] = $settings[$args['prefix'].'btn_css_class'];
        
 
        $btn_wrap_attrs = [];
        $btn_align = techrona_elementor_align_class($settings, [ 'id' => $args['prefix'].'align', 'default' => $args['align'] ] ) ; 
        $btn_wrap_attrs['class'] = 'kng-btn-wraps '.$args['class'].' '.$btn_align;
        $btn_wrap_attrs['data-settings'] = '';
        // Button Animation
        if(isset($settings[$args['prefix'].'btn_animation']) && $settings[$args['prefix'].'btn_animation'] !== '' && $settings[$args['prefix'].'btn_animation'] !== 'none'){
            $btn_wrap_attrs['class'] .= ' kng-animate kng-invisible';
            if(isset($settings[$args['prefix'].'btn_animation']) && $settings[$args['prefix'].'btn_animation'] !== ''){
                $btn_wrap_attrs['data-settings'] = json_encode([
                    'animation'      => $settings[$args['prefix'].'btn_animation'],
                    'animation_delay' => $settings[$args['prefix'].'btn_animation_delay']
                ]);
                 
            }
        }

        // Button attrs
        if($settings[$args['prefix'].'btn_link_type'] === 'custom'){
            $button_attrs = techrona_elementor_custom_link_attrs($settings,[
                'name'   => 'btn_link',
                'prefix' => $args['prefix'],
                'class'  => trim(implode(' ', $button_class))
            ]);
        } else {
            $button_attrs = techrona_elementor_page_link_attrs($settings, array_merge($args, [
                'post_type' => $settings[$args['prefix'].'btn_link_type'],
                'class'     => trim(implode(' ', $button_class))
            ]));
        }
        // Button Animation
        
        // custom attributes
        $button_attrs[] = $args['attrs'];

        if($args['wrap'] == true):
        ?>
        <<?php echo esc_html($args['tag']);?> class="<?php echo esc_attr($btn_wrap_attrs['class']) ?>" <?php echo esc_attr($args['attrs']);?> data-settings="<?php echo esc_attr($btn_wrap_attrs['data-settings']);?>">
        <?php endif; ?>
            <a <?php echo trim(implode(' ', $button_attrs)); ?>>
                <span class="kng-btn-content kng-btn-content-<?php echo esc_attr($args['prefix']);?>">
                    <?php if(!empty($settings[$args['prefix'].'btn_icon']['value']) && $settings[$args['prefix'].'show_btn_icon'] === 'true' ) : ?>
                        <span class="kng-btn-icon kng-align-icon-<?php echo esc_attr($settings[$args['prefix'].'icon_align']);?> <?php echo esc_attr($args['icon_class']);?> rtl-flip">
                            <?php
                                \Elementor\Icons_Manager::render_icon( $settings[$args['prefix'].'btn_icon'], [ 'aria-hidden' => 'true' ] );
                            ?>
                        </span>
                    <?php endif; 
                    if($settings[$args['prefix'].'show_btn_text'] === 'true') {
                    ?>
                    <span class="kng-btn-text"><?php printf('%s', $settings[$args['prefix'].'btn_text']); ?></span>
                    <?php } ?>
                </span>
            </a>
        <?php  if($args['wrap'] == true): ?>
        </<?php echo esc_html($args['tag']);?>>
        <?php
            endif;
        }
}
// Image Render 
if(!function_exists('techrona_elementor_image_render')){
    function techrona_elementor_image_render($settings, $widget, $args = [], $data = []){
        $args = wp_parse_args($args, [
            'id'            => 'selected_img',
            'attachment_id' => '',
            'size'          => 'thumbnail_size',
            'class'         => '',
            'img_class'     => '',
            'before'        => '',
            'after'         => '',
            'echo'          => true
        ]);
         
        if(!empty($data)){
            if(!isset($data[$args['size'].'_size'])) $data[$args['size'].'_size'] = $settings[$args['size'].'_size'];
            if(!isset($data[$args['size'].'_custom_dimension'])) $data[$args['size'].'_custom_dimension'] = $settings[$args['size'].'_custom_dimension'];
            $settings = !empty($data) ? $data : $settings;
        }
         
        if ( empty( $settings[$args['id']]['url'] ) && empty($args['attachment_id']) ) return;
        
        $image_attr = [
            'class' => $args['class']
        ];
         
        if(!empty($args['attachment_id'])) {
            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $args['attachment_id'], $args['size'], $settings );
            $img_alt = trim( strip_tags(get_post_meta( $args['attachment_id'], '_wp_attachment_image_alt', true )));
            $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $img_alt) . '" class="'.esc_attr($args['img_class']).'" />';
        } else {  
            $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, $args['size'], $args['id']);
        }
        ob_start();
            printf('%1$s%2$s%3$s', $args['before'], $image_html, $args['after']);
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}
// Loop Image Render 
if(!function_exists('techrona_elementor_loop_image_render')){
    function techrona_elementor_loop_image_render($settings, $widget, $args = [], $data = []){
        $args = wp_parse_args($args, [
            'id'            => 'selected_img',
            'attachment_id' => '',
            'size'          => 'thumbnail_size',
            'class'         => '',
            'img_class'     => '',
            'before'        => '',
            'after'         => '',
            'echo'          => true
        ]);
        if(!isset($data[$args['size'].'_size'])) $data[$args['size'].'_size'] = $settings[$args['size'].'_size'];
        if(!isset($data[$args['size'].'_custom_dimension'])) $data[$args['size'].'_custom_dimension'] = $settings[$args['size'].'_custom_dimension'];
        $settings = !empty($data) ? $data : $settings;
        $image_attr = [
            'class' => $args['class']
        ];
        if(!empty($args['attachment_id'])) {
            $image_url = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $args['attachment_id'], $args['size'], $settings );
            $img_alt = trim( strip_tags(get_post_meta( $args['attachment_id'], '_wp_attachment_image_alt', true )));
            $image_html = '<img src="' . esc_attr( $image_url ) . '" alt="' . esc_attr( $img_alt) . '" class="'.esc_attr($args['img_class']).'" />';
        } else {
            $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, $args['size'], $args['id']);
        }
        ob_start();
            printf('%1$s%2$s%3$s', $args['before'], $image_html, $args['after']);
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}
// Image URL Render 
if(!function_exists('techrona_elementor_image_url_render')){
    function techrona_elementor_image_url_render($settings, $args = []){
        $args = wp_parse_args($args, [
            'id'            => 'selected_img',
            'size'          => 'thumbnail_size',
            'custom_size'   => '',
            'default_thumb' => false,
            'default_img'   => ''  
        ]); 
        if(empty($settings[$args['id']]) && empty($args['url'])) return;
        if(empty($args['custom_size'])){
            $thumbnail_size_custom = isset($settings[$args['size'].'_custom_dimension']) ? $settings[$args['size'].'_custom_dimension'] : ['width' => '', 'height' => ''];
            if(isset($settings[$args['size'].'_size']) && $settings[$args['size'].'_size'] != 'custom'){
                $img_size = $settings[$args['size'].'_size'];
            }
            elseif(!empty($thumbnail_size_custom['width']) && !empty($thumbnail_size_custom['height'])){
                $img_size = $thumbnail_size_custom['width'] . 'x' . $thumbnail_size_custom['height'];
            }
            else{
                $img_size = 'full';
            }
        } else {
            $img_size = $args['custom_size'];
        }

        return techrona_get_image_url_by_size([
            'id'          => $settings[$args['id']]['id'],
            'size'        => $img_size,
            'default_img' => $args['default_img'],
            'default_thumb' => $args['default_thumb']  
        ]);
    }
}
// Setting Icon
if(!function_exists('techrona_elementor_icon_settings')){
    function techrona_elementor_icon_settings($args = []){
        $args = wp_parse_args($args, [
            'prefix'       => '', 
            'name'         => 'selected_icon',
            'label'        => __('Icon', 'techrona'),
            'default_icon' => [
                'value'   => '',
                'library' => ''
            ],
            'selector' => ''
        ]);
        return array_merge(
            array(
                array(
                    'name'    => $args['prefix'].$args['name'],
                    'label'   => $args['label'],
                    'type'    => \Elementor\Controls_Manager::ICONS,
                    'default' => $args['default_icon'],
                )
            ),
            techrona_elementor_theme_colors([
                'name'                => $args['prefix'].$args['name'].'_color',
                'label'               => esc_html__('Main Color', 'techrona'),
                'custom'              => true,
                'custom_label'        => esc_html__('Custom Main Color', 'techrona'),
                'custom_selector'     => $args['selector'],
                'custom_selector_tag' => 'color',
            ]),
            techrona_elementor_theme_colors([
                'name'                => $args['prefix'].$args['name'].'_hover_color',
                'label'               => esc_html__('Hover Color', 'techrona'),
                'custom'              => true,
                'custom_label'        => esc_html__('Custom Hover Color', 'techrona'),
                'custom_selector'     => $args['selector'].':hover',
                'custom_selector_tag' => 'color',
            ]),
            array(
                array(
                    'name'  => $args['prefix'].$args['name'].'_size',
                    'label' => esc_html__( 'Icon Size', 'techrona' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 15,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} '.$args['selector'] => 'font-size: {{SIZE}}{{UNIT}};'
                    ]
                ),
                array(
                    'name'  => $args['prefix'].$args['name'].'_spacing',
                    'label' => esc_html__( 'Icon Spacing', 'techrona' ),
                    'type'  => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 200,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} '.$args['selector'] => 'margin-right: {{SIZE}}{{UNIT}};',
                    ]
                )
            )
        );
    }
}
// Render icon 
if(!function_exists('techrona_elementor_icon_render')){
    function techrona_elementor_icon_render( $settings, $args = []){
        $args = wp_parse_args($args, [
            'prefix'     => '',   
            'id'         => 'selected_icon',
            'loop'       => false,
            'tag'        => 'div',   
            'wrap_class' => '',
            'class'      => '',
            'style'      => '',
            'before'     => '',
            'after'      => '',
            'atts'       => [],
            'animate_data' => '',
            'default_icon'    => [
                'value'   => '',
                'library' => ''
            ],
            'echo' => true
        ]);
        if($args['loop']) {
            $icon = $args['id'];
        } else {
            $icon = $settings[$args['id']];
        }
        if(empty($icon['value'])) $icon = $args['default_icon'];
        if (empty($icon['value'])) return;

        if ( 'svg' === $icon['library'] ){
            $args['before'] = '<span class="'.$args['wrap_class'].' '.$args['class'].'" data-settings="'. esc_attr($args['animate_data']).'">';
            $args['after']  = '</span>';
        }
        ob_start();
        printf('%s', $args['before']);
        ?>
        <a class="<?php echo esc_attr(trim(implode(' ', ['kng-icon', $args['class'], $args['wrap_class']]))) ?>" href="<?php echo esc_url($args['atts']['href']) ?>" target="<?php echo esc_attr($args['atts']['target']) ?>" >
        <?php \Elementor\Icons_Manager::render_icon($icon,[],$args['tag']); ?>
        </a>
        <?php
        printf('%s', $args['after']);

        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}

// Render link options
if(!function_exists('techrona_elementor_link_render')){
    function techrona_elementor_link_render($key, $args =[]){
        $attributes = $atts = [];
        if ( ! empty( $key['url'] ) ) {
            $attributes['href'] = esc_url( $key['url'] );
        }

        if ( ! empty( $key['is_external'] ) ) {
            $attributes['target'] = '_blank';
        }

        if ( ! empty( $key['nofollow'] ) ) {
            $attributes['rel'] = 'nofollow';
        }
        
        if ( ! empty( $key['custom_attributes'] ) ) {
            // Custom URL attributes should come as a string of comma-delimited key|value pairs
            $attributes = array_merge( $attributes, techrona_parse_custom_attributes( $key['custom_attributes'] ) );
        }

        $attributes = techrona_array_merge_recursive($attributes, $args);
        
        echo trim(implode(' ', $attributes));
    }
}
// Get Excerpt
if(!function_exists('techrona_elementor_excerpt')){
    function techrona_elementor_excerpt($post, $num_words, $more ){
        if(!empty($post->post_excerpt)){
            echo wp_trim_words( $post->post_excerpt, $num_words, $more = null );
        } else {
            $content = strip_shortcodes( $post->post_content );
            $content = apply_filters( 'the_content', $content );
            $content = str_replace(']]>', ']]&gt;', $content);
            echo wp_trim_words( $content, $num_words, '' );
        }
    }
}
// Custom Attributes 
if(!function_exists('techrona_parse_custom_attributes')){
    function techrona_parse_custom_attributes( $attributes_string, $delimiter = ',' ) {
        $attributes = explode( $delimiter, $attributes_string );
        $result = [];

        foreach ( $attributes as $attribute ) {
            $attr_key_value = explode( '|', $attribute );

            $attr_key = mb_strtolower( $attr_key_value[0] );

            // Remove any not allowed characters.
            preg_match( '/[-_a-z0-9]+/', $attr_key, $attr_key_matches );

            if ( empty( $attr_key_matches[0] ) ) {
                continue;
            }

            $attr_key = $attr_key_matches[0];

            // Avoid Javascript events and unescaped href.
            if ( 'href' === $attr_key || 'on' === substr( $attr_key, 0, 2 ) ) {
                continue;
            }

            if ( isset( $attr_key_value[1] ) ) {
                $attr_value = trim( $attr_key_value[1] );
            } else {
                $attr_value = '';
            }

            $result[ $attr_key ] = $attr_value;
        }

        return $result;
    }
}
// Badge
if(!function_exists('techrona_elementor_badge_render')){
    function techrona_elementor_badge_render($settings, $args = []){
        $args = wp_parse_args($args, [
            'show_badge' => 'show_badge',
            'badge_text' => 'badge_text',
            'class'      => '',
            'style'      => '1',
            'before'     => '',
            'after'      => ''        
        ]);
        if($settings[$args['show_badge']] === 'true'){
            printf('%s', $args['before']);
            ?>
            <div class="kng-badge kng-badge-<?php echo esc_attr($args['style']);?> <?php echo esc_attr($args['class']);?>">
                <div class="kng-badge-text empty-none"><?php if(!empty($settings[$args['badge_text']])) echo esc_html($settings[$args['badge_text']]); ?></div>
            </div>
        <?php
            printf('%s', $args['after']);
        }
    }
}
 
// Button Video Settings
// if(!function_exists('techrona_elementor_button_video_settings')){
//     function techrona_elementor_button_video_settings ($args = []){
//         $args = wp_parse_args($args, [
//             'prefix'    => '',
//             'separator' => '',
//             'effect'    => false
//         ]);
//         $default = array(            
//             array(
//                 'name'        => $args['prefix'].'video_link',
//                 'label'       => esc_html__( 'Video URL', 'techrona' ),
//                 'description' => '(https://www.youtube.com/watch?v=F_7ZoAQ3aJM)',
//                 'type'        => \Elementor\Controls_Manager::URL,
//                 'default'     => [
//                     'url'         => 'https://www.youtube.com/watch?v=F_7ZoAQ3aJM',
//                     'is_external' => 'on'
//                 ],
//                 'separator' => $args['separator']
//             ),
//             array(
//                 'name'        =>  $args['prefix'].'video_play_color',
//                 'label'       => esc_html__( 'Play Background Color', 'techrona' ),
//                 'type'        => \Elementor\Controls_Manager::SELECT,
//                 'options'     => techrona_elementor_theme_color_opts(['custom' =>  false]),
//                 'default'     => 'primary',
//                 'condition'   => [
//                     $args['prefix'].'video_link[url]!'  => ''
//                 ]
//             ),
//             array(
//                 'name'        =>  $args['prefix'].'video_play_color_hover',
//                 'label'       => esc_html__( 'Play Background Color Hover', 'techrona' ),
//                 'type'        => \Elementor\Controls_Manager::SELECT,
//                 'options'     => techrona_elementor_theme_color_opts(['custom' =>  false]),
//                 'default'     => 'second',
//                 'condition'   => [
//                     $args['prefix'].'video_link[url]!'  => ''
//                 ]  
//             ),
//             array(
//                 'name'        =>  $args['prefix'].'video_icon_color',
//                 'label'       => esc_html__( 'Video Icon Color', 'techrona' ),
//                 'type'        => \Elementor\Controls_Manager::SELECT,
//                 'options'     => techrona_elementor_theme_color_opts(['custom' =>  false]),
//                 'default'     => 'white',
//                 'condition'   => [
//                     $args['prefix'].'video_link[url]!'  => ''
//                 ]  
//             ),
//             array(
//                 'name'        =>  $args['prefix'].'video_icon_color_hover',
//                 'label'       => esc_html__( 'Video Icon Color Hover', 'techrona' ),
//                 'type'        => \Elementor\Controls_Manager::SELECT,
//                 'options'     => techrona_elementor_theme_color_opts(['custom' =>  false]),
//                 'default'     => 'primary',
//                 'condition'   => [
//                     $args['prefix'].'video_link[url]!'  => ''
//                 ]  
//             )
//             // array(
//             //     'name'        =>  $args['prefix'].'video_text',
//             //     'label'       => __( 'Video Text', 'techrona' ),
//             //     'type'        => \Elementor\Controls_Manager::TEXT,
//             //     'default'     => __('Our Video','techrona'),
//             //     'condition'   => [
//             //         $args['prefix'].'video_link[url]!'  => ''
//             //     ]
//             // ),
//             // array(
//             //     'name'        =>  $args['prefix'].'video_text_color',
//             //     'label'       => __( 'Text Color', 'techrona' ),
//             //     'type'        => \Elementor\Controls_Manager::SELECT,
//             //     'options'     => techrona_elementor_theme_color_opts(['custom' =>  false]),
//             //     'condition' => [
//             //         $args['prefix'].'video_link[url]!' => '',
//             //         $args['prefix'].'video_text!' => ''
//             //     ],
//             //     'default'     => 'primary'  
//             // )
//         );
//         // $effect = [];
//         // if($args['effect'] === true){
//         //     $effect = [
//         //         array(
//         //             'name'      => $args['prefix'].'video_animation',
//         //             'label'     => esc_html__( 'Button Video Effect', 'techrona' ),
//         //             'type'      => \Elementor\Controls_Manager::ANIMATION,
//         //             'condition' => [
//         //                 $args['prefix'].'video_link[url]!' => ''
//         //             ]
//         //         ),
//         //         array(
//         //             'name'    => $args['prefix'].'video_animation_duration', 
//         //             'label'   => __( 'Animation Duration', 'techrona' ),
//         //             'type'    => \Elementor\Controls_Manager::SELECT,
//         //             'default' => 'normal',
//         //             'options' => [
//         //                 'slow'   => __( 'Slow', 'techrona' ),
//         //                 'normal' => __( 'Normal', 'techrona' ),
//         //                 'fast'   => __( 'Fast', 'techrona' ),
//         //             ],
//         //             'condition' => [
//         //                 $args['prefix'].'video_link[url]!' => '',
//         //                 $args['prefix'].'video_animation!' => '',
//         //             ]
//         //         ),
//         //         array(
//         //             'name'      => $args['prefix'].'video_animation_delay',
//         //             'label'     => esc_html__( 'Animation Delay', 'techrona' ),
//         //             'type'      => \Elementor\Controls_Manager::NUMBER,
//         //             'min'       => 0,
//         //             'step'      => 100,
//         //             'condition' => [
//         //                 $args['prefix'].'video_link[url]!' => '',
//         //                 $args['prefix'].'video_animation!' => ''
//         //             ]
//         //         )
//         //     ];
//         // } 
//         return  array_merge($default);
//     }
// }
// Render popup video attrs
if(!function_exists('techrona_elementor_render_lightbox_video_atts')){
    function techrona_elementor_render_lightbox_video_atts($widget, $settings, $args= []){
        $args = wp_parse_args($args, [
            'prefix'    => '',
            'video_url' => '',
            'animation' => 'fadeInUp',
            'ratio'     => '169'
        ]);
        $embed_params = [
            'loop'           => '0',
            'controls'       => '1',
            'mute'           => '0',
            'rel'            => '0',
            'modestbranding' => '0'
        ];
        $embed_options = [];
        $widget->add_render_attribute( 'video_atts', 'data-elementor-open-lightbox', 'yes');
        $widget->add_render_attribute( 'video_atts', 'data-elementor-lightbox', json_encode([
            'type'         => 'video',
            'videoType'    => 'youtube',
            'url'          => \Elementor\Embed::get_embed_url( $args['video_url'], $embed_params, $embed_options ),
            'modalOptions' => [
                'id'                       => 'kng-lightbox-'.$settings['element_id'],
                'entranceAnimation'        => $args['animation'],
                'entranceAnimation_tablet' => '',
                'entranceAnimation_mobile' => '',
                'videoAspectRatio'         => $args['ratio']
            ]
        ]));
        kng_print_html($widget->get_render_attribute_string( 'video_atts' ));
    }
}
// render popup video html
if(!function_exists('techrona_elementor_render_lightbox_video_button')){
    function techrona_elementor_render_lightbox_video_button($widget, $settings, $args= []){
        $args = wp_parse_args($args, [
            'prefix'    => '',
            'animation' => 'fadeInUp',
            'ratio'     => '169',
            'class'     => '',
            'icon_class' => ''
        ]);
        if(empty($settings[$args['prefix'].'video_link']['url']) || $settings[$args['prefix'].'video_link']['url'] === null) return;

        $lightbox_id = isset($settings['_id']) ? $settings['_id'] : $settings['element_id'];
        $embed_params = [
            'loop'           => '0',
            'controls'       => '1',
            'mute'           => '0',
            'rel'            => '0',
            'modestbranding' => '0'
        ];
        $video_atts = $embed_options = [];
        $classes = ['kng-video-lightbox', $args['class']];
        $classes[] = isset($settings[$args['prefix'].'video_animation_duration']) ? 'animated-'.$settings[$args['prefix'].'video_animation_duration'] : '';
        
        if(!empty($settings[$args['prefix'].'video_animation'])){
            $classes[] = 'kng-animate kng-invisible';
            $video_atts[] =  'data-settings='.json_encode([
                'animation'       => $settings[$args['prefix'].'video_animation'],
                'animation_delay' => $settings[$args['prefix'].'video_animation_delay']
            ]);
        }
        $video_atts[] = 'class="'.implode(' ', $classes).'"';
        $video_atts[] = 'data-elementor-open-lightbox="yes"';
        $video_atts[] = 'data-elementor-lightbox='.json_encode([
            'type'         => 'video',
            'videoType'    => 'youtube',
            'url'          => \Elementor\Embed::get_embed_url( $settings[$args['prefix'].'video_link']['url'], $embed_params, $embed_options ),
            'modalOptions' => [
                'id'                       => 'kng-lightbox-'.$lightbox_id,
                'entranceAnimation'        => $args['animation'],
                'entranceAnimation_tablet' => '',
                'entranceAnimation_mobile' => '',
                'videoAspectRatio'         => $args['ratio']
            ]
        ]);
        $video_icon = !empty($settings['play_icon_icon']['value']) ? $settings['play_icon_icon']['value'] : 'icon-play';
        // play video button
        $video_button = [
            'kng-video-btn',
            'bg-'.$settings[$args['prefix'].'video_play_color'],
            'bg-hover-'.$settings[$args['prefix'].'video_play_color_hover'],
            'text-'.$settings[$args['prefix'].'video_icon_color'],
            'text-hover-'.$settings[$args['prefix'].'video_icon_color_hover'],
            $args['icon_class']
        ];
        // play video text 
        // $video_text = ['col empty-none font-700 text-'.$settings[$args['prefix'].'video_text_color']];
        // $widget->add_render_attribute('video-text', 'class', '');
        ?>
        <div <?php echo implode(' ', $video_atts); ?>>
            <div class="row align-items-center gutters-30">
                <div class="col-auto">
                    <div class="<?php echo implode(' ', $video_button); ?>"><span class="video-icon <?php echo esc_html($video_icon) ?>"></span></div>
                </div>
            </div>
        </div>
        <?php
    }
}

// Overlay options
if(!function_exists('techrona_elementor_overlay_settings')){
    function techrona_elementor_overlay_settings($args = []){
        $args = wp_parse_args($args, [
            'prefix'   => '',
            'name'     => 'kng_gradient',
            'label'    => __('Gradient', 'techrona'), 
            'selector' => '.kng-gradient',
            'condition'=> []
        ]);
        $default = array(
            array(
                'name'           => $args['prefix'].$args['name'].'_gradient',
                'label'          => $args['label'].' '.__( 'Color','techrona' ),
                'type'           => \Elementor\Group_Control_Background::get_type(),
                'control_type'   => 'group',
                'types'          => [ 'gradient' ],
                'fields_options' => [
                    'background' => [
                        'frontend_available' => true,
                    ],
                ],
                'selector'  => '{{WRAPPER}} '.$args['selector'].':after',
                'condition' => $args['condition']
            ),
            array(
                'name'      => $args['prefix'].$args['name'].'_color',
                'label'     => $args['label'].' '.__( 'Background Color','techrona' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} '.$args['selector'].':before' => 'background-color: {{VALUE}};',
                ],
                'condition' => $args['condition']
            ),
            array(
                'name'         => $args['prefix'].$args['name'].'_background',
                'title'        => $args['label'].' '.__( 'Background Image', 'techrona' ),
                'type'         => \Elementor\Group_Control_Background::get_type(),
                'control_type' => 'group',
                'types'        => [ 'classic' ],
                'fields_options' => [
                    'background' => [
                        'frontend_available' => true,
                    ],
                ],
                'selector'  => '{{WRAPPER}} '.$args['selector'],
                'condition' => $args['condition']
            )
        );
        return $default;
    }
}
if(!function_exists('techrona_elementor_content_slider_settings')){
    function techrona_elementor_content_slider_settings($args = []){
        $args = wp_parse_args($args, [
            'prefix' => 'kng',
            'prefix_class' => ''
        ]);
        
        $default = array_merge(
            array(
                array(
                    'name'        => $args['prefix'].'image',
                    'label'       => esc_html__('Slide Background Image', 'techrona'),
                    'type'        => 'media',
                    'label_block' => true
                ),
                
                array(
                    'name'        => $args['prefix'].'bg_color',
                    'label'       => esc_html__( 'Background Color', 'techrona' ),
                    'type'        => 'color',
                    'selectors'  => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .kng-slide-overlay' => 'background-color:{{VALUE}};'
                    ]
                ),
                array(
                    'name'         => $args['prefix'].'content_position',
                    'label'        => esc_html__( 'Content Position', 'techrona' ),
                    'type'         => 'choose',
                    'control_type' => 'responsive',
                    'options'      => techrona_content_position_opts(),
                    'default'      => 'start'
                ),
                array(
                    'name'         => $args['prefix'].'content_align',
                    'label'        => esc_html__( 'Content Alignment', 'techrona' ),
                    'type'         => 'choose',
                    'control_type' => 'responsive',
                    'options'      => techrona_text_align_opts(),
                    'default'      => 'start'
                ),
                array(
                    'name'         => $args['prefix'].'align_self',
                    'label'        => esc_html__( 'Align Self', 'techrona' ),
                    'type'         => 'select',
                    'control_type' => 'responsive',
                    'options'      => array(
                        ''       => esc_html__( 'Default', 'techrona' ),
                        'center' => esc_html__( 'Center', 'techrona' ),
                        'start'  => esc_html__( 'Start', 'techrona' ),
                        'end'    => esc_html__( 'End', 'techrona' ),
                    ),
                    'default'      => ''
                ),
                array(
                    'name' => $args['prefix'].'content_margin',
                    'label' => esc_html__('Content Margin(px)', 'techrona' ),
                    'type' => 'dimensions',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .kng-slide-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ),
                array(
                    'name'        => $args['prefix'].'small_heading',
                    'label'       => esc_html__('Small Heading','techrona'),
                    'type'        => 'textarea',
                    'placeholder' => esc_html__( 'Enter your text', 'techrona' ),
                    'label_block' => true,
                    'separator'   => 'before'
                ),
                array(
                    'name'        => $args['prefix'].'small_heading_color',
                    'label'       => esc_html__( 'Color', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts()
                ),
                array(
                    'name'        => $args['prefix'].'small_heading_custom_color',
                    'label'       => esc_html__( 'Custom Color', 'techrona' ),
                    'type'        => 'color',
                    'condition'   => [
                        $args['prefix'].'small_heading_color'      => 'custom'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .small-heading' => 'color:{{VALUE}};',
                        '{{WRAPPER}} .'.$args['prefix'].'item .small-heading:before' => 'background-color:{{VALUE}};'
                    ]
                ),
                array(
                    'name'        => $args['prefix'].'small_heading_animation',
                    'label'       => esc_html__( 'Motion Effect', 'techrona' ),
                    'type'        => 'animation',
                    'label_block' => false,
                ),
                array(
                    'name'      => $args['prefix'].'small_heading_animation_delay',
                    'label'     => esc_html__( 'Transition Delay', 'techrona' ),
                    'type'      => 'text'
                ),
                array(
                    'name'         => $args['prefix'].'small_heading_typo',
                    'type'         => \Elementor\Group_Control_Typography::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .small-heading'
                ),
                array(
                    'name'         => $args['prefix'].'small_heading_shadow',
                    'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .small-heading'
                ),
                array(
                    'name' => $args['prefix'].'small_heading_space',
                    'label' => esc_html__('Small Heading Margin(px)', 'techrona' ),
                    'type' => 'dimensions',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .small-heading-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ),
            ),
            techrona_elementor_responsive_settings([
                'prefix' => $args['prefix'].'small_heading_',
            ]),
             
            array(
                array(
                    'name'        => $args['prefix'].'large_heading',
                    'label'       => esc_html__('Large Heading','techrona'),
                    'type'        => 'textarea',
                    'placeholder' => esc_html__( 'Enter your text', 'techrona' ),
                    'label_block' => true,
                    'separator'   => 'before'
                ),
                array(
                    'name'        => $args['prefix'].'large_heading_color',
                    'label'       => esc_html__( 'Color', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts()
                ),
                array(
                    'name'        => $args['prefix'].'large_heading_custom_color',
                    'label'       => esc_html__( 'Custom Color', 'techrona' ),
                    'type'        => 'color',
                    'condition'   => [
                        $args['prefix'].'large_heading_color'      => 'custom'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .large-heading' => 'color:{{VALUE}};'
                    ]
                ),
                array(
                    'name'         => $args['prefix'].'large_heading_break_line',
                    'label'        => esc_html__( 'Remove Break Line', 'techrona' ),
                    'type'         => 'select',
                    'default'      => '',
                    'control_type' => 'responsive',
                    'options' => [
                        '' => esc_html__('No', 'techrona' ),
                        'none' => esc_html__('Yes', 'techrona' )
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .large-heading br' => 'display: {{VALUE}};',
                    ],
                ),
                array(
                    'name'      => $args['prefix'].'large_heading_animation',
                    'label'     => esc_html__( 'Motion Effect', 'techrona' ),
                    'type'      => 'animation'
                ),
                array(
                    'name'      => $args['prefix'].'large_heading_animation_delay',
                    'label'     => esc_html__( 'Transition Delay', 'techrona' ),
                    'type'      => 'text'
                ),
                array(
                    'name'         => $args['prefix'].'large_heading_typo',
                    'type'         => \Elementor\Group_Control_Typography::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .large-heading'
                ),
                array(
                    'name'         => $args['prefix'].'large_heading_shadow',
                    'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .large-heading'
                ),
                array(
                    'name' => $args['prefix'].'large_heading_space',
                    'label' => esc_html__('Large Heading Margin(px)', 'techrona' ),
                    'type' => 'dimensions',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .large-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ),
                array(
                    'name'        => $args['prefix'].'medium_heading',
                    'label'       => esc_html__('Medium Heading','techrona'),
                    'type'        => 'textarea',
                    'placeholder' => esc_html__( 'Enter your text', 'techrona' ),
                    'label_block' => true,
                    'separator'   => 'before'
                ),
                array(
                    'name'        => $args['prefix'].'medium_heading_color',
                    'label'       => esc_html__( 'Color', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts()
                ),
                array(
                    'name'        => $args['prefix'].'medium_heading_custom_color',
                    'label'       => esc_html__( 'Custom Color', 'techrona' ),
                    'type'        => 'color',
                    'condition'   => [
                        $args['prefix'].'medium_heading_color'      => 'custom'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .medium-heading' => 'color:{{VALUE}};'
                    ]
                ),
                array(
                    'name'        => $args['prefix'].'medium_heading_animation',
                    'label'       => esc_html__( 'Motion Effect', 'techrona' ),
                    'type'        => 'animation',
                    'label_block' => false,
                ),
                array(
                    'name'      => $args['prefix'].'medium_heading_animation_delay',
                    'label'     => esc_html__( 'Transition Delay', 'techrona' ),
                    'type'      => 'text'
                ),
                array(
                    'name'         => $args['prefix'].'medium_heading_typo',
                    'type'         => \Elementor\Group_Control_Typography::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .medium-heading'
                ),
                array(
                    'name'         => $args['prefix'].'medium_heading_shadow',
                    'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .medium-heading'
                ),
                array(
                    'name' => $args['prefix'].'medium_heading_space',
                    'label' => esc_html__('Medium Heading Margin(px)', 'techrona' ),
                    'type' => 'dimensions',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .medium-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ),
            ),
            techrona_elementor_responsive_settings([
                'prefix' => $args['prefix'].'medium_heading_',
            ]),
            array(
                array(
                    'name'        => $args['prefix'].'description',
                    'label'       => esc_html__('Description','techrona'),
                    'type'        => 'textarea',
                    'placeholder' => esc_html__( 'Enter your text', 'techrona' ),
                    'label_block' => true,
                    'separator'   => 'before'
                ),
                array(
                    'name'        => $args['prefix'].'description_color',
                    'label'       => esc_html__( 'Color', 'techrona' ),
                    'type'        => 'select',
                    'options'     => techrona_elementor_theme_color_opts()
                ),
                array(
                    'name'        => $args['prefix'].'description_custom_color',
                    'label'       => esc_html__( 'Custom Color', 'techrona' ),
                    'type'        => 'color',
                    'condition'   => [
                        $args['prefix'].'description_color'      => 'custom'
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .description' => 'color:{{VALUE}};'
                    ]
                ),
                array(
                    'name'  => $args['prefix'].'desc_width',
                    'label' => esc_html__( 'Description Width', 'techrona' ),
                    'type'  => 'slider',
                    'control_type' => 'responsive',
                    'size_units'   => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' =>  270,
                            'max' => 1600,
                        ],
                        '%' => [
                            'min' =>  10,
                            'max' =>  100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .description' => 'width: {{SIZE}}{{UNIT}};',
                    ] 
                ),
                array(
                    'name'      => $args['prefix'].'description_animation',
                    'label'     => esc_html__( 'Motion Effect', 'techrona' ),
                    'type'      => 'animation'
                ),
                array(
                    'name'      => $args['prefix'].'description_animation_delay',
                    'label'     => esc_html__( 'Transition Delay', 'techrona' ),
                    'type'      => 'text',
                ),
                array(
                    'name'         => $args['prefix'].'description_typo',
                    'type'         => \Elementor\Group_Control_Typography::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .description'
                ),
                array(
                    'name'         => $args['prefix'].'description_shadow',
                    'type'         => \Elementor\Group_Control_Text_Shadow::get_type(),
                    'control_type' => 'group',
                    'selector'     => '{{WRAPPER}} .'.$args['prefix'].'item .description'
                ),
                array(
                    'name' => $args['prefix'].'description_space',
                    'label' => esc_html__('Description Margin(px)', 'techrona' ),
                    'type' => 'dimensions',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px' ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'item .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ),
            ),
            techrona_elementor_responsive_settings([
                'prefix' => $args['prefix'].'description_',
            ]),
            // button 01
            techrona_elementor_button_settings([
                'prefix'       => $args['prefix'].'btn1',
                'effect'       => true,
                'separator'    => 'before'
            ]),
            // button 02
            techrona_elementor_button_settings([
                'prefix'    => $args['prefix'].'btn2',
                'effect'    => true,
                'separator' => 'before'
            ])
            // video 
            // techrona_elementor_button_video_settings([
            //     'prefix'       => $args['prefix'],
            //     'separator' => 'before',
            //     'effect'    => true
            // ])
        );
        return $default;
    }
}

// Layer image option
if(!function_exists('techrona_elementor_layers_img_settings')){
    function techrona_elementor_layers_img_settings($args = []){
        $args = wp_parse_args($args, [
            'prefix' => 'kng',
            'prefix_class' => '',
            'condition' => []
        ]);
        $default = array_merge(
            array(
                array(
                    'name'        => $args['prefix'].'image',
                    'label'       => esc_html__('Choose Image', 'techrona'),
                    'type'        => 'media',
                    'separator'    => 'before',
                    'label_block' => true,
                    'default' => [
                        'url' => '',
                    ],
                    'condition' => $args['condition']
                ),
                array(
                    'name'         => $args['prefix'].'thumbnail',
                    'type'         => \Elementor\Group_Control_Image_Size::get_type(),
                    'control_type' => 'group',
                    'default'      => 'full',
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'  => $args['prefix'].'width',
                    'label' => esc_html__( 'Width', 'techrona' ),
                    'type'  => 'slider',
                    'control_type' => 'responsive',
                    'size_units'   => [ 'px', 'em', '%', 'vw' ],
                    'range' => [
                        'px' => [
                            'min' =>  1,
                            'max' => 2000,
                        ],
                        'em' => [
                            'min' =>  1,
                            'max' =>  100,
                        ],
                        '%' => [
                            'min' =>  1,
                            'max' =>  100,
                        ],
                        'vw' => [
                            'min' =>  1,
                            'max' =>  100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'idx' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'      => $args['prefix'].'animation',
                    'label'     => esc_html__( 'Motion Effect', 'techrona' ),
                    'type'      => 'animation',
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'      => $args['prefix'].'delay',
                    'label'     => esc_html__( 'Transition Delay', 'techrona' ),
                    'type'      => 'number',
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'         => $args['prefix'].'pos_top',
                    'label'        => esc_html__( 'Top Position', 'techrona' ),
                    'type'         => 'slider',
                    'control_type' => 'responsive',
                    'size_units'   => [ 'px', 'em', '%', 'vw' ],
                    'default'      => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'tablet_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'mobile_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' =>  -2000,
                            'max' => 2000,
                        ],
                        'em' => [
                            'min' =>  -100,
                            'max' =>  100,
                        ],
                        '%' => [
                            'min' =>  -100,
                            'max' =>  100,
                        ],
                        'vw' => [
                            'min' =>  -100,
                            'max' =>  100,
                        ],
                    ],
                    'required' => true,
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'idx' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'device_args' => [
                        \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'top: {{SIZE}}{{UNIT}};',
                            ]
                        ],
                        \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'top: {{SIZE}}{{UNIT}};',
                            ]
                        ]
                    ],
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'       => $args['prefix'].'pos_right',
                    'label'      => esc_html__( 'Right Position', 'techrona' ),
                    'type'       => 'slider',
                    'control_type' => 'responsive',
                    'size_units' => [ 'px', 'em', '%', 'vw' ],
                    'default'    => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'tablet_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'mobile_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -2000,
                            'max' => 2000,
                        ],
                        'em' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'required' => true,
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'idx' => 'right: {{SIZE}}{{UNIT}};',
                    ],
                    'device_args' => [
                        \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'right: {{SIZE}}{{UNIT}};',
                            ]
                        ],
                        \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'right: {{SIZE}}{{UNIT}};',
                            ]
                        ]
                    ],
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'         => $args['prefix'].'pos_bottom',
                    'label'        => esc_html__( 'Bottom Position', 'techrona' ),
                    'type'         => 'slider',
                    'control_type' => 'responsive',
                    'size_units'   => [ 'px', 'em', '%', 'vw' ],
                    'default'      => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'tablet_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'mobile_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -2000,
                            'max' => 2000,
                        ],
                        'em' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'required' => true,
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'idx' => 'bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'device_args' => [
                        \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'bottom: {{SIZE}}{{UNIT}};',
                            ]
                        ],
                        \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'bottom: {{SIZE}}{{UNIT}};',
                            ]
                        ]
                    ],
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'         => $args['prefix'].'pos_left',
                    'label'        => esc_html__( 'Left Position', 'techrona' ),
                    'type'         => 'slider',
                    'control_type' => 'responsive',
                    'size_units'   => [ 'px', 'em', '%', 'vw' ],
                    'default'      => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'tablet_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'mobile_default' => [
                        //'unit' => 'px',
                        //'size' => 0,
                    ],
                    'range' => [
                        'px' => [
                            'min' => -2000,
                            'max' =>2000,
                        ],
                        'em' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'required' => true,
                    'selectors' => [
                        '{{WRAPPER}} .'.$args['prefix'].'idx' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'device_args' => [
                        \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'left: {{SIZE}}{{UNIT}};',
                            ]
                        ],
                        \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                            'selectors' => [
                                '{{WRAPPER}} .'.$args['prefix'].'idx' => 'left: {{SIZE}}{{UNIT}};',
                            ]
                        ]
                    ],
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                ),
                array(
                    'name'      => $args['prefix'].'class',
                    'label'     => esc_html__( 'Class', 'techrona' ),
                    'type'      => 'text',
                    'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
                )
            ),
            techrona_elementor_responsive_settings([
                'prefix' => $args['prefix'],
                'condition' => array_merge( [$args['prefix'].'image[url]!' => ''], $args['condition'] )
            ])
        );
        return $default;
    }
}
// Layer image option
if(!function_exists('techrona_elementor_position_settings')){
    function techrona_elementor_position_settings($args = []){
        $args = wp_parse_args($args, [
            'prefix' => '',
            'selectors'  => '',
            'condition' => []
        ]);
        $default = array(
            array(
                'name'         => $args['prefix'].'pos_top',
                'label'        => esc_html__( 'Top Position', 'techrona' ),
                'type'         => 'slider',
                'control_type' => 'responsive',
                'size_units'   => [ 'px', 'em', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' =>  -2000,
                        'max' => 2000,
                    ],
                    'em' => [
                        'min' =>  -100,
                        'max' =>  100,
                    ],
                    '%' => [
                        'min' =>  -100,
                        'max' =>  100,
                    ],
                    'vw' => [
                        'min' =>  -100,
                        'max' =>  100,
                    ],
                ],
                'required' => true,
                'selectors' => [
                    '{{WRAPPER}} .'.$args['selectors'] => 'top: {{SIZE}}{{UNIT}};',
                ],
                'device_args' => [
                    \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'top: {{SIZE}}{{UNIT}};',
                        ]
                    ],
                    \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'top: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                ],
                'condition'    => $args['condition']
            ),
            array(
                'name'       => $args['prefix'].'pos_right',
                'label'      => esc_html__( 'Right Position', 'techrona' ),
                'type'       => 'slider',
                'control_type' => 'responsive',
                'size_units' => [ 'px', 'em', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 2000,
                    ],
                    'em' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'required' => true,
                'selectors' => [
                    '{{WRAPPER}} .'.$args['selectors'] => 'right: {{SIZE}}{{UNIT}};',
                ],
                'device_args' => [
                    \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'right: {{SIZE}}{{UNIT}};',
                        ]
                    ],
                    \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'right: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                ],
                'condition'    => $args['condition']
            ),
            array(
                'name'         => $args['prefix'].'pos_bottom',
                'label'        => esc_html__( 'Bottom Position', 'techrona' ),
                'type'         => 'slider',
                'control_type' => 'responsive',
                'size_units'   => [ 'px', 'em', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 2000,
                    ],
                    'em' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'required' => true,
                'selectors' => [
                    '{{WRAPPER}} .'.$args['selectors'] => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'device_args' => [
                    \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'bottom: {{SIZE}}{{UNIT}};',
                        ]
                    ],
                    \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'bottom: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                ],
                'condition'    => $args['condition']
            ),
            array(
                'name'         => $args['prefix'].'pos_left',
                'label'        => esc_html__( 'Left Position', 'techrona' ),
                'type'         => 'slider',
                'control_type' => 'responsive',
                'size_units'   => [ 'px', 'em', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' =>2000,
                    ],
                    'em' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'required' => true,
                'selectors' => [
                    '{{WRAPPER}} .'.$args['selectors'] => 'left: {{SIZE}}{{UNIT}};',
                ],
                'device_args' => [
                    \Elementor\Controls_Stack::RESPONSIVE_TABLET => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'left: {{SIZE}}{{UNIT}};',
                        ]
                    ],
                    \Elementor\Controls_Stack::RESPONSIVE_MOBILE => [
                        'selectors' => [
                            '{{WRAPPER}} .'.$args['selectors'] => 'left: {{SIZE}}{{UNIT}};',
                        ]
                    ]
                ],
                'condition'    => $args['condition']
            )
        );
        return $default;
    }
}
// Responsive option 
if(!function_exists('techrona_elementor_responsive_settings')){
    function techrona_elementor_responsive_settings($args = []){
        $args = wp_parse_args($args, [
            'prefix' => 'kng',
            'prefix_class' => '',
            'condition' => []
        ]);
        $default = [
            [
                'name'         => $args['prefix'].'hide_widescreen',
                'label'        => esc_html__( 'Hide On Wide Screen ', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => 'Hide',
                'label_off'    => 'Show',
                'return_value' => 'elementor-hidden-widescreen',
                'condition'    => $args['condition']
            ],
            [
                'name'         => $args['prefix'].'hide_desktop',
                'label'        => esc_html__( 'Hide On Desktop', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => 'Hide',
                'label_off'    => 'Show',
                'return_value' => 'elementor-hidden-desktop',
                'condition'    => $args['condition']
            ],
            [
                'name'         => $args['prefix'].'hide_laptop',
                'label'        => esc_html__( 'Hide On Laptop', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => 'Hide',
                'label_off'    => 'Show',
                'return_value' => 'elementor-hidden-laptop',
                'condition'    => $args['condition']
            ],
            [
                'name'         => $args['prefix'].'hide_tablet_extra',
                'label'        => esc_html__( 'Hide On Tablet Extra', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => 'Hide',
                'label_off'    => 'Show',
                'return_value' => 'elementor-hidden-tablet_extra',
                'condition'    => $args['condition']
            ],
            [
                'name'         => $args['prefix'].'hide_tablet',
                'label'        => esc_html__( 'Hide On Tablet', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => 'Hide',
                'label_off'    => 'Show',
                'return_value' => 'elementor-hidden-tablet',
                'condition'    => $args['condition']
            ],
            [
                'name'         => $args['prefix'].'hide_mobile_extra',
                'label'        => esc_html__( 'Hide On Mobile Extra', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => 'Hide',
                'label_off'    => 'Show',
                'return_value' => 'elementor-hidden-mobile_extra',
                'condition'    => $args['condition']
            ],
            [
                'name'         => $args['prefix'].'hide_mobile',
                'label'        => esc_html__( 'Hide On Mobile', 'techrona' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => 'Hide',
                'label_off'    => 'Show',
                'return_value' => 'elementor-hidden-mobile',
                'condition'    => $args['condition']
            ]
        ];
        return $default;
    }
}
if(!function_exists('techrona_elementor_responsive_render')){
    function techrona_elementor_responsive_render($settings, $args = []){
        $args = wp_parse_args($args, [
            'prefix' => 'kng'
        ]);
        $hidden = [
            $settings[$args['prefix'].'hide_widescreen'],
            $settings[$args['prefix'].'hide_desktop'],
            $settings[$args['prefix'].'hide_laptop'],
            $settings[$args['prefix'].'hide_tablet_extra'],
            $settings[$args['prefix'].'hide_tablet'],
            $settings[$args['prefix'].'hide_mobile_extra'],
            $settings[$args['prefix'].'hide_mobile'],
        ];
        return implode(' ',$hidden);
    }
}

if(!function_exists('techrona_get_class_breakpoints')){
    function techrona_get_class_breakpoints($settings, $args = []){
        $args = wp_parse_args($args, [
            'prefix' => 'kng',
            'type-prefix' => 'text-', //justify-content-, text-,align-self-
        ]);

        $type = [];
        $type[] = empty($settings[$args['prefix'].'_mobile']) ? '' : $args['type-prefix'].'xs-'.$settings[$args['prefix'].'_mobile'];
        $type[] = empty($settings[$args['prefix'].'_mobile_extra']) ? '' : $args['type-prefix'].'sm-'.$settings[$args['prefix'].'_mobile_extra'];
        $type[] = empty($settings[$args['prefix'].'_tablet']) ? '' : $args['type-prefix'].'md-'.$settings[$args['prefix'].'_tablet'];
        $type[] = empty($settings[$args['prefix'].'_tablet_extra']) ? '' : $args['type-prefix'].'lg-'.$settings[$args['prefix'].'_tablet_extra'];
        $type[] = empty($settings[$args['prefix'].'_laptop']) ? '' : $args['type-prefix'].'xl-'.$settings[$args['prefix'].'_laptop'];
        //$type[] = empty($settings[$args['prefix']]) ? '' : $args['type-prefix'].'xxl-'.$settings[$args['prefix']]; //desktop
        $type[] = empty($settings[$args['prefix']]) ? '' : $args['type-prefix'].$settings[$args['prefix']]; //desktop
        $type[] = empty($settings[$args['prefix'].'_widescreen']) ? '' : $args['type-prefix'].'xxxl-'.$settings[$args['prefix'].'_widescreen'];
          
        return $type;
    }
}

// Scan element (need add to bottom of this file)
$files = scandir(get_template_directory() . '/elements/el-widgets');
foreach ($files as $file){
    $pos = strrpos($file, ".php");
    if($pos !== false){
        require_once get_template_directory() . '/elements/el-widgets/' . $file;
    }
}
// Testinomial Rating
if(!function_exists('techrona_star_rating')){
    function techrona_star_rating($args = []){
        $args = wp_parse_args($args, [
            'rated'      => '100',
            'text'       => '',
            'class'      => '',
            'rated_class' => '',
            'text_class' => ''    
        ]);
        $text_class = !empty($args['text_class']) ? $args['text_class'] : 'text-16 font-700';
        ?>
        <div class="row align-items-center gutters-15 text-accent">
            <div class="col-12 col-md-auto">
                <div class="kng-star-rating relative <?php echo esc_attr($args['class']);?>">
                    <div class="kng-star-rated absolute <?php echo esc_attr($args['rated_class']);?>" data-width="<?php echo esc_attr($args['rated']);?>"></div>
                </div>
            </div>
            <div class="col empty-none <?php echo esc_attr($text_class);?>"><?php
                echo esc_html($args['text']);
            ?></div>
        </div>
        <?php
    }
}


 
