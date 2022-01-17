<?php
/**
 * The searchform.php template.
 *
 */
$search_placeholder = techrona_get_opts('search_field_placeholder', esc_html__('Search&hellip;', 'techrona'));
?>
<form role="search" method="get" class="kng-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="kng-search-field" placeholder="<?php echo esc_attr( $search_placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="kng-search-submit" value=""><span class="icon-search1"></span></button>
</form>