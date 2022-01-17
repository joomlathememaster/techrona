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
<div class="kng-search-wrap d-flex layout-<?php echo esc_attr($layout) ?> <?php echo esc_attr(implode(' ', $content_aligns)) ?>">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="kng-search-inner d-flex gutters-10 gutters-grid">
			<div class="col-12 col-sm-auto">
	        	<input type="search" class="search-field" placeholder="<?php echo esc_attr( $settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" /><span class="kng-icon-search kngi-search-400"></span>
	        	<button type="submit" class="search-submit-xs btn-large d-sm-none" value=""><span class="kngi-search-400"></span></button>
	        </div>
	        <div class="col-12 col-sm-auto d-none d-sm-block">
	        	<button type="submit" class="search-submit btn-large" value=""><?php echo esc_html__( 'Search Now', 'techrona' ) ?><span class="kng-icon kngi-arrow-right-solid"></span></button>
	        </div>
        </div>
    </form>
</div>
 