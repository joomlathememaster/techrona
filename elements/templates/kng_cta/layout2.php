<?php
  
$heading = $widget->get_setting('heading_text', 'get ready  to any  help for law solutions');

?>
<div class="kng-cta-wrap">
	<div class="cta-inner row gutters-30 gutters-xl-50 justify-content-center align-items-center">
		<div class="col-12 text-center col-sm-auto mb-15">
			<<?php kng_print_html($widget->get_setting('heading_text_tag','h4'))?> class="kng-cta-title <?php echo esc_attr('text-'.$widget->get_setting('heading_text_color','heading')) ?>"><?php kng_print_html(nl2br($heading)) ?></<?php kng_print_html( $widget->get_setting('heading_text_tag','h4'))?>>
		</div>
		<div class="col-12 text-center col-sm-auto mb-15">
			<?php 
			techrona_elementor_button_render($settings, [
            	'prefix'	   => 'cta_link1',
                'class'        => 'btn1 col-auto',
                'icon_class'   => 'text-15 uppercase'
            ]);
			?>
		</div>
	</div>
</div>