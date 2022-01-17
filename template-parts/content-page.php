<?php
/**
 * Template part for displaying page content in page.php
 *
 */
?>
<div <?php post_class('kng-single-page clearfix'); ?>><?php 
	the_content();
?></div>
<?php 
	techrona_post_link_pages(); 
?>
