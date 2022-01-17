<?php
/**
 * Template part for displaying default header layout
 */

$logo = techrona_get_opts( 'logo', array( 'url' => get_template_directory_uri().'/assets/images/logo.png', 'id' => '' ) );
?>
<header id="kng-header" class="<?php techrona_header_css_class(); ?>">
    <div class="header-container container">
        <div class="row justify-content-between align-items-center gutters-40">
            <div class="kng-header-logo col-auto">
                <?php 
                printf(
                    '<a class="logo-default" href="%1$s" title="%2$s" rel="home"><img class="kng-logo" src="%3$s" alt="%2$s"/></a>',
                    esc_url( home_url( '/' ) ),
                    esc_attr( get_bloginfo( 'name' ) ),
                    esc_url( $logo['url'] )
                );
                ?>
            </div>
            <div class="kng-navigation col d-none d-xl-block">
                <div class="row align-items-center justify-content-between">
                    <div class="col-12 col-xl-auto">
                        <div class="row align-items-center">
                            <div class="kng-main-navigation col-12 col-xl-auto">
                                <?php 
                                if ( has_nav_menu( 'primary' ) )
                                    {
                                        wp_nav_menu( array(
                                            'theme_location' => 'primary',
                                            'container'      => '',
                                            'menu_id'        => 'kng-primary-menu',
                                            'menu_class'     => 'kng-primary-menu clearfix',
                                            'link_before'    => '<span class="kng-menu-title">',
                                            'link_after'     => '</span>',  
                                            'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
                                        ) );
                                    }
                                    else
                                    {
                                        printf(
                                            '<ul class="kng-primary-menu primary-menu-not-set"><li><a href="%1$s">%2$s</a></li></ul>',
                                            esc_url( admin_url( 'nav-menus.php' ) ),
                                            esc_html__( 'Create New Menu', 'techrona' )
                                        );
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-auto d-xl-none">
                <div class="row align-items-center justify-content-end">
                    <?php techrona_mobile_menu_icon(['class' => 'col-auto']);?>
                </div>
            </div>
        </div>
    </div>
     
</header>