<?php
/**
 * Template part for displaying default header layout
 */

$img_404_logo = techrona_get_theme_opt( 'img_404_logo', array( 'url' => get_template_directory_uri().'/assets/images/logo.png', 'id' => '' ) );

add_action( 'kng_anchor_target', 'techrona_hook_anchor_side_info');
add_action('kng_anchor_target', 'techrona_search_popup_normal');
?>
<header id="kng-header" class="kng-header header-layout-404">
    <div class="header-container container">
        <div class="row justify-content-between align-items-center gutters-30">
            <div class="kng-header-logo col-auto">
                <?php 
                printf(
                    '<a class="logo-default" href="%1$s" title="%2$s" rel="home"><img class="kng-logo" src="%3$s" alt="%2$s"/></a>',
                    esc_url( home_url( '/' ) ),
                    esc_attr( get_bloginfo( 'name' ) ),
                    esc_url( $img_404_logo['url'] )
                );
                ?>
            </div>
             
            <div class="kng-header-attrs col-auto">
                <div class="d-flex gutters-30 gutters-sm-10 align-items-center">
                    <div class="atts-item">
                    <a href="#kng-search-popup-normal" class="kng-factor kng-search kng-modal kng-transition d-flex align-items-center justify-content-center"><span class="kng-icon kngi-search-400"></span></a>
                    </div>
                    <div class="atts-item">
                    <a href="#kng-side-info" class="kng-anchor side-panel d-flex align-items-center justify-content-center" data-target=".kng-side-info"><span class="kng-icon lh-1 kng-anchor-icon custom kng-bars"><span></span><span></span><span></span></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
</header>