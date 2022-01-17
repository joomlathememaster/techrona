<?php
/**
 * The template for displaying all single posts
 */
get_header();
?>
<div class="container kng-content-container">
    <div class="row kng-content-row">
        <div id="kng-content-area" class="<?php techrona_content_css_class(['content_col'=> 'single_content_col','sidebar_pos' => 'single_sidebar_pos']); ?>">
            <div class="kng-single-post-wrap">
            <?php
                while ( have_posts() )
                {
                    the_post();
                    get_template_part( 'template-parts/content-single/content', get_post_format() );
                    if ( comments_open() || get_comments_number() ){
                        comments_template();
                    }
                }

            ?>
            </div>
        </div>
        <?php techrona_sidebar(['content_col'=> 'single_content_col','sidebar_pos' => 'single_sidebar_pos']); ?>
    </div>
</div> 
<?php
get_footer();
