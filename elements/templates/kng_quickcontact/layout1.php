<?php
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
?>
<div class="kng-qc-wrap layout-1">
	<div class="qc-item-wrap d-flex gutters-30 gutters-md-50 gutters-lg-30 gutters-xl-50">
		<div class="qc-img">
			<?php 
			techrona_elementor_image_render($settings,$widget, [
				'id'     => 'qc_image',
				'before' => '',
				'after'  => ''
			]);
			?>
		</div>
		<div class="qc-content-wrap">
			<?php if(!empty($settings['heading_text'])): ?>
			<div class="qc-title"><?php echo kng_print_html(nl2br($settings['heading_text'])); ?></div> 
			<?php endif; ?>
			<div class="qc-desc-wrap">
				<?php foreach ($settings['contact_list'] as $value): ?>
				<?php if(!empty($value['item_title'])): ?>
					<div class="qc-item">
						<?php if(!empty($value['kng_icon']['value'])):
							if($is_new):
					            \Elementor\Icons_Manager::render_icon( $value['kng_icon'], [ 'aria-hidden' => 'true' ] );
					        else: ?>
					            <span <?php kng_print_html($widget->get_render_attribute_string( $value['kng_icon'] )); ?>></span>
					        <?php endif; ?>
						<?php endif; ?>
						<span><?php kng_print_html(nl2br($value['item_title'])) ?></span>
					</div>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>