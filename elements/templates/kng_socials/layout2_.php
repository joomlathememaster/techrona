<?php
	
	$kng_align = techrona_get_class_breakpoints($settings, [
	    'prefix' => 'row_align',
	    'type-prefix' => 'justify-content-',
	]);
	$widget->add_render_attribute( 'socials-wrap', 'class', 'row gutters-30 gutters-grid '.trim(implode(' ', $kng_align)));
 
?>
<div class="kng-socials-wrap layout-2">
	<div <?php kng_print_html($widget->get_render_attribute_string( 'socials-wrap' )); ?>>
		<?php foreach ($settings['social_list'] as $value): 
			$link_attrs = [];
			if ( ! empty( $value['social_link']['url'] ) ) {
				$link_attrs['href'] = $value['social_link']['url'];
			}
		    if ( ! empty($value['social_link']['is_external'] )) {
		        $link_attrs['target'] = '_blank';
		    }
		    if ( ! empty($value['social_link']['nofollow'] )) {
		        $link_attrs['rel'] = 'nofollow';
		    }
		    if( ! empty($value['social_link']['custom_attributes'])){
		    	$custom_attributes = explode('|', $value['social_link']['custom_attributes']);
		    	foreach ($custom_attributes as $atts_value) {
		    		$_custom_attributes = explode(':', $atts_value);
		    		$link_attrs[$_custom_attributes[0]] = $_custom_attributes[1];
		    	}
		    }
			$icon_color       = $widget->get_setting('social_icon_color', '');
			$icon_color_hover = $widget->get_setting('social_icon_color_hover', '');
			$bg_color         = $widget->get_setting('social_bg_color', '');
			$bg_color_hover   = $widget->get_setting('social_bg_color_hover', '');
			 
			$icon_shape		  = $widget->get_setting('social_shape', '');
		?>
		<div class="kng-social kng-social-item col-auto">
			<?php 
	        	techrona_elementor_icon_render($settings,
	        		[
		        		'tag'		 => 'a',		
						'id'         => $value['social_icon'],
						'loop'       => true,
						'wrap_class' => 'text-center bg-'.$bg_color.' bg-hover-'.$bg_color_hover.' kng-'.$icon_shape. ' text-'.$icon_color.' text-hover-'.$icon_color_hover,
						'class'      => '',
						'atts'	     => $link_attrs
		        	]
		        );
	        ?>
		</div>    
		<?php endforeach; ?>
	</div>
</div>