<?php
/**
 * Widget Tag Cloud WP 
 * Change separator text, font size, ...
 * Hook filter: widget_tag_cloud_args, woocommerce_product_tag_cloud_widget_args
*/
if(!function_exists('techrona_widget_tag_cloud_args')){
    add_filter('widget_tag_cloud_args', 'techrona_widget_tag_cloud_args');
    add_filter('woocommerce_product_tag_cloud_widget_args', 'techrona_widget_tag_cloud_args');
    function techrona_widget_tag_cloud_args($args){
        $_args =[
            'smallest'  => '12',
            'largest'   => '12',
            'unit'      => 'px',
            'separator' => ''
        ];
        $args = wp_parse_args($args, $_args);
        return $args;
    }
}