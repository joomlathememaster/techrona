<?php
if(!function_exists('techrona_html')){
    function techrona_html($html){
        return $html;
    }
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
add_filter( 'body_class', 'techrona_body_classes' );
function techrona_body_classes( $classes )
{   
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }
    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
    }

    if (techrona_get_opts( 'site_boxed', false )) {
        $classes[] = 'kng-site-boxed';
    }

    if ( class_exists('WPBakeryVisualComposerAbstract') ) {
        $classes[] = 'kng-visual-composer';
    }

    if (class_exists('ReduxFramework')) {
        $classes[] = 'redux-page';
    }
 
     
    if(techrona_get_opts('footer_fixed', '0') == '1'){
        $classes[] = 'kng-page-footer-fixed';
    }
    $classes[] = 'kng-body-font-'.techrona_get_opts('body_typo','default');
    $classes[] = 'kng-heading-font-'.techrona_get_opts('heading_font_typo','default');
    $classes[] = 'kng-subheading-font-'.techrona_get_opts('sub_heading_default_font','default');

    if(get_option( 'woosw_page_id',0) == get_the_ID())
        $classes[] = 'kng-wishlist-page';
    return $classes;
}
 
/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function techrona_posts_classes( $classes )
{
    if(has_post_thumbnail() || techrona_configs('default_post_thumbnail'))
        $classes[] = 'kng-has-post-thumbnail';
    else 
        $classes[] = 'kng-no-post-thumbnail';

    return $classes;
}
add_filter( 'post_class', 'techrona_posts_classes' );
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function techrona_pingback_header()
{
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}
add_action( 'wp_head', 'techrona_pingback_header' );

/**
 * Helper functions for the theme
 *
 */
function techrona_get_the_excerpt( $length = 55, $more = '&hellip;', $post = null ) {
	$post = get_post( $post );

	if ( empty( $post ) || 0 >= $length ) {
		return '';
	}

	if ( post_password_required( $post ) ) {
		return esc_html__( 'Post password required.', 'techrona' );
	}

	$content = apply_filters( 'the_content', strip_shortcodes( $post->post_content ) );
	$content = str_replace( ']]>', ']]&gt;', $content );

	$excerpt_more = apply_filters( 'techrona_excerpt_more', $more );
	$excerpt      = wp_trim_words( $content, $length, $excerpt_more );

	return $excerpt;
}

/*
 * Set post views count using post meta
 */
function techrona_set_post_views( $postID ) {
	$countKey = 'post_views_count';
	$count    = get_post_meta( $postID, $countKey, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $countKey );
		add_post_meta( $postID, $countKey, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $countKey, $count );
	}
}

/*
 * Content area css class
*/
if(!function_exists('techrona_content_css_class')){
    function techrona_content_css_class($args = []){
        $args = wp_parse_args($args,[
            'content_col'  => 'archive_content_col',
            'sidebar_pos'  => 'archive_sidebar_pos',
            'class'        => ''
        ]);
        $classes = [
            'kng-content-area'
        ];
        $sidebar            = techrona_get_sidebar();
        $sidebar_position   = techrona_sidebar_position(['sidebar_pos' => $args['sidebar_pos']]);
       
        $content_grid_class = techrona_get_opts($args['content_col'], techrona_configs('blog')['archive_content_col']);
  
        if( $sidebar_position === 'bottom' ){
            $classes[] = 'col-12';
        }else if($sidebar_position === '0'){
            $classes[] = 'no-sidebar col-12';
        } else {  
            if($sidebar && ('none' !== $sidebar_position && '0' !== $sidebar_position)){
                $classes[] = 'has-sidebar col-lg-'.$content_grid_class;
                if($sidebar_position == 'left') $classes[] = 'order-lg-last';
                if($sidebar_position == 'center') $classes[] = 'offset-lg-2';
            } else { 
                $classes[] = 'col-12';
            }
        }
        $classes[] = $args['class'];
        echo trim(implode(' ', $classes));
    }
}

/**
 * Scan svg directory
 * @param $filename
 * @return $image
 */
if (!function_exists('techrona_get_svg')) {
    function techrona_get_svg($filename)
    {
        if(file_exists(get_template_directory() . '/assets/images/svg/' . $filename.'.svg'))
            echo '<img class="kng-svg" alt="'.$filename.'" src="' . esc_url(get_template_directory_uri() . '/assets/images/svg/' . $filename . '.svg') . '">';
        else return; 
    }
}

/**
 * Loop Page 
*/
function techrona_is_loop(){
    if(is_home() || is_archive() || is_author() || is_category() || is_post_type_archive() || is_tag() || is_tax() || is_search())
        return true;
    else 
        return false;
}

if (!function_exists('techrona_is_shop_loop')) {
    function techrona_is_shop_loop(){
        if(class_exists('WooCommerce') && (is_post_type_archive('product') || (function_exists('is_shop') && is_shop()) || is_product_category() || is_product_tag()))
            return true;
        else return false;
    }
}

/**
 * get all post type
 * used for register sidebar for each post type
*/
if(!function_exists('techrona_all_post_types')){
    function techrona_all_post_types(){
        $default_post_type = [
            'post' => esc_html__('Post','techrona'),
            'service' => esc_html__('Service','techrona'),
            // 'page' => esc_html__('Page','techrona'),
            // 'case' => esc_html__('Case','techrona'),
            // 'practice' => esc_html__('Practice','techrona'),
        ];
        //$custom_post_type = function_exists('kng_get_post_type_options') ? kng_get_post_type_options() : [];
        $custom_post_type = [];
        if ( class_exists( 'Woocommerce' ) ) {
            $custom_post_type['product'] = esc_html__('WooCommerce','techrona');
        }
        $all_post_type = array_unique(array_merge($default_post_type, $custom_post_type));

        return $all_post_type;
    }
}

if(!function_exists('techrona_kng_get_post_types')){
    add_filter('kng_get_post_types', 'techrona_kng_get_post_types');
    function techrona_kng_get_post_types($exclude_post_type){
        $exclude_post_type = [
            'kng-header',
            'kng-footer',
            'e-landing-page',
            'product'
        ];
        return $exclude_post_type;
    }
}
 

/**
 * Get custom post type taxonomy: TAXONOMIES
 *
 * @since 1.0.0
*/
if(!function_exists('techrona_get_custom_post_taxonomies')){
    function techrona_get_custom_post_taxonomies($post_type, $key)
    {
        $tax_names = get_object_taxonomies($post_type);
        $result    = '';
        if(is_array($tax_names))
        {
            foreach ($tax_names as $name)
                if(strpos($name , $key) !== false)
                {
                    $result = $name;
                    break;
                }
        }
        return $result;
    }
}
/**
 * Get custom post type taxonomy: CAT
 *
 * @since 1.0.0
*/
if(!function_exists('techrona_get_custom_post_cat_taxonomy')){
    function techrona_get_custom_post_cat_taxonomy()
    {
        $post = get_post();
        $tax_names = get_object_taxonomies($post);
        $result = 'category';
        if(is_array($tax_names))
        {
            foreach ($tax_names as $name)
                if(strpos($name,'cat') !== false)
                {
                    $result = $name;
                    break;
                }
        }
        return $result;
    }
}

/**
 * Get custom post type taxonomy: TAGS
 *
 * @since 1.0.0
*/
if(!function_exists('techrona_get_custom_post_tag_taxonomy')){
    function techrona_get_custom_post_tag_taxonomy()
    {
        $post = get_post();
        $tax_names = get_object_taxonomies($post);
        $result = 'post_tag';
        if(is_array($tax_names))
        {
            foreach ($tax_names as $name)
                if(strpos($name,'tag') !== false)
                {
                    $result = $name;
                    break;
                }
        }
        return $result;
    }
}

/**
 * Get post type taxonomies list
*/
function techrona_get_taxo_slug_as_css_class($args = [])
{
    $args = wp_parse_args($args, ['id' => null, 'taxo' => 'category']);
    $post = get_post( $args['id'] );
    $terms = get_terms([
        'taxonomy' => $args['taxo']
    ]);
    $classes = [];
    if ( is_object_in_taxonomy( $post->post_type, $args['taxo'] ) ) {
        foreach ( (array) get_the_terms( $post->ID, $args['taxo'] ) as $term ) {
            if ( empty( $term->slug ) ) {
                     continue;
            }
            $term_class = sanitize_html_class( $term->slug );
            if ( is_numeric( $term_class ) || ! trim( $term_class, '-' ) ) {
                $term_class = $term->term_id;
            }
            $classes[] =  sanitize_html_class($term_class);
        }
    }
    return implode(' ', $classes);
}

/**
 * Terms List
*/
function techrona_terms($args=[]){
    $args = wp_parse_args($args, [
        'id'    => null,
        'link'  => true,
        'taxo'  => 'category',
        'sep'   => ', ',
        'before' => '',
        'after'  => '' 
    ]);
    if(empty($args['id'])) $args['id'] = get_the_ID();
    $term_list = get_the_term_list( $args['id'], $args['taxo'], $args['before'], $args['sep'], $args['after']);
    $term_obj_list = get_the_terms( $args['id'], $args['taxo']);
    if ( is_wp_error( $term_list ) ) {
        return false;
    }

    if($args['link'] === true){
       $terms_string = $term_list;
    } else {
        $terms_string = $args['before'].join($args['sep'], wp_list_pluck($term_obj_list, 'name')).$args['after'];
    }

    echo apply_filters('techrona_terms', $terms_string);
}

/**
 * Get term ID by slug
 * @param $post_type
 * @param $taxo_key, example category -> get: cat , post_tag -> get: tag, portfolio-category -> get: cat
 * @param $term_slugs //string of slug,  separare by comma
 * @return array
 *
*/
function techrona_get_term_id_by_slug($post_type, $taxo_key, $term_slugs){
    if(empty($term_slugs)) return;
    $term_ids = [];
    foreach ($term_slugs as $slug) {
        $term = get_term_by('slug', $slug, techrona_get_custom_post_taxonomies( $post_type , $taxo_key));
        if(isset($term->term_id)) $term_ids[] = $term->term_id;
    }
    return $term_ids;
}

/**
 * Get taxonomy query for post query
 *
*/
function techrona_tax_query($post_type, $taxonomies, $taxonomies_exclude ){
    $tax_query = array();    
    if(!empty($taxonomies) || !empty($taxonomies_exclude)) {
        $terms              = get_object_taxonomies( $post_type );
        if(count($terms) > 1){
            $tax_query['relation'] = 'OR'; 
        }
        foreach ($terms as $term) {
            $real_terms_args = [
                'taxonomy' => techrona_get_custom_post_taxonomies( $post_type , $term), 
                'exclude'  => techrona_get_term_id_by_slug($post_type, $term, $taxonomies_exclude)
            ];
            if(!empty($taxonomies))  $real_terms_args['slug'] = $taxonomies;
            $_real_terms = get_terms($real_terms_args);
            $real_terms = [];
            foreach ($_real_terms as $_real_term) {
                $real_terms[] = $_real_term->slug;
            }             
            if(!empty($real_terms) && strpos($term, 'cat') !== false ){
                $tax_query[] = array(
                    'taxonomy' => $term,
                    'field'    => 'slug',
                    'terms'    => $real_terms,
                    'relation' => 'IN',
                );
            }
        }
    }
    return $tax_query;
}


/**
 * Nice css class from string 
*/
if(!function_exists('techrona_nice_class')){
    function techrona_nice_class( $class, $fallback = '' ) {
        // Strip out any %-encoded octets.
        $sanitized = preg_replace( '|%[a-fA-F0-9][a-fA-F0-9]|', ' ', $class );
     
        // Limit to A-Z, a-z, 0-9, '_', '-'.
        $sanitized = preg_replace( '/[^A-Za-z0-9_-]/', ' ', $sanitized );
     
        if ( '' === $sanitized && $fallback ) {
            return sanitize_html_class( $fallback );
        }
        /**
         * Filters a sanitized HTML class string.
         *
         * @since 1.0
         *
         * @param string $sanitized The sanitized HTML class.
         * @param string $class     HTML class before sanitization.
         * @param string $fallback  The fallback string.
         */
        return apply_filters( 'techrona_nice_class', $sanitized, $class, $fallback );
    }
}

function techrona_get_content_image( $args = []){
    $args = wp_parse_args($args, [
        'content' => '',
        'class'   => 'content-image',
        'echo'    => true
    ]);
    $src = $title = $alt = $srcset = $sizes = '';
    if ( empty($args['content']) )
        $args['content'] = get_the_content();
    // src
    if( preg_match( '/<img\s[^>]*?src=([\'"])(.+?)\1/is', $args['content'], $_src )) {
        $src = isset($_src[2]) ? $_src[2] : '';
    }
    // srcset
    if( preg_match( '/<img\s[^>]*?srcset=([\'"])(.+?)\1/is', $args['content'], $_srcset )) { 
        $srcset = isset($_srcset[2]) ? $_srcset[2] : ''; 
    } else {
        $img_id = techrona_get_attachment_id_from_url($src);
        $srcset = wp_get_attachment_image_srcset($img_id, 'large');
    }
    // sizes
    if( preg_match( '/<img\s[^>]*?sizes=([\'"])(.+?)\1/is', $args['content'], $_sizes )) { 
        $sizes = isset($_sizes[2]) ? $_sizes[2] : get_the_title(); 
    } else {
        $img_id = techrona_get_attachment_id_from_url($src);
        $sizes = wp_get_attachment_image_sizes($img_id);
    }
    // title  
    if(preg_match( '/<img\s[^>]*?title=([\'"])(.+?)\1/is', $args['content'], $_title )) {
        $title = isset($_title[2]) ? $_title[2] : '';
    }
    // alt  
    if(preg_match( '/<img\s[^>]*?alt=([\'"])(.+?)\1/is', $args['content'], $_alt )) {
        $alt = isset($_alt[2]) ? $_alt[2] : '';
    }
    if(!empty($src)){
        if($args['echo'])
            echo '<img src="'.esc_url_raw($src).'" srcset="'.$srcset.'" sizes="'.esc_attr($sizes).'" title="'.esc_attr($title).'" alt="'.esc_attr($alt).'" class="'.esc_attr($args['class']).'" />';
        else 
            return '<img src="'.esc_url_raw($src).'" srcset="'.esc_attr($srcset).'" sizes="'.esc_attr($sizes).'" title="'.esc_attr($title).'" alt="'.esc_attr($alt).'" class="'.esc_attr($args['class']).'" />';
    }
    return false;
}

/**
 * Get the Attachment ID for a given image URL.
 *
 * @link   http://wordpress.stackexchange.com/a/7094
 *
 * @param  string $url
 *
 * @return boolean|integer
 */
if ( ! function_exists( 'techrona_get_attachment_id_from_url' ) ) {
    
    function techrona_get_attachment_id_from_url( $url ) {

        $dir = wp_upload_dir();

        // baseurl never has a trailing slash
        if ( false === strpos( $url, $dir['baseurl'] . '/' ) ) {
            // URL points to a place outside of upload directory
            return false;
        }

        $file  = basename( $url );
        $query = array(
            'post_type'  => 'attachment',
            'fields'     => 'ids',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => '_wp_attached_file',
                    'value'   => $file,
                    'compare' => 'LIKE',
                ),
            )
        );

        // query attachments
        $ids = get_posts( $query );
        if ( ! empty( $ids ) ) {
            foreach ( $ids as $id ) {

                // first entry of returned array is the URL
                $attachment_url = wp_get_attachment_image_src( $id, 'full' );
                if ( $url === $attachment_url[0] )
                    return $id;
            }
        }

        $query['meta_query'][0]['key'] = '_wp_attachment_metadata';

        // query attachments again
        $ids = get_posts( $query );

        if ( empty( $ids) )
            return false;

        foreach ( $ids as $id ) {

            $meta = wp_get_attachment_metadata( $id );

            foreach ( $meta['sizes'] as $size => $values ) {
                $attachment_url = wp_get_attachment_image_src( $id, $size );
                if ( $values['file'] === $file && $url === $attachment_url[0] )
                    return $id;
            }
        }

        return false;
    }
    
}
function techrona_hex_rgb($color) {
 
    $default = '0,0,0';
 
    //Return default if no color provided
    if(empty($color))
        return $default; 
 
    //Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    $output = implode(",",$rgb);

    //Return rgb(a) color string
    return $output;
}
function techrona_hex2rgba($color, $opacity = false) {
 
    $default = 'rgb(0,0,0)';
 
    //Return default if no color provided
    if(empty($color))
          return $default; 
 
    //Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}

function techrona_animate() {
    $kng_animate = array(
        '' => 'None',
        'wow bounce' => 'bounce',
        'wow flash' => 'flash',
        'wow pulse' => 'pulse',
        'wow rubberBand' => 'rubberBand',
        'wow shake' => 'shake',
        'wow swing' => 'swing',
        'wow tada' => 'tada',
        'wow wobble' => 'wobble',
        'wow bounceIn' => 'bounceIn',
        'wow bounceInDown' => 'bounceInDown',
        'wow bounceInLeft' => 'bounceInLeft',
        'wow bounceInRight' => 'bounceInRight',
        'wow bounceInUp' => 'bounceInUp',
        'wow bounceOut' => 'bounceOut',
        'wow bounceOutDown' => 'bounceOutDown',
        'wow bounceOutLeft' => 'bounceOutLeft',
        'wow bounceOutRight' => 'bounceOutRight',
        'wow bounceOutUp' => 'bounceOutUp',
        'wow fadeIn' => 'fadeIn',
        'wow fadeInDown' => 'fadeInDown',
        'wow fadeInDownBig' => 'fadeInDownBig',
        'wow fadeInLeft' => 'fadeInLeft',
        'wow fadeInLeftBig' => 'fadeInLeftBig',
        'wow fadeInRight' => 'fadeInRight',
        'wow fadeInRightBig' => 'fadeInRightBig',
        'wow fadeInUp' => 'fadeInUp',
        'wow fadeInUpBig' => 'fadeInUpBig',
        'wow fadeOut' => 'fadeOut',
        'wow fadeOutDown' => 'fadeOutDown',
        'wow fadeOutDownBig' => 'fadeOutDownBig',
        'wow fadeOutLeft' => 'fadeOutLeft',
        'wow fadeOutLeftBig' => 'fadeOutLeftBig',
        'wow fadeOutRight' => 'fadeOutRight',
        'wow fadeOutRightBig' => 'fadeOutRightBig',
        'wow fadeOutUp' => 'fadeOutUp',
        'wow fadeOutUpBig' => 'fadeOutUpBig',
        'wow flip' => 'flip',
        'wow flipInX' => 'flipInX',
        'wow flipInY' => 'flipInY',
        'wow flipOutX' => 'flipOutX',
        'wow flipOutY' => 'flipOutY',
        'wow lightSpeedIn' => 'lightSpeedIn',
        'wow lightSpeedOut' => 'lightSpeedOut',
        'wow rotateIn' => 'rotateIn',
        'wow rotateInDownLeft' => 'rotateInDownLeft',
        'wow rotateInDownRight' => 'rotateInDownRight',
        'wow rotateInUpLeft' => 'rotateInUpLeft',
        'wow rotateInUpRight' => 'rotateInUpRight',
        'wow rotateOut' => 'rotateOut',
        'wow rotateOutDownLeft' => 'rotateOutDownLeft',
        'wow rotateOutDownRight' => 'rotateOutDownRight',
        'wow rotateOutUpLeft' => 'rotateOutUpLeft',
        'wow rotateOutUpRight' => 'rotateOutUpRight',
        'wow hinge' => 'hinge',
        'wow rollIn' => 'rollIn',
        'wow rollOut' => 'rollOut',
        'wow zoomIn' => 'zoomIn',
        'wow zoomInDown' => 'zoomInDown',
        'wow zoomInLeft' => 'zoomInLeft',
        'wow zoomInRight' => 'zoomInRight',
        'wow zoomInUp' => 'zoomInUp',
        'wow zoomOut' => 'zoomOut',
        'wow zoomOutDown' => 'zoomOutDown',
        'wow zoomOutLeft' => 'zoomOutLeft',
        'wow zoomOutRight' => 'zoomOutRight',
        'wow zoomOutUp' => 'zoomOutUp',
    );
    return $kng_animate;
}

function techrona_animate_case() {
    $kng_animate = array(
        '' => 'None',
        'case-fade-in-up' => 'Case Fade In Up',
        'bounce' => 'bounce',
        'flash' => 'flash',
        'pulse' => 'pulse',
        'rubberBand' => 'rubberBand',
        'shake' => 'shake',
        'swing' => 'swing',
        'tada' => 'tada',
        'wobble' => 'wobble',
        'bounceIn' => 'bounceIn',
        'bounceInDown' => 'bounceInDown',
        'bounceInLeft' => 'bounceInLeft',
        'bounceInRight' => 'bounceInRight',
        'bounceInUp' => 'bounceInUp',
        'bounceOut' => 'bounceOut',
        'bounceOutDown' => 'bounceOutDown',
        'bounceOutLeft' => 'bounceOutLeft',
        'bounceOutRight' => 'bounceOutRight',
        'bounceOutUp' => 'bounceOutUp',
        'fadeIn' => 'fadeIn',
        'fadeInDown' => 'fadeInDown',
        'fadeInDownBig' => 'fadeInDownBig',
        'fadeInLeft' => 'fadeInLeft',
        'fadeInLeftBig' => 'fadeInLeftBig',
        'fadeInRight' => 'fadeInRight',
        'fadeInRightBig' => 'fadeInRightBig',
        'fadeInUp' => 'fadeInUp',
        'fadeInUpBig' => 'fadeInUpBig',
        'fadeOut' => 'fadeOut',
        'fadeOutDown' => 'fadeOutDown',
        'fadeOutDownBig' => 'fadeOutDownBig',
        'fadeOutLeft' => 'fadeOutLeft',
        'fadeOutLeftBig' => 'fadeOutLeftBig',
        'fadeOutRight' => 'fadeOutRight',
        'fadeOutRightBig' => 'fadeOutRightBig',
        'fadeOutUp' => 'fadeOutUp',
        'fadeOutUpBig' => 'fadeOutUpBig',
        'flip' => 'flip',
        'flipInX' => 'flipInX',
        'flipInY' => 'flipInY',
        'flipOutX' => 'flipOutX',
        'flipOutY' => 'flipOutY',
        'lightSpeedIn' => 'lightSpeedIn',
        'lightSpeedOut' => 'lightSpeedOut',
        'rotateIn' => 'rotateIn',
        'rotateInDownLeft' => 'rotateInDownLeft',
        'rotateInDownRight' => 'rotateInDownRight',
        'rotateInUpLeft' => 'rotateInUpLeft',
        'rotateInUpRight' => 'rotateInUpRight',
        'rotateOut' => 'rotateOut',
        'rotateOutDownLeft' => 'rotateOutDownLeft',
        'rotateOutDownRight' => 'rotateOutDownRight',
        'rotateOutUpLeft' => 'rotateOutUpLeft',
        'rotateOutUpRight' => 'rotateOutUpRight',
        'hinge' => 'hinge',
        'rollIn' => 'rollIn',
        'rollOut' => 'rollOut',
        'zoomIn' => 'zoomIn',
        'zoomInDown' => 'zoomInDown',
        'zoomInLeft' => 'zoomInLeft',
        'zoomInRight' => 'zoomInRight',
        'zoomInUp' => 'zoomInUp',
        'zoomOut' => 'zoomOut',
        'zoomOutDown' => 'zoomOutDown',
        'zoomOutLeft' => 'zoomOutLeft',
        'zoomOutRight' => 'zoomOutRight',
        'zoomOutUp' => 'zoomOutUp',
    );
    return $kng_animate;
}