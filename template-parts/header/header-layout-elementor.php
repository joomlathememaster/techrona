<?php
/**
 * Template part for displaying default header layout
 */
//if(is_singular('kng-header') || is_singular('kng-footer')  || is_singular('kng-mega-menu') ) return;

$header_layout           = techrona_get_opts('header_layout','header-main');
$header_is_sticky        = techrona_get_opts('header_is_sticky','1');
$header_layout_sticky    = techrona_get_opts('header_sticky_layout','header-main-sticky');
$header_mobile_layout    = techrona_get_opts('header_mobile_layout',false);
$header_mobile_is_sticky = techrona_get_theme_opt('header_mobile_is_sticky','0');

$mobile_sticky_cls = ($header_mobile_is_sticky == '1') ? 'is-sticky' : '';

$pid                  = techrona_get_id_by_slug($header_layout, 'kng-header');
$post_main            = get_post($pid);

//$header_layout_sticky = $header_layout.'-sticky';
$pstk_id              = techrona_get_id_by_slug($header_layout_sticky, 'kng-header');
$post_sticky          = get_post($pstk_id);

$pmid                 = techrona_get_id_by_slug($header_mobile_layout, 'kng-header');
$post_mobile          = get_post($pmid);
 
$logo_m = techrona_get_opts( 'logo_m', array( 'url' => get_template_directory_uri().'/assets/images/logo-mobile.png', 'id' => '' ) );
 
?>
<header id="kng-header-elementor" class="<?php techrona_header_css_class() ?>">
	<?php if (!is_wp_error($post_main) && $post_main->post_name == $header_layout && class_exists('Kngtheme_Core')) : ?>
		<div class="kng-header-elementor-main">
            <?php 
                $content_main = \Elementor\Plugin::$instance->frontend->get_builder_content( $pid );
                kng_print_html($content_main);
            ?>         
		</div>
	<?php endif; ?>

	<?php if (!is_wp_error($post_sticky) && $post_sticky->post_name == $header_layout_sticky && class_exists('Kngtheme_Core') && $header_is_sticky =='1') : ?>
		<div class="kng-header-elementor-sticky">
            <?php 
                $content_sticky = \Elementor\Plugin::$instance->frontend->get_builder_content( $pstk_id );
                kng_print_html($content_sticky);
            ?>   
		</div>
	<?php endif; ?>

    <?php if (!is_wp_error($post_mobile) && $post_mobile->post_name == $header_mobile_layout && class_exists('Kngtheme_Core')) : ?>
        <div class="kng-header-elementor-mobile <?php echo esc_attr($mobile_sticky_cls) ?>">
            <div class="header-main-mobile">
            <?php 
                $content_hmobile = \Elementor\Plugin::$instance->frontend->get_builder_content( $pmid );
                kng_print_html($content_hmobile);
            ?>
            </div>         
        </div>
    <?php endif; ?>

    <?php if(!$header_mobile_layout): ?>
        <div class="kng-header-mobile <?php echo esc_attr($mobile_sticky_cls) ?>">
            <div class="header-main-mobile">
                <div class="container">
                    <div class="header-mobile-content row justify-content-between">
                        <div class="kng-header-mobile-branding col-auto">
                            <?php 
                                printf(
                                    '<a class="logo-mobile" href="%1$s" title="%2$s" rel="home"><img class="kng-logo" src="%3$s" alt="%2$s"/></a>',
                                    esc_url( home_url( '/' ) ),
                                    esc_attr( get_bloginfo( 'name' ) ),
                                    esc_url( $logo_m['url'] )
                                );
                            ?>
                        </div>
                        <div class="kng-menu-mobile-toggle col-auto">
                            <div class="mobile-menu-toggle d-flex align-items-center" >
                                <span class="bars" data-target=".kng-side-mobile" onclick="">
                                    <span></span><span></span><span></span>
                                </span>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</header>