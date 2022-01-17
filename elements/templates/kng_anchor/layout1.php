<?php
$side_panel = $widget->get_setting('side_panel','side-mobile');
  
$content_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'align',
    'type-prefix' => 'justify-content-',
]);
  
$widget->add_render_attribute('anchor', 'class', 'kng-anchor side-panel d-flex align-items-center');

$target = '.kng-'.$side_panel;

?>
<div class="kng-anchor-wrap d-flex <?php echo esc_attr(trim(implode(' ', $content_align))) ?>">
	<a href="#kng-<?php echo esc_attr($side_panel)?>" <?php kng_print_html($widget->get_render_attribute_string( 'anchor' )); ?> data-target="<?php echo esc_attr($target)?>">
	    <?php 
	    if( $widget->get_setting('icon_type','none') == 'lib'){
	        techrona_elementor_icon_render($settings,[
	            'wrap_class'   => 'kng-anchor-icon',
	            'class'        => 'lh-1',
	            'default_icon' => [
	            	'library' => 'awesome',
	            	'value'   => 'fas fa-bars'
	            ]
	        ]);
	    }
	    if($widget->get_setting('icon_type','none') == 'custom'){
	    	echo '<div class="kng-icon lh-1 kng-anchor-icon custom kng-bars"><span></span><span></span><span></span></div>';
	    } 
	    if(!empty($widget->get_setting('title',''))){
	    	echo '<span class="anchor-title">'.$widget->get_setting('title', '').'</span>';
	    } ?>
	</a>
</div>
<?php 
 
add_action( 'kng_anchor_target', 'techrona_hook_anchor_'.str_replace('-', '_', $side_panel) );
 
?>