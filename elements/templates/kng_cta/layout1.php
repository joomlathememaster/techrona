<?php
  
$heading = $widget->get_setting('heading_text', 'Choose Your Law Firm, Choose The Best Care For Yourself');

?>
<div class="kng-cta-wrap">
	<div class="cta-inner row justify-content-center justify-content-lg-between align-items-center">
		<div class="col-auto">
			<<?php kng_print_html($widget->get_setting('heading_text_tag','h3'))?> class="kng-cta-title <?php echo esc_attr('text-'.$widget->get_setting('heading_text_color','heading')) ?>"><?php kng_print_html(nl2br($heading)) ?></<?php kng_print_html( $widget->get_setting('heading_text_tag','h3'))?>>
		</div>
		<div class="col-auto">
			<div class="row gutters-10 align-items-center justify-content-center justify-content-lg-end">
			<?php 
			techrona_elementor_button_render($settings, [
            	'prefix'	   => 'cta_link1',
                'class'        => 'btn1 col-auto',
                'icon_class'   => 'text-15 uppercase'
            ]);
            techrona_elementor_button_render($settings, [
            	'prefix'	   => 'cta_link2',
                'class'        => 'btn2 col-auto',
                'icon_class'   => 'text-15 uppercase'
            ]);
			?>
			</div>
		</div>
	</div>
</div>