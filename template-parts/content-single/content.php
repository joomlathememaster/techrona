<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Soapee
 */
$sidebar = techrona_sidebar_position();
$post_feature_image_type = techrona_get_theme_opt('post_feature_image_type','cropped');
if($post_feature_image_type == 'cropped'){
    if(in_array($sidebar, ['0','none', 'bottom'])){
        $thumbnail_size = 'post-thumbnail';
    } else {
        $thumbnail_size = 'large';
    }
}else if($post_feature_image_type == 'full'){
    $thumbnail_size = 'full';
}else{
    $thumbnail_size = 'large';
}
 
if(has_post_thumbnail()){
    $content_inner_cls = 'kng-single-post-inner kng-post-has-thumbnail';
    $meta_class    = ''; 
    $categories = true;
} else {
    $content_inner_cls = 'kng-single-post-inner  kng-post-no-thumbnail';
    $meta_class = '';
    $categories = false;
}
if(class_exists('\Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor( get_the_ID() )){
    $post_content_classes = 'single-elementor-content';
} else {
    $post_content_classes = '';
}
 
?>
<div <?php post_class('kng-single-post'); ?>>
    
    <div class="<?php echo esc_attr($content_inner_cls);?>">
        <?php techrona_post_media(['size' => 'large' ]);  ?>
        <div class="content-wrap">
            <div class="content-inner">
                <?php            
                    techrona_post_meta([
                        'show_author' => true,
                        'show_cat'    => $categories,
                        'show_date'   => techrona_get_opts('post_date_on','1'),
                        'show_cmt'    => techrona_get_opts('post_comments_on','1'),
                        'show_share'  => techrona_get_theme_opt( 'post_share_this', '1' ),
                        'show_icon'   => true,
                        'class'       => 'kng-meta-before'.$meta_class,
                        'separator'   => ''
                    ]);
                    techrona_post_title(['tag' => 'h3']);
                  
                ?>
                <div class="overflow-hidden">
                    <div class="kng-post-content clearfix <?php echo esc_attr($post_content_classes);?>">
                    <?php
                        the_content();
                    ?>                    
                    </div>
                    
                </div>
            </div>
            <div class="kng-post-tags-share row gutters-20 justify-content-between empty-none"><?php
                techrona_post_tagged_in([
                    'show_tag'  => techrona_get_opts( 'post_tags_on', '1' ), 
                    'title'     => '',
                    'style'     => 'tagcloud', 
                    'separator' => '',
                    'class'     => 'col-auto'
                ]);
                techrona_socials_share_default([
                    'class'             => 'gutters-16 gutters-grid justify-content-between',
                    'show_share'        => techrona_get_opts( 'post_social_share_on', '0' ),
                    'icons_share'       => techrona_get_opts( 'post_social_share_icon', [] ),   
                    'title'             => '<div class="col-auto"><div class="text-heading">'.esc_html__('Share This Post:','techrona').'</div></div>',
                    'social_class'      => 'kng-socials',
                    'social_item_class' => 'circle',
                    'before'            => '<div class="col-auto">',
                    'after'             => '</div>'
                ]);
            ?>                    
            </div>
        </div>
    </div>
</div>