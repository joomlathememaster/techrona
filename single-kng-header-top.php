<?php
/**
 * The template for displaying all single KNG Header top
 */
get_header();
	while ( have_posts() )
	{
	    the_post();
	    the_content();
	}
get_footer();
