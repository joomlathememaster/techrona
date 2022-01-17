<?php
/**
 * The template for displaying all single events
 */
get_header(); 
$show_feature_image = techrona_get_theme_opt('show_practice_feature_image','0');
$show_title = techrona_get_theme_opt('show_practice_title','0');
?>
    <div class="container kng-content-container">
    <div class="row kng-content-row">
        <div id="kng-content-area" class="<?php techrona_content_css_class(['content_col'=> 'single_practice_content_col','sidebar_pos' => 'single_practice_sidebar_pos']); ?>">
            <div class="kng-single-practice-wrap">
            <?php
                while ( have_posts() )
                {
                    the_post();
                    if (has_post_thumbnail() && $show_feature_image == '1'){
                        echo '<div class="feature-img">';
                        the_post_thumbnail('large');
                        echo '</div>';
                    }
                    if( $show_title == '1' )
                        techrona_post_title(['tag' => 'h3']); 
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
        <?php techrona_sidebar(['content_col'=> 'single_practice_content_col','sidebar_pos' => 'single_practice_sidebar_pos','class' => 'practice-sidebar']); ?>
    </div>
</div>
<?php
get_footer(); ?>

