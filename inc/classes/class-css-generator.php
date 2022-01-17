<?php
if ( ! class_exists( 'Redux_Instances' ) ) {
	return;
}

class CSS_Generator {
	/**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

	/**
	 * Constructor
	 */
	function __construct() {
		$this->opt_name = techrona_get_theme_opt_name();

		if ( empty( $this->opt_name ) ) {
			return;
		}
		$this->dev_mode = techrona_get_theme_opt( 'dev_mode', '0' ) === '1' ? true : false;
		add_filter( 'kng_scssc_on', '__return_true' );
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * init hook - 10
	 */
	function init() {
		if ( ! class_exists( 'scssc' ) ) {
            return;
        }

		$this->redux = Redux_Instances::get_instance( $this->opt_name );

		if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
			return;
		}
		add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
		add_action( "redux/options/{$this->opt_name}/saved", function () {
			$this->generate_file();
		} );
	}

	function generate_with_dev_mode() {
		if ( $this->dev_mode === true ) {
			$this->generate_file(); 
		}
	}

	/**
	 * Generate options and css files
	 */
	function generate_file() {
		 
		$scss_dir = get_template_directory() . '/assets/scss/';
		$css_dir  = get_template_directory() . '/assets/css/';

		$this->scssc = new scssc();
        $this->scssc->setImportPaths( $scss_dir );

        $_options = $scss_dir . '_options.scss';

        $this->redux->filesystem->execute( 'put_contents', $_options, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->options_output() )
        ) );
        $css_file = $css_dir . 'theme.css';
 
        $this->scssc->setFormatter( 'scss_formatter' );
        $this->redux->filesystem->execute( 'put_contents', $css_file, array(
            'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "theme.scss"' ) )
        ) );
	}

    protected function print_scss_opt_colors($variable,$param){
        if(is_array($variable)){
            $k = [];
            $v = [];
            foreach ($variable as $key => $value) {
                $k[] = str_replace('-', '_', $key);
                $v[] = 'var(--'.str_replace(['#',' '], [''],$key).'-color)';
            }
            if($param === 'key'){
                return implode(',', $k);
            }else{
                return implode(',', $v);
            }
            
        } else {
            return $variable;
        }
    }
    protected function options_output() {
        $theme_colors                    = wp_parse_args( techrona_configs('theme_colors'), techrona_custom_colors() );
        $links                           = techrona_configs('link');
        $body                            = techrona_configs('body');
        $header                          = techrona_configs('header');
        $heading                         = techrona_configs('heading');
        $menu                            = techrona_configs('menu');
        $dropdown                        = techrona_configs('dropdown');
        $mobile_menu                     = techrona_configs('mobile_menu');
        $mobile_submenu                  = techrona_configs('mobile_submenu');
        $ptitle                          = techrona_configs('ptitle');  
        $ptitle_mobile                   = techrona_configs('ptitle_mobile');  
        $ptitle_overlay                  = techrona_configs('ptitle_overlay'); 
        $ptitle_gradient_bg_from         = techrona_configs('ptitle_gradient_bg_from'); 
        $ptitle_gradient_bg_to           = techrona_configs('ptitle_gradient_bg_to'); 
        $ptitle_breadcrumb               = techrona_configs('ptitle_breadcrumb'); 
        $button                          = techrona_configs('button');
        $border                          = techrona_configs('border');
        $comment                         = techrona_configs('comment');
        //$header                        = techrona_configs('header');
        $logo                            = techrona_configs('logo');
          
        ob_start();
 
            printf('$kng_theme_colors_key:(%s);',$this->print_scss_opt_colors($theme_colors,'key'));
            printf('$kng_theme_colors_val:(%s);',$this->print_scss_opt_colors($theme_colors,'val'));
            // color rgb only
            foreach ($theme_colors as $key => $value) {
                printf('$%1$s_color_hex: %2$s;', str_replace('-', '_', $key), $value['value']); 
            }
            // color
            foreach ($theme_colors as $key => $value) {
                printf('$%1$s_color: %2$s;', str_replace('-', '_', $key), 'var(--'.str_replace(['#',' '], [''],$key).'-color)' );
            }
             
            // link color
            foreach ($links as $key => $value) {
                printf('$link_%1$s: %2$s;', str_replace('-', '_', $key), 'var(--link-'.$key.')');
            }
            foreach ($body as $key => $value) {
                printf('$body_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            foreach ($header as $key => $value) {
                printf('$header_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            foreach ($heading as $key => $value) {
                printf('$heading_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            foreach ($menu as $key => $value) {
                printf('$menu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            foreach ($dropdown as $key => $value) {
                printf('$dropdown_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            foreach ($mobile_menu as $key => $value) {
                printf('$mobile_menu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            foreach ($mobile_submenu as $key => $value) {
                printf('$mobile_submenu_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            foreach ($ptitle as $key => $value) {
                if($key === 'background-image') $value = 'url('.$value.')';
                if(!is_array($value))
                    printf('$ptitle_%1$s: var(--ptitle-%2$s);', str_replace('-', '_', $key), $key);       
            }
            foreach ($ptitle_mobile as $key => $value) {
                printf('$ptitle_mobile_%1$s: var(--ptitle-mobile-%2$s);', str_replace('-', '_', $key), $key);       
            }
            foreach ($ptitle_overlay as $key => $value) {
                printf('$ptitle_overlay_%1$s: var(--ptitle-overlay-%2$s);', str_replace('-', '_', $key), $key);  
            }
            printf('$ptitle_gradient_bg_from: %1$s;', $ptitle_gradient_bg_from['rgba']);  
            printf('$ptitle_gradient_bg_to: %1$s;', $ptitle_gradient_bg_to['rgba']);  
           
            foreach ($ptitle_breadcrumb as $key => $value) {
                printf('$ptitle_breadcrumb_%1$s: var(--ptitle-breadcrumb-%2$s);', str_replace('-', '_', $key), $key);  
            }
           
            foreach ($button as $key => $value) {
                printf('$button_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
             
            foreach ($border as $key => $value) {
                printf('$border_%1$s: %2$s;', str_replace('-', '_', $key), $value);
                if($key === 'color'){
                    printf('$border_%1$s_rgb: %2$s;', str_replace('-', '_', $key), $value);
                }
            }
            foreach ($comment as $key => $value) {
                printf('$comment_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }
            
            foreach ($logo as $key => $value) {
                printf('$logo_%1$s: %2$s;', str_replace('-', '_', $key), $value);
            }   
        return ob_get_clean();
 
    }
	 
}

new CSS_Generator();