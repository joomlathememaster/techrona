<?php
if(isset($settings['progressbar_list']) && !empty($settings['progressbar_list'])):
    foreach ($settings['progressbar_list'] as $key => $progressbar):
        $wrapper_key      = $widget->get_repeater_setting_key( 'wrapper', 'progressbar_list', $key );
        $progress_bar_key = $widget->get_repeater_setting_key( 'progress_bar', 'progressbar_list', $key );
        $widget->add_render_attribute( $wrapper_key, [
            'class'         => 'kng-progress-wrapper',
            'role'          => 'progressbar',
            'aria-valuemin' => '0',
            'aria-valuemax' => '100',
            'aria-valuenow' => $progressbar['percent']['size'],
        ] );

        if ( ! empty( $progressbar['progress_type'] ) ) {
            $widget->add_render_attribute( $wrapper_key, 'class', 'progress-' . $progressbar['progress_type'] );
        }
        $percent_color = !empty($progressbar['percent_color']) ? $progressbar['percent_color'] : 'accent';
        $widget->add_render_attribute( $progress_bar_key, [
            'class'    => 'kng-progress-bar h-100 kng-transition bg-'.$percent_color.' text-'.$widget->get_setting('percent_typo_color','white') ,
            'data-max' => $progressbar['percent']['size'],
        ] );
        if($progressbar['percent_color'] === 'custom'){
            $widget->add_render_attribute( $progress_bar_key, [
                'style'    => 'background-color:'.$progressbar['custom_percent_color'],
            ]);
        }
        ?>
        <div class="kng-progress-wraps">
            <?php
            if ( ! empty( $progressbar['title'] ) ) { ?>
                <div class="kng-heading text-<?php echo esc_attr($widget->get_setting('title_typo_color','heading'))?>"><?php echo esc_html($progressbar['title']); ?></div>
            <?php } ?>
            <div <?php kng_print_html($widget->get_render_attribute_string( $wrapper_key )); ?>>
                <div <?php kng_print_html($widget->get_render_attribute_string( $progress_bar_key )); ?>>
                    <span class="kng-progressbar-inner-text empty-none"><?php kng_print_html($progressbar['inner_text']); ?></span>
                    <span class="kng-progressbar-percentage"><?php echo esc_html($progressbar['percent']['size']); ?>%</span>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>