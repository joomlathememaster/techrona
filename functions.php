<?php echo 'aaaaaaaaaaa'; die;
/**
 * Functions and definitions
 *
 */

if(!defined('DEV_MODE')){
    define('DEV_MODE', true);
}

if(!function_exists('techrona_require_folder')){
    function techrona_require_folder($foldername,$path = '')
    {
        if($path === '') $path = get_template_directory();
        $dir = $path . DIRECTORY_SEPARATOR . $foldername;
        if (!is_dir($dir)) {
            return;
        }
        $files = array_diff(scandir($dir), array('..', '.'));
        foreach ($files as $file) {
            $patch = $dir . DIRECTORY_SEPARATOR . $file;
            if (file_exists($patch) && strpos($file, ".php") !== false) {
                require_once $patch;
            }
        }
    }
}
techrona_require_folder('inc');

if ( ! function_exists( 'techrona_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
    add_action( 'after_setup_theme', 'techrona_setup' );
	function techrona_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'techrona', get_template_directory() . '/languages' );
		// Custom Header
		add_theme_support( "custom-header" );
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );
		

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'techrona Primary', 'techrona' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
            'script',
            'style'
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'techrona_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for core custom logo.
		add_theme_support( 'custom-logo', array(
			'height'      => 45,
			'width'       => 192,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'post-formats', array(
            'video',
            'link'
		) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        // Set post thumbnail size.
        set_post_thumbnail_size( 1170, 576 );
        $custom_sizes = techrona_configs('custom_sizes'); 
        foreach ($custom_sizes as $option => $values) {
            add_image_size( $option, $values[0], $values[1], $values[2] );
        }
        
        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );
  
        // Enable support for WooCommerce.
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
        
        remove_theme_support('widgets-block-editor');

	}
}
 
/* Display Custom Image Sizes */
if(!function_exists('techrona_custom_sizes')){
    add_filter('image_size_names_choose','techrona_custom_sizes');
    function techrona_custom_sizes($sizes){
        return array_merge($sizes, array(
            'medium_large' => esc_html__('Medium Large', 'techrona')
        ));
    }
}
if(!function_exists('techrona_update')){
    add_action('after_switch_theme', 'techrona_update');
    function techrona_update(){
        /* Change default image thumbnail sizes in wordpress */
        $thumbnail_size = techrona_configs('thumbnails'); 
        foreach ($thumbnail_size as $values) {
            foreach ($values as $option => $value) {
                if( get_option($option, '') != $value){  
                    update_option($option, $value);
                }
            }
        }
    }
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
// Set up the content width value based on the theme's design and stylesheet.
if(!function_exists('techrona_content_width')){
    add_action('after_setup_theme', 'techrona_content_width', 0);
    function techrona_content_width(){
        $GLOBALS['content_width'] = apply_filters( 'techrona_content_width', 1050 );
    }
}

// Add new menu Locations
add_action( 'kng_locations', function ( $kng_locations ) {
	return $kng_locations;
} );
/**
 * Register widget area.
 */
if(!function_exists('techrona_widgets_init')){
    add_action( 'widgets_init', 'techrona_widgets_init' );
    function techrona_widgets_init() {
    	if(class_exists('Kngtheme_Core')){
            $all_post_type = techrona_all_post_types();
            foreach ($all_post_type as $key => $value) {
                register_sidebar( array(
                    'name'          => sprintf( esc_html__( '%s Sidebar', 'techrona' ), $value ),
                    'id'            => 'sidebar-'.$key,
                    'description'   => sprintf(esc_html__( 'Add widgets here to show in %1$s archive page and single %2$s page', 'techrona' ), strtoupper(str_replace('-', ' ', $key)), $value),
                    'class'         => 'kng-post-type-widget',
                    'title_class'   => '',
                    'before_title'  => '<h4 class="widget-title"><span>',
                    'after_title'   => '</span></h4>',
                ) );
            }
            if(class_exists('WooCommerce')){
                register_sidebar( array(
                    'name'          => esc_html__( 'Product Sidebar', 'techrona' ),
                    'id'            => 'sidebar-single-product',
                    'description'   => esc_html__( 'Add widgets here to show on ingle product sidebar', 'techrona' ),
                    'class'         => 'kng-product-widget',
                    'title_class'   => '',
                    'before_title'  => '<h4 class="widget-title"><span>',
                    'after_title'   => '</span></h4>',
                ) );
            }
        } else {
            register_sidebar( array(
                'name'          => esc_html__( 'Blog Widgets', 'techrona' ),
                'id'            => 'sidebar-post',
                'description'   => esc_html__( 'Add widgets here to show on blog/archives/single post page', 'techrona' ),
                'class'         => 'kng-blog-widget',
                'title_class'   => '',
                'before_title'  => '<h4 class="widget-title"><span>',
                'after_title'   => '</span></h4>',
            ) );
            if(class_exists('WooCommerce')){
                register_sidebar( array(
                    'name'          => esc_html__( 'WooCommerce Widgets', 'techrona' ),
                    'id'            => 'sidebar-product',
                    'description'   => esc_html__( 'Add widgets here to show on woocommerce page', 'techrona' ),
                    'class'         => 'kng-blog-widget',
                    'title_class'   => '',
                    'before_title'  => '<h4 class="widget-title"><span>',
                    'after_title'   => '</span></h4>',
                ) );
            }
        }
    }
}
/**
 * Change default widget title structure
*/
if(!function_exists('techrona_widgets_title')){
    add_filter('widget_display_callback', 'techrona_widgets_structure');
    add_filter('register_sidebar_defaults', 'techrona_widgets_structure');
    function techrona_widgets_structure($args){
        $args = wp_parse_args($args, [
            'title_class' => ''
        ]);
        $widget_title_tag = 'h4';
        $title_class = [
            'kng-widget-title',
            'kng-heading',
            isset($args['title_class']) ? $args['title_class'] : ''
        ];
        $args['before_widget'] = '<div id="%1$s" class="kng-widget %2$s"><div class="kng-widget-inner">';
        $args['after_widget']  = '</div></div>';
        $args['before_title']  = '<'.$widget_title_tag.' class="'.trim(implode(' ', $title_class)).'">';
        $args['after_title']   = '</'.$widget_title_tag.'>';
        return $args;
    }
}
/**
 * Enqueue scripts and styles.
 */
if(!function_exists('techrona_scripts')){
    add_action( 'wp_enqueue_scripts', 'techrona_scripts');
    function techrona_scripts() {
    	$theme = wp_get_theme( get_template() );
        $dev_mode   = techrona_get_theme_opt_name('dev_mode', false);
        // google font
        wp_enqueue_style( 'techrona-google-fonts', techrona_fonts_url(), array(), null );
        
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.0.2' );
         
        wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '1.0.0' );
        
        // theme font icon
        wp_enqueue_style( 'techrona-icon', get_template_directory_uri() . '/assets/fonts/font-kngi/style.css', array(), $theme->get( 'Version' ) );
        // wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/fonts/font-kngf/flaticon.css', array(), $theme->get( 'Version' ) );
        // wp_enqueue_style( 'flaticon1', get_template_directory_uri() . '/assets/fonts/font-kngfi/flaticon1.css', array(), $theme->get( 'Version' ) );
         
        wp_register_style( 'techrona-local-font', get_template_directory_uri() . '/assets/css/local-font.css', array(), wp_get_theme()->get( 'Version' )  );
         
        
        // theme style
        wp_enqueue_style( 'techrona', get_template_directory_uri() . '/assets/css/theme.css', array(), $theme->get( 'Version' ) );
        wp_add_inline_style( 'techrona', techrona_inline_styles() );

        wp_enqueue_style( 'techrona-style', get_stylesheet_uri() );

        // WP Comment
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
        if(class_exists('Woocommerce')) {
            wp_enqueue_script( 'selectWoo' );
            wp_enqueue_style( 'select2' ); 
        }
        
        // Theme JS
        wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), '1.0.0', true );
    	wp_enqueue_script( 'techrona', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), $theme->get( 'Version' ), true );
    	wp_localize_script( 'techrona', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
        /*
         * Elementor Widget JS
         */
        // Animation
        wp_register_script('kng-animation', get_template_directory_uri() . '/assets/js/kng-animation.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        // Accordion
        wp_register_script('kng-accordion', get_template_directory_uri() . '/assets/js/kng-accordion.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        // Counter
        wp_register_script('kng-counter', get_template_directory_uri() . '/assets/js/kng-counter.js', [ 'jquery' ], $theme->get( 'Version' ), true);
         
        // Post Grid Widget
        wp_register_script('kng-post-grid', get_template_directory_uri() . '/assets/js/kng-post-grid.js', [ 'isotope', 'jquery' ], $theme->get( 'Version' ), true);
        // Progress Bar Widget
        wp_register_script( 'kng-progressbar', get_template_directory_uri() . '/assets/js/kng-progressbar.js', [ 'jquery' ], $theme->get( 'Version' ) );
         // Swiper Slider
        wp_register_script('kng-swiper', get_template_directory_uri() . '/assets/js/kng-swiper.js', [ 'jquery' ], $theme->get( 'Version' ), true);
         
        // Galleries
        wp_register_script('kng-galleries', get_template_directory_uri() . '/assets/js/kng-galleries.js', [ 'jquery' ], $theme->get( 'Version' ), true);
        // Elementor Custom
        wp_enqueue_script('kng-elementor-custom-js', get_template_directory_uri() . '/assets/js/elementor-custom.js', [ 'jquery' ], $theme->get( 'Version' ), true);
    }
}
// Custom Elementor Editor
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'techrona-elementor-custom-editor', get_template_directory_uri() . '/assets/css/elementor-custom-editor.css', array(), '1.0.0' );
});

/* add admin styles */
if(!function_exists('techrona_admin_style')){
    add_action( 'admin_enqueue_scripts', 'techrona_admin_style' );
    function techrona_admin_style() {
    	$theme = wp_get_theme( get_template() );
    	wp_enqueue_style( 'techrona-admin-style', get_template_directory_uri() . '/assets/css/admin.css' );
        wp_enqueue_script( 'techrona-main-admin', get_template_directory_uri() . '/assets/js/main-admin.js', array( 'jquery' ), $theme->get( 'Version' ), true);
    }
}

/**
 * Register Google Fonts
 *
 * https://gist.github.com/kailoon/e2dc2a04a8bd5034682c
 * https://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
*/
 

function techrona_fonts_url() {  
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
 
    if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'techrona' ) ) {
        $fonts[] = 'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap';
    }
    if ( 'off' !== _x( 'on', 'Open+Sans font: on or off', 'techrona' ) ) {
        $fonts[] = 'Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap';
    }
     
    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $fonts ),
            'subset' => urlencode( $subsets ),
        ), '//fonts.googleapis.com/css2' );
    }

    return $fonts_url;
}
  
/**
 * Incudes file
 *
*/
techrona_require_folder('inc/theme-options');
techrona_require_folder('inc/kng-iconpicker');
techrona_require_folder('inc/classes');
/**
 * Additional widgets for the theme
 */
techrona_require_folder('inc/widgets');

/**
 * Elementor
*/
techrona_require_folder('inc/el-custom');
/**
 *  Woocommerce
 */
if(class_exists('Woocommerce')){
    techrona_require_folder('woocommerce');
}

/**
 * Remove all Font Awesome from 3rd extension 
 * to use only font-awesome latest from our theme
*/
if(!function_exists('kng_remove_styles')){
    add_action( 'wp_enqueue_scripts', 'kng_remove_styles', 999 );
    add_action( 'wp_footer', 'kng_remove_styles', 999 );
    add_action( 'wp_header', 'kng_remove_styles', 999 );
    function kng_remove_styles() {
        $default = ['gglcptch' ];
        $styles  = apply_filters( 'kng_remove_styles', $default );
        foreach ( $styles as $style ) {
            wp_dequeue_style( $style );
            wp_deregister_style( $style );
        }
    }
}
if(!function_exists('techrona_remove_styles')){
    add_filter('kng_remove_styles', 'techrona_remove_styles');
    function techrona_remove_styles($styles){
        $_styles = [
            'newsletter',
            // elementor
            'elementor-frontend-legacy',
            // woo
            'woocommerce-smallscreen',
            'woocommerce-general',
            'woocommerce-layout',
            'wc-block-vendors-style',
            'wc-block-style',
            // theme core
            'oc-css',
            'kng-main-css',
            'progressbar-lib-css',
            // language switcher
            'trp-floater-language-switcher-style',
            'trp-language-switcher-style',
            // Profile Press 
            'ppress-frontend',
            'ppress-flatpickr',
            'ppress-select2',
        ];
        $styles = array_merge($styles, $_styles);
        return $styles;
    }
}
// remove lazy load 
add_filter( 'wp_lazy_loading_enabled', '__return_false' );
