<?php
$settings = $widget->get_settings_for_display();
$fallback_defaults = [
	'fa fa-check',
	'fa fa-times',
	'fa fa-dot-circle-o',
];

$widget->add_render_attribute( 'icon_list', 'class', 'el-list-items' );
$widget->add_render_attribute( 'list_item', 'class', 'el-icon-list-item' );
if(!empty($settings['icon_align'])){
	// $widget->add_render_attribute( 'icon_list', 'class', 'align-'.$settings['icon_align'] );
}

if ( 'inline' === $settings['view'] ) {
	$widget->add_render_attribute( 'icon_list', 'class', 'el-inline-items' );
	$widget->add_render_attribute( 'list_item', 'class', 'el-inline-item' );
}
?>
<div class="kng-icon-list">
	<ul <?php $widget->print_render_attribute_string( 'icon_list' ); ?>>
		<?php
		foreach ( $settings['icon_list'] as $index => $item ) :
			$repeater_setting_key = $widget->get_repeater_setting_key( 'text', 'icon_list', $index );

			$widget->add_render_attribute( $repeater_setting_key, 'class', 'el-icon-list-text' );

			$widget->add_inline_editing_attributes( $repeater_setting_key );
			$migration_allowed = \Elementor\Icons_Manager::is_migration_allowed();
			?>
			<li <?php $widget->print_render_attribute_string( 'list_item' ); ?>>
				<?php
				if ( ! empty( $item['link']['url'] ) ) {
					$link_key = 'link_' . $index;

					$widget->add_link_attributes( $link_key, $item['link'] );
					?>
					<a <?php $widget->print_render_attribute_string( $link_key ); ?>>

					<?php
				}

				// add old default
				if ( ! isset( $item['icon'] ) && ! $migration_allowed ) {
					$item['icon'] = isset( $fallback_defaults[ $index ] ) ? $fallback_defaults[ $index ] : 'fa fa-check';
				}

				$migrated = isset( $item['__fa4_migrated']['selected_icon'] );
				$is_new = ! isset( $item['icon'] ) && $migration_allowed;
				if ( ! empty( $item['icon'] ) || ( ! empty( $item['selected_icon']['value'] ) && $is_new ) ) :
					?>
					<span class="el-icon-list-icon">
						<?php
						if ( $is_new || $migrated ) {
							\Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
						} else { ?>
								<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
						<?php } ?>
					</span>
				<?php endif; ?>
				<span <?php $widget->print_render_attribute_string( $repeater_setting_key ); ?>><?php $widget->print_unescaped_setting( 'text', 'icon_list', $index ); ?></span>
				<?php if ( ! empty( $item['link']['url'] ) ) : ?>
					</a>
				<?php endif; ?>
			</li>
			<?php
		endforeach;
		?>
	</ul>
</div>	