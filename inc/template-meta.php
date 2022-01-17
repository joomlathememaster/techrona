<?php
/**
 * Prints post meta
 */
if ( ! function_exists( 'techrona_post_meta' ) ) {
    function techrona_post_meta($args=[]) {
        $args = wp_parse_args($args,[
            'show_author' => techrona_get_theme_opt( 'archive_author_on', true ),
            'show_cat'    => techrona_get_theme_opt( 'archive_categories_on', true ),
            'show_cmt'    => techrona_get_theme_opt( 'archive_comments_on', true ),
            'show_date'   => techrona_get_theme_opt( 'archive_date_on', true ),
            'show_share'  => techrona_get_theme_opt( 'archive_share_on', true ),
            'show_icon'   => true, 
            'class'       => '',
            'inner_class' => '',
            'item_class'  => '',
            'post_id'     => get_the_ID(),
            'date_format' => get_option('date_format'),
            'taxo'        => techrona_get_custom_post_taxonomies(get_post_type(), 'cat'),
            'separator'   => '',
            'echo'        => false  
        ]);
         
        $inner_class = ['kng-post-meta-inner', 'row align-items-center', $args['inner_class']];
        $metas = [
            techrona_post_author([
                'post_id'       => $args['post_id'],
                'show_author'   => $args['show_author'], 
                'show_icon'     => $args['show_icon'],
                'author_avatar' => false,
                'class'         => 'col-auto '.$args['item_class'],
                'echo'          => $args['echo']
            ]),
            techrona_post_category([
                'show_icon' => $args['show_icon'],
                'show_cat'  => $args['show_cat'],
                'class'     => 'col-auto empty-none '.$args['item_class'],
                'post_id'   => $args['post_id'],
                'text'      =>  '',
                'taxo'      => $args['taxo'],
                'echo'      => $args['echo']
            ]),
            techrona_post_date([
                'post_id'     => $args['post_id'],
                'show_date'   => $args['show_date'],
                'show_icon'   => $args['show_icon'],
                'date_format' => $args['date_format'],
                'class'       => 'col-auto '.$args['item_class'],
                'echo'        => $args['echo']
            ]),
            techrona_post_comment([
                'post_id'   => $args['post_id'],
                'show_icon' => $args['show_icon'],
                'show_cmt'  => $args['show_cmt'],
                'class'     => 'col-auto '.$args['item_class'],  
                'text'      => '',
                'echo'      => $args['echo']
            ]),
        ];
        if( function_exists('kng_share_this_all') ){
            $metas[] = kng_share_this_all([
                'post_id'   => $args['post_id'],
                'show_icon' => $args['show_icon'],
                'show_share' => $args['show_share'],
                'class'     => 'col-auto '.$args['item_class'],  
                'text'      => '',
                'echo'      => $args['echo']
            ]);
        }
        if($args['show_author'] || $args['show_cat'] || $args['show_cmt'] || $args['show_date'] || $args['show_share']) : ?>
            <div class="<?php echo implode(' ', ['kng-post-meta', $args['class']]); ?>">
                <div class="<?php echo trim(implode(' ', $inner_class));?>">
                    <?php echo implode($args['separator'], array_filter($metas)); ?>
                </div>
            </div>
        <?php endif; 
    }
}
 

/* Meta Post Author */
if(!function_exists('techrona_post_author')){
    function techrona_post_author($args = []){
        $args = wp_parse_args($args,[
            'post_id'     => get_the_ID(),
			'show_author' => true,
			'class'       => '',
			'text'        => '',
			'show_icon'   => true,
			'icon'        => 'icon-user',
            'author_avatar' => false,
            'echo'        => true
        ]);

        if(!$args['show_author']) return;
 
        ob_start();
    ?>
        <span class="<?php echo trim(implode(' ', ['kng-post-author', $args['class']]));?>">
            <span class="meta-inner">
                <?php 
                    // Author name
                    $my_post = get_post( $args['post_id'] );
                    $user_id = $my_post->post_author;
                    $author_url = get_author_posts_url($user_id);
                    // $author_url2 = get_the_author_meta( 'user_url', $user_id );
                    // $author_avatar = $args['author_avatar'] ? get_avatar( $user_id, 40, '', get_the_author_meta( 'display_name', $user_id ), array( 'class' => 'circle' ) ) : '';

                    // author icon
                    if(empty($author_avatar) && $args['show_icon'] ){
                        $icon_class = implode(' ', ['meta-icon', $args['icon']]);
                        if(!empty($args['icon'])) echo '<span class="'.esc_attr($icon_class).'"></span>';
                    }
                    // Author text
                    if(!empty($args['text'])):  echo '<span>'.esc_html($args['text']).'&nbsp;</span>'; endif; 
                ?>
                <a class="author-name" href="<?php echo esc_url($author_url); ?>" title="<?php the_author_meta('display_name', $user_id); ?>"><span><?php the_author_meta('display_name', $user_id); ?></span></a>
            </span>
        </span>
    <?php
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}
/* Meta Post Category */
if(!function_exists('techrona_post_category')){
    function techrona_post_category($args = []){
        $args = wp_parse_args($args,[
            'show_cat'   => true,
            'class'      => '',
            'text'       => '',
            'show_icon'  => true,
            'icon'       => 'kngi-folder-open1',
            'icon_class' => 'text-accent',
            'taxo'       => 'category',
            'separator'  => ', ',
            'post_id'    => get_the_ID(),
            'echo'       => true   
        ]);
        
        if(!$args['show_cat'] || !get_the_terms($args['post_id'], $args['taxo'])) return;


        ob_start();
    ?>
        <span class="<?php echo trim(implode(' ', ['kng-post-cat', $args['class']]));?>">
            <span class="meta-inner">
                <?php 
                	if($args['show_icon']){
    	                // cat icon
    	                $icon_class = implode(' ', ['meta-icon',$args['icon'], $args['icon_class']]);
    	                if(!empty($args['icon'])) echo '<span class="'.esc_attr($icon_class).'">&nbsp;</span>';
    	            }
                    // cat text
                    if(!empty($args['text'])):  echo '<span>'.esc_html($args['text']).'&nbsp;</span>'; endif; 
                    // cat list
                    the_terms( $args['post_id'], $args['taxo'], '', $args['separator'], '' );
                ?>
            </span>
        </span>
    <?php
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}
/* Meta Post Comment */
if(!function_exists('techrona_post_comment')){
    function techrona_post_comment($args = []){
        $args = wp_parse_args($args,[
            'post_id'       => get_the_ID(),
			'show_cmt'      => true,
			'text'          => esc_html__('Comments','techrona'),
			'class'         => '',
			'show_icon'     => true,
			'icon'          => 'icon-comments',
			'icon_class'    => 'text-accent',
			'cmt_with_text' => true,
            'echo'          => true
        ]);

        if(!$args['show_cmt']) return;
        ob_start();
    ?>
        <span class="<?php echo trim(implode(' ', ['kng-post-cmt', $args['class']]));?>">
            <span class="meta-inner">
                <?php 
                	if($args['show_icon']){
    	                // comment icon
    	                $icon_class = implode(' ', ['meta-icon', $args['icon'], $args['icon_class']]);
    	                if(!empty($args['icon'])) echo '<span class="'.esc_attr($icon_class).'"></span>';
    	            }
                    // comment text
                    if(!empty($args['text'])):  echo '<span>'.esc_html($args['text']).'&nbsp;</span>'; endif; 
                ?>
                <a class="kng-scroll" href="<?php the_permalink();?>#comments"><?php
                    if($args['cmt_with_text']) 
                        echo comments_number(
                            esc_html__('Comments ', 'techrona').'<span class="cmt-count">(0)</span>',
                            esc_html__('Comment ', 'techrona').'<span class="cmt-count">(1)</span>',
                            esc_html__('Comments ', 'techrona').'<span class="cmt-count">(%)</span>',
                            $args['post_id']
                        ); 
                    else 
                        echo comments_number(
                            '0',
                            '1',
                            '%',
                            $args['post_id']
                        );
                ?></a>
            </span>
        </span>
    <?php
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}
/* Meta post author */
if(!function_exists('techrona_post_date')){
    function techrona_post_date($args = []){
        $args = wp_parse_args($args, [
            'post_id'     => get_the_ID(),
			'show_date'   => true,
			'date_format' => get_option('date_format'),
			'class'       => '',
			'show_icon'   => true,
			'icon'        => 'icon-calendar',
			'icon_class'  => 'text-accent',
            'echo'        => true  
        ]);
        if(!$args['show_date']) return;
        ob_start();
        ?>
        <span class="<?php echo trim(implode(' ', ['kng-post-date', $args['class']]));?>">
            <span class="meta-inner">
                <?php 
                	if($args['show_icon']){
    	                // date icon
    	                $icon_class = implode(' ', ['meta-icon', $args['icon'], $args['icon_class']]);
    	                if(!empty($args['icon'])) echo '<span class="'.esc_attr($icon_class).'"></span>';
    	            }
                ?>
                <span><?php echo get_the_date($args['date_format'], $args['post_id'] ); ?></span>
            </span>
        </span>
        <?php
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}
 

/**
 * Prints tag list
 */
if ( ! function_exists( 'techrona_post_tagged_in' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function techrona_post_tagged_in($args = [])
    {
        $args = wp_parse_args($args, [
            'title'    => '',
            'class'    => '',
            'style'    => 'tagcloud',     
            'show_tag' => '1',
            'post_id'  => get_the_ID(),
            'separator' => '',
        ]);
        if($args['show_tag'] !== '1') return;
        $tags_list = get_the_tag_list( '<div class="'.$args['style'].'">', $args['separator'], '</div>', $args['post_id']);
        if ( $tags_list )
        {
            echo '<div class="'.trim(implode(' ', ['kng-post-tags', $args['class']])).'"><div class="row gutters-grid align-items-center">';
                if($args['title'] != '') printf('%s', $args['title']);
                printf('<div class="col">%2$s</div>', '', $tags_list);
            echo '</div></div>';
        }
    }
endif;