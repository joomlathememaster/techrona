<?php 
 
$default_settings = [
	'layout'	=> '1',
    'on_search' => '',
    'search_type' => 'normal',
    'on_user' => '',
    //'on_compare' => '',
    'on_wishlist' => '',
    'on_cart' => '',
    'class'	=> ''
];

$content_aligns = techrona_get_class_breakpoints($settings, [
	'prefix' => 'content_align',
	'type-prefix' => 'justify-content-',
]);

$settings = array_merge($default_settings, $settings);
extract($settings); 
  
if (!empty(get_option('woosw_page_id')))
    $wishlist_link = class_exists('WPcleverWoosw') ? WPcleverWoosw::get_url() : get_the_permalink(get_option('woosw_page_id'));
else 
    $wishlist_link = '#';
 
 
?>
<div class="kng-header-factor layout-<?php echo esc_attr($layout) ?> <?php echo esc_attr($class) ?>">
	<?php if(!empty($on_search)):?>
		<div class="kng-factor-item">
			<?php if($search_type == 'normal'): ?>
	 			<div class="kng-search-wrap search-normal <?php echo esc_attr(implode(' ', $content_aligns)) ?>">
			        <form role="search" method="get" class="kng-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			            <input type="search" class="kng-search-field" placeholder="<?php echo esc_attr__( 'Search...', 'techrona' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>
			            <button type="submit" class="kng-search-submit" value=""><span class="kngi-search-400"></span></button>
			        </form>
			    </div>
	 		<?php endif; ?>
	 		<?php if($search_type == 'product'): ?>
	 			<div class="kng-search-wrap search-ajax <?php echo esc_attr(implode(' ', $content_aligns)) ?>">
			        <div class="kng-ajax-search">
			            <form role="search" method="get" class="kng-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			                <fieldset>
			                    <div class="search-button-group">
			                        <a href="#" class="search-clear remove" title="Clear"></a>
			                        <span class="search-icon"><span class="kngi-search-400"></span></span>
			                        <input type="search" class="kng-search-field" placeholder="<?php echo esc_attr__( 'Search Product...', 'techrona' ); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>
			                        <button type="submit" class="kng-search-submit" value="<?php echo esc_attr__( 'Search', 'techrona' ); ?>"><span class="kngi-search-400"></span></button>
			                    </div>
			                    <input type="hidden" name="post_type" value="product">
			                    <div class="autocomplete-wrapper"><ul class="product_list_result row" style="display: none;"></ul></div>
			                </fieldset>
			            </form>
			        </div>
			    </div>
	 		<?php endif; ?>
	 	</div>
	 	
	<?php endif; ?>
	<?php if(!empty($on_user)): 
		if (is_user_logged_in()):
            if(class_exists('WooCommerce'))
                $user_link = wc_get_page_permalink( 'myaccount' );
            else 
                $user_link = get_edit_user_link();
            $user = wp_get_current_user();
            $display_name = $user->data->display_name;
            ?>
            <div class="kng-factor-item kng-user logined">
                <a class="kng-factor" href="<?php echo esc_url($user_link) ?>">
                	<span class="factor-title user-title"><?php echo esc_html($display_name) ?></span>
                    <?php echo get_avatar( get_the_author_meta( 'ID' ), '22', '', esc_html__('techrona', 'techrona'), [
                            'width' => '22',
                            'height' => '22',
                            'class'  => 'kng-radius-11'
                        ] ); ?>
                </a>
            </div>  
            <?php 
        else:
            $user_link = wp_login_url();
            ?>
            <a class="kng-factor kng-user kng-factor-item" href="<?php echo esc_url($user_link) ?>">
            	<span class="factor-title user-title"><?php echo esc_html__( 'Login', 'techrona' ) ?></span>
            	<?php techrona_get_svg('icon-user') ?>
        	</a> 
            <?php 
        endif;
		?>
	<?php endif; ?>
	<?php if(!empty($on_wishlist) && class_exists('WPcleverWoosw')):?>
		<div class="m-divider"></div>
		<a href="<?php echo WPcleverWoosw::get_url(); ?>" class="kng-factor kng-wishlist kng-factor-item">
			<span class="factor-title wishlist-title"><?php echo esc_html__( 'Wishlist', 'techrona' ) ?></span>
			<span class="wishlist-icon-count item-count">
				<?php techrona_get_svg('icon-heart') ?>
				<span class="header-count wishlist-count" data-count="0"><?php echo WPcleverWoosw::get_count(); ?></span>
			</span>
		</a>	
	<?php endif; ?>
	<?php if(!empty($on_cart) && class_exists('WooCommerce')): 
		if(!is_admin())
            $count = WC()->cart->get_cart_contents_count();

        $cart_link = wc_get_page_permalink( 'cart' );
		?>
		<a href="<?php echo esc_url($cart_link) ?>" class="kng-factor kng-factor-item kng-cart-toggle" data-target=".kng-side-cart">
			<span class="factor-title cart-title"><?php echo esc_html__( 'Cart', 'techrona' ) ?></span>
			<span class="cart-icon-count item-count">
				<?php techrona_get_svg('icon-cart1') ?>   
                <?php if(!is_admin()): ?>
                    <span class="header-count cart_total"><?php echo esc_attr($count) ?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php add_action( 'kng_anchor_target', 'techrona_header_popup_cart',99); ?>
	<?php endif; ?>
	 
</div>
 