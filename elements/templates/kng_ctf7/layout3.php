<div class="kng-cf7 relative">
    <div class="kng-cf7-inner">
    	<?php if(!empty($widget->get_setting('form_title')) || !empty($widget->get_setting('form_desc'))): ?>
        <div class="kng-cf-heading mb-30 text-center">
            <h3><?php echo esc_html($widget->get_setting('form_title')); ?></h3>
            <p><?php echo esc_html($widget->get_setting('form_desc')); ?></p>
        </div>
    	<?php endif; ?>
        <div class="kng-cf-form"><?php 
            echo do_shortcode('[contact-form-7 id="'.esc_attr( $settings['ctf7_id']).'"]'); 
        ?></div>
    </div>
</div>