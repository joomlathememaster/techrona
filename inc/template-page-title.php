<?php
/**
 * Page title layout
 **/
if(!function_exists('techrona_page_title_layout')){
    function techrona_page_title_layout($args = []) {
        if( is_singular('kng-footer') || is_singular('kng-mega-menu') || is_404()) return;

		$show_pagetitle  = techrona_get_opts( 'pagetitle', '1' );
        $show_title      = techrona_get_opts( 'ptitle_title_on', '1');
        $show_breadcrumb = techrona_get_opts( 'ptitle_breadcrumb_on', '1' );
        $show_scroll     = techrona_get_opts( 'ptitle_scroll_on', '0' );
 
        $pt_cls = '-default';

        if($show_pagetitle !== '1' || ($show_title !== '1' && $show_breadcrumb !== '1') ) return;
 
        $ptitle_layout = techrona_get_opts( 'ptitle_layout', techrona_configs('ptitle')['layout'] );
          
    	$args = wp_parse_args($args, [
    		'class' => ''
    	]);

        $title_align = techrona_get_opts( 'ptitle_title_align', '' );
        $title_wrap = ['text-'.$title_align];
        $title_class = 'heading';

        //  Breadcrumb
        $breadcrumb_align = techrona_get_opts( 'ptitle_breadcrumb_align', '' );
        $breadcrumb_class = ['kng-pagetitle-breadcrumb','justify-content-'.$breadcrumb_align]; ;
     	?>
    	<div id="kng-pagetitle" class="kng-pagetitle kng-pagetitle<?php echo esc_attr($pt_cls); ?> kng-page-title-layout<?php echo esc_attr($ptitle_layout); ?> relative">
        	<div class="kng-page-title-overlay"></div>
        	<div class="container relative">
        		<div class="kng-page-title-inner">
        			<?php
                        switch ($ptitle_layout) {
                            case '1':
                                    techrona_page_title([
                                        'class'      => implode(',', $title_wrap),
                                        'title_class' => $title_class,
                                        'sub_class'   => 'text-18'
                                    ]);
                                    techrona_breadcrumb( ['class'   => implode(' ', $breadcrumb_class)] );
                                break;
                            case '2':
                                    techrona_breadcrumb( ['class'   => implode(' ', $breadcrumb_class)] );
                                    techrona_page_title([
                                        'class'      => implode(',', $title_wrap),
                                        'title_class' => $title_class,
                                        'sub_class'   => 'text-18'
                                    ]);
                                break;
                            case '3':
                                printf('%s', '<div class="row justify-content-between align-items-center">');
                                    techrona_page_title([
                                        'before'      => '<div class="col-lg-6">',
                                        'after'       => '</div>',
                                        'class'       =>  implode(' ', $title_wrap),
                                        'title_class' =>  $title_class,
                                        'sub_class'   => 'text-18'
                                    ]);
                                    techrona_breadcrumb([
                                        'before'  => '<div class="col-lg-6 text-lg-end">',
                                        'after'   => '</div>',
                                        'class'   => implode(' ', $breadcrumb_class)
                                    ]);
                                printf('%s', '</div>');
                                break;
                            case '4':
                                printf('%s', '<div class="row justify-content-between align-items-center">');
                                    techrona_breadcrumb([
                                        'before'  => '<div class="col-lg-6">',
                                        'after'   => '</div>',
                                        'class'   => implode(' ', $breadcrumb_class)
                                    ]);
                                    techrona_page_title([
                                        'before'      => '<div class="col-lg-6 text-lg-end">',
                                        'after'       => '</div>',
                                        'class'       =>  implode(' ', $title_wrap),
                                        'title_class' => $title_class,
                                        'sub_class'   => 'text-18'
                                    ]);
                                printf('%s', '</div>');
                                break;
                        }
                    ?>
        		</div>
        	</div>
            <?php if($show_scroll): ?>
                <a href="#kng-main" class="kng-scroll kng-ripple kng-ripple-accent kng-vibrate"><span class="kngi-long-arrow-down"></span></a>
            <?php endif; ?>
        </div>
        <?php
    }
}

/**
 * Page Title 
*/
if(!function_exists('techrona_page_title')){
	function techrona_page_title($args = []){
       
		$show_title = techrona_get_opts('ptitle_title_on', '1');
  
		if($show_title !== '1') return;

		$args = wp_parse_args($args, [
            'class'      => '',
            'title_class' => 'kng-heading',
            'sub_class'  => '',
            'before'     => '',
            'after'      => ''
		]);
         
		$titles        = techrona_get_page_titles();

		printf('%s', $args['before']);
            printf('<div class="kng-page-title %1$s">', $args['class']);
    			if (!empty($titles['title'])){
    			    printf( '<h1 class="main-title %1$s">%2$s</h1>',$args['title_class'], $titles['title'] );
    			}
    	        if(!empty($titles['sub_title'])) { 
    	        	printf( '<div class="kng-page-sub-title %1$s">%2$s</div>',$args['sub_class'], $titles['sub_title']);
    	        }
            printf('%s','</div>');
        printf('%s', $args['after']);
	}
}

/**
 * Prints HTML for breadcrumbs.
 */
if(!function_exists('techrona_breadcrumb')){
    function techrona_breadcrumb($args = []){
         
        $args = wp_parse_args($args, [
            'show_breadcrumb' => techrona_get_opts( 'ptitle_breadcrumb_on', '1' )
        ]);

        if ( ! class_exists( 'KNG_Breadcrumb' ) || $args['show_breadcrumb'] !== '1' )
        {
            return;
        }

        $breadcrumb = new KNG_Breadcrumb();
        $entries = $breadcrumb->get_entries();
        if ( empty( $entries ) )
        {
            return;
        }
        $args = wp_parse_args($args, [
            'before'       => '',
            'after'        => '',
            'show_divider' => true,
            'divider_icon' => 'kngi-angle-right',
            'divider_class' => '',
            'class'        => '',
            'link_class'   => '',
            'text_class'   => ''
        ]);
        $divider = '';
        if($args['show_divider']){
            $divider = '<span class="'.implode(' ', ['br-divider', $args['divider_class'], $args['divider_icon'], 'rtl-flip']).'"></span>';
        }
        ob_start();
        foreach ( $entries as $entry )
        {
            $entry = wp_parse_args( $entry, array(
                'label' => '',
                'url'   => ''
            ) );

            if ( empty( $entry['label'] ) )
            {
                continue;
            }

            echo '<div class="br-item">';

            if ( ! empty( $entry['url'] ) )
            {
                printf(
                    '<a class="br-link '.$args['link_class'].'" href="%1$s">%2$s</a>%3$s',
                    esc_url( $entry['url'] ),
                    esc_attr( $entry['label'] ),
                    $divider
                );
            }
            else
            {
                printf( '<span class="br-text '.$args['text_class'].'" >%s</span>%2$s', $entry['label'], $divider );
            }

            echo '</div>';
        }

        $output = ob_get_clean();

        if ( $output )
        {
        	printf('%s', $args['before']);
            printf( '<div class="kng-breadcrumb %s">%s</div>', $args['class'], $output);
            printf('%s', $args['after']);
        }
    }
}
if(!function_exists('techrona_get_page_titles')){
    function techrona_get_page_titles() {
        $title = '';
        $single_post_title_layout = techrona_get_theme_opt('single_post_title_layout','0');
        $post_custom_title  = techrona_get_theme_opt('post_custom_title',esc_html__('Blog details', 'techrona'));
        $disable_product_title = techrona_get_theme_opt('disable_product_title','1');
        // Default titles
        if ( ! is_archive() ) { 
            // Posts page view
            if ( is_home() ) {
                // Only available if posts page is set.
                if ( ! is_front_page() && $page_for_posts = get_option( 'page_for_posts' ) ) {
                    $title = get_post_meta( $page_for_posts, 'custom_title', true );
                    if ( empty( $title ) ) {
                        $title = get_the_title( $page_for_posts );
                    }
                }
                if ( is_front_page() ) {
                    $title = esc_html__( 'Blog', 'techrona' );
                }
            } elseif ( is_404() ) {
                $title = esc_html__( '404', 'techrona' );
            } elseif ( is_search() ) {
                $title = esc_html__( 'Search results', 'techrona' );
            } elseif ( is_singular('product') && $disable_product_title == '0' ) {
                $title = esc_html__( 'Product Details', 'techrona' );
            } else {
                $title = get_post_meta( get_the_ID(), 'custom_title', true );
                if( is_singular('post') && $single_post_title_layout == '1'){
                    $title = $post_custom_title; 
                } elseif ( ! $title ) {
                    $title = get_the_title();
                } else {
                    $title = $title; //get_the_title();
                }
            }
            $sub_title = get_post_meta( get_the_ID(), 'custom_sub_title', true );
        } elseif ( is_author() ) {  
            //esc_html__( 'Author:', 'techrona' ) . ' ' .
            $title     = get_the_author();
            $sub_title = techrona_get_opts('custom_sub_title');
        } else {    
            $custom_title = techrona_get_opts('custom_title');
            $_title = get_the_archive_title();
            if( class_exists( 'WooCommerce' ) && is_shop() ) {
                $_title = esc_html__( 'Our Shop ', 'techrona' );
            }
            $title = !empty($custom_title) ? $custom_title : $_title;
            $sub_title = techrona_get_opts('custom_sub_title');
        }
        
        return array(
            'title'     => $title,
            'sub_title' => $sub_title
        );
    }
}
 

/**
 * Filter breadcrumb entries for single custom post type
 * 
 * @param  array   $entries Each entry should be an array with 'label' and 'url' keys.
 * @param  WP_Post $post    Current post object
 * @return array
 */
function techrona_breadcrumb_single_filter( $entries, $post )
{
    if ( 'cpt' == $post->post_type )
    {
        $new_entries = array();
        $term        = current( wp_get_post_terms( $post->ID, 'ctax2' ) );
        $taxonomy    = get_taxonomy( $term->taxonomy );

        $new_entries[] = array(
            'label' => $term->name,
            'url'   => get_term_link( $term )
        );

        $pterm_id = $term->parent;

        while ( $pterm_id )
        {
            $pterm = get_term( $pterm_id );

            $new_entries[] = array(
                'label' => $pterm->name,
                'url'   => get_term_link( $pterm )
            );
            $pterm_id = $pterm->parent;
        }

        $new_entries[] = array(
            'label' => $taxonomy->labels->name
        );

        return array_reverse( $new_entries );
    }

    return $entries;
}
add_filter( 'techrona_breadcrumb_single', 'techrona_breadcrumb_single_filter', 10, 2 );