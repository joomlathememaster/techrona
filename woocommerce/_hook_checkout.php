<?php
//Message
if(!function_exists('techrona_woocommerce_checkout_coupon_message')){
	add_filter('woocommerce_checkout_coupon_message','techrona_woocommerce_checkout_coupon_message');
	function techrona_woocommerce_checkout_coupon_message(){
		return '<span class="kng-added-to-cart-msg">'.esc_html__( 'Have a coupon?', 'techrona' ) . '</span> <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'techrona' ) . '</a>';
	}
}

// add inner wrap div to order review columns
if(!function_exists('techrona_woocommerce_checkout_order_review_inner_open')){
	add_action('woocommerce_checkout_order_review','techrona_woocommerce_checkout_order_review_inner_open', 0);
	function techrona_woocommerce_checkout_order_review_inner_open(){
		echo '<div class="kng-woocommerce-checkout-review-order-inner p-30 bg-accent kng-radius-12">';
	}
}
if(!function_exists('techrona_woocommerce_checkout_order_review_inner_close')){
	add_action('woocommerce_checkout_order_review','techrona_woocommerce_checkout_order_review_inner_close', 999);
	function techrona_woocommerce_checkout_order_review_inner_close(){
		echo '</div>';
	}
}

// add heading to order review columns
if(!function_exists('techrona_woocommerce_checkout_order_review')){
	add_action('woocommerce_checkout_order_review','techrona_woocommerce_checkout_order_review', 1);
	function techrona_woocommerce_checkout_order_review(){ ?>
		<h3 id="kng-order-review-heading" class="order-title"><?php esc_html_e( 'Your order', 'techrona' ); ?></h3>
	<?php }
}

// add div wrap content after order review title
if(!function_exists('techrona_woocommerce_checkout_order_review_inner2_open'))
{
	add_action('woocommerce_checkout_order_review','techrona_woocommerce_checkout_order_review_inner2_open', 2);
	function techrona_woocommerce_checkout_order_review_inner2_open(){
		echo '<div class="kng-woocommerce-checkout-review-order-inner2 overflow-hidden text-body">';
	}
}
if(!function_exists('techrona_woocommerce_checkout_order_review_inner2_close'))
{
	add_action('woocommerce_checkout_order_review','techrona_woocommerce_checkout_order_review_inner2_close', 998);
	function techrona_woocommerce_checkout_order_review_inner2_close(){
		echo '</div>';
	}
}

// custom proceed to paypal button
if(!function_exists('techrona_woocommerce_order_button_html')){
	add_filter('woocommerce_order_button_html', 'techrona_woocommerce_order_button_html');
	function techrona_woocommerce_order_button_html(){
		$order_button_text = apply_filters( 'woocommerce_order_button_text', esc_html__( 'Place order', 'techrona' ) );
		return '<div class="kng-checkout-place-order"><button type="submit" class="button btn-black" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button></div>';
	}
}