<?php
/**
 * All function for footer
*/
/**
 * Footer 
 **/
if(!function_exists('techrona_footer')){
    function techrona_footer()
    {
        if(is_singular('kng-header') || is_singular('kng-footer')  || is_singular('kng-mega-menu')) return;
        $footer_layout = techrona_get_opts( 'footer_layout', 'df' );
        if($footer_layout === '0') return;
        if( $footer_layout === 'df') {
            techrona_footer_default();
        } else {
            $pid = techrona_get_id_by_slug($footer_layout, 'kng-footer'); 
            $kng_post            = get_post($pid);
            if (!is_wp_error($kng_post) && $kng_post->post_name == $footer_layout && class_exists('Kngtheme_Core')){
                $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $pid );
                ?>
                <div id="kng-footer" class="<?php techrona_footer_css_class();?>"><?php 
                    do_action('techrona_before_footer');
                    kng_print_html($content);
                    do_action('techrona_after_footer'); 
                ?></div>
                <?php 
            }
        }
    }
}

/*
 * Footer css class
*/
if(!function_exists('techrona_footer_css_class')){
    function techrona_footer_css_class($args = []){
        $args = wp_parse_args($args, [
            'class' => ''
        ]);
        $footer_fixed = techrona_get_opts('footer_fixed', '0');
        $css_classes = [
            'kng-footer',
            $args['class']
        ];
        if($footer_fixed == '1') $css_classes[] = 'kng-footer-fixed';
        echo trim(implode(' ', $css_classes));
    }
}
 

/*
 * Footer css class
*/
if(!function_exists('techrona_footer_default')){
    function techrona_footer_default(){
        ?>
        <div id="kng-footer" class="<?php techrona_footer_css_class(['class' => 'kng-footer-default']);?>">
            <div class="kng-footer-bottom">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-md-auto text-center">
                            <div class="kng-copyright-text kng-footer-copyright">
                                <?php 
                                printf( esc_html__('%s © All rights reserved by %s ','techrona'), date('Y') , '<a href="'.esc_url('https://themeforest.net/user/untheme').'" target="_blank" rel="nofollow">'.esc_html__('UnTheme','techrona').'</a>');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
        <?php 
    }
}

/***
 * Back to top
*/
if(!function_exists('techrona_backtotop')){
    add_action('wp_footer', 'techrona_backtotop',2);
    function techrona_backtotop($args = []){
    $back_totop_on = techrona_get_theme_opt('back_totop_on', true);
    if ('1' !== $back_totop_on) return;
    ?>
        <a href="#kng-page" class="kng-scroll-top"><span class="kng-scroll-top-arrow kng-scroll-top-icon"><span class="kngi-angle-up"></span></span></a>
    <?php 
    } 
}