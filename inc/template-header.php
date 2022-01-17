<?php
/**
 * Header layout
 **/
if(!function_exists('techrona_header_layout')){
    function techrona_header_layout()
    {
        if( is_singular('kng-header') || is_singular('kng-footer')  || is_singular('kng-mega-menu') ) return;
        
        /*if(is_404()){
            get_template_part( 'template-parts/header/header-layout', '404' );
        }else{*/
            $header_layout = techrona_get_opts( 'header_layout', 'df' );
            if($header_layout == 'df') {
                get_template_part( 'template-parts/header/header-layout', 'df' );
            } else {
                get_template_part( 'template-parts/header/header-layout', 'elementor' );
            }
        //}
    }
}
/**
 * Header css class
*/
if(!function_exists('techrona_header_css_class')){
    function techrona_header_css_class($class=''){
        $classes = [
            'kng-header',
            'header-layout-'.techrona_get_opts('header_layout','df')
        ];
   
        $header_ontop = techrona_get_opts('header_ontop','0');
        $mobile_header_ontop = techrona_get_opts('mobile_header_ontop','0');
         
        if($header_ontop == '1') $classes[] = 'is-ontop header-ontop';
        if($mobile_header_ontop == '1') $classes[] = 'header-ontop-mobile';
        if(!empty($class)) $classes[] = $class;

        echo esc_attr(implode(' ', $classes));
    }
}

/**
 * Header Container CSS class
*/
if(!function_exists('techrona_header_container_css_class')){
    function techrona_header_container_css_class($class = ''){
        $classes = ['header-container container'];
        $classes[] = $class;
        echo esc_attr(trim(implode(' ', $classes)));
    }
}
 
/**
 * Search Popup
 */
if(!function_exists('techrona_search_popup_normal')){
    function techrona_search_popup_normal(){
        ?>
        <div class="kng-search-popup kng-search-popup-normal kng-modal-html kng-transition">
            <a href="#" class="kng-modal-close kng-transition" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
            <div class="kng-search-popup-inner kng-modal-inner container">
                <form role="search" method="get" class="search-form kng-search-form-popup" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="text-search-wrap">
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search Here...','techrona'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                        <button type="submit" class="search-submit" value=""><span class="kngi-search-400"></span></button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('techrona_search_popup_product')){
    function techrona_search_popup_product(){
        ?>
        <div class="kng-search-popup kng-search-popup-product kng-modal-html kng-transition">
            <a href="#" class="kng-modal-close kng-transition" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
            <div class="kng-search-popup-inner kng-modal-inner container">
                <form role="search" method="get" class="search-form kng-search-form-popup" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="hidden" name="post_type" value="product"/>
                    <div class="kng-search-inner d-flex gutters-30">
                        <div class="cat-search-wrap col-auto">
                            <?php 
                            if(class_exists('Woocommerce')){
                                $args = array(
                                    'show_option_all'    => esc_html__('All Categories','techrona'),
                                    'orderby'            => 'ID',
                                    'order'              => 'ASC',
                                    'show_count'         => 0,
                                    'hide_empty'         => 1,
                                    'child_of'           => 0,
                                    'exclude'            => '',
                                    'include'            => '',
                                    'echo'               => 1,
                                    'selected'           => 0,
                                    'hierarchical'       => 1,
                                    'name'               => 'product_cat',
                                    'id'                 => 'p_cat',
                                    'class'              => 'postform woo_cat_search',
                                    'depth'              => 0,
                                    'tab_index'          => 0,
                                    'taxonomy'           => 'product_cat',
                                    'hide_if_empty'      => false,
                                    'value_field'        => 'slug',
                                );
                                wp_dropdown_categories( $args );
                            }
                            ?>
                        </div>
                        <div class="text-search-wrap col">
                            <input type="search" class="search-field" placeholder="<?php echo esc_attr__( 'Search Here...','techrona'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                            <button type="submit" class="search-submit" value=""><span class="kngi-search-400"></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}
 
// Header Cart
if(!function_exists('techrona_header_cart')){
    function techrona_header_cart($args=[]){
        $cart_on = techrona_get_opts( 'cart_on', '0' );
        if(!class_exists('Woocommerce') || $cart_on == '0') return;
        $args = wp_parse_args($args,[
            'class'  => '',
            'text'   => '',
            'style'  => '1',
            'icon'   => 'kngi-shopping-cart',
            'before' => '',
            'after'  => ''
        ]);
        $css_class = ['kng-header-cart header-icon relative', $args['class']];
       

        printf('%s', $args['before']);
    ?>
        <div class="<?php echo implode(' ', $css_class); ?>">
            <span class="h-btn-cart menu-color kng-transition">
                <?php if(!empty($args['text'])) { ?><span class="menu-text menu-color"><?php echo esc_html($args['text']);?></span><?php }?>
                <span class="cart-icon <?php echo esc_attr($args['icon']);?>"></span>
                <span class="header-count cart-count cart_total style-<?php echo esc_attr($args['style']);?>"><?php techrona_woocommerce_cart_counter(['style' => $args['style']]); ?></span>
            </span>
            
        </div>
    <?php
        printf('%s', $args['after']);
    }
}
if(!function_exists('techrona_header_popup_cart')){
    function techrona_header_popup_cart(){  
        if(!class_exists('Woocommerce')) return;
        ?>
        <div class="kng-side-panel kng-side-cart">
            <div class="kng-panel-header">
                <div class="panel-header-inner">
                    <span class="kng-title h3"><?php echo esc_html__( 'Cart', 'techrona' ) ?></span>
                    <a href="#" class="kng-close" title="<?php echo esc_attr__( 'Close', 'techrona' ) ?>"></a>
                </div>
            </div>
            <div class="kng-side-panel-content widget_shopping_cart custom_scroll">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        </div>
        <?php
    }
}
if(!function_exists('techrona_woocommerce_add_to_cart_fragments')){
    add_filter('woocommerce_add_to_cart_fragments', 'techrona_woocommerce_add_to_cart_fragments', 10, 1 );
    function techrona_woocommerce_add_to_cart_fragments( $fragments ) {
        if(!class_exists('WooCommerce')) return;
        ob_start();
        $header_layout = techrona_get_opts('header_layout','1');
        switch ($header_layout) {
            case '5':
                $cart_style = '2';
                break;
            
            default:
                $cart_style = '1';
                break;
        }
        ?>
        <span class="header-count cart-count cart_total style-<?php echo esc_attr($cart_style);?>"><?php techrona_woocommerce_cart_counter(['style' => $cart_style]); ?></span>
        <?php
        $fragments['.cart_total'] = ob_get_clean();
        return $fragments;
    }
}

if(!function_exists('techrona_woocommerce_cart_counter')){
    function techrona_woocommerce_cart_counter($args=[]){
        if(!class_exists('WooCommerce')) return;
        $args = wp_parse_args($args, [
            'style' => '1'
        ]);
        switch ($args['style']) {
            case '2':
                $count = WC()->cart->cart_contents_count;
                break;
            
            default:
                $count = WC()->cart->cart_contents_count;
                break;
        }
        echo techrona_html($count);
    }
}

// Mobile menu icon
if(!function_exists('techrona_mobile_menu_icon')){
    function techrona_mobile_menu_icon($args=[]){
        $args = wp_parse_args($args,[
            'class' => ''
        ]);
        $css_class = ['main-menu-mobile', $args['class']];
        ?>
            <div id="main-menu-mobile" class="<?php echo implode(' ', $css_class);?>">
                <span class="btn-nav-mobile open-menu" data-target=".kng-side-mobile" onclick="">
                    <span></span>
                </span>
            </div>
        <?php
    }
}
 

