<?php
/**
 * The template for displaying all single KNG Footer
 *
 */
get_header();
while ( have_posts() )
{
    the_post();
    the_content();
}
get_footer();
