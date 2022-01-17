<?php
// make some configs
if(!function_exists('techrona_configs')){
    function techrona_configs($value){
        $body_font    = '\'Open Sans\', sans-serif';
        $heading_font = '\'Poppins\', sans-serif';
        $btn_font     = '\'Poppins\', sans-serif';
         
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'techrona').' ('.techrona_get_opts('primary_color', '#00c3ff').')', 
                    'value' => techrona_get_opts('primary_color', '#00c3ff')
                ],
                'second' => [
                    'title' => esc_html__('Secondary', 'techrona').' ('.techrona_get_opts('second_color', '#162542').')', 
                    'value' => techrona_get_opts('second_color', '#162542')
                ],
                'rating' => [
                    'title' => esc_html__('Rating', 'techrona').' ('.techrona_get_opts('rating_color', '#FFB237').')', 
                    'value' => techrona_get_opts('rating_color', '#FFB237')
                ],
                'body'     => [
                    'title' => esc_html__('Body', 'techrona').' ('.techrona_get_opts('body_font_typo', ['color' => '#555555'])['color'].')', 
                    'value' => techrona_get_opts('body_font_typo', ['color' => '#555555'])['color']
                ],
                'heading'     => [
                    'title' => esc_html__('Heading', 'techrona').' #222222', 
                    'value' => '#222222'
                ],
                'white'     => [
                    'title' => esc_html__('White', 'techrona'), 
                    'value' => '#ffffff'
                ],
                'footer_text' => [
                    'title' => esc_html__('Footer Text', 'techrona').' ('.techrona_get_opts('footer_text_color', '#aab5cc').')', 
                    'value' => techrona_get_opts('footer_text_color', '#aab5cc')
                ]
            ],
            'thumbnails' => [ 
                'thumbnail'    => [
                    'thumbnail_size_w'    => 110,
                    'thumbnail_size_h'    => 110,
                    'thumbnail_crop'      => 1,
                ], //blog recent posts widget
                'medium'       => [
                    'medium_size_w'       => 770,  
                    'medium_size_h'       => 370,
                    'medium_crop'         => 1,
                ], //blog grid
                'medium_large' => [
                    'medium_large_size_w' => 740,  
                    'medium_large_size_h' => 600,
                    'medium_large_crop'   => 1, 
                ], // case layout 2
                'large'        => [
                    'large_size_w'        => 1200,  
                    'large_size_h'        => 576,
                    'large_crop'          => 1, 
                ] //blog 770
            ],
            'custom_sizes' => [
                // 'techrona-gal'      => [740, 580, true], //gallery
                // 'techrona-case'     => [540, 700, true], //case layout 1
                // 'techrona-news'     => [740, 500, true], //news widget
                //'techrona-attorney' => [495, 585, true], //attorney grid
                // 'techrona-practice' => [495, 585, true], //practice grid
            ],
            'link' => [
                'color' => techrona_get_opts('link_color', ['regular' => '#666666'])['regular'],
                'color-hover'   => techrona_get_opts('link_color', ['hover' => 'var(--primary-color)'])['hover'],
                'color-active'  => techrona_get_opts('link_color', ['active' => 'var(--primary-color)'])['active'],
            ],

            'body' => [
                'bg'                => '#fff',
                'font-family'       => techrona_get_opts('body_font_typo',['font-family' => $body_font])['font-family'],
                'font-size'         => techrona_get_opts('body_font_typo',['font-size' => '16px'])['font-size'],
                'font-weight'       => techrona_get_opts('body_font_typo',['font-weight' => '400'])['font-weight'],
                'line-height'       => techrona_get_opts('body_font_typo',['line-height' => '2'])['line-height'],
                'letter-spacing'    => techrona_get_opts('body_font_typo',['letter-spacing' => '0px'])['letter-spacing']
            ],
            'side_panel' => [
                'side-mobile' => esc_html__('Menu Mobile Side Panel', 'techrona'),
                'side-menu'   => esc_html__('Menu Desktop Side Panel', 'techrona'),
                'popup-menu'  => esc_html__('Menu Desktop Popup', 'techrona'),
                'side-info'   => esc_html__('Information Side Panel', 'techrona'),
            ],
            'header' => [
                'height' => '76px' // use for default header
            ],
            'logo' => [
                'mobile_width' => techrona_get_opts('logo_mobile_size', ['width' => '192px', 'units' => 'px'])['width'],
            ],
            'heading' => [
                'font-family'      => $heading_font,
                'color-hover'      => 'var(--primary-color)',
                'font-weight'      => '500',
            ],
            'button' => [
                'font-family'       => techrona_get_opts('btn_typo',['font-family' => $btn_font])['font-family'],
                'font-size'         => techrona_get_opts('btn_typo',['font-size' => '16px'])['font-size'],
                'font-weight'       => techrona_get_opts('btn_typo',['font-weight' => '400'])['font-weight'],
                'color'             => techrona_get_opts('btn_typo',['color' => '#ffffff'])['color'],
                'letter-spacing'    => techrona_get_opts('btn_typo',['letter-spacing' => '-0.03em'])['letter-spacing'],
                'padding'           => '12px 35px',
                'radius'            => '0',     
                'radius-rtl'        => '0',
            ],
            'border' => [
                'color'          => '#f9f9f9',
                'main'           => '1px solid var(--border-color)', 
                'main2'          => '2px solid var(--border-color)',
            ],

            'comment' => [
                'avatar-size'  => 110,
                'border'       => '0',
                'radius'       => '50px' 
            ],

            'blog' => [
                'archive_content_col' => 8,
                'archive_sidebar_pos' => 'right',
                'single_content_col'  => 8,
                'single_sidebar_pos'  => 'right',
            ],
             
            'single_product' => [
                'title_layout' => '1'
            ],
    
            // use placeholder image if post dont have feature image
            'default_post_thumbnail' => techrona_get_theme_opt('default_post_thumbnail', false), 
            // make post thumbnail as background of it
            'thumbnail_is_bg'        => techrona_get_theme_opt('thumbnail_is_bg', false),
              
            // Menu Ontop Color
            'ontop' => array_merge(
                ['bg'            => 'transparent'],
                [
                    'regular' => '#fff',
                    'hover'   => 'var(--primary-color)',
                    'active'  => 'var(--primary-color)'
                ]
            ),
            // Menu Sticky Color
            'sticky' => array_merge(
                ['bg'            => '#fff'],
                [
                    'regular' => 'var(--second-color)',
                    'hover'   => 'var(--primary-color)',
                    'active'  => 'var(--primary-color)',
                ]
            ),
            // Menu Color

            'menu' => array_merge(
                [
                    'bg'            => '#fff'
                ],
                [
                    'regular' => 'var(--second-color);',
                    'hover'   => 'var(--primary-color);',
                    'active'  => 'var(--primary-color);',
                ],
                
                [
                    'font_size'   => '15px',
                    'font_weight' => 500,
                    'font_family' => $heading_font 
                ]
            ),
            'dropdown' => array_merge(
                [
                    'bg'            => '#FFFFFF',
                    'shadow'        => '0px 10px 40px 0px rgba(27, 26, 26, 0.09)'
                ],
                [
                    'regular' => 'var(--second-color);',
                    'hover'   => 'var(--primary-color);',
                    'active'  => '#ffffff',
                ],
                [
                    'font_size'     => '15px',  
                    'font_weight'   => '500',  
                    'item_bg'       => 'transparent',
                    // 'item_bg_hover' => 'var(--primary-color);'
                ]
            ),
            'mobile_menu' => array_merge(
                techrona_get_opts('mobile_menu_color', [
                    'regular' => 'var(--heading-color)',
                    'hover'   => 'var(--primary-color);',
                    'active'  => 'var(--primary-color);',
                ]),
                [
                    'font_size'   => '15px',
                    'font_weight' => 500,
                    'font_family' => $heading_font,
                    'item_bg'       => 'transparent',
                    'item_bg_hover' => 'transparent',
                    'text_transform' => 'capitalize' 
                ]
            ),
            'mobile_submenu' => array_merge(
                [
                    'regular' => 'var(--heading-color)',
                    'hover'   => 'var(--primary-color);',
                    'active'  => 'var(--primary-color);',
                ],
                [
                    'font_size'     => '15px', 
                    'font_weight' => 400, 
                    'font_family' => $body_font,
                    'item_bg'       => 'transparent',
                    'item_bg_hover' => 'transparent',
                    'text_transform' => 'capitalize' 
                ]
            ),
             
            // Page title
            'ptitle' => array_merge(
                [
                    'layout' => '1'
                ],
                techrona_get_opts('ptitle_color', [
                    'color' => '#fff',
                    'alpha' => '1',
                    'rgba'  => 'unset'
                ]),
                techrona_get_opts('ptitle_bg', [
                    'background-color'      => '#fff',
                    'background-image'      => '',
                    'background-repeat'     => 'no-repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position'   => 'center'
                ]),
                techrona_get_opts('ptitle_padding', [
                    'padding-top'      => '136px', //200px
                    'padding-bottom'   => '136px'  //136px
                ])
            ),
            'ptitle_mobile' => array_merge(
                techrona_get_opts('ptitle_padding_mobile', [
                    'padding-top'      => '100px',
                    'padding-bottom'   => '86px'
                ])
            ),
            'ptitle_overlay' => techrona_get_opts('ptitle_overlay_color', [
                'color' => 'inherit',
                'rgba'  => 'rgba(255, 255, 255, 0)'
            ]),
            'ptitle_gradient_bg_from' => techrona_get_opts('ptitle_gradient_bg_from', [
                'color' => '#162542',
                'rgba'  => 'rgba(22, 37, 66, 0.8)'
            ]),
            'ptitle_gradient_bg_to' => techrona_get_opts('ptitle_gradient_bg_to', [
                'color' => '#ffffff',
                'rgba'  => 'rgba(22, 37, 66, 0.8)'
            ]),
            'ptitle_breadcrumb' => techrona_get_opts('ptitle_breadcrumb_link_color', [
                'regular' => '#ffffff', 
                'hover'   => 'var(--primary-color)', 
                'active'  => '#ffffff'
            ]),

            // 404 page
            '404' => [
                'background' => techrona_get_opts('bg_404_page', [
                    'background-repeat'     => 'no-repeat',
                    'background-size'       => 'cover',
                    'background-attachment' => 'fixed',
                    'background-position'   => 'center center'
                ])
            ],

            'content_width'         => 1280,          
            // WooCommerce,
            'techrona_product_single_image_w'          => '690', //460
            'techrona_product_single_image_h'          => '672', //448
            
            'techrona_product_loop_image_w'            => '520', //260
            'techrona_product_loop_image_h'            => '684', //342

            'techrona_product_gallery_layout'          => 'default', // simplle, default, horizontal, vertical
            'techrona_product_gallery_thumb_position'  => 'bottom', // bottom, left, right

            'techrona_product_gallery_thumbnail_w'     => '100',
            'techrona_product_gallery_thumbnail_h'     => '120',
            
            'techrona_product_gallery_thumbnail_v_w'   => '100',
            'techrona_product_gallery_thumbnail_v_h'   => '120',
            
            'techrona_product_gallery_thumbnail_h_w'   => '100',
            'techrona_product_gallery_thumbnail_h_h'   => '120',
            
            'techrona_product_gallery_thumbnail_space_vertical'   => '10',
            'techrona_product_gallery_thumbnail_space_horizontal' => '10',
  
        ];
        return $configs[$value];
    }
}
if(!function_exists('techrona_inline_styles')){
    function techrona_inline_styles() {  
        
        $theme_colors      = array_merge(techrona_configs('theme_colors'), techrona_custom_colors());
        $link_color        = techrona_configs('link');
        //$header            = techrona_configs('header'); 
        $border            = techrona_configs('border'); 
        $menu              = techrona_configs('menu');
        $ontop             = techrona_configs('ontop');
        $sticky            = techrona_configs('sticky');
        $dropdown          = techrona_configs('dropdown');
        $ptitle            = techrona_configs('ptitle');
        $ptitle_mobile     = techrona_configs('ptitle_mobile');
        $ptitle_overlay    = techrona_configs('ptitle_overlay');
        $ptitle_breadcrumb = techrona_configs('ptitle_breadcrumb');
         
        ob_start();
        echo ':root{';
            
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color-rgb: %2$s;', str_replace('#', '',$color),  techrona_hex_rgb($value['value']));
            }
            foreach ($link_color as $color => $value) {
                printf('--link-%1$s: %2$s;', $color, $value);
            }
            foreach ($border as $key => $value) {
                printf('--border-%1$s: %2$s;', $key, $value);
            }
            foreach ($ontop as $key => $value) {
                printf('--ontop-%1$s: %2$s;', $key, $value);
            }
            foreach ($sticky as $key => $value) {
                printf('--sticky-%1$s: %2$s;', $key, $value);
            }
            foreach ($dropdown as $key => $value) {
                printf('--dropdown-%1$s: %2$s;', $key, $value);
            }
            foreach ($ptitle as $key => $value) {
                if($key === 'background-image') $value = 'url('.$value.')';
                if(!is_array($value))
                    printf('--ptitle-%1$s: %2$s;', $key, $value);          
            }
            foreach ($ptitle_mobile as $key => $value) {
                printf('--ptitle-mobile-%1$s: %2$s;', $key, $value);          
            }
            foreach ($ptitle_overlay as $key => $value) {
                printf('--ptitle-overlay-%1$s: %2$s;', $key, $value);
            }
            foreach ($ptitle_breadcrumb as $key => $value) {
                printf('--ptitle-breadcrumb-%1$s: %2$s;', $key, $value);
            }
                printf('--box: red');
        echo '}';

        return ob_get_clean();
         
    }
}
 