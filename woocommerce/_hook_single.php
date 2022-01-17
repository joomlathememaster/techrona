<?php
/**
 * Build Single Product Gallery and Summary layout 
 *
*/
if(!function_exists('techrona_woocommerce_before_single_product_summary')){
	add_action('woocommerce_before_single_product_summary','techrona_woocommerce_before_single_product_summary', 0);
	function techrona_woocommerce_before_single_product_summary(){
		$classes = ['kng-wc-img-summary kng-single-product-gallery-summary-wraps row', techrona_get_theme_opt('techrona_product_gallery_layout', techrona_configs('techrona_product_gallery_layout'))];
		$class = techrona_get_theme_opt('techrona_product_gallery_thumb_position', techrona_configs('techrona_product_gallery_thumb_position'));
		echo '<div class="'.trim(implode(' ', $classes)).'">';
			echo '<div class="kng-single-product-gallery-wraps col-md-6 thumbnail-'.esc_attr($class).'"><div class="kng-single-product-gallery-wraps-inner relative">';
				do_action('techrona_before_single_product_gallery');
				do_action('techrona_single_product_gallery');
				do_action('techrona_adter_single_product_gallery');
			
	}
}
// close gallery column  and open summary column
if(!function_exists('techrona_woocommerce_single_gallery_close')){
	add_action('woocommerce_before_single_product_summary', 'techrona_woocommerce_single_gallery_close', 999);
	function techrona_woocommerce_single_gallery_close(){
		echo '</div></div>';
		echo '<div class="kng-single-product-summary-wrap col-md-6">';
	}
}

// close summary columns and close galery-sumary row
if(!function_exists('techrona_woocommerce_after_single_product_summary')){
	add_action('woocommerce_after_single_product_summary', 'techrona_woocommerce_after_single_product_summary', 0);
	function techrona_woocommerce_after_single_product_summary(){
			echo '</div>';
		echo '</div>';
	}
}
// Remove default sale flash and gallery 
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
// Get back sale flash and galley 
add_action('techrona_before_single_product_gallery', 'woocommerce_show_product_sale_flash', 1);
add_action('techrona_single_product_gallery', 'woocommerce_show_product_images', 1);

/**
 * Add Custom CSS class to Gallery
*/
add_filter('woocommerce_single_product_image_gallery_classes','techrona_woocommerce_single_product_image_gallery_classes');
function techrona_woocommerce_single_product_image_gallery_classes($class){
	$class[] = 'kng-product-gallery-'.techrona_get_theme_opt('techrona_product_gallery_layout', techrona_configs('techrona_product_gallery_layout'));
	$class[] = 'kng-product-gallery-'.techrona_get_theme_opt('techrona_product_gallery_thumb_position', techrona_configs('techrona_product_gallery_thumb_position'));
	unset($class[3]);
	return $class;
}
 
/* Single Thumbnail Size */
add_filter( 'woocommerce_get_image_size_single', function( $size ) {
	$product_image_cropped = techrona_get_theme_opt('product_image_cropped');
	if($product_image_cropped !='1') return $size;
    return array(
        'width'  => (int)techrona_configs('techrona_product_single_image_w'),
        'height' => (int)techrona_configs('techrona_product_single_image_h'),
        'crop'   => 1,
    );
} );

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
	$product_image_cropped = techrona_get_theme_opt('product_image_cropped');
	if($product_image_cropped !='1') return $size;
	return array(
        'width'  => (int)techrona_configs('techrona_product_gallery_thumbnail_w'),
        'height' => (int)techrona_configs('techrona_product_gallery_thumbnail_h'),
        'crop'   => 1,
    );
} );
 
/**
 * Single Product 
 *
 * Gallery style with thumbnail carousel in bottom
 *
*/
if(!function_exists('techrona_wc_single_product_gallery_layout')){
	add_filter('woocommerce_single_product_carousel_options', 'techrona_wc_single_product_gallery_layout' );
    function techrona_wc_single_product_gallery_layout($options){
        $gallery_layout = techrona_get_theme_opt('techrona_product_gallery_layout', techrona_configs('techrona_product_gallery_layout'));

        $options['prevText']     = '<span class="flex-prev-icon"></span>';
		$options['nextText']     = '<span class="flex-next-icon"></span>';

        switch ($gallery_layout) {
	        case 'vertical':
				$options['directionNav'] = true;
				$options['controlNav']   = false;
	            $options['sync'] = '.wc-gallery-sync';
	            break;
	    
	        case 'horizontal':
	            $options['directionNav'] = true;
				$options['controlNav']   = false;
	            $options['sync'] = '.wc-gallery-sync';
	            break;
	    }
	    return $options;
    }
}

/**
 * Single Product Gallery
 *
 * Add thumbnail product gallery 
 *
*/
if(!function_exists('techrona_product_gallery_thumbnail_sync')){
	add_action('techrona_single_product_gallery', 'techrona_product_gallery_thumbnail_sync', 2);
	function techrona_product_gallery_thumbnail_sync($args=[]){
		global $product;
		$gallery_layout = techrona_get_theme_opt('product_gallery_layout', techrona_configs('techrona_product_gallery_layout'));
		$product_gallery_thumb_position = techrona_get_theme_opt('techrona_product_gallery_thumb_position', techrona_configs('techrona_product_gallery_thumb_position'));
        $args = wp_parse_args($args, [
            'gallery_layout' => $gallery_layout
        ]);
        $post_thumbnail_id = $product->get_image_id();
    	$attachment_ids = array_merge( (array)$post_thumbnail_id , $product->get_gallery_image_ids() );
 
        if('simple' === $args['gallery_layout'] || '' ===  $args['gallery_layout'] || 'default' === $args['gallery_layout'] || empty($attachment_ids[0])) return;
        $flex_class = '';

        $thumb_v_w = techrona_configs('techrona_product_gallery_thumbnail_v_w');
        $thumb_v_h = techrona_configs('techrona_product_gallery_thumbnail_v_h');

        $thumb_h_w = techrona_configs('techrona_product_gallery_thumbnail_h_w');
        $thumb_h_h = techrona_configs('techrona_product_gallery_thumbnail_h_h');
         
        switch ($args['gallery_layout']) {
	        case 'vertical':
				$thumbnail_size = $thumb_v_w.'x'.$thumb_v_h;
				$thumb_w        = $thumb_v_w;
				$thumb_h        = $thumb_v_h;
				$flex_class     = 'flex-vertical';
				$thumb_margin   = techrona_configs('techrona_product_gallery_thumbnail_space_vertical');
	            break;
	    
	        case 'horizontal':
	            $thumbnail_size = $thumb_h_w.'x'.$thumb_h_h;
	            $thumb_w = $thumb_h_w;
	            $thumb_h = $thumb_h_h;
	            $flex_class = 'flex-horizontal';
	            $thumb_margin   = techrona_configs('techrona_product_gallery_thumbnail_space_horizontal');
	            break;

	    }
	    $gallery_css_class = ['wc-gallery-sync', 'thumbnail-'.$gallery_layout, 'thumbnail-pos-'.$product_gallery_thumb_position];
	    
    ?>
    	<div class="<?php echo trim(implode(' ', $gallery_css_class));?>" data-thumb-w="<?php echo esc_attr($thumb_w);?>" data-thumb-h="<?php echo esc_attr($thumb_h);?>" data-thumb-margin="<?php echo esc_attr($thumb_margin); ?>">
			<div class="wc-gallery-sync-slides flexslider <?php echo esc_attr($flex_class);?>">
	            <?php foreach ( $attachment_ids as $attachment_id ) { 
	            	$img = kng_get_image_by_size( array(
                        'attach_id'  => $attachment_id,
                        'thumb_size' => $thumbnail_size,
                        'class' => 'img-gal',
                    ));
                    $thumbnail = $img['thumbnail'];
	            	?>
	                <div class="wc-gallery-sync-slide flex-control-thumb"><?php echo wp_kses_post($thumbnail);?></div>
	            <?php } ?>
	        </div>
	    </div>
    <?php
	}
}
 
// single product title
if ( ! function_exists( 'woocommerce_template_single_title' ) ) {
	/**
	 * Output the product title.
	 */
	function woocommerce_template_single_title() {
		$disable_product_title = techrona_get_theme_opt('disable_product_title','1');
		if($disable_product_title == '0')
			the_title('<div class="single-product-title h3">', '</div>');
	}
}
if ( ! function_exists( 'techrona_single_product_author' ) ) {
	function techrona_single_product_author(){
		global $product;

		$author =  wc_get_product_terms( get_the_ID(), 'pa_book-author', array( 'fields' => 'all' ) );
		if(count($author) > 0){
			echo '<div class="product-single-author">';
				echo '<div class="product-single-author-inner">';
					echo '<span class="lbl">'.esc_html__( 'Author:','techrona' ).'</span>';
					the_terms( get_the_ID(), 'pa_book-author', '', ', ', '' );
				echo '</div>';
			echo '</div>';
		}
	}
}
  
// change rating html
if ( ! function_exists( 'woocommerce_template_single_rating' ) ) {

	/**
	 * Output the product rating.
	 */
	function woocommerce_template_single_rating() {
		global $product;

		if ( ! wc_review_ratings_enabled() ) { 
			return;
		}

		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
		echo '<div class="product-single-summary-meta-top-wrap"><div class="product-single-summary-meta-top d-flex gutters-24 justify-content-between">';
		techrona_single_product_author();
	 	?>

			<div class="woocommerce-product-rating">
				<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
				<?php if ( comments_open() ) : ?>
					<?php //phpcs:disable ?>
					<a href="#reviews" class="woocommerce-review-link kng-scroll-down" rel="nofollow"><?php printf( _n( '%s Review', '%s Reviews', $review_count, 'techrona' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?></a>
					<?php // phpcs:enable ?>
				<?php endif ?>
			</div>

		<?php 
		echo '</div></div>';
	}
}

// single price 
add_filter('woocommerce_product_price_class', function(){
	return 'kng-product-single-price';
});
if(!function_exists('techrona_single_product_summary_sold')){
	add_action('woocommerce_single_product_summary','techrona_single_product_summary_sold', 15);
	function techrona_single_product_summary_sold(){
		global $product;
		$publisher =  wc_get_product_terms( get_the_ID(), 'pa_publisher', array( 'fields' => 'all' ) );
		if(count($publisher) > 0){
			echo '<div class="sold-by-wrap">';
				echo '<span class="lbl">'.esc_html__( 'Sold by:', 'techrona' ).'</span>';
				the_terms( get_the_ID(), 'pa_publisher', '', ', ', '' );
			echo '</div>';
		}
 
	}
}

remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary','techrona_wc_template_single_meta',21);

if(!function_exists('techrona_wc_template_single_meta')){
	add_action('woocommerce_template_single_excerpt','techrona_wc_template_single_meta',99);
	function techrona_wc_template_single_meta(){
		global $product;

		echo '<div class="product_meta">';

		do_action( 'woocommerce_product_meta_start' );
		
		if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) {
			$sku = $product->get_sku() ? $product->get_sku() : esc_html__( 'N/A', 'techrona' );
			echo '<span class="sku_wrapper"><span class="lbl">'.esc_html__( 'SKU:', 'techrona' ).'</span> <span class="sku">'.$sku.'</span></span>';
		}
		
		echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in"><span class="lbl">' . _n( 'Category: ', 'Categories:', count( $product->get_category_ids() ), 'techrona' ) . '</span>', '</span>' );

		echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as"><span class="lbl">' . _n( 'Tag: ', 'Tags: ', count( $product->get_tag_ids() ), 'techrona' ) . '</span>', '</span>' );

		do_action( 'woocommerce_product_meta_end' );

		echo '</div>';
		 
	}
}

if(!function_exists('techrona_wc_quantity_stock_message')){
	add_action('woocommerce_after_quantity_input_field','techrona_wc_quantity_stock_message');
	function techrona_wc_quantity_stock_message(){
		global $product;
		//$variations_stock = techrona_get_variations_stock_quantity( $product );
 		if(is_singular( 'product' )){
			if($product->is_in_stock()){
				echo '<div class="stock in-stock bottom"><span class="fa fa-check-circle"></span>'.esc_html__('In Stock','techrona').'</div>';
			} else {
				echo '<div class="stock out-of-stock bottom"><span class="fa fa-window-close"></span>'.esc_html__('Out of Stock','techrona').'</div>';
			}
		}
	}
}

function techrona_get_variations_stock_quantity( $product ) {

	if($product->get_type() != 'variable') return;
	$variations = $product->get_available_variations();

    $variations_stock = array();

    foreach ( $variations as $variation ) {

        $variation_o = new WC_Product_Variation( $variation['variation_id'] );
        $variations_stock[] = $variation_o->get_stock_quantity();
    }

    return $variations_stock;
}

remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart', 30);
if(!function_exists('techrona_single_add_to_cart')){
	add_action('woocommerce_single_product_summary','techrona_single_add_to_cart', 30);
	function techrona_single_add_to_cart(){
		global $product;
		switch ($product->get_type()) {
			case 'variable':
				techrona_variable_add_to_cart(); 
				//do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
				break;
			case 'external':
				techrona_external_add_to_cart(); 
				break;
			case 'grouped':
				techrona_grouped_add_to_cart(); 
				break;
			default:
				techrona_simple_add_to_cart(); 
				break;
		}
	}
}
function techrona_single_add_to_cart_layout1(){
	global $product;
	switch ($product->get_type()) {
		case 'variable':
			techrona_variable_add_to_cart(); 
			break;
		case 'external':
			techrona_external_add_to_cart(); 
			break;
		case 'grouped':
			techrona_grouped_add_to_cart(); 
			break;
		default:
			techrona_simple_add_to_cart(); 
			break;
	}
}
 

add_filter( 'woocommerce_dropdown_variation_attribute_options_html', 'techrona_custom_variation_attribute_options_html', 10, 2 );
function techrona_custom_variation_attribute_options_html( $html, $args){
	global $wpdb, $product;
	$product_variation_style = isset($_GET['variation-style']) ? sanitize_text_field($_GET['variation-style']) : techrona_get_theme_opt('product_variation_style','dropdown');
	if($product_variation_style == 'dropdown') return $html;

	$options               = $args['options'];
	$product               = $args['product'];
	$attribute             = $args['attribute'];
	$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title( $attribute );
	$id                    = $args['id'] ? $args['id'] : sanitize_title( $attribute );
	$class                 = $args['class'];
	$show_option_none      = (bool) $args['show_option_none'];
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : esc_html__( 'Choose an option', 'techrona' ); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

	if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
		$attributes = $product->get_variation_attributes();
		$options    = $attributes[ $attribute ];
	}
  
	$custom_html  = '<ul id="techrona-variation-att-terms" class="techrona-variation-att-terms ' . esc_attr( $class ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-id="'.esc_attr($id).'">';
	if ( ! empty( $options ) ) {
		if ( $product && taxonomy_exists( $attribute ) ) {
			
			$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

			foreach ( $terms as $term ) {
				
    			$term_slug = $term->slug;
    			$variation_id = $wpdb->get_col( 
    				$wpdb->prepare( 
					    "
					        SELECT      postmeta.post_id AS product_id
					        FROM        ".$wpdb->prefix."postmeta AS postmeta
					        LEFT JOIN  ".$wpdb->prefix."posts AS products
					                ON ( products.ID = postmeta.post_id )
					        WHERE       postmeta.meta_key LIKE 'attribute_%'
					        AND postmeta.meta_value = '%s'
					        AND products.post_parent = %d
					    ",
				        $term_slug,
					    $product->get_id()
					)
    			);
    			if(!empty($variation_id)){
	    			$parent = wp_get_post_parent_id( $variation_id[0] );

	    			$vari_price = '';
	    			if ( $parent > 0 ) {
				        $_product = new WC_Product_Variation( $variation_id[0] );
				    
				        $vari_price = $_product->get_price_html();  
				    }
				}
				if ( in_array( $term->slug, $options, true )) {
					$custom_html .= '<li class="kng-vari-item">';
					$custom_html .= '<a href="javascript:void(0)" onclick="return false;" aria-label="'. esc_html($term->name) .'" class="pro-variation-select custom-vari-enabled" data-value="'. esc_attr($term->slug) .'" ><span class="lbl">' . esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</span>';
						if(!empty($vari_price))
							$custom_html .= '<span class="price">'.$vari_price.'</span>';
						$custom_html .= '</a>';
					$custom_html .= '</li>';
				}
			}
		} else {
			foreach ( $options as $option ) {
				// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
				$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
				$custom_html .= '<li>';
				$custom_html .= '<a href="javascript:void(0)" onclick="return false;" aria-label="'. esc_html($name) .'" class="pro-variation-select ' . $selected . '" data-value="'. esc_attr($option) .'" >' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</a>';
				$custom_html .= '</li>';
			}
		}
	}

	$custom_html .= '</ul>';
	return $custom_html.$html;
}
function techrona_variable_add_to_cart(){
	global $product;
 	
 	$product_variation_style = isset($_GET['variation-style']) ? sanitize_text_field($_GET['variation-style']) : techrona_get_theme_opt('product_variation_style','dropdown');
	wp_enqueue_script( 'wc-add-to-cart-variation' );
 	
	$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
 
	$available_variations = $get_variations ? $product->get_available_variations() : false;
	$attributes = $product->get_variation_attributes();
	$attribute_keys  = array_keys( $attributes );
	$variations_json = wp_json_encode( $available_variations );
	$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
	do_action( 'woocommerce_before_add_to_cart_form' );
	?>
		<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo esc_attr($variations_attr); ?>">
			<?php do_action( 'woocommerce_before_variations_form' ); ?>

			<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
				<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', esc_html__( 'This product is currently out of stock and unavailable.', 'techrona' ) ) ); ?></p>
			<?php else : ?>
				<div class="techrona-variation-quantity-wrap style-<?php echo esc_attr($product_variation_style) ?>">
					<div class="variations">
						<?php foreach ( $attributes as $attribute_name => $options ) : ?>
							<div class="kng-variation-row row">
								<div class="label col-12"><span for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><span class="lbl"><?php echo wc_attribute_label( $attribute_name );  ?>: </span><span><?php echo esc_html__( 'Choose An Option', 'techrona' ) ?></span></span></div>
								<div class="value col-12">
									<?php
										wc_dropdown_variation_attribute_options(
											array(
												'options'   => $options,
												'attribute' => $attribute_name,
												'product'   => $product,
											)
										);
										echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'techrona' ) . '</a>' ) ) : '';
									?>
								</div>
							</div>
						<?php endforeach; ?>
						
					</div>

					<div class="single_variation_wrap">
						 
						<div class="woocommerce-variation-add-to-cart variations_button">
							<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
							<?php
							do_action( 'woocommerce_before_add_to_cart_quantity' );
							echo '<div class="quantity-lbl">'.esc_html__( 'Quantity','techrona' ).'</div>';
							woocommerce_quantity_input(
								array(
									'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
									'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
									'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( sanitize_text_field( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), 
								)
							);

							do_action( 'woocommerce_after_add_to_cart_quantity' );
							?>

							<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
							<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
							<input type="hidden" name="variation_id" class="variation_id" value="0" />
						</div>
							 
					</div>
				</div>
				<div class="kng-variation-results">
					<?php 
						do_action( 'woocommerce_before_single_variation' );
						echo '<div class="woocommerce-variation single_variation"></div>';//do_action( 'woocommerce_single_variation' );
						do_action( 'woocommerce_after_single_variation' );
					?>
				</div>
				<div class="techrona-addtocart-btn-wrap">
					<div class="kng-atc-btn">
						<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
					</div>
					<?php do_action( 'techrona_after_add_to_cart_button' ); ?>
					<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
				</div>
			<?php endif; ?>

			<?php do_action( 'woocommerce_after_variations_form' ); ?>
		</form>
	<?php 
	do_action( 'woocommerce_after_add_to_cart_form' );
}

function techrona_external_add_to_cart(){
	global $product;

	if ( ! $product->add_to_cart_url() ) {
		return;
	}
 
	$product_url = $product->add_to_cart_url();
	$button_text = $product->single_add_to_cart_text();
	do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart external" action="<?php echo esc_url( $product_url ); ?>" method="get">
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<div class="techrona-addtocart-btn-wrap">
			<div class="kng-atc-btn">
				<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $button_text ); ?></button>
			</div>
			<?php do_action( 'techrona_after_add_to_cart_button' ); ?>
		</div>
		 
		<?php wc_query_string_form_fields( $product_url ); ?>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
	<?php 
}

function techrona_grouped_add_to_cart(){
	global $product, $post;

	$products = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );

	if ( $products ) {
		 
		$grouped_product = $product;
		$grouped_products = $products;
		do_action( 'woocommerce_before_add_to_cart_form' ); ?>

		<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
			<div class="woocommerce-grouped-product-list group_table">
					<?php
					$quantites_required      = false;
					$previous_post           = $post;
					$grouped_product_columns = apply_filters(
						'woocommerce_grouped_product_columns',
						array(
							'quantity',
							'label',
							'price',
						),
						$product
					);
					$show_add_to_cart_button = false;

					do_action( 'woocommerce_grouped_product_list_before', $grouped_product_columns, $quantites_required, $product );

					foreach ( $grouped_products as $grouped_product_child ) {
						$post_object        = get_post( $grouped_product_child->get_id() );
						$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
						$post               = $post_object;  
						setup_postdata( $post );

						if ( $grouped_product_child->is_in_stock() ) {
							$show_add_to_cart_button = true;
						}

						echo '<div id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item d-flex gutters-16 ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';
 
						foreach ( $grouped_product_columns as $column_id ) {
							do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );

							switch ( $column_id ) {
								case 'quantity':
									ob_start();

									if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
										woocommerce_template_loop_add_to_cart();
									} elseif ( $grouped_product_child->is_sold_individually() ) {
										echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
									} else {
										do_action( 'woocommerce_before_add_to_cart_quantity' );

										woocommerce_quantity_input(
											array(
												'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
												'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( sanitize_text_field( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : '',  
												'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
												'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
												'placeholder' => '0',
											)
										);

										do_action( 'woocommerce_after_add_to_cart_quantity' );
									}

									$value = ob_get_clean();
									break;
								case 'label':
									$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
									$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
									$value .= '</label>';
									break;
								case 'price':
									$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
									break;
								default:
									$value = '';
									break;
							}

							echo '<div class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</div>';  
							do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
						}

						echo '</div>';
					}
					$post = $previous_post;  
					setup_postdata( $post );

					do_action( 'woocommerce_grouped_product_list_after', $grouped_product_columns, $quantites_required, $product );
					?>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

			<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

				<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
				<div class="techrona-addtocart-btn-wrap">
					<div class="kng-atc-btn">
						<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
					</div>
					<?php do_action( 'techrona_after_add_to_cart_button' ); ?>
				</div>

				<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

			<?php endif; ?>
		</form>

		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
		<?php 
	}
}

function techrona_simple_add_to_cart(){
	global $product;

	if ( ! $product->is_purchasable() ) {
		return;
	}

	echo wc_get_stock_html( $product ); // WPCS: XSS ok.

	if ( $product->is_in_stock() ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

		<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

			<?php
			do_action( 'woocommerce_before_add_to_cart_quantity' );
			echo '<div class="quantity-lbl">'.esc_html__( 'Quantity','techrona' ).'</div>';
			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( sanitize_text_field( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
				)
			);

			do_action( 'woocommerce_after_add_to_cart_quantity' );
			?>

			<div class="techrona-addtocart-btn-wrap">
				<div class="kng-atc-btn">
					<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
				</div>
				<?php do_action( 'techrona_after_add_to_cart_button' ); ?>
			</div>
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</form>

		<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

	<?php endif; ?>
	<?php 
	
}



// Wrap add-to-cart and some other button
add_action('woocommerce_single_product_summary', function(){ echo '<div class="kng-single-product-btns d-flex align-items-end">';}, 29);
add_action('woocommerce_single_product_summary', function(){ echo '</div>';}, 39);



remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);
add_action( 'woocommerce_after_single_product_summary', 'techrona_wc_output_product_data_tabs', 10 );
function techrona_wc_output_product_data_tabs(){
	$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
	if ( ! empty( $product_tabs ) ) : ?>

	<div class="woocommerce-tabs wc-tabs-wrapper">
		 
		<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
				<?php
				if ( isset( $product_tab['callback'] ) ) {
					call_user_func( $product_tab['callback'], $key, $product_tab );
				}
				?>
			</div>
		<?php endforeach; ?>

		<?php do_action( 'woocommerce_product_after_tabs' ); ?>
	</div>
	<?php 
	endif; 
}

add_filter( 'woocommerce_reviews_title', 'techrona_wc_reviews_title', 10, 3 );
function techrona_wc_reviews_title($reviews_title, $count, $product){ 
	if ( 1 === intval($count) ) {
        $reviews_title = esc_html__( 'Review (1)', 'techrona' );
    } else {
        $reviews_title = esc_html__('Reviews', 'techrona').' ('.esc_attr( $count ).')';
    }
	return $reviews_title;
}

if(!function_exists('techrona_woocommerce_rename_tabs')){
	add_filter( 'woocommerce_product_tabs', 'techrona_woocommerce_rename_tabs', 98 );
	function techrona_woocommerce_rename_tabs( $tabs ) {
		$product_addition_tab = techrona_get_theme_opt('product_addition_tab','0');
		 
		$tabs['additional_information']['title'] = esc_html__( 'Product details','techrona' );	// Rename the additional information tab

		if($product_addition_tab == '0')
			unset($tabs['additional_information']);

		return $tabs;
	}
}

// Change  added to cart message
if(!function_exists('techrona_wc_add_to_cart_message_html')){
	add_filter('wc_add_to_cart_message_html', 'techrona_wc_add_to_cart_message_html', 10, 3);
	function techrona_wc_add_to_cart_message_html($message, $products, $show_qty){
		$titles = array();
		$count  = 0;

		if ( ! is_array( $products ) ) {
			$products = array( $products => 1 );
			$show_qty = false;
		}

		if ( ! $show_qty ) {
			$products = array_fill_keys( array_keys( $products ), 1 );
		}

		foreach ( $products as $product_id => $qty ) {
			/* translators: %s: product name */
			$titles[] = apply_filters( 'woocommerce_add_to_cart_qty_html', ( $qty > 1 ? absint( $qty ) . ' &times; ' : '' ), $product_id ) . apply_filters( 'woocommerce_add_to_cart_item_name_in_quotes', sprintf( _x( '&ldquo;%s&rdquo;', 'Item name in quotes', 'techrona' ), strip_tags( get_the_title( $product_id ) ) ), $product_id );
			$count   += $qty;
		}

		$titles = array_filter( $titles );
		/* translators: %s: product name */
		$added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', $count, 'techrona' ), wc_format_list_of_items( $titles ) );

		// Output success messages.
		if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
			$return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect( wc_get_raw_referer(), false ) : wc_get_page_permalink( 'shop' ) );
			$message   = sprintf( '<span class="kng-added-to-cart-msg">%s</span> <a href="%s" tabindex="1" class="btn btn-accent btn-lg">%s</a>', esc_html( $added_text ), esc_url( $return_to ), esc_html__( 'Continue shopping', 'techrona' ) );
		} else {
			$message = sprintf( '<span class="kng-added-to-cart-msg">%s</span> <a href="%s" tabindex="1" class="btn btn-accent btn-lg">%s</a>',esc_html( $added_text ), esc_url( wc_get_cart_url() ), esc_html__( 'View cart', 'techrona' ) );
		}
		return $message;
	}
}

// Upsell Products
remove_action('woocommerce_after_single_product_summary','woocommerce_upsell_display', 15);
if(techrona_get_theme_opt('product_upsell', '1') === '1'){
	add_action('woocommerce_after_single_product_summary','woocommerce_upsell_display', 15);
}
//filter:  woocommerce_cross_sells_columns
add_filter( 'woocommerce_upsells_columns', 'techrona_woocommerce_upsells_columns');
function techrona_woocommerce_upsells_columns( $columns ) {
	$columns = techrona_get_theme_opt('product_upsell_column', '4');
	return $columns;
}
// filter: woocommerce_cross_sells_total
add_filter( 'woocommerce_upsells_total', 'techrona_woocommerce_upsells_total');
function techrona_woocommerce_upsells_total( $totals ) {
	$totals = techrona_get_theme_opt('product_upsell_total', '4');;
	return $totals;
}
// Related Products
if(techrona_get_theme_opt('product_related', '1') === '1' ){
	remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);
	add_action('techrona_hook_shop_related','woocommerce_output_related_products', 10);
}
if(techrona_get_theme_opt('product_related', '1') === '0' ){
	remove_action('woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);
}
add_filter( 'woocommerce_output_related_products_args', 'techrona_woocommerce_output_related_products_args',20 );
function techrona_woocommerce_output_related_products_args( $args ) {
	$args['posts_per_page'] = 4; //techrona_get_theme_opt('product_related_total', 4); // 4 related products
	$args['columns'] = 4; //techrona_get_theme_opt('product_related_column', 4); // arranged in 2 columns

	return $args;
}


 