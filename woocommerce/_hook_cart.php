<?php
// Cart Coupon
if(!function_exists('techrona_woocommerce_cart_actions')){
	add_action('woocommerce_cart_actions','techrona_woocommerce_cart_actions', 0);
	function techrona_woocommerce_cart_actions(){
	?>
		<div class="kng-cart-acctions row justify-content-between gutters-30 gutters-grid">
			<?php if ( wc_coupons_enabled() ) { ?>
				<div class="coupon kng-coupon col-12 col-md-auto">
					<div class="kng-coupon-wrap row gutters-0 gutters-grid">
						<div class="col">
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'techrona' ); ?>" />
						</div>
						<div class="col-auto">
							<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'techrona' ); ?>"><?php esc_html_e( 'Apply coupon', 'techrona' ); ?></button>
						</div>
						<div class="col-12 empty-none"><?php do_action( 'woocommerce_cart_coupon' ); ?></div>
					</div>
				</div>
			<?php } ?>
			<div class="kng-btns-continue-update col-12 col-md-auto">
				<div class="row gutters-10 gutters-grid justify-content-between justify-content-md-end">
					<div class="col-12 col-sm-auto">
						<a class="btn kng-continue-shop text-center btn-alt primary" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
							<?php esc_html_e( 'Continue Shopping', 'techrona' ); ?>
						</a>
					</div>
					<div class="col-12 col-sm-auto">
						<button type="submit" class="button kng-update-cart btn-black" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'techrona' ); ?>"><?php esc_html_e( 'Update cart', 'techrona' ); ?></button>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

// Continue Shopping Button
if(!function_exists('techrona_woocommerce_return_to_shop')){
	//add_action('woocommerce_cart_actions', 'techrona_woocommerce_return_to_shop', 2);
	function techrona_woocommerce_return_to_shop(){ ?>
		<div class="text-end pt-10">
			<a class="btn kng-continue-shop" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php esc_html_e( 'Continue Shopping', 'techrona' ); ?>
			</a>
		</div>
	<?php
	}
}

if ( ! function_exists( 'woocommerce_button_proceed_to_checkout' ) ) {
	/**
	 * Output the proceed to checkout button.
	 */
	function woocommerce_button_proceed_to_checkout() {
		?>
		<div class="text-end pt-10">
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button btn btn-second btn-xlg">
				<?php esc_html_e( 'Proceed to checkout', 'techrona' ); ?>
			</a>
		</div>
		<?php
	}
}

// Cross Sell
// Move Cross Sell to Last
remove_action('woocommerce_cart_collaterals','woocommerce_cross_sell_display');
if(techrona_get_opts('cart_cross_sell', '1') === '1'){
	add_action('woocommerce_after_cart','woocommerce_cross_sell_display', 0);
}
//filter:  woocommerce_cross_sells_columns
add_filter( 'woocommerce_cross_sells_columns', 'techrona_woocommerce_cross_sells_columns');
function techrona_woocommerce_cross_sells_columns( $columns ) {
	$columns = techrona_get_opts('cart_cross_sell_column', '4');
	return $columns;
}
// filter: woocommerce_cross_sells_total
add_filter( 'woocommerce_cross_sells_total', 'techrona_woocommerce_cross_sells_total');
function techrona_woocommerce_cross_sells_total( $totals ) {
	$totals = techrona_get_opts('cart_cross_sell_total', '4');;
	return $totals;
}

add_action( 'woocommerce_cart_is_empty', 'techrona_custom_cart_is_empty' );
function techrona_custom_cart_is_empty(){
	?>
	<div class="kng-cart-empty-wrap text-center">
		<img class="img-bag" src="<?php echo esc_url(get_template_directory_uri().'/assets/images/bag-large.png')?>">
		<h2 class="kng-heading"><?php echo esc_html__('Your cart is currently empty.','techrona') ?></h2>
		<p class="desc"><?php echo esc_html__( 'You may check out all the available products and buy some in the shop.', 'techrona' ) ?></p>
	</div>
	<?php 
}

/* mini cart */
if ( ! function_exists( 'techrona_widget_shopping_cart_button_view_cart' ) ) {
	remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
	add_action( 'woocommerce_widget_shopping_cart_buttons', 'techrona_widget_shopping_cart_button_view_cart', 10 );
	function techrona_widget_shopping_cart_button_view_cart(){
		echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward btn-black">' . esc_html__( 'View cart', 'techrona' ) . '</a>';
	}
}
if ( ! function_exists( 'techrona_widget_shopping_cart_proceed_to_checkout' ) ) {
	remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );
	add_action( 'woocommerce_widget_shopping_cart_buttons', 'techrona_widget_shopping_cart_proceed_to_checkout', 20 );
	function techrona_widget_shopping_cart_proceed_to_checkout(){
		echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button checkout wc-forward btn-alt black">' . esc_html__( 'Checkout', 'techrona' ) . '</a>';
	}
}