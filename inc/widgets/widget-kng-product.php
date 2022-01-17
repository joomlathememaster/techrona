<?php
defined( 'ABSPATH' ) or exit( - 1 );
/**
 * Product hot, onsale widgets
 *
 */
 
if(!function_exists('kng_register_wp_widget')) return;
add_action( 'widgets_init', function(){
    kng_register_wp_widget( 'Kng_Products' );
});

class Kng_Products extends WP_Widget {
	function __construct() {
		parent::__construct(
			'kng_products',
			esc_html__( '*KNG Products', 'techrona' ),
			array(
				'description'                 => esc_html__( 'Shows products with select type.', 'techrona' ),
				'customize_selective_refresh' => true,
			)
		);
	}

	/**
	 * Outputs the HTML for this widget.
	 *
	 * @param array $args An array of standard parameters for widgets in this theme
	 * @param array $instance An array of settings for this widget instance
	 *
	 * @return void Echoes it's output
	 **/
	function widget( $args, $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'        => esc_html__( 'Products', 'techrona' ),
			'post_to_show' => 4,
			'order_by'     => 'date',
			'order'        => 'asc',
		) );

		$product_visibility_term_ids = wc_get_product_visibility_term_ids();

		$title        = empty( $instance['title'] ) ? '' : $instance['title'];
		$title        = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$post_per_page = ! empty( $instance['post_to_show'] ) ? absint( $instance['post_to_show'] ) : 3;
		$type      = ! empty( $instance['type'] ) ? sanitize_title( $instance['type'] ) : 'recent_product';
		 
		$query_args = array(
	        'post_type' => 'product',
	        'posts_per_page' => $post_per_page,
	        'post_status' => 'publish',
	        'tax_query' => array(
	            array(
	                'taxonomy' => 'product_visibility',
	                'field'    => 'term_taxonomy_id',
	                'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
	                'operator' => 'NOT IN',
	            )
	        ),
	        'meta_query' => array(
		        'relation'    => 'AND'
		    ),
	    );
	    $query_args = techrona_product_filter_type_args($type,$query_args); 
		 
		 
		$products = new WP_Query( $query_args );
		printf( '%s', $args['before_widget'] );
		printf( '%s', $args['before_title'] . $title . $args['after_title'] ); 
		if ( $products && $products->have_posts() ){
			echo '<div class="kng-wg-products '.str_replace('_', '-',$type).'">';
			while ( $products->have_posts() ) :
				$products->the_post();
				$this->product_item();
			endwhile;
			echo '</div>';
			wp_reset_postdata();
		}else{
			echo '<div class="products no-items">'.esc_html__( 'Not found product','techrona' ).'</div>';
		}
		printf( '%s', $args['after_widget'] );
	}

	protected function product_item() {
		global $product;
		?>
        <div class="product">  
			<?php
			if ( $product->get_type() == 'variable' ) {
				$regular_price = $product->get_variation_regular_price( 'max' );
				$sales_price   = $product->get_variation_sale_price( 'max' );
			} else {
				$regular_price = $product->get_regular_price();
				$sales_price   = $product->get_sale_price();
			}
  
			if ( isset( $regular_price ) && $regular_price > 0 && isset( $sales_price ) && floatval($sales_price ) > 0){
				$percentage = round( ( ( $regular_price - floatval($sales_price )) / $regular_price ) * 100 );
				printf( '<span class="kng-onsale">- %s </span>', $percentage . '%' );
			}
			?>
            <a class="product-img" href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php echo techrona_html( $product->get_image() ); ?>
            </a>
            <a class="product-title" href="<?php echo esc_url( $product->get_permalink() ); ?>">
				<?php the_title(); ?>
            </a>
            <div class="product-cat">
				<?php the_terms($product->get_id(), 'product_cat', '', ', ', '' ); ?>
			</div>
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<span class="price"><?php echo techrona_html($price_html); ?></span>
			<?php endif; ?>
        </div>
		<?php
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @param array $new_instance An array of new settings as submitted by the admin
	 * @param array $old_instance An array of the previous settings
	 *
	 * @return array The validated and (if necessary) amended settings
	 **/
	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['post_to_show'] = absint( $new_instance['post_to_show'] );
		$instance['type']     = sanitize_text_field( $new_instance['type'] );
		 
		return $instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @param array $instance An array of the current settings for this widget
	 *
	 * @return void Echoes it's output
	 **/
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'        => esc_html__( 'Deal of the Month', 'techrona' ),
			'post_to_show' => 3,
			'type'     => 'recent_product',
			 
		) );

		$title        = $instance['title'] ? esc_attr( $instance['title'] ) : '';
		$post_to_show = absint( $instance['post_to_show'] );
		$type     = $instance['type'] ? esc_attr( $instance['type'] ) : '';
		 
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'techrona' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'post_to_show' ) ); ?>"><?php esc_html_e( 'Number of product to show:', 'techrona' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'post_to_show' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'post_to_show' ) ); ?>" type="number" step="1"
                   min="1"
                   value="<?php echo esc_attr( $post_to_show ); ?>" size="3"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"><?php esc_html_e( 'Type', 'techrona' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'order_by' ) ); ?>">
                <option value="recent_product" <?php selected( $type, 'recent_product' ) ?>><?php esc_html_e( 'Recent Product', 'techrona' ) ?></option>
                <option value="best_selling" <?php selected( $type, 'best_selling' ) ?>><?php esc_html_e( 'Best Selling', 'techrona' ) ?></option>
                <option value="featured_product" <?php selected( $type, 'featured_product' ) ?>><?php esc_html_e( 'Featured Product', 'techrona' ) ?></option>
                <option value="top_rate" <?php selected( $type, 'top_rate' ) ?>><?php esc_html_e( 'Top Rate', 'techrona' ) ?></option>
                <option value="on_sale" <?php selected( $type, 'on_sale' ) ?>><?php esc_html_e( 'On Sale', 'techrona' ) ?></option>
                <option value="recent_review" <?php selected( $type, 'recent_review' ) ?>><?php esc_html_e( 'Recent Review', 'techrona' ) ?></option>
                <option value="deals" <?php selected( $type, 'deals' ) ?>><?php esc_html_e( 'Deals', 'techrona' ) ?></option>
            </select>
        </p>
         
		<?php
	}
}