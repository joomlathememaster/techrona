<?php
/**
 * Ajax paginate links
*/
if(!function_exists('techrona_ajax_paginate_links')){
    function techrona_ajax_paginate_links($link){
        $parts = parse_url($link);
        parse_str($parts['query'], $query);
        if(isset($query['page']) && !empty($query['page'])){
            return '#' . $query['page'];
        }
        else{
            return '#1';
        }
    }
}

/**
 * AJAX HTML for pagination
*/
if(!function_exists('techrona_get_pagination_html')){
    add_action( 'wp_ajax_techrona_get_pagination_html', 'techrona_get_pagination_html' );
    add_action( 'wp_ajax_nopriv_techrona_get_pagination_html', 'techrona_get_pagination_html' );
    function techrona_get_pagination_html(){
        try{
            if(!isset($_POST['query_vars'])){
                throw new Exception(__('Something went wrong while requesting. Please try again!', 'techrona'));
            }
            $query = new WP_Query( sanitize_text_field($_POST['query_vars']));
            $cls = isset($_POST['cls']) ? sanitize_text_field($_POST['cls']) : '';
            ob_start();
           		techrona_posts_pagination( $query,  true, ['class' => $cls] );
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status'  => true,
                    'message' => esc_html__('Load Pagination Successfully!', 'techrona'),
                    'data'    => array(
                        'html'       => $html,
                        'query_vars' => sanitize_text_field($_POST['query_vars']),
                        'post'       => $query->have_posts()
                    ),
                )
            );
        }
        catch (Exception $e){
            wp_send_json(array('status' => false, 'message' => $e->getMessage()));
        }
        die;
    }
}
// Post Layout 
if(!function_exists('techrona_get_post_grid')){
    function techrona_get_post_grid($posts = [], $settings = [], $args = []){
        
        if(empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)){
            return false;
        }

        extract($settings);

        if($thumbnail_size != 'custom'){
            $image_size = $thumbnail_size;
        }elseif(!empty($thumbnail_size_custom)){
            $image_size = $thumbnail_size_custom;
        }
        else{
            $image_size = 'full';
        }  


        $col_xxl = isset($settings['col_xxl']) ? 'col-xxl-'.str_replace('.', '',12 / floatval($settings['col_xxl'])) : '';
        $col_xl = isset($settings['col_xl']) ? 'col-xl-'.str_replace('.', '',12 / floatval( $settings['col_xl'])) : '';
        $col_lg = isset($settings['col_lg']) ? 'col-lg-'.str_replace('.', '',12 / floatval( $settings['col_lg'])) : '';
        $col_md = isset($settings['col_md']) ? 'col-md-'.str_replace('.', '',12 / floatval( $settings['col_md'])) : '';
        $col_sm = isset($settings['col_sm']) ? 'col-sm-'.str_replace('.', '',12 / floatval( $settings['col_sm'])) : ''; 
        $col_xs = isset($settings['col_xs']) ? 'col-xs-'.str_replace('.', '',12 / floatval( $settings['col_xs'])) : ''; 

        $args = wp_parse_args($args, [
            'item_class' => trim(implode(' ', ['kng-grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]))
        ]);

         
        $item_class = $args['item_class'];
        $settings['gap_extra'] = empty($settings['gap_extra']) ? '0' : $settings['gap_extra'];
        //style
        $style = 'style="';

        if(isset($settings['masonry_mode']) && $settings['gap'] !== 0){
            $style .= 'padding:'.($settings['gap']/2).'px;';
        }
        if($settings['gap_extra']!== '0'){
            $style .= 'margin-bottom:'.$settings['gap_extra'].'px;';
        }
        $style .= '"';   
       
        foreach ($posts as $key => $post):   
            $filter_class = kng_get_term_of_post_to_class($post->ID, array_unique($tax));
             
            $user_id = $post->post_author;
            $author_url = get_author_posts_url($user_id);
            
            $item_class = $args['item_class'];  
            $img_size = $image_size;
            if(isset($grid_custom_columns) && !empty($grid_custom_columns[$key]) && count($grid_custom_columns)) {  
                $col_xxl_c = isset($grid_custom_columns[$key]['col_xxl_c']) ? 'col-xxl-'.str_replace('.', '',12 / floatval($grid_custom_columns[$key]['col_xxl_c'])) : '';
                $col_xl_c = isset($grid_custom_columns[$key]['col_xl_c']) ? 'col-xl-'.str_replace('.', '',12 / floatval( $grid_custom_columns[$key]['col_xl_c'])) : '';
                $col_lg_c = isset($grid_custom_columns[$key]['col_lg_c']) ? 'col-lg-'.str_replace('.', '',12 / floatval( $grid_custom_columns[$key]['col_lg_c'])) : '';
                $col_md_c = isset($grid_custom_columns[$key]['col_md_c']) ? 'col-md-'.str_replace('.', '',12 / floatval( $grid_custom_columns[$key]['col_md_c'])) : '';
                $col_sm_c = isset($grid_custom_columns[$key]['col_sm_c']) ? 'col-sm-'.str_replace('.', '',12 / floatval( $grid_custom_columns[$key]['col_sm_c'])) : ''; 
                $col_xs_c = isset($grid_custom_columns[$key]['col_xs_c']) ? 'col-xs-'.str_replace('.', '',12 / floatval( $grid_custom_columns[$key]['col_xs_c'])) : ''; 
                 
                $item_class = trim(implode(' ', ['kng-grid-item', $col_xxl_c, $col_xl_c, $col_lg_c, $col_md_c, $col_sm_c, $col_xs_c]));

                $thumbnail_size_c = $grid_custom_columns[$key]['thumbnail_size_c'];
                $thumbnail_size_custom_c = $grid_custom_columns[$key]['thumbnail_size_custom_c'];

                if(!empty($thumbnail_size_c)) {
                    if($thumbnail_size_c == 'custom' && !empty($thumbnail_size_custom_c))
                        $img_size = $thumbnail_size_custom_c;
                    else
                        $img_size = $thumbnail_size_c;
                } else {
                    $img_size = $image_size;
                }
            } 
             
            ?>
            <div class="<?php echo trim(implode(' ', [$item_class, $filter_class])); ?>" <?php kng_print_html($style); ?>>
                <?php switch ($settings['layout']) {
                    case '1-service':
                        $service_icon = !empty(techrona_get_post_format_value($post->ID, 'service_icon')) ? techrona_get_post_format_value($post->ID, 'service_icon') : 'icon-data-storage';     
                        ?>
                        <div class="kng-item-content">
                            <div class="kng-featured-wrap">                     
                                <?php if(!empty($service_icon)): ?>
                                    <div class="service-icon">
                                        <div class="icon-wrap">
                                            <i class="<?php echo esc_attr($service_icon)?>"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="kng-item-content-inner">
                                    <h4 class="kng-item-content-title kng-heading">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                                    </h4>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                    <?php if(!empty($settings['show_readmore'])): ?>
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore d-inline-block">
                                        <span class="kng-btn-content">
                                            <?php if(!empty($settings['readmore_text'])): ?>
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                            <?php endif; ?>                                           
                                        </span>
                                    </a>
                                    <?php endif; ?>          
                                </div>
                            </div>
                             
                        </div>
                        <?php 
                        break;
                    case '2-service':
                        $service_img = !empty(techrona_get_post_format_value($post->ID, 'service_img')) ? techrona_get_post_format_value($post->ID, 'service_img') : '';  
                        $service_icon = !empty(techrona_get_post_format_value($post->ID, 'service_icon')) ? techrona_get_post_format_value($post->ID, 'service_icon') : 'icon-data-storage';  
                        // var_dump($service_img);
                        ?>
                        <div class="kng-item-content">
                            <div class="kng-featured-wrap"> 
                                <div class="icon-box">
                                    <div class="icon-box-wrap">
                                        <?php if(!empty($service_img['thumbnail'])): ?>
                                        <div class="icon-layer" style="background-image: url(<?php echo get_template_directory_uri().'/assets/images/icon-5.png' ?>);"></div>          
                                        <div class="servcie-img">                                                      
                                            <img src="<?php echo esc_html( $service_img['thumbnail'] ) ?>" alt="">
                                        </div>
                                        <?php else: ?>
                                            <div class="icon-layer" style="background-image: url(<?php echo get_template_directory_uri().'/assets/images/icon-5.png' ?>);"></div>
                                            <div class="service-icon">                                        
                                                <div class="icon-wrap">                                                    
                                                    <i class="<?php echo esc_attr($service_icon)?>"></i>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>                   
                                <div class="kng-item-content-inner">
                                    <h4 class="kng-item-content-title kng-heading">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                                    </h4>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                    <?php if(!empty($settings['show_readmore'])): ?>
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore d-inline-block">
                                        <span class="kng-btn-content">
                                            <?php if(!empty($settings['readmore_text'])): ?>
                                                <i class="readmore-icon icon-chevron-right"></i>
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                            <?php endif; ?>                                           
                                        </span>
                                    </a>
                                    <?php endif; ?>          
                                </div>
                            </div>
                             
                        </div>
                        <?php 
                        break;
                    case '1-project':
                        ?>
                        <div class="kng-item-content">
                            <?php techrona_post_thumbnail([
                                    'post_id'     => $post->ID, 
                                    'size'        => $img_size,
                                    'class'   => 'w-100'
                                ]); ?>
                            <h4 class="kng-item-content-title kng-heading"> <?php echo get_the_title($post->ID); ?> </h4>
                        </div>
                        <?php 
                        break;
                    case '2-practice':
                        $bg_url = get_the_post_thumbnail_url( $post->ID, $img_size );
                        $practice_icon = get_post_meta($post->ID,'practice_icon', true ); 
                        $bg_style = !empty($bg_url) ? 'style="background-image:url('.$bg_url.');"' : '';
                        ?>
                        <div class="kng-item-content kng-transition text-center">
                            <div class="kng-item-content-inner">
                                <div class="bg-cover kng-overlay" <?php echo ''.$bg_style ?>></div>
                                <?php if(!empty($practice_icon)): ?>
                                    <div class="prac-icon"><span class="<?php echo esc_attr($practice_icon)?>"></span></div>
                                <?php endif; ?>
                                <h4 class="kng-item-content-title kng-heading"> <?php echo get_the_title($post->ID); ?> </h4>
                                <?php if( $settings['show_excerpt'] == 'yes' && (int)$settings['excerpt_lenght'] > 0): ?>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['show_readmore'])): ?>
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore d-inline-block">
                                        <span class="kng-btn-content">
                                            <?php if(!empty($settings['readmore_text'])): ?>
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                            <?php endif; ?>
                                            <span class="kng-btn-icon kngi-arrow-right-solid"></span>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            </div> 
                        </div>
                        <?php 
                        break;
                    case '3-practice':
                        ?>
                        <div class="kng-item-content kng-transition clearfix">
                            <div class="kng-featured-wrap relative empty-none"><?php 
                                techrona_post_thumbnail([
                                    'post_id'     => $post->ID, 
                                    'size'        => $img_size,
                                    'class'   => 'w-100'
                                ]);
                            $practice_icon = get_post_meta($post->ID,'practice_icon', true ); 
                            $rezo = '';
                            if($key <= 10) $rezo = '0';
                            if(!empty($practice_icon)): ?>
                                <div class="icon"><span class="<?php echo esc_attr($practice_icon)?>"></span></div>
                            <?php endif; ?></div>
                            <div class="kng-item-content-inner">
                                <span class="number-idx"><?php echo esc_html($rezo.($key + 1)) ?></span>
                                <h4 class="kng-item-content-title kng-heading">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                                </h4>
                                <?php if( $settings['show_excerpt'] == 'yes' && (int)$settings['excerpt_lenght'] > 0): ?>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                <?php endif; ?>
                                <?php if(!empty($settings['show_readmore'])): ?>
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore d-inline-block">
                                        <span class="kng-btn-content">
                                            <?php if(!empty($settings['readmore_text'])): ?>
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                            <?php endif; ?>
                                            <span class="kng-btn-icon kngi-arrow-right-solid"></span>
                                        </span>
                                    </a>
                                <?php endif; ?>
                            </div> 
                        </div>
                        <?php 
                        break;
                    case '5':  
                        ?>
                        <div class="kng-item-content kng-transition clearfix">
                            <div class="kng-featured-wrap empty-none"><?php 
                                techrona_post_media([
                                    'post_id'     => $post->ID, 
                                    'size'        => $img_size,
                                    'wrap_class'  => '',
                                    'img_class'   => 'w-100',
                                ]);
                            ?></div>
                            <div class="kng-item-content-inner">
                                <?php techrona_post_meta(['post_id' => $post->ID,'show_author' => 0,'show_cat' => 0,'show_cmt' => 1,'show_date' => 1,'show_share' => 0,'show_icon'   => true]); ?>

                                <h4 class="kng-item-content-title kng-heading">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                                </h4>
                                  
                                <?php if( $settings['show_excerpt'] == 'yes' && (int)$settings['excerpt_lenght'] > 0): ?>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(!empty($settings['show_readmore'])): ?>
                                    <div class="kng-btn-wraps kng-post-item-readmore kng-transition">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore kng-readmore d-inline-block btn-link">
                                            <span class="kng-btn-content">
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                                <span class="kng-btn-icon kngi-arrow-right-solid"></span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>  
                            </div>
                        </div>
                        <?php 
                        break;
                    case '4':
                        ?>
                        <div class="kng-item-content kng-transition relative clearfix">
                            <div class="kng-featured-wrap">
                                <?php 
                                    techrona_post_media([
                                        'post_id'     => $post->ID, 
                                        'size'        => $img_size,
                                        'wrap_class'  => '',
                                        'img_class'   => 'w-100',
                                    ]);
                                ?>
                            </div>
                            <div class="kng-overlay kng-transition"></div>
                            <div class="kng-item-content-inner">
                                <?php techrona_post_meta(['post_id' => $post->ID,'show_author' => 0,'show_cat' => 0,'show_cmt' => 1,'show_date' => 1,'show_share' => 0,'show_icon'   => true]); ?>

                                <h4 class="kng-item-content-title font-700 kng-heading">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                                </h4>
                                  
                                <?php if( $settings['show_excerpt'] == 'yes' && (int)$settings['excerpt_lenght'] > 0): ?>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(!empty($settings['show_readmore'])): ?>
                                    <div class="kng-btn-wraps kng-post-item-readmore kng-transition">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore text-uppercase d-inline-block btn-link">
                                            <span class="kng-btn-content">
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                                <span class="kng-btn-icon kngi-arrow-right-solid"></span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>  
                            </div>
                        </div>
                        <?php 
                        break;
                    case '3':
                        ?>
                        <div class="kng-item-content row gutters-30 gutters-xl-40 kng-transition clearfix">
                            <div class="kng-featured-wrap col-12 col-sm-auto empty-none"><?php 
                                techrona_post_media([
                                    'post_id'     => $post->ID, 
                                    'size'        => $img_size,
                                    'wrap_class'  => '',
                                    'img_class'   => 'w-100',
                                ]);
                            ?></div>
                            <div class="kng-item-content-inner col">
                                <?php techrona_post_meta(['post_id' => $post->ID,'show_author' => 0,'show_cat' => 0,'show_cmt' => 1,'show_date' => 1,'show_share' => 0,'show_icon'   => true]); ?>

                                <h3 class="kng-item-content-title text-30 font-700 kng-heading">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                                </h3>
                                  
                                <?php if( $settings['show_excerpt'] == 'yes' && (int)$settings['excerpt_lenght'] > 0): ?>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(!empty($settings['show_readmore'])): ?>
                                    <div class="kng-btn-wraps kng-post-item-readmore kng-transition">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore kng-readmore d-inline-block btn-link">
                                            <span class="kng-btn-content">
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                                <span class="kng-btn-icon kngi-arrow-right-solid"></span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>  
                            </div>
                        </div>
                        <?php 
                        break;
                    case '2':
                        ?>
                        <div class="kng-item-content kng-transition clearfix">
                            <div class="kng-featured-wrap empty-none"><?php 
                                techrona_post_media([
                                    'post_id'     => $post->ID, 
                                    'size'        => $img_size,
                                    'wrap_class'  => '',
                                    'img_class'   => 'w-100',
                                ]);
                                techrona_post_category([
                                    'show_icon' => false,
                                    'show_cat'  => 1,
                                    'class'     => 'col-auto empty-none',
                                    'post_id'   => $post->ID,
                                    'text'      =>  '',
                                    'taxo'      => 'category',
                                    'echo'      => true
                                ]); 
                            ?></div>
                            <div class="kng-item-content-inner">
                                <?php techrona_post_meta(['post_id' => $post->ID,'show_author' => 0,'show_cat' => 0,'show_cmt' => 1,'show_date' => 1,'show_share' => 0,'show_icon'   => true]); ?>

                                <h4 class="kng-item-content-title kng-heading">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                                </h4>
                                  
                                <?php if( $settings['show_excerpt'] == 'yes' && (int)$settings['excerpt_lenght'] > 0): ?>
                                    <div class="kng-item-content-excerpt">
                                        <?php
                                            if(!empty($post->post_excerpt)){
                                                echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            } else{
                                                $content = strip_shortcodes( $post->post_content );
                                                $content = apply_filters( 'the_content', $content );
                                                $content = str_replace(']]>', ']]&gt;', $content);
                                                echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                            }
                                        ?> 
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(!empty($settings['show_readmore'])): ?>
                                    <div class="kng-btn-wraps kng-post-item-readmore kng-transition">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore kng-readmore d-inline-block btn-link">
                                            <span class="kng-btn-content">
                                                <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                                <span class="kng-btn-icon kngi-arrow-right-solid"></span>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>  
                            </div>
                        </div>
                        <?php 
                        break;
                    case '1':
                    default: 
                    ?>
                    <div class="kng-item-content kng-transition clearfix">
                        <div class="kng-featured-wrap empty-none"><?php 
                            techrona_post_media([
                                'post_id'     => $post->ID, 
                                'size'        => $img_size,
                                'wrap_class'  => '',
                                'img_class'   => 'w-100',
                            ]);
                            if(!empty($settings['show_readmore'])): ?>
                                <div class="kng-btn-wraps kng-post-item-readmore kng-transition">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>" class="kng-readmore kng-readmore d-inline-block btn">
                                        <span class="kng-btn-content">
                                            <span class="kng-btn-text"><?php echo esc_html($settings['readmore_text']); ?></span>
                                            <span class="kng-btn-icon kngi-arrow-right-solid"></span>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; 
                        ?></div>
                        <div class="kng-item-content-inner">
                            <?php techrona_post_meta(['post_id' => $post->ID,'show_author' => 1,'show_cat' => 0,'show_cmt' => 0,'show_date' => 0,'show_share' => 0,'show_icon'   => true]); ?>
                            <div class="kng-item-content-title kng-heading">
                                <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                            </div>
                              
                            <?php if( $settings['show_excerpt'] == 'yes' && (int)$settings['excerpt_lenght'] > 0): ?>
                                <div class="kng-item-content-excerpt">
                                    <?php
                                        if(!empty($post->post_excerpt)){
                                            echo wp_trim_words( $post->post_excerpt, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                        } else{
                                            $content = strip_shortcodes( $post->post_content );
                                            $content = apply_filters( 'the_content', $content );
                                            $content = str_replace(']]>', ']]&gt;', $content);
                                            echo wp_trim_words( $content, $settings['excerpt_lenght'], $settings['excerpt_more_text'] );
                                        }
                                    ?> 
                                </div>
                            <?php endif; ?>
                            <?php techrona_post_meta(['post_id' => $post->ID,'show_author' => 0,'show_cat' => 0,'show_cmt' => 1,'show_date' => 1,'show_share' => 0,'show_icon'   => true, 'class' => 'kng-meta-bottom']); ?>
                            
                        </div>
                    </div>
                    <?php 
                    break;
                    } ?>
            </div>
        <?php
        endforeach;
        if( isset($masonry_mode) && $masonry_mode == 'masonry')
            echo '<div class="kng-grid-sizer"></div>' ;
    }
}
 
// Load More Post
if(!function_exists('techrona_load_more_post_grid')){
    add_action( 'wp_ajax_techrona_load_more_post_grid', 'techrona_load_more_post_grid' );
    add_action( 'wp_ajax_nopriv_techrona_load_more_post_grid', 'techrona_load_more_post_grid' );
    function techrona_load_more_post_grid(){
        try{
            if(!isset($_POST['settings'])){
                throw new Exception(__('Something went wrong while requesting. Please try again!', 'techrona'));
            }
            $settings = wp_unslash($_POST['settings']);
            
            set_query_var('paged', $settings['paged']);
            extract(kng_get_posts_of_grid($settings['post_type'], [
                'source'   => isset($settings['source'])?$settings['source']:'',
                'orderby'  => isset($settings['orderby'])?$settings['orderby']:'date',
                'order'    => isset($settings['order'])?$settings['order']:'desc',
                'limit'    => isset($settings['limit'])?$settings['limit']:'6',
                'post_ids' => '',
            ]));
            ob_start();
                techrona_get_post_grid($posts, $settings);
            $html = ob_get_clean();
            wp_send_json(
                array(
                    'status' => true,
                    'message' => __('Load Post Grid Successfully!', 'techrona'),
                    'data' => array(
                        'html'  => $html,
                        'paged' => $settings['paged'],
                        'posts' => $posts,
                    ),
                )
            );
        }
        catch (Exception $e){
            wp_send_json(array('status' => false, 'message' => $e->getMessage()));
        }
        die;
    }
}
if(!function_exists('techrona_get_project_grid')){
    function techrona_get_project_grid($posts = [], $settings = [], $args = []){
        
        if(empty($posts) || !is_array($posts) || empty($settings) || !is_array($settings)){
            return false;
        }

        extract($settings);
        $settings['gap_extra'] = empty($settings['gap_extra']) ? '0' : $settings['gap_extra'];
        //style
        $style = 'style="';

        if(isset($settings['masonry_mode']) && $settings['gap'] !== 0){
            $style .= 'padding:'.($settings['gap']/2).'px;';
        }
        if($settings['gap_extra']!== '0'){
            $style .= 'margin-bottom:'.$settings['gap_extra'].'px;';
        }
        $style .= '"';   
       
        foreach ($posts as $key => $post):   
            $filter_class = kng_get_term_of_post_to_class($post->ID, array_unique($tax));            
            $item_class = 'kng-grid-item col-4';
            $img_size = '370x450';
            if ( $key == 3 || $key == 4) {
                $item_class = 'kng-grid-item col-6';
                $img_size = '570x390';
            }
            ?>
            <div class="<?php echo trim(implode(' ', [$item_class, $filter_class])); ?>" <?php kng_print_html($style); ?>>           
                <div class="kng-item-content kng-transition clearfix">
                    <div class="img-layer">
                        <a class="img-button" href="#">
                            <i class="icon-full-screen"></i>
                        </a>
                    </div>
                    <div class="kng-featured-wrap empty-none"><?php 
                    if (has_post_thumbnail($post->ID)) {
                        techrona_post_media([
                            'post_id'     => $post->ID, 
                            'size'        => $img_size,
                            'wrap_class'  => '',
                            'img_class'   => 'w-100',
                        ]);
                    }else{ ?>
                        <img src="<?php echo get_template_directory_uri().'/assets/images/'.$img_size.'.png' ?>">
                    <?php }                       
                    ?>                        
                    </div>
                    <div class="kng-item-content-inner">
                        <div class="kng-item-content-title kng-heading">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo get_the_title($post->ID); ?></a>
                        </div>
                        <?php techrona_post_category([
                            'taxo'       => 'project-category',        
                            'post_id'    => $post->ID
                        ]) ?>                             
                    </div>
                </div>   
            </div>
        <?php
        endforeach;
        if( isset($masonry_mode) && $masonry_mode == 'masonry')
            echo '<div class="kng-grid-sizer"></div>' ;
    }
} 