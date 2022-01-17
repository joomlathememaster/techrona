<?php
function techrona_get_current_page_url() {
    if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
        $link = home_url();
    } elseif ( is_shop() ) {
        $link = get_permalink( wc_get_page_id( 'shop' ) );
    } elseif ( is_product_category() ) {
        $link = get_term_link( get_query_var( 'product_cat' ), 'product_cat' );
    } elseif ( is_product_tag() ) {
        $link = get_term_link( get_query_var( 'product_tag' ), 'product_tag' );
    } else {
        $queried_object = get_queried_object();
        $link = get_term_link( $queried_object->slug, $queried_object->taxonomy );
    }

    // Min/Max.
    if ( isset( $_GET['min_price'] ) ) {
        $link = add_query_arg( 'min_price', wc_clean( sanitize_text_field( $_GET['min_price'] ) ), $link );
    }

    if ( isset( $_GET['max_price'] ) ) {
        $link = add_query_arg( 'max_price', wc_clean( sanitize_text_field( $_GET['max_price'] ) ), $link );
    }

    // Order by.
    if ( isset( $_GET['orderby'] ) ) {
        $link = add_query_arg( 'orderby', wc_clean( sanitize_text_field( $_GET['orderby'] ) ), $link );
    }

    /**
     * Search Arg.
     * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
     */
    if ( get_search_query() ) {
        $link = add_query_arg( 's', rawurlencode( wp_specialchars_decode( get_search_query() ) ), $link );
    }

    // Post Type Arg.
    if ( isset( $_GET['post_type'] ) ) {
        $link = add_query_arg( 'post_type', wc_clean( sanitize_text_field( $_GET['post_type'] ) ), $link );
    }

    // Min Rating Arg.
    if ( isset( $_GET['rating_filter'] ) ) {
        $link = add_query_arg( 'rating_filter', wc_clean( sanitize_text_field( $_GET['rating_filter'] ) ), $link );
    }

    // All current filters.
    if ( $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes() ) { // phpcs:ignore Squiz.PHP.DisallowMultipleAssignments.Found, WordPress.CodeAnalysis.AssignmentInCondition.Found
        foreach ( $_chosen_attributes as $name => $data ) {
            $filter_name = sanitize_title( str_replace( 'pa_', '', $name ) );
            if ( ! empty( $data['terms'] ) ) {
                $link = add_query_arg( 'filter_' . $filter_name, implode( ',', $data['terms'] ), $link );
            }
            if ( 'or' === $data['query_type'] ) {
                $link = add_query_arg( 'query_type_' . $filter_name, 'or', $link );
            }
        }
    }

    return $link;
}

function techrona_woocommerce_query($type='recent_product',$post_per_page=-1,$product_ids='',$taxonomies='',$taxonomies_exclude='',$param_args=[]){
    global $wp_query;

    $product_visibility_term_ids = wc_get_product_visibility_term_ids();
    if(!empty($product_ids)){
        $kng_query = new WP_Query(array(
            'post_type' => 'product',
            'post__in' => array_map('intval', explode(',', $product_ids)),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                )
            ),
        ));
        $posts = $wp_query;
    }else{
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'post_parent' => 0,
            'date_query' => array(
                array(
                   'before' => date('Y-m-d H:i:s', current_time( 'timestamp' ))
                )
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                )
            ),
        );
        if(!empty($taxonomies) || !empty($taxonomies_exclude)){
            $tax_query = techrona_tax_query('product', $taxonomies, $taxonomies_exclude);
            $args['tax_query'][]= $tax_query;
        }
        if( !empty($param_args['pro_atts']) ){
            foreach ($param_args['pro_atts'] as $k => $v) {
                $args['tax_query'][] = array(
                    'taxonomy' => $k,
                    'field' => 'slug',
                    'terms' => $v
                );
            }
        }

        $args['meta_query'] = array(
            'relation'    => 'AND'
        );
        if( !empty($param_args['min_price']) && !empty($param_args['max_price'])){ 
            $args['meta_query'][] =   array(
                'key'     => '_price',
                'value'   => array( $param_args['min_price'], $param_args['max_price'] ),
                'compare' => 'BETWEEN',
                'type'    => 'DECIMAL(10,' . wc_get_price_decimals() . ')',
            );
        }
         
        $args = techrona_product_filter_type_args($type,$args);

        if (get_query_var('paged')){ 
            $kng_paged = get_query_var('paged'); 
        }elseif(get_query_var('page')){ 
            $kng_paged = get_query_var('page'); 
        }else{ 
            $kng_paged = 1; 
        }
        if($kng_paged > 1){
            $args['paged'] = $kng_paged;
        }

        $posts = $kng_query = new WP_Query($args);
         
    }
    global $wp_query;
    $wp_query = $kng_query;
    $pagination = get_the_posts_pagination(array(
        'screen_reader_text' => '',
        'mid_size' => 2,
        'prev_text' => esc_html__('Back', 'techrona'),
        'next_text' => esc_html__('Next', 'techrona'),
    ));
    global $paged;
    $paged = $kng_paged; 
 
    wp_reset_postdata();
    
    return array(
        'posts' => $posts,
        'query' => $kng_query,
        'args' => $args,
        'paged' => $paged,
        'max' => $kng_query->max_num_pages,
        'next_link' => next_posts($kng_query->max_num_pages, false),
        'total' => $kng_query->found_posts,
        'pagination' => $pagination
    );
 
}
function techrona_product_filter_type_args($type,$args){
    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            //$args['meta_query'] = array();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            //$args['meta_query'] = array();
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => $product_visibility_term_ids['featured'],
            );
            break;
        case 'top_rate':
            $args['meta_key']   ='_wc_average_rating';
            $args['orderby']    ='meta_value_num';
            $args['order']      ='DESC';
            //$args['meta_query'] = array();
            break;
        case 'recent_product':
            $args['orderby']    = 'date';
            $args['order']      = 'DESC';
            //$args['meta_query'] = array();
            break;
        case 'on_sale':
            //$args['meta_query'] = array();
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'recent_review':
            if($post_per_page == -1) $_limit = 4;
            else $_limit = $post_per_page;
            global $wpdb;
            $query = $wpdb->prepare("SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC LIMIT 0, %d", $_limit);
            $results = $wpdb->get_results($query, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                $_pids[] = $re->comment_post_ID;
            }

            //$args['meta_query'] = array();
            $args['post__in'] = $_pids;
            break;
        case 'deals':
            //$args['meta_query'] = array();
            $args['meta_query'][] = array(
                                 'key' => '_sale_price_dates_to',
                                 'value' => '0',
                                 'compare' => '>');
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'separate':
            //$args['meta_query'] = array();
            if ( ! empty( $product_ids ) ) {
                $ids = array_map( 'trim', explode( ',', $product_ids ) );
                if ( 1 === count( $ids ) ) {
                    $args['p'] = $ids[0];
                } else {
                    $args['post__in'] = $ids;
                }
            }
            break;
    }
    return $args;
}

// Sale Flash
if(!function_exists('techrona_woocommerce_sale_flash')){
	add_filter('woocommerce_sale_flash', 'techrona_woocommerce_sale_flash');
	function techrona_woocommerce_sale_flash(){
		global $post, $product;
			$classes = [];
		if(is_singular('product')) {
			$classes[] = 'single';
		} else {
			$classes[] = 'loop';
		}
		echo '<div class="kng-badge">';
		if ( $product->is_featured() ) {
			$classes = ['kng-hot'];
			echo '<span class="' . trim(implode(' ', $classes)) . '">' . esc_html__( 'Hot', 'techrona' ) . '</span>';
		}
		if ( $product->is_on_sale() ) {
			$classes = ['kng-onsale'];
			if($product->get_type() == 'variable'){
	            $regular_price = $product->get_variation_regular_price('max');
	            $sales_price = $product->get_variation_sale_price('min');  
	        }else{
	            $regular_price = $product->get_regular_price();
	            $sales_price = $product->get_sale_price();
	        }


	        if(isset($regular_price) && $regular_price > 0 && isset($sales_price)){
	            $percentage = round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 );
				echo '<span class="'.trim(implode(' ', $classes)).'">'.  '- '.$percentage . '%</span>';
			}else{
				echo '<span class="'.trim(implode(' ', $classes)).'">' . esc_html__( 'Sale', 'techrona' ) . '</span>';
			}
		}
		echo '</div>';
	}
}

// Share
if(!function_exists('techrona_woocommerce_template_single_sharing')){
	add_action('woocommerce_share', 'techrona_woocommerce_template_single_sharing');
	function techrona_woocommerce_template_single_sharing(){
		techrona_socials_share_default([
			'show_share'   => techrona_get_opts( 'product_social_share_on', '0' ),
			'icons_share'  => techrona_get_opts( 'product_social_share_icon', [] ),   
			'class'		   => 'gutters-16',	
			'title'        => '<div class="col-auto title">'.esc_html__('Share:','techrona').'</div>',
			'social_class' => 'kng-socials kng-social-layout-6 social-bg-colored',
			'icon_facebook'     => 'fa fa-facebook-square',
            'icon_twitter'      => 'fa fa-twitter',
            'icon_linkedin'     => 'fab fa-linkedin',
            'icon_instagram'    => 'fa fa-instagram',
            'icon_pinterest'    => 'fa fa-pinterest-square'
		]);
	}
}

add_filter( 'get_product_search_form', 'techrona_product_search_form', 10, 1 );
function techrona_product_search_form($form){
	ob_start();
	?>
	<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'techrona' ); ?></label>
		<input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search&hellip;', 'techrona' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'techrona' ); ?>"><?php echo esc_html_x( 'Search', 'submit button', 'techrona' ); ?></button>
		<input type="hidden" name="post_type" value="product" />
	</form>
	<?php 
	$form = ob_get_clean();
	return $form;
}