<?php 

?>
<div class="kng-imgs-box layout-<?php echo esc_attr($settings['layout'])?>">
	<div class="kng-imgs-box-content relative">
		<?php 
		$img1_prefix = 'img_box_1_';
		$img2_prefix = 'img_box_2_';
		$img3_prefix = 'img_box_3_';
		$img4_prefix = 'img_box_4_';
		$img5_prefix = 'img_box_5_';

		if(!empty($settings[$img1_prefix.'image']['url'])){
	 		$img1_attrs = [];
			$img1_cls = ['kng-banner-static absolute'];
			$img1_cls[] = $img1_prefix.'idx '.$settings[$img1_prefix.'class'];
			$img1_cls[] = techrona_elementor_responsive_render($settings, ['prefix' => $img1_prefix]);

			$img1_attrs['data-settings'] = '';
			if ( $settings[$img1_prefix.'animation'] ) {
				$img1_cls[] = 'kng-animate kng-invisible';
				$img1_attrs['data-settings'] = json_encode([
			        'animation'      => $settings[$img1_prefix.'animation'],
			        'animation_delay' => $settings[$img1_prefix.'delay']
			    ]);
			}
			$img1_attrs['class'] = trim(implode(' ', $img1_cls));
			techrona_elementor_image_render($settings,$widget, [
				'id'     => $img1_prefix.'image',
				'before' => '<div class="'.esc_attr($img1_attrs['class']).' xs-relative" data-settings="'.esc_attr($img1_attrs['data-settings']).'">',
				'after'  => '</div>'
			]);
		}

		if(!empty($settings[$img2_prefix.'image']['url'])){
	 		$img2_attrs = [];
			$img2_cls = ['kng-banner-static absolute'];
			$img2_cls[] = $img2_prefix.'idx '.$settings[$img2_prefix.'class'];
			$img2_cls[] = techrona_elementor_responsive_render($settings, ['prefix' => $img2_prefix]);

			$img2_attrs['data-settings'] = '';
			if ( $settings[$img2_prefix.'animation'] ) {
				$img2_cls[] = 'kng-animate kng-invisible';
				$img2_attrs['data-settings'] = json_encode([
			        'animation'      => $settings[$img2_prefix.'animation'],
			        'animation_delay' => $settings[$img2_prefix.'delay']
			    ]);
			}
			$img2_attrs['class'] = trim(implode(' ', $img2_cls));
			techrona_elementor_image_render($settings,$widget, [
				'id'     => $img2_prefix.'image',
				'before' => '<div class="'.esc_attr($img2_attrs['class']).' xs-relative" data-settings="'.esc_attr($img2_attrs['data-settings']).'">',
				'after'  => '</div>'
			]);
		}

		if(!empty($settings[$img3_prefix.'image']['url'])){
	 		$img3_attrs = [];
			$img3_cls = ['kng-banner-static absolute'];
			$img3_cls[] = $img3_prefix.'idx '.$settings[$img3_prefix.'class'];
			$img3_cls[] = techrona_elementor_responsive_render($settings, ['prefix' => $img3_prefix]);

			$img3_attrs['data-settings'] = '';
			if ( $settings[$img3_prefix.'animation'] ) {
				$img3_cls[] = 'kng-animate kng-invisible';
				$img3_attrs['data-settings'] = json_encode([
			        'animation'      => $settings[$img3_prefix.'animation'],
			        'animation_delay' => $settings[$img3_prefix.'delay']
			    ]);
			}
			$img3_attrs['class'] = trim(implode(' ', $img3_cls));
			techrona_elementor_image_render($settings,$widget, [
				'id'     => $img3_prefix.'image',
				'before' => '<div class="'.esc_attr($img3_attrs['class']).' xs-relative" data-settings="'.esc_attr($img3_attrs['data-settings']).'">',
				'after'  => '</div>'
			]);
		}

		if(!empty($settings[$img4_prefix.'image']['url'])){
	 		$img4_attrs = [];
			$img4_cls = ['kng-banner-static absolute'];
			$img4_cls[] = $img4_prefix.'idx '.$settings[$img4_prefix.'class'];
			$img4_cls[] = techrona_elementor_responsive_render($settings, ['prefix' => $img4_prefix]);

			$img4_attrs['data-settings'] = '';
			if ( $settings[$img4_prefix.'animation'] ) {
				$img4_cls[] = 'kng-animate kng-invisible';
				$img4_attrs['data-settings'] = json_encode([
			        'animation'      => $settings[$img4_prefix.'animation'],
			        'animation_delay' => $settings[$img4_prefix.'delay']
			    ]);
			}
			$img4_attrs['class'] = trim(implode(' ', $img4_cls));
			techrona_elementor_image_render($settings,$widget, [
				'id'     => $img4_prefix.'image',
				'before' => '<div class="'.esc_attr($img4_attrs['class']).' xs-relative" data-settings="'.esc_attr($img4_attrs['data-settings']).'">',
				'after'  => '</div>'
			]);
		}

		if(!empty($settings[$img5_prefix.'image']['url'])){
	 		$img5_attrs = [];
			$img5_cls = ['kng-banner-static absolute'];
			$img5_cls[] = $img5_prefix.'idx '.$settings[$img5_prefix.'class'];
			$img5_cls[] = techrona_elementor_responsive_render($settings, ['prefix' => $img5_prefix]);

			$img5_attrs['data-settings'] = '';
			if ( $settings[$img5_prefix.'animation'] ) {
				$img5_cls[] = 'kng-animate kng-invisible';
				$img5_attrs['data-settings'] = json_encode([
			        'animation'      => $settings[$img5_prefix.'animation'],
			        'animation_delay' => $settings[$img5_prefix.'delay']
			    ]);
			}
			$img5_attrs['class'] = trim(implode(' ', $img5_cls));
			techrona_elementor_image_render($settings,$widget, [
				'id'     => $img5_prefix.'image',
				'before' => '<div class="'.esc_attr($img5_attrs['class']).' xs-relative" data-settings="'.esc_attr($img5_attrs['data-settings']).'">',
				'after'  => '</div>'
			]);
		}
		?>
	</div>
</div> 
			 