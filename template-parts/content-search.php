<?php
/**
 * Template part for displaying posts in loop
 *
 */
$link_style = '';
if(has_post_thumbnail()){
    $class = 'kng-has-post-thumbnail';
    $meta_class = '';
    if(get_post_format() == 'link')
        $link_style = 'style="background-image:url('.get_the_post_thumbnail_url().')"';
} else {
    $class = 'kng-no-post-thumbnail';
    $meta_class = '';
}
 
?>
<div <?php post_class('kng-post-archive'); ?> <?php echo techrona_html($link_style) ?>>
    <div class="kng-post-content <?php echo esc_attr($class);?>"><?php
        techrona_post_title();
        techrona_post_excerpt(['class' => 'mb-26', 'length' => 15]);
        techrona_post_link_pages(['class' => 'pb-26']);
        techrona_post_meta(['show_author' => 0,'show_cat' => 0,'show_cmt' => 1,'show_date' => 1,'show_share' => 1,'show_icon'   => true, 'class' => 'kng-meta-bottom']);
    ?></div>
</div>