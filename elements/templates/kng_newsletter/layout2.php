<?php
$kng_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'text_align',
    'type-prefix' => 'justify-content-',
]);	 
?>
<div class="kng-newsletter-wrap layout-2 d-flex <?php echo esc_attr(trim(implode(' ', $kng_align))) ?>">
	<div class="kng-newsletter relative">
		<?php 
			echo do_shortcode('
				[newsletter_form button_label="'.$widget->get_setting('button_text',esc_html__('subscribe now','techrona')).'"]
					[newsletter_field name="email" label="" placeholder="'.$widget->get_setting('email_text',esc_html__('Enter Email Address','techrona')).'"]
				[/newsletter_form]
			');
		?>
	</div>
</div>

