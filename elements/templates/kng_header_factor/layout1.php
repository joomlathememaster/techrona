<?php 
 
$default_settings = [
	'layout'	=> '1',
    'on_search' => '',
    'search_type' => 'normal',
    'on_user' => '',
    'on_btn_more' => '',
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
  
if(class_exists('WooCommerce'))
    $user_link = wc_get_page_permalink( 'myaccount' );
else 
    $user_link = get_edit_user_link();

if (!empty(get_option('woosw_page_id')))
    $wishlist_link = class_exists('WPcleverWoosw') ? WPcleverWoosw::get_url() : get_the_permalink(get_option('woosw_page_id'));
else 
    $wishlist_link = '#';

//$user_link = wp_login_url();
 
?>
<div class="kng-header-factor layout-<?php echo esc_attr($layout) ?> <?php echo esc_attr($class) ?>">
	<div class="header-factor-inner d-flex align-items-center <?php echo esc_attr(implode(' ', $content_aligns)) ?>">
		<?php if(!empty($on_search)):?>
			<div class="kng-factor-item">
				<?php if($search_type == 'normal'): ?>
		 			<a href="javascript:void(0);" class="kng-factor kng-search kng-modal kng-transition" data-target=".kng-search-popup-normal"><span class="header-icon icon-search"></span></a>
		 			<?php add_action('kng_anchor_target', 'techrona_search_popup_normal'); ?>
		 		<?php endif; ?>
		 		<?php if($search_type == 'product'): ?>
		 			<a href="javascript:void(0);" class="kng-factor kng-search kng-modal kng-transition" data-target=".kng-search-popup-product"><span class="header-icon icon-search"></span></a>
		 			<?php add_action('kng_anchor_target', 'techrona_search_popup_product'); ?>
		 		<?php endif; ?>
		 	</div>
		 	
		<?php endif; ?>
		<?php if(!empty($on_user)): 
			if (is_user_logged_in()):
				$user = wp_get_current_user();
				$display_name = $user->data->display_name;
				?>
				<div class="kng-factor-item kng-user logined">
					<a class="kng-factor" href="<?php echo esc_url($user_link) ?>">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), '44', '', esc_html__('techrona', 'techrona'), [
	                            'width' => '44',
	                            'height' => '44',
	                            'class'  => 'kng-radius-22'
	                        ] ); ?>
	                    <span class="user-title"><?php echo esc_html($display_name) ?></span>
					</a>
				</div>	
				<?php 
			else:
				?>
				<div class="kng-factor-item kng-user">
					<a class="kng-factor" href="<?php echo esc_url($user_link) ?>"><span class="kng-icon kngi-user1"></span></a>	
				</div>			
				<?php 
			endif;
			?>
		<?php endif; ?>
		<?php if(!empty($on_wishlist) && class_exists('WPcleverWoosw')):?>
			<div class="kng-factor-item  kng-wishlist">
				<a href="<?php echo WPcleverWoosw::get_url(); ?>" class="kng-factor"><span class="kng-icon kngi-heart-regular"></span><span class="header-count wishlist-count" data-count="0"><?php echo WPcleverWoosw::get_count(); ?></span></a>	
			</div>	
		<?php endif; ?>
		<?php if(!empty($on_cart) && class_exists('WooCommerce')): 
			if(!is_admin())
				$count = WC()->cart->get_cart_contents_count();
			$cart_link = wc_get_page_permalink( 'cart' );
			?>
			<div class="kng-factor-item kng-cart">
				<a href="<?php echo esc_url($cart_link) ?>" class="kng-factor kng-cart-toggle" data-target=".kng-side-cart"><span class="header-icon icon-shopping-bag"></span>
					<?php if(!is_admin()): ?>
						<span class="header-count cart_total"><?php echo esc_attr($count) ?></span>
					<?php endif; ?>
				</a>
			</div>
			<?php add_action( 'kng_anchor_target', 'techrona_header_popup_cart'); ?>
		<?php endif; ?>
		<?php if(!empty($on_btn_more)): ?>
			<div class="kng-factor-item btn-more-wrap">
				<div class="btn-more">
					<span class="line-1"></span>
					<span class="line-2"></span>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
 