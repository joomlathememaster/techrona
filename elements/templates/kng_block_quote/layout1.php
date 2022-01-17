<?php
$bq_content = !empty($settings['bq_content']) ? $settings['bq_content'] : '';
$bq_client_name = !empty($settings['bq_client_name']) ? $settings['bq_client_name'] : '';
?>

<div class="kng-block-quote-wrap">
    <?php if(!empty($bq_content) && !empty($bq_client_name)): ?>
        <blockquote class="wp-block-quote kng-block-quote">
            <?php kng_print_html($bq_content); ?>
            <div class="clearfix"></div>
            <cite><?php kng_print_html($bq_client_name); ?></cite>
        </blockquote>        
    <?php else: ?>
    <?php endif; ?>
</div>



