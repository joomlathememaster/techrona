<?php
/**
 * Post Media
 * @since 1.0.1
*/
if(!function_exists('techrona_post_media')){
    function techrona_post_media($args = []){
        $args = wp_parse_args($args, [
            'post_id'   => null,
            'size'      => is_single() ? 'post-thumbnail' : 'large',
            'echo'      => true,
            'class'     => '',
            'img_atts'  => [],
            'before'    => '',
            'after'     => '',
            'show_link' => is_single() ? false : true,
            'wrap_class'    => '',
            'media_content' => true,
            'media_before'  => '',
            'media_after'   => '',
        ]);
        do_action('techrona_before_post_media');
        $post_format = !empty(get_post_format($args['post_id'])) ? get_post_format($args['post_id']) : 'standard';

        $classes = [
            'kng-featured',
            'kng-post-'.$post_format,
        ];
        $classes[] = techrona_is_loop() ? 'loop' : '';
        if(!empty($args['wrap_class'])) $classes[] = $args['wrap_class'];
    ?>
    <div class="<?php echo trim(implode(' ', $classes));?>"><div class="kng-featured-inner relative"><?php
        printf('%s', $args['media_before']);
            switch (get_post_format($args['post_id'])) {
                case 'gallery':
                    techrona_post_gallery($args);
                    break;
                case 'video':
                    techrona_post_video($args);
                    break;
                case 'audio':
                    techrona_post_audio($args);
                    break;
                case 'quote':
                    techrona_post_quote($args);
                    break;
                case 'link':
                    techrona_post_link($args);
                    break;
                case 'image':
                    techrona_post_image($args);
                    break;
                default: 
                    techrona_post_thumbnail($args);
                    break;
            }
        printf('%s', $args['media_after']);
        if($args['media_content']) do_action('techrona_post_media_content', $args);
    ?></div></div>
    <?php
        do_action('techrona_after_post_media');
    }
}
/**
 * Post Thumbnail
 * @since 1.0.0
*/
if(!function_exists('techrona_post_thumbnail')){
    function techrona_post_thumbnail($args=[]){
        $args = wp_parse_args($args,[
            'post_id'   => null,
            'size'      => is_single() ? 'post-thumbnail' : 'large',
            'echo'      => true,
            'class'     => '',
            'img_atts'  => [],
            'before'    => '',
            'after'     => '',
            'show_link' => is_single() ? false : true
        ]);

        if(!has_post_thumbnail($args['post_id'])) return;

        $post_feature_image_type = techrona_get_theme_opt('post_feature_image_type','cropped');

        $thumbnail_atts = [];
        // class
        $thumbnail_atts_class = ['post-image','kng-post-image', $args['class'], $post_feature_image_type];
        $thumbnail_atts[] = 'class="'.implode(' ', $thumbnail_atts_class).'"';

        if($post_feature_image_type == 'background'){
            $img_src = get_the_post_thumbnail_url( $args['post_id'], 'full' );
            $thumbnail_atts[] = 'style="background:url('.$img_src.') no-repeat center center; background-attachment: fixed;"';
        }

        ob_start();
            printf('%s', $args['before']);
        ?>
            <div <?php echo implode(' ', $thumbnail_atts);?>>
                <?php if($args['show_link']) : ?><a href="<?php the_permalink($args['post_id']);?>" title="<?php the_title($args['post_id']);?>" rel="nofollow"><?php endif; 
                    if( strpos( strtolower($args['size']), 'x') !== false){
                        $attachment_id = get_post_thumbnail_id( $args['post_id'] ); 
                        $img = kng_get_image_by_size( array(
                            'attach_id'  => $attachment_id,
                            'thumb_size' => $args['size'],
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                        echo wp_kses_post($thumbnail);
                    }else{  
                        echo get_the_post_thumbnail($args['post_id'], $args['size'], $args['img_atts']);
                    }
                if($args['show_link']) : ?></a><?php endif; ?>
            </div>
            <?php do_action('techrona_post_thumbnail_content');
            printf('%s', $args['after']);
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}

/**
 * Post Gallery 
 * @since 1.0.0
*/
if(!function_exists('techrona_post_gallery')){
    function techrona_post_gallery($args=[], $gallery = 'post-gallery-images'){
        $args = wp_parse_args($args, array(
            'post_id'   => null,
            'size'      => is_single() ? 'post-thumbnail' : 'large',
            'echo'      => true,
            'class'     => '',
            'img_atts'  => [],
            'before'    => '',
            'after'     => '',
            'show_link' => true
        ));
        $post_format_value = techrona_get_post_format_value($args['post_id'], $gallery, []);
         
        // Get gallery from option
        if(!empty($post_format_value))
            $gallery_list = explode(',', $post_format_value);
        $lightbox = techrona_get_post_format_value($args['post_id'], 'post-gallery-lightbox', 'yes');

        ob_start();
        if(!empty($gallery_list[0])){
            wp_enqueue_script('swiper');
            printf('%s', $args['before']);
        ?>
            <div class="kng-post-galleries" data-settings='{"slides_to_show":"1","navigation":"arrows","autoplay":"yes","pause_on_hover":"yes","pause_on_interaction":"yes","autoplay_speed":5000,"infinite":"yes","effect":"slide","speed":500}'>
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <?php
                        foreach ($gallery_list as $img_id):
                            ?>
                            <div class="swiper-slide">
                                <a href="<?php echo esc_url(wp_get_attachment_image_url($img_id, 'full'));?>" data-elementor-open-lightbox="<?php echo esc_attr( $lightbox);?>" data-elementor-lightbox-slideshow="<?php echo uniqid('post-'.$args['post_id'].'-');?>" data-elementor-lightbox-title="<?php echo esc_attr(get_post_meta( $img_id, '_wp_attachment_image_alt', true )) ?>" ><?php echo wp_get_attachment_image($img_id, $args['size'], false, $args['img_atts']); ?></a>
                            </div>
                            <?php
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        <?php 
            printf('%s', $args['after']);
        } elseif(has_post_thumbnail()) {
            techrona_post_thumbnail($args);
        }
        if($args['echo']){
            echo ob_get_clean();
        } else {
            return ob_get_clean();
        }
    }
}
/**
 * Post Video
 * @since 1.0.0
*/
if(!function_exists('techrona_post_video')){
    function techrona_post_video($args=[]){
        global $wp_embed;
        $args = wp_parse_args($args, [
            'post_id'   => null,
            'size'      => is_single() ? 'post-thumbnail' : 'large',
            'echo'      => true,
            'class'     => '',
            'img_atts'  => [],
            'before'    => '',
            'after'     => '',
            'show_link' => true
        ]);
        $video_url     = techrona_get_post_format_value($args['post_id'], 'post-video-url', '');
        $video_file    = techrona_get_post_format_value($args['post_id'], 'post-video-file', []);
        $video_file_id = isset($video_file['id']) ? $video_file['id'] : '';
        $video_html    = techrona_get_post_format_value($args['post_id'], 'post-video-html', '');

        // Only get video from the content if a playlist isn't present.
        $_video_in_content = apply_filters( 'the_content', get_the_content('','',$args['post_id']) );
        if ( false === strpos( $_video_in_content, 'wp-playlist-script' ) ) {
            $video_in_content = get_media_embedded_in_content( $_video_in_content, array( 'video', 'object', 'embed', 'iframe' ) );
        }
        $html = $video = '';
        if (!empty($video_url)) {
            $video = do_shortcode($wp_embed->autoembed($video_url));
        } elseif (!empty($video_file_id)) {
            /* Get default video poster */
            $poster = !empty(get_the_post_thumbnail_url($video_file_id)) ? get_the_post_thumbnail_url($video_file_id,'full') : get_the_post_thumbnail_url(get_the_ID(),'full');
            //attachment meta data 
            $att_data = wp_get_attachment_metadata($video_file_id);
            $mime_type = explode('/', $att_data['mime_type']);
            /* Build video */            
            $video_atts = array(
                'src'    => esc_url($video_file['url']),
                'poster' => esc_url($poster),
                'width'  => esc_attr($video_file['width']),
                'height' => esc_attr($video_file['height'])
            );
            switch ($mime_type[0]) {
                case 'audio':
                    $video = do_shortcode($wp_embed->autoembed($video_file['url']));
                    break;
                
                default:
                    if(!empty($poster))
                        $video = wp_video_shortcode($video_atts);
                    else 
                        $video = do_shortcode($wp_embed->autoembed($video_file['url']));
                    break;
            }            
        } elseif ('' != $video_html) {
            $_video_html = explode(',', $video_html);
            foreach ($_video_html as $value) {
                $video .= '<div class="video-item">'.do_shortcode($wp_embed->autoembed($value)).'</div>';
            }
        } elseif(! empty( $video_in_content ) && !is_singular()){
            // If not a single post, highlight the video file.
            foreach ( $video_in_content as $video_in_content_html ) {
                $video .= $video_in_content_html;
            }
        }
        if(!empty($video)){
            $html = $args['before'] . $video . $args['after'];
        } else {
            $html = techrona_post_thumbnail($args);
        }
        // Show video 
        if($args['echo'])
            echo techrona_html($html);
        else 
            return $html;
    }
}

/**
 * Post Audio
 * @since 1.0.0
*/
if(!function_exists('techrona_post_audio')){
    function techrona_post_audio($args = []){
        $args = wp_parse_args($args, [
            'audio_url'      => 'post-audio-url',
            'audio_file'     => 'post-audio-file',
            'id'             => null,
            'thumbnail_size' => is_single() ? 'large' : 'medium',
            'echo'           => true,
            'default_thumb'  => techrona_configs('default_post_thumbnail')
        ]);
        global $wp_embed;
        $audio_url = techrona_get_post_format_value($args['id'], $args['audio_url'], '');
        $audio_file = techrona_get_post_format_value($args['id'], $args['audio_file'], ['id'=>'']);
        if(!empty($audio_file['id'])){
            /* Get default video poster */
            $poster = (is_array($audio_file) && !empty(get_the_post_thumbnail_url($audio_file['id']))) ? get_the_post_thumbnail_url($audio_file['id'],'full') : get_the_post_thumbnail_url(get_the_ID(),'full');
            //attachment meta data 
            $att_data = wp_get_attachment_metadata($audio_file['id']);
            $mime_type = explode('/', $att_data['mime_type']);
            /* Build audio */            
            $audio_atts = array(
                'src'    => esc_url($audio_file['url']),
                'poster' => esc_url($poster),
                'width'  => esc_attr($audio_file['width']),
                'height' => esc_attr($audio_file['height'])
            );
        }
        // get audion in content 
        $_audio_in_content = apply_filters( 'the_content', get_the_content() );
        // Only get audio from the content if a playlist isn't present.
        if ( false === strpos( $_audio_in_content, 'wp-playlist-script' ) ) {
            $audio_in_content = get_media_embedded_in_content( $_audio_in_content, array( 'audio' ) );
        }        
        $audio = '';
        ob_start();
        if(!empty($audio_url)){
            $audio =  do_shortcode($wp_embed->autoembed($audio_url));
        } elseif (!empty($audio_file['id'])) {
            switch ($mime_type[0]) {
                case 'audio':
                    $audio = do_shortcode($wp_embed->autoembed($audio_file['url']));
                    break;
                case 'application':
                    $audio = do_shortcode($wp_embed->autoembed($audio_file['url']));
                    break;
                
                default:
                    if(!empty($poster)){
                        $audio = wp_video_shortcode($audio_atts);
                    } else {
                        $audio = do_shortcode($wp_embed->autoembed($audio_file['url']));
                    }
                    break;
            }            
        } elseif(! empty( $audio_in_content ) && !is_singular()){
            // If not a single post, highlight the audio file.
            foreach ( $audio_in_content as $audio_in_content_html ) {
                $audio .= $audio_in_content_html;
            }
        } elseif ( has_post_thumbnail() ){
            $audio = techrona_post_thumbnail($args);
        }
        $audio .= ob_get_clean();
        // Show video 
        if($args['echo'])
            echo apply_filters('techrona_post_audio', $audio);
        else 
            return $audio;
    }
}
/**
 * Post Quote
 * @since 1.0.0
*/
if(!function_exists('techrona_post_quote')){
    function techrona_post_quote($args = []){
        $args = wp_parse_args($args, [
            'post_id'   => null,
            'size'      => is_single() ? 'post-thumbnail' : 'large',
            'echo'      => true,
            'class'     => '',
            'img_atts'  => [],
            'before'    => '',
            'after'     => '',
            'show_link' => true
        ]);
        $text = techrona_get_post_format_value($args['post_id'], 'post-quote-text', '');
        $cite = techrona_get_post_format_value($args['post_id'], 'post-quote-cite', '');
        $quote = '';
        $quote_attrs = $quote_style = [];
        $quote_css_class = ['quote-wrap'];
        
        // Inline Style
        if(has_post_thumbnail($args['post_id'])) {
            $quote_style[] = 'background-image:url('.get_the_post_thumbnail_url($args['post_id']).')';
            $quote_css_class[] = 'has-bg';
        }
        $quote_attrs[] = 'class="'.trim(implode(' ', $quote_css_class)).'"';
        if(!empty($quote_style)) $quote_attrs[] = 'style="'.trim(implode(';', $quote_style)).'"'; 

        ob_start();
            printf('%s', $args['before']);
                if(!empty($text) || !empty($cite)){
                    echo '<div '.trim(implode(' ', $quote_attrs)).'><blockquote><div class="quote-text">'.$text.'</div><cite>'.$cite.'</cite></blockquote></div>';
                } else {
                    techrona_post_thumbnail($args);
                }
            printf('%s', $args['before']);

        if($args['echo'])
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}
/**
 * Post Link
 * @since 1.0.0
*/
if(!function_exists('techrona_post_link')){
    function techrona_post_link($args = []){
        $args = wp_parse_args($args, [
            'post_id'   => null,
            'size'      => is_single() ? 'post-thumbnail' : 'large',
            'echo'      => true,
            'class'     => '',
            'img_atts'  => [],
            'before'    => '',
            'after'     => '',
            'show_link' => true
        ]);

        
        $title = techrona_get_post_format_value($args['post_id'], 'post-link-title', esc_html__('View Our Portfolio','techrona'));
        $link = techrona_get_post_format_value($args['post_id'], 'post-link-url', 'https://themeforest.net/user/bravis-themes/portfolio');
        if(empty($link)) return;
        
        // Link attribute
        $link_attrs = $link_style = [];
        $link_css_class = ['link-wrap'];
        // Inline Style
        if(has_post_thumbnail($args['post_id'])) {
            $link_style[] = 'background-image:url('.get_the_post_thumbnail_url($args['post_id']).')';
            $link_css_class[] = 'has-bg';
        }
        $link_attrs[] = 'class="'.trim(implode(' ', $link_css_class)).'"';
        if(!empty($link_style)) $link_attrs[] = 'style="'.trim(implode(';', $link_style)).'"';
        // Build Content
        ob_start();
        printf('%s', $args['before']);
        if(!empty($link)) {
        ?>
            <div <?php echo trim(implode(' ', $link_attrs));?>>
                <a href="<?php echo esc_url($link);?>" class="btn btn-fill btn-accent btn-hover-secondary" target="_blank">
                    <span class="btn-title"><?php echo esc_html($title);?></span>
                </a>
            </div>
        <?php } else {
            techrona_post_thumbnail($args);
        }
        printf('%s', $args['before']);

        if($args['echo'])
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}

/**
 * Post Image
 * @since 1.0.0
*/
if(!function_exists('techrona_post_image')){
    function techrona_post_image($args = []){
        $args = wp_parse_args($args, [
            'id'             => null,
            'thumbnail_size' => is_single() ? 'large' : 'medium',
            'echo'           => true,
            'default_thumb'  => techrona_configs('default_post_thumbnail')
        ]);
        $image = $image_in_content = '';
        // Get first link in content 
        $image_in_content =  techrona_get_content_image(['echo' => false]);
        
        if(has_post_thumbnail($args['id'])){
           $image =  techrona_post_thumbnail($args);
        } elseif(!empty($image_in_content) && !is_single()){
            // images
            $image =  techrona_get_content_image(['echo' => false]);
        }
        if($args['echo'])
            echo apply_filters('techrona_post_image', $image);
        else 
            return $image;
    }
}
 
/**
 * Post Date on Media
 * action hook: techrona_post_media_content
 * @since 1.0.0
 * add_action('techrona_post_media_content', 'techrona_post_date_on_media', 10);
*/
if(!function_exists('techrona_post_date_on_media')){
    //add_action('techrona_post_media_content', 'techrona_post_date_on_media', 10);
    function techrona_post_date_on_media($args =[]){
        $args = wp_parse_args($args, [
            'show_date' => is_singular() ? techrona_get_opts('post_date_on', '1' ) : techrona_get_opts('archive_date_on', '1' ),
        ]);
        if($args['show_date'] !== '1') return;
        extract($args);
        ob_start();
            echo '<div class="kng-post-date-on-media bg-white kng-radius-tl-br-8 text-616161 text-center text-small">'
            .get_the_date( get_option('date_format'), $args['id'])
            .'</div>';
        if($args['echo'])
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}
/**
 * Post Author's on Media 
 * action hook : techrona_post_thumbnail_content
 * @since 1.0.0
*/
if(!function_exists('techrona_post_author_on_media')){
    function techrona_post_author_on_media($args = []){
        $args = wp_parse_args($args, [
            'echo'        => true,
            'show_author' => is_singular() ? techrona_get_opts('post_author_on','1') : techrona_get_opts('archive_author_on','1')
        ]);
        extract($args);

        if('1' !== $show_author) return;

        ob_start();
            echo '<div class="post-author">'
            .get_avatar(get_the_author_meta('ID'), 30,  '' , get_the_author(), array('class' => 'circle')).'&nbsp;&nbsp;'
            .esc_html__('By','techrona').':&nbsp;'
            .get_the_author_posts_link()
            .'</div>';
        if($args['echo'])
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}

/**
 * Post Category on Media
 * action hook: techrona_post_thumbnail_content
 * @since 1.0.0
 * add_action('techrona_post_thumbnail_content', 'techrona_post_category_on_media', 10);
*/
if(!function_exists('techrona_post_category_on_media')){
    function techrona_post_category_on_media($args =[]){
        $args = wp_parse_args($args, [
            'echo'     => true,
            'show_cat' => is_singular() ? techrona_get_opts('post_categories_on','1') : techrona_get_opts('archive_categories_on','1'),
            'taxonomy' => 'category',
            'before'   => '<span class="icon-pencil icon"></span>',
            'sep'      => ' / ',
            'after'    => ''
        ]);
        extract($args);
        if('1' !== $show_cat) return;

        ob_start();
            echo '<div class="post-category badge-info">'
            .get_the_term_list( get_the_ID(), $taxonomy, $before, $sep, $after )
            .'</div>';
        if($args['echo'])
            echo ob_get_clean();
        else 
            return ob_get_clean();
    }
}

/**
 * Read more on media 
 *
*/
if(!function_exists('techrona_post_readmore_on_media')){
    function techrona_post_readmore_on_media($args=[]){
        $args = wp_parse_args($args, [
            'icon' => 'kngi-plus',

        ]);
        ob_start();
    ?>
        <a class="overlay gradient-btt" href="<?php the_permalink();?>">
            <span class="icon-readmore <?php echo esc_attr($args['icon']);?>"></span>
        </a>
    <?php
        echo ob_get_clean();
    }
}