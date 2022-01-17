<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part( 'inc/libs/class-tgm-plugin-activation' );

add_action( 'tgmpa_register', 'sunix_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
*/
function sunix_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $default_path = 'https://exptheme.com/plugins/';
    $plugins = array(
 
        array(
            'name'               => esc_html__('Redux Framework', 'techrona'),
            'slug'               => 'redux-framework',
            'required'           => true
        ),
        array(
            'name'               => esc_html__('Slider Revolution','techrona'),
            'slug'               => 'revslider',
            'source'             => 'revslider.zip',
            'required'           => true,
        ),
        array(
            'name'               => esc_html__('Elementor', 'techrona'),
            'slug'               => 'elementor',
            'required'           => true
        ),
        array(
            'name'               => esc_html__('Theme Core', 'techrona'),
            'slug'               => 'kngtheme-core',
            'source'             => 'kngtheme-core.zip',
            'required'           => true
        ),
        array(
            'name'               => esc_html__('KNG Import Export', 'techrona'),
            'slug'               => 'kngtheme-import',
            'source'             => 'kngtheme-import.zip',
            'required'           => true
        ),
        array(
            'name'               => esc_html__('WooCommerce', 'techrona'),
            'slug'               => 'woocommerce',
            'required'           => false
        ),
        array(
            'name'               => esc_html__('Contact Form 7', 'techrona'),
            'slug'               => 'contact-form-7',
            'required'           => false
        ),
        array(
            'name'               => esc_html__('WPC Smart Compare for WooCommerce','techrona'),
            'slug'               => 'woo-smart-compare',
            'required'           => false,
        ),
        array(
            'name'               => esc_html__('WPC Smart Wishlist for WooCommerce','techrona'),
            'slug'               => 'woo-smart-wishlist',
            'required'           => false,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
    */
    $config = array(
        'default_path' => $default_path,                    // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins',          // Menu slug.
        'is_automatic' => true,

    );
    tgmpa( $plugins, $config );
}