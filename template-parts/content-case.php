<?php
/**
 * Template part for displaying posts in loop
 *
 */
 
if(has_post_thumbnail()){
    $class = 'kng-has-post-thumbnail';
    $meta_class = '';
} else {
    $class = 'kng-no-post-thumbnail';
    $meta_class = '';
}
 
?>
<div <?php post_class('kng-case-archive'); ?>>
    <div class="kng-featured-wrap relative">
        <?php 
            techrona_post_media([
                'size'       => 'medium_large',
            ]);
        ?>
        <div class="kng-overlay kng-transition"></div>
        <a href="<?php echo esc_url(get_permalink( get_the_ID() )); ?>" class="kng-readmore d-inline-block">
        	<span class="kng-btn-content">
            <span class="kng-btn-icon kngi-arrow-right-solid"></span>
            </span>
        </a>
    </div>
    <div class="kng-item-content-inner text-center">
        <h4 class="kng-item-content-title kng-heading">
            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a>
        </h4>
        <div class="kng-item-category">
            <?php the_terms( get_the_ID(), 'case-category', '', ' ', '' ); ?>  
        </div>
    </div> 
</div>