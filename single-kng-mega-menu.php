<?php
/**
 * The template for displaying all single KNG Footer
 *
 */
get_header();
?>
<div class="container kng-content-container">
    <?php
        while ( have_posts() )
        {
            the_post();
            the_content();
        }
    ?>
</div>
<?php
get_footer();
