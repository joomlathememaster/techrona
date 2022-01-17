<?php 
$default_settings = [
	'layout'	=> '1',
    'placeholder' => '',
];

$content_aligns = techrona_get_class_breakpoints($settings, [
	'prefix' => 'content_align',
	'type-prefix' => 'justify-content-',
]);

$settings = array_merge($default_settings, $settings);
extract($settings); 

?>
<div class="kng-search-wrap layout-<?php echo esc_attr($layout) ?> <?php echo esc_attr(implode(' ', $content_aligns)) ?>">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    	<input type="search" class="search-field" placeholder="<?php echo esc_attr( $settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" />  
    	<button type="submit" class="search-submit btn-large" value="">
    		<span class="search-icon icon-search1"></span>
    	</button>
    </form>
</div>
 