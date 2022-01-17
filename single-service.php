<?php
/**
 * The template for displaying all single events
 */
get_header(); 
?>
    <div class="container kng-content-container">
    <div class="row kng-content-row">
        <div id="kng-content-area" class="<?php techrona_content_css_class(['content_col'=> 'single_service_content_col','sidebar_pos' => 'single_service_sidebar_pos']); ?>">
            <div class="kng-single-service-wrap">
            <?php
                while ( have_posts() )
                {
                    the_post();
                    // if (has_post_thumbnail()){
                    //     the_post_thumbnail('large');
                    // }
                    // techrona_post_title(['tag' => 'h3']); 
                    ?>  
                    <div class="kng-post-content clearfix"> 
                       <?php the_content(); ?> 
                    </div>
                    <?php 
                    if ( comments_open() || get_comments_number() ){
                        comments_template();
                    }
                }

            ?>
            </div>
        </div>
        <?php techrona_sidebar(['content_col'=> 'single_service_content_col','sidebar_pos' => 'single_service_sidebar_pos','class' => 'service-sidebar']); ?>
    </div>
</div>
<?php
get_footer(); ?>

