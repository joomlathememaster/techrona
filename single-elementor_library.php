<?php
/**
 * The main template file
 *
 */
get_header();
?>
<div class="container kng-content-container">
    <div class="row kng-content-row">
        <div id="kng-content-area" class="col-12">
            <?php if ( have_posts() ) { ?>
                <div class="kng-content-el">
                    <?php while ( have_posts() )
                        {
                            the_post();
                            get_template_part( 'template-parts/content', 'elementor-lib' );
                        }
                    ?>
                </div>
            <?php }
            ?>
        </div>
    </div>
</div>
<?php
get_footer();
 