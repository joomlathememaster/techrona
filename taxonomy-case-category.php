<?php
/**
 * The main template file
 *
 */
get_header();
?>
<div class="container kng-content-container">
    <div class="row kng-content-row">
        <div id="kng-content-area" class="<?php techrona_content_css_class(['content_col'=> 'archive_case_content_col','sidebar_pos' => 'archive_case_sidebar_pos']); ?>">
            <?php if ( have_posts() ) { ?>
                <div class="kng-case-grid row relative animation-time">
                <?php while ( have_posts() )
                    {
                        the_post();
                        ?>
                        <div class="kng-grid-item col-sm-6 family-case">  
                            <?php  get_template_part( 'template-parts/content','case' ); ?>
                        </div>
                        <?php 
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
        <?php techrona_sidebar(['content_col'=> 'archive_case_content_col','sidebar_pos' => 'archive_case_sidebar_pos','class' => 'case-sidebar']); ?>
    </div>
</div>
<?php
get_footer();
