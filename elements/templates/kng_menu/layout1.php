<?php
$default_settings = [
    'type' => '1',
    'menu' => '',
    'show_arrow' => false
];
$settings = array_merge($default_settings, $settings);

$content_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'align',
    'type-prefix' => 'justify-content-',
]);

$html_id = kng_get_element_id($settings);  
$show_arrow_cls = ($settings['show_arrow'] === 'yes') ? 'is-arrow' : ''; 

?>
<?php if($settings['type'] == '1'): ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="kng-nav-menu <?php echo esc_attr($show_arrow_cls) ?>">
    <?php 
        if(!empty($settings['menu'])) { 
            wp_nav_menu(
                array(
                    'menu_id'    => 'kng-primary-menu-'.$html_id,
                    'menu_class' => 'kng-primary-menu clearfix '.trim(implode(' ', $content_align)),
                    'walker'     => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                    'link_before'    => '<span class="kng-menu-title">',
                    'link_after'      => '</span>',
                    'menu'        => wp_get_nav_menu_object($settings['menu'])
                )
            ); 
        } elseif( has_nav_menu( 'primary' ) ) { 
            wp_nav_menu( 
                array(
                    'theme_location' => 'primary',
                    'menu_id'    => 'kng-primary-menu-'.$html_id,
                    'menu_class' => 'kng-primary-menu clearfix '.trim(implode(' ', $content_align)),
                    'link_before'    => '<span class="kng-menu-title">',
                    'link_after'      => '</span>',
                    'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                )
            );
        }
    ?>
    </div>
<?php elseif($settings['type'] == '2'): ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="kng-nav-menu kng-nav-menu-inner">
        <?php 
            if(!empty($settings['menu'])) { 
                wp_nav_menu(array(
                    'menu_class'  => 'kng-nav-inner clearfix',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'depth'       => '1',
                    'menu'        => wp_get_nav_menu_object($settings['menu']),
                    'walker'      => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : ''
                ));
            } elseif( has_nav_menu( 'primary' ) ) { 
                wp_nav_menu( 
                    array(
                        'theme_location' => 'primary',
                        'menu_class'     => 'kng-nav-inner clearfix',
                        'link_before'    => '<span>',
                        'link_after'     => '</span>',
                        'depth'          => '1',
                        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                    )
                );
            }
        ?>
    </div>
<?php else: ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="kng-nav-menu kng-nav-menu-mobile">
        <?php 
            if(!empty($settings['menu'])) { 
                wp_nav_menu(
                    array(
                        'menu_id'     => 'kng-mobile-menu',
                        'menu'        => wp_get_nav_menu_object($settings['menu']),
                        'container'   => '',
                        'menu_class'  => 'kng-mobile-menu clearfix '.trim(implode(' ', $content_align)),
                        'walker'      => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                        'link_before' => '<span class="kng-menu-title">',
                        'link_after'  => '</span>'
                    )
                ); 
            } elseif( has_nav_menu( 'primary' ) ) { 
                wp_nav_menu( 
                    array(
                        'theme_location' => 'primary',
                        'menu_id'     => 'kng-mobile-menu',
                        'menu_class'  => 'kng-mobile-menu clearfix '.trim(implode(' ', $content_align)),
                        'link_before'    => '<span class="kng-menu-title">',
                        'link_after'      => '</span>',
                        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : ''
                    )
                );
            }
        ?>
    </div>
<?php endif; ?>
