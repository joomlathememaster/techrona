<?php
/**
 * Template Name: Blog Classic
 *
 * @package techrona
 */

get_header();
?>
<div class="container kng-content-container blog-classic">
    <div class="row kng-content-row">
        <div id="kng-content-area" class="<?php techrona_content_css_class(); ?> ">
            <?php 
            global $wp_query, $paged;
            $wp_query->query('post_type=post&showposts='.get_option('posts_per_page').'&paged='.$paged);
            if ( have_posts() ) { ?>
                <div class="kng-content-archive">
                    <?php 
                    
                    while ( have_posts() ){
                            the_post();
                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called loop-post-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'template-parts/content' );
                        }
                    ?>
                </div>
            <?php   
                techrona_posts_pagination();
            } else {
                get_template_part( 'template-parts/content', 'none' );
            }
            ?>
        </div>
        <?php techrona_sidebar(['class' => '']); ?>
    </div>
</div>
<?php
get_footer();