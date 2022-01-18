<?php 
    add_action( 'admin_enqueue_scripts', function(){
        wp_enqueue_style( 'font-kngi', get_template_directory_uri() . '/assets/fonts/font-kngi/style.css', array(), '1.0.0'  );
    } );
    if(!function_exists('sunix_iconpicker')){
    add_filter("redux_kng_iconpicker_field/get_icons", 'sunix_iconpicker');
    function sunix_iconpicker($icons){  
        unset($icons['New in 4.6']);
        unset($icons['Web Application Icons']);
        unset($icons['Medical Icons']);
        unset($icons['Text Editor Icons']);
        unset($icons['Spinner Icons']);
        unset($icons['File Type Icons']);
        unset($icons['Directional Icons']);
        unset($icons['Video Player Icons']);
        unset($icons['Form Control Icons']);
        unset($icons['Transportation Icons']);
        unset($icons['Chart Icons']);
        unset($icons['Brand Icons']);
        unset($icons['Hand Icons']);
        unset($icons['Payment Icons']);
        unset($icons['Currency Icons']);
        unset($icons['Accessibility Icons']);
        unset($icons['Gender Icons']);
        $icons['Social'] = [       
            array('icon-twitter'    => ''),      
            array('icon-linkedin'   => ''),     
            array('icon-facebook'   => ''),     
        ];
        $icons['Service'] = [       
            array('icon-cloud'    => ''),      
            array('icon-cyber-security'   => ''),     
            array('icon-data-storage'    => ''),      
            array('icon-pie-chart'   => ''),     
            array('icon-machine-learning'   => ''),     
            array('icon-consulting'   => ''),    
        ];
        return $icons;
    }
}
 ?>