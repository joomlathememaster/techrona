<?php 
$slider_settings_class = ['kng-slider-container'];
if($widget->get_setting('slide_direction') === 'vertical') $slider_settings_class[] = 'overflow-hidden';
$slider_settings_class = implode(' ', $slider_settings_class);

$number_of_slider = (int)$settings['number_of_slider'];

$container_cls = $widget->get_setting('content_width', 'container');

 
?>
<div class="kng-sliders-wrap">
	<div <?php techrona_swiper_slider_settings($widget, ['swiper_container' => $slider_settings_class]); ?>>
		<?php techrona_swiper_slider_arrows_top($settings); ?>
        <div class="kng-swiper-slider swiper-wrapper">
			<?php 
				 
				for( $i=1; $i <= $number_of_slider; $i++){
					/*$data_id = $slide['_id'];*/
					 
					$cs_prefix = 'content_slide_'.$i.'_';
					$static_layer_prefix = 'static_slide_'.$i.'_';

			        $content_position = techrona_get_class_breakpoints($settings, [
			        	'prefix' => $cs_prefix.'content_position',
			        	'type-prefix' => 'justify-content-',
			        ]);

			        $content_align = techrona_get_class_breakpoints($settings, [
			        	'prefix' => $cs_prefix.'content_align',
			        	'type-prefix' => 'text-',
			        ]);
  
			        $align_self = techrona_get_class_breakpoints($settings, [
			        	'prefix' => $cs_prefix.'align_self',
			        	'type-prefix' => 'align-self-',
			        ]);
			           
					// small heading 
					$small_heading_animation = !empty($settings[$cs_prefix.'small_heading_animation']) ? $settings[$cs_prefix.'small_heading_animation'] : 'fadeInLeft';
					$small_heading_animation_delay = !empty($settings[$cs_prefix.'small_heading_animation_delay']) ? $settings[$cs_prefix.'small_heading_animation_delay'] : 300;
					$small_heading_color = !empty($settings[$cs_prefix.'small_heading_color']) ? $settings[$cs_prefix.'small_heading_color'] : 'white';
					$small_heading_reponsive = techrona_elementor_responsive_render($settings, ['prefix' => $cs_prefix.'small_heading_']);

					// large heading
					$large_heading_animation = !empty($settings[$cs_prefix.'large_heading_animation']) ? $settings[$cs_prefix.'large_heading_animation'] : 'fadeInLeft';
					$large_heading_animation_delay = !empty($settings[$cs_prefix.'large_heading_animation_delay']) ? $settings[$cs_prefix.'large_heading_animation_delay'] : 600;
					$large_heading_color = !empty($settings[$cs_prefix.'large_heading_color']) ? $settings[$cs_prefix.'large_heading_color'] : 'white';

					// medium heading 
					$medium_heading_animation = !empty($settings[$cs_prefix.'medium_heading_animation']) ? $settings[$cs_prefix.'medium_heading_animation'] : 'fadeInLeft';
					$medium_heading_animation_delay = !empty($settings[$cs_prefix.'medium_heading_animation_delay']) ? $settings[$cs_prefix.'medium_heading_animation_delay'] : 300;
					$medium_heading_color = !empty($settings[$cs_prefix.'medium_heading_color']) ? $settings[$cs_prefix.'medium_heading_color'] : 'white';
					$medium_heading_reponsive = techrona_elementor_responsive_render($settings, ['prefix' => $cs_prefix.'medium_heading_']);

					// Description
					$description_animation = !empty($settings[$cs_prefix.'description_animation']) ? $settings[$cs_prefix.'description_animation'] : 'fadeInLeft';
					$description_animation_delay = !empty($settings[$cs_prefix.'description_animation_delay']) ? $settings[$cs_prefix.'description_animation_delay'] : 900;
					$description_color = !empty($settings[$cs_prefix.'description_color']) ? $settings[$cs_prefix.'description_color'] : 'white';
					$description_heading_reponsive = techrona_elementor_responsive_render($settings, ['prefix' => $cs_prefix.'description_']);
					 
					// Button Video
					$btn_video_animation = !empty($settings[$cs_prefix.'btn_video_animation']) ? $settings[$cs_prefix.'btn_video_animation'] : 'fadeInRight';
					$btn_video_animation_delay = !empty($settings[$cs_prefix.'btn_video_animation_delay']) ? $settings[$cs_prefix.'btn_video_animation_delay'] : 1200;
					// Build Attributes
  
					$small_heading_attrs = [
						'class' => 'small-heading relative mb-10 align-items-center text-22 font-700 text-'.$small_heading_color.' '.$small_heading_reponsive.' kng-animate kng-invisible',
						'data-settings' => json_encode([
					        'animation'      => $small_heading_animation,
					        'animation_delay' => $small_heading_animation_delay
					    ])
					];
					$large_heading_attrs = [
						'class' => 'large-heading text-40 text-sm-50 text-md-60 text-lg-80 text-xl-110 lh-1-09090909091 font-700 heading-font-family mb-12 text-'.$large_heading_color.'  kng-animate kng-invisible',
						'data-settings' => json_encode([
					        'animation'      => $large_heading_animation,
					        'animation_delay' => $large_heading_animation_delay
					    ])
					];
					$medium_heading_attrs = [
						'class' => 'medium-heading align-items-center text-24 font-400 text-'.$medium_heading_color.' '.$medium_heading_reponsive.' kng-animate kng-invisible',
						'data-settings' => json_encode([
					        'animation'      => $medium_heading_animation,
					        'animation_delay' => $medium_heading_animation_delay
					    ])
					];
					$description_attrs = [
						'class' => 'description text-17 text-'.$description_color.' '.$description_heading_reponsive.' kng-animate kng-invisible',
						'data-settings' => json_encode([
					        'animation'      => $description_animation,
					        'animation_delay' => $description_animation_delay
					    ])
					];
 
					?>
					<div class="kng-slider-item swiper-slide <?php echo esc_attr($cs_prefix.'item')?>">
						<?php if(!empty($settings[$cs_prefix.'image']['url'])): ?>
						<div class="kng-slide-img kng-overlay">
							<img src="<?php echo esc_url($settings[$cs_prefix.'image']['url']);?>" alt="<?php echo get_bloginfo('name');?>" class="w-100 h-100 img-cover" />
						</div>
						<?php endif; ?>
						<div class="kng-slide-overlay kng-overlay"></div>
						<div class="kng-slide-content kng-overlay <?php echo esc_attr($container_cls)?>">
							<?php 
								for($j=1; $j<=5; $j++){ 
									$static_layer_img_prefix = $static_layer_prefix.'img_layer_'.$j.'_';
									 
									if(!empty($settings[$static_layer_img_prefix.'image']['url'])){
 
										$img_layer_attrs = [];
										$img_cls = ['kng-slide-static-layer absolute'];
										$img_cls[] = $static_layer_img_prefix.'idx ';
										$img_cls[] = techrona_elementor_responsive_render($settings, ['prefix' => $static_layer_img_prefix]);
										//$img_layer_attrs['class'] = 'kng-slide-static-layer absolute '.$static_layer_img_prefix.'idx '.$res_cls;
										$img_layer_attrs['data-settings'] = '';
										if ( $settings[$static_layer_img_prefix.'animation'] ) {
											$img_cls[] = 'kng-animate kng-invisible';
											$img_layer_attrs['data-settings'] = json_encode([
										        'animation'      => $settings[$static_layer_img_prefix.'animation'],
										        'animation_delay' => $settings[$static_layer_img_prefix.'delay']
										    ]);
										}
										if(!empty($settings[$static_layer_img_prefix.'class']))
											$img_cls[] = $settings[$static_layer_img_prefix.'class'];

										$img_layer_attrs['class'] = implode(' ', $img_cls);

										techrona_elementor_image_render($settings,$widget, [
											'id'     => $static_layer_img_prefix.'image',
											'size'   => $static_layer_img_prefix.'thumbnail',
											'before' => '<div class="'.esc_attr($img_layer_attrs['class']).'" data-settings="'.esc_attr($img_layer_attrs['data-settings']).'">',
											'after'  => '</div>'
										]);
									}
									 	
								}
							?>
							<div class="h-100 d-flex align-items-center <?php echo esc_attr(trim(implode(' ', $content_position))) ?> <?php echo esc_attr(implode(' ', $content_align)) ?>">
								<div class="kng-slide-content-wrap <?php echo esc_attr(implode(' ', $align_self)) ?>">	  
									 
									<?php if(!empty($settings[$cs_prefix.'small_heading'])): ?>
									<div class="<?php echo esc_attr($small_heading_attrs['class']); ?>" data-settings="<?php echo esc_attr($small_heading_attrs['data-settings']);?>">
									<?php kng_print_html($settings[$cs_prefix.'small_heading']);?>
									</div>
									<?php endif; ?>
									<?php if(!empty($settings[$cs_prefix.'large_heading'])): ?>
									<div class="<?php echo esc_attr($large_heading_attrs['class']); ?>" data-settings="<?php echo esc_attr($large_heading_attrs['data-settings']);?>"><?php kng_print_html( nl2br($settings[$cs_prefix.'large_heading']));?></div>
									<?php endif; ?>
									<?php if(!empty($settings[$cs_prefix.'medium_heading'])): ?>
									<div class="<?php echo esc_attr($medium_heading_attrs['class']); ?>" data-settings="<?php echo esc_attr($medium_heading_attrs['data-settings']);?>"><?php kng_print_html( $settings[$cs_prefix.'medium_heading']);?></div> 
									<?php endif; ?>
									<?php if(!empty($settings[$cs_prefix.'description'])): ?>
									<div class="<?php echo esc_attr($description_attrs['class']); ?>" data-settings="<?php echo esc_attr($description_attrs['data-settings']);?>"><?php 
										kng_print_html($settings[$cs_prefix.'description']);
									?></div>
									<?php endif; ?>
									<div class="row gutters-10 align-items-center mt-30 <?php echo esc_attr(implode(' ', $content_position)) ?>">
								        <?php 
								            techrona_elementor_button_render($settings, [
								            	'prefix'	   => $cs_prefix.'btn1',
								                'class'        => $cs_prefix.'btn1 col-auto',
								                'icon_class'   => 'text-13'
								            ]);
								            techrona_elementor_button_render($settings, [
								            	'prefix'	   => $cs_prefix.'btn2',
								                'class'        => $cs_prefix.'btn2 col-auto',
								                'icon_class'   => 'text-13'
								            ]);
								            // video
								            techrona_elementor_render_lightbox_video_button($widget, $settings, [
								            	'prefix'	   => $cs_prefix,
								            	'class' => 'col-auto'
								            ]);
								             
								        ?>
								    </div>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
			?>
        </div>
        <?php 
            techrona_swiper_slider_dots($settings, ['class' => 'kng-dots-main']); 
            techrona_swiper_slider_arrows($settings);
            techrona_swiper_slider_arrows_bottom($settings);
        ?>
    </div>
</div>