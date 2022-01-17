<?php
/**
 * Custom template tags for this theme.
 *
 */

/**
 * Page loading
 **/
if(!function_exists('techrona_page_loading')){
    function techrona_page_loading()
    {
        $page_loading = techrona_get_theme_opt( 'show_page_loading', '0' );
        $loading_img = techrona_get_theme_opt( 'loading_img', array( 'url' => get_template_directory_uri().'/assets/images/loader.png', 'id' => '' ) );
        if($page_loading == '1') { ?>
            <div id="kng-loadding" class="kng-loader style-1">
                <div class="loading-spinner">
                    <img src="<?php echo esc_url($loading_img['url'])?>" alt="<?php esc_attr_e('Loading','techrona');?>">
                </div>
            </div>
        <?php } 
        if($page_loading == '2') { ?>
            <div id="kng-loadding" class="kng-loader style-2">
                <div class="loading-spinner">
                    <div class="loading-dot1"></div>
                    <div class="loading-dot2"></div>
                </div>
            </div>
        <?php } 
    }
}


// Post title
if ( ! function_exists( 'techrona_post_title' ) ) :
    /**
     * Print post title
     *
     * @param  integer $length
     */
    function techrona_post_title($args = []){
        $single_post_title_layout = techrona_get_theme_opt('single_post_title_layout','0');
        if( is_singular('post') && $single_post_title_layout == '0') return;
        $args = wp_parse_args($args, [
            'tag'         => 'h3',
            'sticky_icon' => '<span class="kngi-thumbtack"></span>',
            'show_link'   => true,
            'class'       => ''
        ]);
        ?>
        <<?php echo esc_attr($args['tag']); ?> class="<?php echo trim(implode(' ', ['kng-post-title', $args['class']]));?>"><?php 
            if($args['show_link'] && !is_single() ) { ?>
                <a href="<?php echo esc_url( get_permalink()); ?>"><?php 
            }
                if(is_sticky()) { echo wp_kses_post($args['sticky_icon']); }
                the_title();
            if($args['show_link']) { ?>
                </a><?php 
            } ?></<?php echo esc_attr($args['tag']); ?>>
    <?php
    }
endif;

if ( ! function_exists( 'techrona_post_excerpt' ) ) :
    /**
     * Print post excerpt based on length.
     *
     * @param  integer $length
     */
    function techrona_post_excerpt($args = []) {
        $args = wp_parse_args($args, [
            'class'  => '',
            'length' => techrona_get_theme_opt('archive_excerpt_length', '55'),
            'more'   => ''
        ]);
    ?>
    <div class="<?php echo trim(implode(' ', ['kng-post-excerpt', $args['class']])) ?>">
        <?php 
            $kng_the_excerpt = get_the_excerpt();
            if(!empty(get_the_excerpt())) {
                echo wp_trim_words( $kng_the_excerpt, $args['length'], $args['more'] );
            } else {
                echo techrona_get_the_excerpt( $args['length'], $args['more']);
            }
        ?>
    </div>
    <?php
    }
endif;
/**
 * Prints post edit link when applicable
 */
if(!function_exists('techrona_post_edit_link')){
    function techrona_post_edit_link()
    {
        edit_post_link(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    esc_html__( 'Edit', 'techrona' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<div class="kng-post-edit-link"><span class="kngi-edit"></span>',
            '</div>'
        );
    }
}

// Post link pages
if(!function_exists('techrona_post_link_pages')){
    add_filter('wp_link_pages_args', 'techrona_wp_link_pages_args');
    function techrona_wp_link_pages_args($args){
        $args['before']      = '';
        $args['after']       = '';
        $args['link_before'] = '<span>';
        $args['link_after']  = '</span>';
        return $args;   
    }
    function techrona_post_link_pages($args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
    ?>
    <div class="<?php echo trim(implode(' ', ['navigation kng-page-links clearfix empty-none', $args['class']])); ?>"><?php 
        wp_link_pages(); 
    ?></div>
    <?php
    }
}

/**
 * Prints posts pagination based on query
 *
 * @param  WP_Query $query     Custom query, if left blank, this will use global query ( current query )
 * @return void
 */
function techrona_posts_pagination( $query = null, $ajax = false, $args = [] )
{
    $args = wp_parse_args($args, [
        'class' => ''
    ]);
    if($ajax){
        add_filter('paginate_links', 'techrona_ajax_paginate_links');
    }

    $classes = array();

    if ( empty( $query ) )
    {
        $query = $GLOBALS['wp_query'];
    }

    if ( empty( $query->max_num_pages ) || ! is_numeric( $query->max_num_pages ) || $query->max_num_pages < 2 )
    {
        return;
    }

    $paged = $query->get( 'paged', '' );

    if ( ! $paged && is_front_page() && ! is_home() )
    {
        $paged = $query->get( 'page', '' );
    }

    $paged = $paged ? intval( $paged ) : 1;

    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) )
    {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $paginate_links_args = array(
        'base'     => $pagenum_link,
        'total'    => $query->max_num_pages,
        'current'  => $paged,
        'mid_size' => 1,
        'add_args' => array_map( 'urlencode', $query_args ),
        'prev_text' => techrona_pagination_prev_text(),
        'next_text' => techrona_pagination_next_text(),
    );
    if($ajax){
        $paginate_links_args['format'] = '?page=%#%';
    }
    $links = paginate_links( $paginate_links_args );
    if ( $links ):
    ?>
    <nav class="navigation posts-pagination <?php echo esc_attr($ajax?'ajax':''); ?> <?php echo esc_attr($args['class']) ?>">
        <?php
            printf('%s',$links);
        ?>
    </nav>
    <?php
    endif;
}
if(!function_exists('techrona_pagination_prev_text')){
    function techrona_pagination_prev_text(){
        return '<span class="kngi-angle-left"></span>';
    }
}
if(!function_exists('techrona_pagination_next_text')){
    function techrona_pagination_next_text(){
        return '<span class="kngi-angle-right"></span>';
    }
}

/**
 * List socials share for post.
 * <a class="pin-social pinterest hover-effect" title="Pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(the_permalink()); ?>&media=<?php echo esc_attr($pinterestimage[0]); ?>&description=<?php the_title(); ?>"><i class="kngi-pinterest"></i></a>
                <a class="it-social instagram hover-effect" title="Instagram" target="_blank" href="https://instagram.com/<?php echo techrona_get_theme_opt('instagram_user');?>"><i class="kngi-instagram"></i></a>
 */
if(!function_exists('techrona_socials_share_default')){
    function techrona_socials_share_default($args = []) {
        $args = wp_parse_args($args, [
            'echo'              => true, 
            'show_share'        => '0', 
            'icons_share'       => [],
            'class'             => '',
            'title'             => '<div class="kng-post-share-title kng-heading col">'.esc_html__('Share:','techrona').'</div>',
            'social_class'      => '',
            'social_item_class' => '',
            'before'            => '',
            'after'             => '',
            'icon_facebook'     => 'icon-facebook',
            'icon_twitter'      => 'icon-twitter',
            'icon_linkedin'     => 'icon-linkedin',
            'icon_instagram'    => 'icon-instagram',
            'icon_pinterest'    => 'icon-pinterest'
        ]);
         
        if($args['show_share'] != '1') return;
        $pinterestimage = get_the_post_thumbnail_url( get_the_ID(), 'full' );
        ob_start();
            printf('%s', $args['before']);
        ?>
            <div class="<?php echo trim(implode(' ',['kng-post-share row align-items-center',  $args['class']]));?>">
                <?php if(!empty($args['title'])) printf('%s', $args['title']); ?>
                <div class="<?php echo trim(implode(' ',['col kng-social',  $args['social_class']]));?>">
                    <div class="row gutters-16">
                        <?php if(in_array('facebook', $args['icons_share'])): ?>
                        <div class="kng-social-item col-auto">
                            <a class="<?php echo esc_attr($args['social_item_class'].' '.$args['icon_facebook']);?>" title="<?php echo esc_attr__('Facebook', 'techrona'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"></a>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('instagram', $args['icons_share'])): ?>
                            <div class="kng-social-item col-auto">
                                <a class="<?php echo esc_attr($args['social_item_class'].' '.$args['icon_instagram']);?>" title="<?php echo esc_attr__('Instagram', 'techrona'); ?>" target="_blank" href="https://instagram.com/<?php echo techrona_get_theme_opt('instagram_user');?>"></a>
                            </div>
                        <?php endif; ?> 
                        <?php if(in_array('twitter', $args['icons_share'])): ?>
                        <div class="kng-social-item col-auto">
                            <a class="<?php echo esc_attr($args['social_item_class'].' '.$args['icon_twitter']);?>" title="<?php echo esc_attr__('Twitter', 'techrona'); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urldecode(home_url('/')); ?>&url=<?php echo urlencode(get_permalink()); ?>&text=<?php the_title();?>&via=<?php echo techrona_get_theme_opt('twitter_user', 'joomskys');?>"></a>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('linkedin', $args['icons_share'])): ?>
                        <div class="kng-social-item col-auto">
                            <a class="<?php echo esc_attr($args['social_item_class'].' '.$args['icon_linkedin']);?>" title="<?php echo esc_attr__('Linkedin', 'techrona'); ?>" target="_blank" href="https://www.linkedin.com/cws/share?url=<?php echo urlencode(get_permalink());?>"></a>
                        </div>
                        <?php endif; ?> 
                        <?php if(in_array('pinterest', $args['icons_share'])): ?>
                            <div class="kng-social-item col-auto">
                                <a class="<?php echo esc_attr($args['social_item_class'].' '.$args['icon_pinterest']);?>" title="<?php echo esc_attr__('Pinterest', 'techrona'); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo esc_attr($pinterestimage); ?>&description=<?php the_title(); ?>"></a>
                            </div>
                        <?php endif; ?>                          
                    </div>
                </div>
            </div>
            <?php
            printf('%s', $args['after']);

        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}

/**
 * Post Author Info
****/
if(!function_exists('techrona_post_author_info')){
    function techrona_post_author_info($args = []){
        $args = wp_parse_args($args,[
            'class'       => '',
            'title_class' => '',
            'show_author' => '0',
            'before'      => '',
            'after'       => ''  
        ]);
       
        if($args['show_author'] != '1' || get_the_author_meta( 'description' ) == '' ) return;
        printf('%s', $args['before']);
    ?>
        <div class="<?php echo trim(implode(' ', ['entry-author-info', $args['class']]));?>">
            <div class="kng-post-author row text-center text-md-start">
                <div class="kng-post-author-avatar col-12 col-md-auto mb-20 mb-md-0">
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), '160', '', esc_html__('techrona', 'techrona'), [
                            'width' => '160',
                            'height' => '160',
                            'class'  => 'kng-round'
                        ] ); ?>
                    </div>
                <div class="kng-post-author-description col"><?php 
                    echo '<div class="kng-post-author-title '.$args['title_class'].'">'.get_the_author_meta( 'display_name' ).'</div>';
                    echo '<div class="kng-post-author-description">'.get_the_author_meta( 'description' ).'</div>';
                    techrona_get_user_social([
                        'class'             => 'kng-socials-layout-1',
                        'row_class'         => 'justify-content-center justify-content-md-start',
                        'social_item_class' => ''
                    ]); 
                ?></div>
            </div>
        </div>
    <?php 
        printf('%s', $args['after']);
    }
}
/**
 * Single  Next/Prev Link
*/
if(!function_exists('techrona_posts_nav_link')) { 
    function techrona_posts_nav_link($args = []){
        $post_nav_title_on = techrona_get_theme_opt('post_nav_title_on','0');
        $args = wp_parse_args($args, [
            'show_nav'       => '1',
            'show_thumbnail' => '1',
            'thumbnail_size' => '70',
            'show_title'     => '1',
            'prev_title'     =>  esc_html__('Previous', 'techrona'). ' ' .get_post_type(),
            'next_title'     =>  esc_html__('Next', 'techrona'). ' ' . get_post_type(),
            'prev_icon'      => 'kngi-long-arrow-alt-left',
            'next_icon'      => 'kngi-long-arrow-alt-right',
            'class'          => '',
            'img_class'      => '',
            'before'         => '',
            'after'          => ''
        ]);
        if($args['show_nav'] != '1' ) return;
        $next_post = get_next_post();
        $previous_post = get_previous_post();
        if(empty($previous_post) && empty($next_post)) return;
        printf('%s', $args['before']);
    ?>
        <div class="<?php echo trim(implode(' ', ['kng-single-next-prev-navigation row justify-content-between align-items-center', $args['class']])); ?>">
            <?php if(!empty($previous_post)) { ?>
            <div class="kng-single-next-prev kng-single-prev col relative text-start">
                <div class="kng-single-next-prev-inner kng-single-prev-inner kng-single-nav-inner">
                    <?php 
                        // overlay link
                        previous_post_link('%link',''); 
                    ?>
                    <div class="row align-items-center gutters-10 gutters-sm-20">
                        <?php if('1' === $args['show_thumbnail']):
                            techrona_post_thumbnail([
                                'post_id'             => $previous_post->ID, 
                                'size'           => $args['thumbnail_size'], 
                                'class'          => 'd-none d-sm-block', 
                                'img_atts'      => [$args['img_class']],
                                'before'         => '<div class="col-auto"><span class="kng-nav-icon kngi-angle-left d-sm-none"></span>',
                                'after'          => '</div>'
                            ]);
                        endif;
                            if('1' !== $args['show_thumbnail'] && !empty($args['prev_icon'])){
                                echo '<div class="col-auto"><span class="kng-nav-icon '.$args['prev_icon'].'"></span></div>';
                            }
                         ?>
                        <div class="col">
                            <?php  if(!empty($args['prev_title'])) printf('<div class="kng-nav-label ">%s</div>', esc_html($args['prev_title'])); ?>
                            <?php if('1' === $args['show_title']) echo '<div class="kng-nav-title">'.get_the_title($previous_post->ID).'</div>'; ?>  
                            <div class="post-nav-date d-none d-sm-block"><span class="kngi-calendar-alt-regular"></span><span><?php echo get_the_date(get_option( 'date_format' ),$previous_post->ID ); ?></span></div>
                        </div>
                    </div>
                </div>
               
            </div>
            <?php } else { 
                echo '<div class="col-6 relative text-start"></div>'; 
            }
            if(!empty($next_post)) : ?>
            <div class="kng-single-next-prev-separate col-auto d-none d-sm-block"></div>
            <div class="kng-single-next-prev kng-single-next col relative text-end">
                <div class="kng-single-next-prev-inner kng-single-next-inner kng-single-nav-inner">
                    <?php 
                        // overlay link
                        next_post_link('%link','');
                    ?>
                    <div class="row align-items-center gutters-10 gutters-sm-20">
                        <?php if('1' === $args['show_thumbnail']):
                            techrona_post_thumbnail([
                                'post_id'             => $next_post->ID,
                                'size' => $args['thumbnail_size'], 
                                'class'          => 'd-none d-sm-block', 
                                'img_atts'      => [$args['img_class']],
                                'before'         => '<div class="col-auto order-last">',
                                'after'          => '<span class="kng-nav-icon kngi-angle-right d-sm-none"></span></div>'
                            ]); 
                        endif;
                            if('1' !== $args['show_thumbnail'] && !empty($args['next_icon'])){
                                echo '<div class="col-auto order-last"><span class="kng-nav-icon '.$args['next_icon'].'"></span></div>';
                            }
                        ?>
                        <div class="col">
                            <?php if(!empty($args['prev_title'])) printf('<div class="kng-nav-label">%s</div>', esc_html($args['next_title']));?>
                            <?php if('1' === $args['show_title']) echo '<div class="kng-nav-title">'.get_the_title($next_post->ID).'</div>'; ?>
                            <div class="post-nav-date d-none d-sm-block"><span><?php echo get_the_date(get_option( 'date_format' ),$next_post->ID ); ?></span><span class="kngi-calendar-alt-regular"></span></div>    
                        </div>
                    </div>
                </div>   
            </div>
            <?php endif; ?>
        </div>
    <?php 
        printf('%s', $args['after']);
    }
}

/**
 * Related Post
 */
if(!function_exists('techrona_related_post')){
    function techrona_related_post($args = [])
    {
        $args = wp_parse_args($args, [
            'class'          => '',
            'show_related'   => techrona_get_theme_opt( 'post_related_on', '0' ),
            'title'          => esc_html__('Related Posts','techrona'),
            'posts_per_page' => '3',
            'post_type'      => 'post',
            'before'         => '',
            'after'          => ''
        ]);
 
        if($args['show_related'] != '1') return;
        
        global $post;
        $current_id = $post->ID;
        $posttags = get_the_category($post->ID);
        if (empty($posttags)) return;
        $tags = array();
        foreach ($posttags as $tag) {
            $tags[] = $tag->term_id;
        }
        $query_similar = new WP_Query(array(
            'posts_per_page' => $args['posts_per_page'], 
            'post_type'      => $args['post_type'], 
            'post__not_in'   => array( $current_id ),
            'post_status'    => 'publish', 
            'category__in'   => $tags
        ));
        
        if (count($query_similar->posts) > 1) {
            printf('%s', $args['before']);
            ?>
            <div class="<?php echo trim(implode(' ', ['kng-related-post', $args['class']]));?>">
                <?php if(!empty($args['title'])) echo '<div class="kng-heading kng-related-heading text-24 mb-25">'.esc_html($args['title']).'</div>'; ?>
                <div class="kng-related-post-inner row">
                    <?php foreach ($query_similar->posts as $post): ?>
                        <div class="grid-item col-lg-4 col-12">
                            <div class="grid-item-inner">
                                <?php 
                                    techrona_post_media([
                                        'id'        => $post->ID,
                                        'size'      => 'medium_large',
                                        'show_link' => true,
                                        'img_class' => 'kng-radius-8'
                                    ]);
                                ?>
                                <?php 
                                    techrona_post_meta([
                                        'show_date'   => '1',
                                        'show_cat'    => '1',
                                        'show_author' => '0',
                                        'show_cmt'    => '0',
                                        'show_icon'   => false,
                                        'class'       => 'kng-meta-before',
                                        'separator'   => '<span class="col-auto"><span class="kng-meta-separator"></span></span>'
                                    ]);
                                ?>
                                <h4 class="item-title mt-25">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php 
            printf('%s', $args['after']);
        }
        wp_reset_postdata();
    }
}
/**
 * Recent Post
 */
if(!function_exists('techrona_recent_post')){
    function techrona_recent_post($args = []) {
 
        global $post;
        
        $args = wp_parse_args($args, [
            'class'          => '',
            'show_recent'   => techrona_get_theme_opt( 'recent_post_on', '0' ),
            'title'          => techrona_get_theme_opt( 'recent_post_title', esc_html__('Related Posts','techrona') ),
            'posts_per_page' => '3',
            'post_type'      => 'post',
            'before'         => '',
            'after'          => ''
        ]);

        if($args['show_recent'] != '1') return;

        $current_id = $post->ID;
         
        $style = isset($_GET['rp_style']) ? sanitize_text_field($_GET['rp_style']) : techrona_get_theme_opt( 'recent_post_style', 'style-1' );
          
        $query = new WP_Query(array(
            'posts_per_page' => $args['posts_per_page'], 
            'post_type'      => $args['post_type'], 
            'post__not_in'   => array( $current_id ),
            'post_status'    => 'publish', 
        ));

        if (count($query->posts) > 1) {
            printf('%s', $args['before']);
            ?>
            <div class="<?php echo trim(implode(' ', ['kng-recent-post', $args['class']]));?>">
                <?php if(!empty($args['title'])) echo '<div class="kng-heading kng-recent-heading">'.esc_html($args['title']).'</div>'; ?>
                <div class="kng-recent-post-inner row">
                    <?php foreach ($query->posts as $post):
                         
                        $my_post = get_post( $post->ID );
                        $user_id = $my_post->post_author;
                        $author_url = get_author_posts_url($user_id);
                            ?>
                        <div class="grid-item col-md-4 col-12">
                            <div class="grid-item-inner">
                                <?php 
                                    techrona_post_media([
                                        'id'        => $post->ID,
                                        'size'      => 'medium_large',
                                        'show_link' => true,
                                        'img_class' => ''
                                    ]);
                                ?>
                                <?php 
                                if($style === 'style-2') 
                                    techrona_post_meta([
                                        'show_date'   => '1',
                                        'show_cat'    => '1',
                                        'show_author' => '0',
                                        'show_cmt'    => '0',
                                        'show_icon'   => false,
                                        'class'       => 'kng-meta-before',
                                        'separator'   => '<span class="col-auto"><span class="kng-meta-separator"></span></span>'
                                    ]);

                                ?>
                                <h4 class="item-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h4>
                                <?php if($style === 'style-1'): ?>
                                <div class="item-meta d-flex kng-meta-bottom gutters-5">
                                    <div class="m-item">
                                        <div class="d-flex">
                                            <?php techrona_get_svg('calendar') ?>
                                            <span><?php echo get_the_date( get_option('date_format'), $post->ID) ?></span>
                                        </div>
                                    </div>
                                    <div class="m-item">
                                        <div class="d-flex">
                                            <span class="lbl"><?php echo esc_html__( 'by', 'techrona' ) ?></span>
                                            <a href="<?php echo esc_url($author_url); ?>" title="<?php the_author_meta('display_name', $user_id); ?>"><?php the_author_meta('display_name', $user_id); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php 
            printf('%s', $args['after']);
        }
        wp_reset_postdata();
    }
}
/**
 * User custom fields.
 */
if(!function_exists('techrona_user_fields')){
    add_action( 'show_user_profile', 'techrona_user_fields' );
    add_action( 'edit_user_profile', 'techrona_user_fields' );
    function techrona_user_fields($user){

        $user_facebook = get_user_meta($user->ID, 'user_facebook', true);
        $user_twitter = get_user_meta($user->ID, 'user_twitter', true);
        $user_linkedin = get_user_meta($user->ID, 'user_linkedin', true);
        $user_skype = get_user_meta($user->ID, 'user_skype', true);
        $user_google = get_user_meta($user->ID, 'user_google', true);
        $user_youtube = get_user_meta($user->ID, 'user_youtube', true);
        $user_vimeo = get_user_meta($user->ID, 'user_vimeo', true);
        $user_tumblr = get_user_meta($user->ID, 'user_tumblr', true);
        $user_rss = get_user_meta($user->ID, 'user_rss', true);
        $user_pinterest = get_user_meta($user->ID, 'user_pinterest', true);
        $user_instagram = get_user_meta($user->ID, 'user_instagram', true);
        $user_yelp = get_user_meta($user->ID, 'user_yelp', true);

        ?>
        <h3><?php esc_html_e('Social', 'techrona'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="user_facebook"><?php esc_html_e('Facebook', 'techrona'); ?></label></th>
                <td>
                    <input id="user_facebook" name="user_facebook" type="text" value="<?php echo esc_attr(isset($user_facebook) ? $user_facebook : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_twitter"><?php esc_html_e('Twitter', 'techrona'); ?></label></th>
                <td>
                    <input id="user_twitter" name="user_twitter" type="text" value="<?php echo esc_attr(isset($user_twitter) ? $user_twitter : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_linkedin"><?php esc_html_e('Linkedin', 'techrona'); ?></label></th>
                <td>
                    <input id="user_linkedin" name="user_linkedin" type="text" value="<?php echo esc_attr(isset($user_linkedin) ? $user_linkedin : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_skype"><?php esc_html_e('Skype', 'techrona'); ?></label></th>
                <td>
                    <input id="user_skype" name="user_skype" type="text" value="<?php echo esc_attr(isset($user_skype) ? $user_skype : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_google"><?php esc_html_e('Google', 'techrona'); ?></label></th>
                <td>
                    <input id="user_google" name="user_google" type="text" value="<?php echo esc_attr(isset($user_google) ? $user_google : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_youtube"><?php esc_html_e('Youtube', 'techrona'); ?></label></th>
                <td>
                    <input id="user_youtube" name="user_youtube" type="text" value="<?php echo esc_attr(isset($user_youtube) ? $user_youtube : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_vimeo"><?php esc_html_e('Vimeo', 'techrona'); ?></label></th>
                <td>
                    <input id="user_vimeo" name="user_vimeo" type="text" value="<?php echo esc_attr(isset($user_vimeo) ? $user_vimeo : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_tumblr"><?php esc_html_e('Tumblr', 'techrona'); ?></label></th>
                <td>
                    <input id="user_tumblr" name="user_tumblr" type="text" value="<?php echo esc_attr(isset($user_tumblr) ? $user_tumblr : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_rss"><?php esc_html_e('Rss', 'techrona'); ?></label></th>
                <td>
                    <input id="user_rss" name="user_rss" type="text" value="<?php echo esc_attr(isset($user_rss) ? $user_rss : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_pinterest"><?php esc_html_e('Pinterest', 'techrona'); ?></label></th>
                <td>
                    <input id="user_pinterest" name="user_pinterest" type="text" value="<?php echo esc_attr(isset($user_pinterest) ? $user_pinterest : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_instagram"><?php esc_html_e('Instagram', 'techrona'); ?></label></th>
                <td>
                    <input id="user_instagram" name="user_instagram" type="text" value="<?php echo esc_attr(isset($user_instagram) ? $user_instagram : ''); ?>" />
                </td>
            </tr>
            <tr>
                <th><label for="user_yelp"><?php esc_html_e('Yelp', 'techrona'); ?></label></th>
                <td>
                    <input id="user_yelp" name="user_yelp" type="text" value="<?php echo esc_attr(isset($user_yelp) ? $user_yelp : ''); ?>" />
                </td>
            </tr>
        </table>
        <?php
    }
}
/**
 * Save user custom fields.
 */
if(!function_exists('techrona_save_user_custom_fields')){
    add_action( 'personal_options_update', 'techrona_save_user_custom_fields' );
    add_action( 'edit_user_profile_update', 'techrona_save_user_custom_fields' );
    function techrona_save_user_custom_fields( $user_id )
    {
        if ( !current_user_can( 'edit_user', $user_id ) )
            return false;

        if(isset($_POST['user_facebook']))
            update_user_meta( $user_id, 'user_facebook', sanitize_text_field($_POST['user_facebook'] ));
        if(isset($_POST['user_twitter']))
            update_user_meta( $user_id, 'user_twitter', sanitize_text_field($_POST['user_twitter'] ));
        if(isset($_POST['user_linkedin']))
            update_user_meta( $user_id, 'user_linkedin', sanitize_text_field($_POST['user_linkedin'] ));
        if(isset($_POST['user_skype']))
            update_user_meta( $user_id, 'user_skype', sanitize_text_field($_POST['user_skype'] ));
        if(isset($_POST['user_google']))
            update_user_meta( $user_id, 'user_google', sanitize_text_field($_POST['user_google'] ));
        if(isset($_POST['user_youtube']))
            update_user_meta( $user_id, 'user_youtube', sanitize_text_field($_POST['user_youtube'] ));
        if(isset($_POST['user_vimeo']))
            update_user_meta( $user_id, 'user_vimeo', sanitize_text_field($_POST['user_vimeo'] ));
        if(isset($_POST['user_tumblr']))
            update_user_meta( $user_id, 'user_tumblr', sanitize_text_field($_POST['user_tumblr'] ));
        if(isset($_POST['user_rss']))
            update_user_meta( $user_id, 'user_rss', sanitize_text_field($_POST['user_rss'] ));
        if(isset($_POST['user_pinterest']))
            update_user_meta( $user_id, 'user_pinterest', sanitize_text_field($_POST['user_pinterest'] ));
        if(isset($_POST['user_instagram']))
            update_user_meta( $user_id, 'user_instagram', sanitize_text_field($_POST['user_instagram'] ));
        if(isset($_POST['user_yelp']))
            update_user_meta( $user_id, 'user_yelp', sanitize_text_field($_POST['user_yelp'] ));
    }
}

/* Author Social */
if(!function_exists('techrona_get_user_social')){
    function techrona_get_user_social($args = []) {
        $args = wp_parse_args($args,[
            'class'             => '',
            'row_class'         => '',    
            'social_item_class' => ''
        ]);
        $user_facebook = get_user_meta(get_the_author_meta( 'ID' ), 'user_facebook', true);
        $user_twitter = get_user_meta(get_the_author_meta( 'ID' ), 'user_twitter', true);
        $user_linkedin = get_user_meta(get_the_author_meta( 'ID' ), 'user_linkedin', true);
        $user_skype = get_user_meta(get_the_author_meta( 'ID' ), 'user_skype', true);
        $user_google = get_user_meta(get_the_author_meta( 'ID' ), 'user_google', true);
        $user_youtube = get_user_meta(get_the_author_meta( 'ID' ), 'user_youtube', true);
        $user_vimeo = get_user_meta(get_the_author_meta( 'ID' ), 'user_vimeo', true);
        $user_tumblr = get_user_meta(get_the_author_meta( 'ID' ), 'user_tumblr', true);
        $user_rss = get_user_meta(get_the_author_meta( 'ID' ), 'user_rss', true);
        $user_pinterest = get_user_meta(get_the_author_meta( 'ID' ), 'user_pinterest', true);
        $user_instagram = get_user_meta(get_the_author_meta( 'ID' ), 'user_instagram', true);
        $user_yelp = get_user_meta(get_the_author_meta( 'ID' ), 'user_yelp', true);

        ?>
        <div class="<?php echo trim(implode(' ', ['user-social kng-socials', $args['class']]));?>">
            <div class="row gutters-20 <?php echo esc_attr($args['row_class']);?>">
                <?php if(!empty($user_facebook)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-facebook-f');?>" href="<?php echo esc_url($user_facebook); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_twitter)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-twitter');?>" href="<?php echo esc_url($user_twitter); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_linkedin)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-linkedin-in');?>" href="<?php echo esc_url($user_linkedin); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_rss)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-rss');?>" href="<?php echo esc_url($user_rss); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_instagram)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-instagram');?>" href="<?php echo esc_url($user_instagram); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_google)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-google');?>" href="<?php echo esc_url($user_google); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_skype)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-skype');?>" href="<?php echo esc_url($user_skype); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_pinterest)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-pinterest');?>" href="<?php echo esc_url($user_pinterest); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_vimeo)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-vimeo');?>" href="<?php echo esc_url($user_vimeo); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_youtube)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-youtube');?>" href="<?php echo esc_url($user_youtube); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_yelp)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-yelp');?>" href="<?php echo esc_url($user_yelp); ?>"></a>
                    </div>
                <?php } ?>
                <?php if(!empty($user_tumblr)) { ?>
                    <div class="kng-social kng-social-item col-auto">
                        <a class="<?php echo esc_attr($args['social_item_class'].' kngi-tumblr');?>" href="<?php echo esc_url($user_tumblr); ?>"></a>
                    </div>
                <?php } ?>
            </div>
        </div> <?php
    }
}

function techrona_product_nav() {
    global $post;
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <?php
    $next_post = get_next_post();
    $previous_post = get_previous_post();
    if( !empty($next_post) || !empty($previous_post) ) { ?>
        <div class="product-previous-next">
            <?php if ( is_a( $previous_post , 'WP_Post' ) && get_the_title( $previous_post->ID ) != '') { ?>
                <a class="nav-link-prev" href="<?php echo esc_url(get_permalink( $previous_post->ID )); ?>"><i class="kngi-long-arrow-left"></i></a>
            <?php } ?>
            <?php if ( is_a( $next_post , 'WP_Post' ) && get_the_title( $next_post->ID ) != '') { ?>
                <a class="nav-link-next" href="<?php echo esc_url(get_permalink( $next_post->ID )); ?>"><i class="kngi-long-arrow-right"></i></a>
            <?php } ?>
        </div>
    <?php }
}

/**
 * Header Search Mobile
 */
function techrona_header_mobile_search()
{
    $search_field_placeholder = techrona_get_theme_opt( 'search_field_placeholder' );
    $mobile_search = techrona_get_theme_opt( 'mobile_search', false );
    if($mobile_search) : ?>
        <div class="header-mobile-search">
            <form role="search" method="get" action="<?php echo esc_url(home_url( '/' )); ?>">
                <input type="text" placeholder="<?php if(!empty($search_field_placeholder)) { echo esc_attr( $search_field_placeholder ); } else { esc_attr_e('Search...', 'techrona'); } ?>" name="s" class="search-field" />
                <button type="submit" class="search-submit"><i class="kngi-search"></i></button>
            </form>
        </div>
<?php endif; }