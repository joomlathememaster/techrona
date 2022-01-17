<?php	
	$kng_align = techrona_get_class_breakpoints($settings, [
	    'prefix' => 'row_align',
	    'type-prefix' => 'justify-content-',
	]);
	$widget->add_render_attribute( 'socials-wrap', 'class', 'row gutters-8 gutters-grid '.trim(implode(' ', $kng_align))); 
	$color = $widget->get_setting('color_t');
	techrona_inline_styles(['box-shadow'=> $color]);
?>
<div class="kng-socials layout-2">
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
			// $icon_color       = $widget->get_setting('social_icon_color', 'secondary');
			// $icon_color_hover = $widget->get_setting('social_icon_color_hover', 'white');
			// $bg_color         = $widget->get_setting('social_bg_color', 'transparent');
			// $bg_color_hover   = $widget->get_setting('social_bg_color_hover', 'accent');
			 
			// $icon_shape		  = $widget->get_setting('social_shape', 'circle');
		?>
		<div class="kng-social kng-social-item col-auto">
			<?php 
	        	techrona_elementor_icon_render($settings,
	        		[
		        		'tag'		 => 'i',		
						'id'         => $value['social_icon'],
						'loop'       => true,
						'wrap_class' => 'text-center',
						'class'      => '',
						'atts'	     => $link_attrs
		        	]
		        );
	        ?>
		</div>    
		<?php endforeach; ?>
	</div>
</div>