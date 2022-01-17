<?php
/**
 * Panel layout
 **/
if(!function_exists('techrona_browse_category_anchor')){
    function techrona_browse_category_anchor(){
        ?>
        <div id="kng-side-cat" class="kng-side-panel kng-side-cat">
            <div class="kng-panel-header">
                <div class="panel-header-inner">
                    <span class="kng-title h3"><?php echo esc_html__( 'Browse Category', 'techrona' ) ?></span>
                    <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                </div>
            </div>
            <div class="kng-side-panel-content custom_scroll kng-widget">
                <ul class="kng-cat-menu-wrap product-categories">
                    <?php 
                    if(class_exists('Woocommerce')){
                         
                        include_once WC()->plugin_path() . '/includes/walkers/class-wc-product-cat-list-walker.php';
                        $list_args['walker']                     = new WC_Product_Cat_List_Walker();
                        $list_args['title_li']                   = '';
                        $list_args['pad_counts']                 = 1;
                        $list_args['show_option_none']           = __( 'No product categories exist.', 'techrona' );
                        $list_args['current_category']           = 0;
                        $list_args['current_category_ancestors'] = 0;
                        $list_args['taxonomy']                   = 'product_cat';
                        wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php  
    }
}
 
if(!function_exists('techrona_hook_anchor_side_info')){
    function techrona_hook_anchor_side_info(){
        $templates = techrona_list_post_elementor_library('side-info');
        if(empty($templates)){
            ?>
            <div id="kng-side-info" class="kng-side-panel kng-side-info">
                <div class="kng-panel-header">
                    <div class="panel-header-inner">
                        <span></span>
                        <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                    </div>
                </div>
                <div class="kng-side-panel-content custom_scroll">
                    <p><?php echo esc_html__('No template content post in Elementor Template', 'techrona');?></p>
                </div>
            </div>
            <?php
        }else{
            $pid = $templates[0]->ID;   
            $kng_post  = get_post($pid);
            ?>
            <div id="kng-side-info" class="kng-side-panel kng-side-info">
                <div class="kng-panel-header">
                    <div class="panel-header-inner">
                        <span></span>
                        <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                    </div>
                </div>
                <?php 
                if (!is_wp_error($kng_post) && class_exists('Kngtheme_Core')){
                    $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $pid );
                    ?>
                    <div class="kng-side-panel-content custom_scroll">
                       <?php kng_print_html($content); ?>
                    </div>
                <?php }?>
            </div>
            <?php 
        }
    }
}

add_action( 'kng_anchor_target', 'techrona_hook_anchor_side_mobile');
if(!function_exists('techrona_hook_anchor_side_mobile')){
    function techrona_hook_anchor_side_mobile(){
        $templates = techrona_list_post_elementor_library('side-mobile');
        if(empty($templates)){
            ?>
            <nav id="kng-mobile-panel" class="kng-side-panel kng-side-mobile">
                <div class="kng-panel-header">
                    <div class="panel-header-inner">
                        <a href="#" class="kng-close" data-target=".kng-side-mobile" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                    </div>
                </div> 
                <div class="kng-side-panel-content side-panel-mobile custom_scroll">
                    <div class="menu-main-container-wrap">
                        <div id="mobile-menu-container" class="menu-main-container">
                            <?php 
                                if ( has_nav_menu( 'primary' ) ){
                                    wp_nav_menu( 
                                        array(
                                            'theme_location' => 'primary',
                                            'container'      => '',
                                            'menu_id'        => 'kng-mobile-menu',
                                            'menu_class'     => 'kng-mobile-menu kng-primary-menu clearfix',
                                            'link_before'    => '<span class="kng-menu-title">',
                                            'link_after'     => '</span>',  
                                            'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                        ) 
                                    );
                                }else{
                                    printf(
                                        '<ul class="kng-mobile-menu kng-primary-menu primary-menu-not-set"><li><a href="%1$s">%2$s</a></li></ul>',
                                        esc_url( admin_url( 'nav-menus.php' ) ),
                                        esc_html__( 'Create New Menu', 'techrona' )
                                    );
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </nav>
            <?php 
        }else{
            $pid = $templates[0]->ID;   
            $kng_post  = get_post($pid);
            ?>
            <nav id="kng-mobile-panel" class="kng-side-panel kng-side-mobile el-builder">
                <div class="kng-panel-header">
                    <div class="panel-header-inner">
                        <a href="#" class="kng-close" data-target=".kng-side-mobile" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                    </div>
                </div>
                <?php 
                if (!is_wp_error($kng_post) && class_exists('Kngtheme_Core')){
                    $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $pid );
                    ?>
                    <div class="kng-side-panel-content side-panel-mobile custom_scroll">
                       <?php kng_print_html($content); ?>
                    </div>
                <?php }?>
            </nav>
            <?php
        }  
    }
}

if(!function_exists('techrona_hook_anchor_popup_menu')){
    function techrona_hook_anchor_popup_menu(){ 
        $templates = techrona_list_post_elementor_library('popup-menu');  
        if(empty($templates)){
        ?>
        <div id="kng-popup-menu" class="kng-side-panel kng-popup-menu widescreen">
            <div class="kng-panel-header">
                <div class="container">
                    <div class="panel-header-inner">
                        <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                    </div>
                </div>
            </div>
            <div class="kng-side-panel-content custom_scroll">
                <div class="container">
                    <div class="separate"></div>
                    <div class="kng-menu-menu-wrap">
                        <?php 
                            if( has_nav_menu( 'primary' ) ) { 
                                wp_nav_menu( 
                                    array(
                                        'theme_location' => 'primary',
                                        'menu_id'    => 'kng-primary-menu',
                                        'menu_class' => 'kng-primary-menu clearfix ',
                                        'link_before'    => '<span class="kng-menu-title">',
                                        'link_after'      => '</span>',
                                        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                    )
                                );
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php 
        }else{
            $pid = $templates[0]->ID;   
            $kng_post  = get_post($pid);
            ?>
            <div id="kng-popup-menu" class="kng-side-panel kng-popup-menu widescreen el-builder">
	            <div class="kng-panel-header">
	                <div class="container">
	                    <div class="panel-header-inner">
	                        <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
	                    </div>
	                </div>
	            </div>
	            <div class="kng-side-panel-content custom_scroll">
	                <div class="container">
	                    <div class="separate"></div>
	                    <?php 
		                if (!is_wp_error($kng_post) && class_exists('Kngtheme_Core')){
		                    $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $pid );
		                    kng_print_html($content);
		                }?>
	                </div>
	            </div>
	        </div>
            <?php
        }  
    }
}
if(!function_exists('techrona_hook_anchor_side_menu')){
    function techrona_hook_anchor_side_menu(){ 
        $templates = techrona_list_post_elementor_library('side-menu');  
        if(empty($templates)){
        ?>
        <div id="kng-side-menu-side" class="kng-side-panel kng-side-menu">
            <div class="kng-panel-header">
                <div class="container">
                    <div class="panel-header-inner">
                        <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                    </div>
                </div>
            </div>
            <div class="kng-side-panel-content custom_scroll">
                <div class="kng-menu-menu-wrap">
                    <?php 
                        if( has_nav_menu( 'primary' ) ) { 
                            wp_nav_menu( 
                                array(
                                    'theme_location' => 'primary',
                                    'menu_id'    => 'kng-side-menu',
                                    'menu_class' => 'kng-side-menu clearfix ',
                                    'link_before'    => '<span class="kng-menu-title">',
                                    'link_after'      => '</span>',
                                    'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                )
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php 
        }else{
            $pid = $templates[0]->ID;   
            $kng_post  = get_post($pid);
            ?>
            <div id="kng-side-menu-side" class="kng-side-panel kng-side-menu el-builder">
	            <div class="kng-panel-header">
	                <div class="container">
	                    <div class="panel-header-inner">
	                        <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
	                    </div>
	                </div>
	            </div>
	            <div class="kng-side-panel-content custom_scroll"> 
                    <?php 
	                if (!is_wp_error($kng_post) && class_exists('Kngtheme_Core')){
	                    $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $pid );
                       	kng_print_html($content);
	                }?>
	            </div>
	        </div>
            <?php
        } 
    }
}