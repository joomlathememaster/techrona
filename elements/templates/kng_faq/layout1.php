<?php
  
$html_id = kng_get_element_id($settings);
$number_faq_case = $widget->get_setting('number_faq_case', 4);

$filter_align = techrona_get_class_breakpoints($settings, [
    'prefix' => 'filter_top_align',
    'type-prefix' => 'justify-content-',
]);

?>
<div id="<?php echo esc_attr($html_id); ?>" class="kng-faq layout-1">
    <?php if($number_faq_case >=2): ?>
        <div class="faq-filter-wrap">
            <ul class="d-flex gutters-10 gutters-grid <?php echo esc_attr(trim(implode(' ', $filter_align))) ?>">
                <?php for($i=1; $i <= $number_faq_case; $i++): 
                    $prefix = 'case'.$i.'_';
                ?>
                <?php if(!empty($widget->get_setting($prefix.'heading', ''))): ?>
                    <li class="faq-filter-item">
                        <a class="faq-heading <?php echo esc_attr($i) == 1 ? 'active' : '' ?>" data-toggle="tab" href="#cat<?php echo esc_attr($i);?>"><?php kng_print_html($widget->get_setting($prefix.'heading', '')) ?></a>
                    </li>
                <?php endif; ?>
                <?php endfor; ?>
            </ul>
        </div>
        <div class="tab-contents">
            <?php for($i=1; $i <= $number_faq_case; $i++): 
                $prefix = 'case'.$i.'_';
                $active_section = $widget->get_setting($prefix.'active_section', 1);
                $active_section = intval($active_section);
                $accordions = $widget->get_settings($prefix.'faq_items');
            ?>
            <div class="faq-pane <?php echo esc_attr($i) == 1 ? 'active' : '' ?>" id="cat<?php echo esc_attr($i);?>">
                <div class="faq-tabpane-<?php echo esc_attr($i);?>" id="faq-tabpane-<?php echo esc_attr($i);?>">
                    <?php foreach ($accordions as $key => $value): 
                        $is_active     = ($key + 1) == $active_section;
                        $_id           = isset($value['_id']) ? $value['_id'] : '';
                        $faq_title      = isset($value['faq_title']) ? $value['faq_title'] : '';
                        $faq_content    = isset($value['faq_content']) ? $value['faq_content'] : ''; 
                        ?>
                        <div class="kng-faq-item kng-transition <?php echo esc_attr($is_active?'active':''); ?> kng-radius-8" data-target="<?php echo esc_attr('#' . $html_id.'-'.$_id); ?>">
                            <div class="kng-faq-title">
                                <a class="kng-faq-title-text"><?php echo esc_html($faq_title); ?></a>
                                <span class="kng-faq-title-icon">
                                    <i class="kng-faq-title-icon-close kng-transition kngi-plus"></i>
                                    <i class="kng-faq-title-icon-open kng-transition kngi-window-close-regular"></i>     
                                </span>
                            </div>
                            <div id="<?php echo esc_attr($html_id.'-'.$_id); ?>" class="kng-faq-content" <?php kng_print_html($is_active?'style="display:block"':''); ?>><?php kng_print_html(wpautop($faq_content)); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>         
            </div>
            <?php endfor; ?>
             
        </div>
    <?php else: ?>
        <div class="faq-content">
            <?php if(!empty($widget->get_setting('case1_heading', ''))): ?>
            <div class="faq-heading"><?php kng_print_html($widget->get_setting('case1_heading', '')) ?></div>    
            <?php endif; ?>
            <?php 
                $prefix = 'case1_';
                $active_section = $widget->get_setting($prefix.'active_section', 1);
                $active_section = intval($active_section);
                $accordions = $widget->get_settings($prefix.'faq_items');
            ?>
            <div class="faq-pane">
                <div class="faq-tabpane-1" id="faq-1">
                    <?php foreach ($accordions as $key => $value): 
                        $is_active     = ($key + 1) == $active_section;
                        $_id           = isset($value['_id']) ? $value['_id'] : '';
                        $faq_title      = isset($value['faq_title']) ? $value['faq_title'] : '';
                        $faq_content    = isset($value['faq_content']) ? $value['faq_content'] : ''; 
                        ?>
                        <div class="kng-faq-item kng-transition <?php echo esc_attr($is_active?'active':''); ?> kng-radius-8" data-target="<?php echo esc_attr('#' . $html_id.'-'.$_id); ?>">
                            <div class="kng-faq-title">
                                <a class="kng-faq-title-text"><?php echo esc_html($faq_title); ?></a>
                                <span class="kng-faq-title-icon">
                                    <i class="kng-faq-title-icon-close kng-transition kngi-plus"></i>
                                    <i class="kng-faq-title-icon-open kng-transition kngi-window-close-regular"></i>     
                                </span>
                            </div>
                            <div id="<?php echo esc_attr($html_id.'-'.$_id); ?>" class="kng-faq-content" <?php kng_print_html($is_active?'style="display:block"':''); ?>><?php kng_print_html(wpautop($faq_content)); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>