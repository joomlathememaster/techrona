<?php 
/**
 * Get Page List 
 * @return array
*/
if(!function_exists('techrona_list_page')){
    function techrona_list_page($default = []){
        $page_list = array();
        if(!empty($default))
            $page_list[$default['value']] = $default['label'];
        $pages = get_pages(array('hierarchical' => 0, 'posts_per_page' => '-1'));
        foreach($pages as $page){
            $page_list[$page->ID] = $page->post_title;
        }
        return $page_list;
    }
}

/**
 * Get Post List
 * @return array
*/
if(!function_exists('techrona_list_post')){
    function techrona_list_post($post_type = 'post', $default = false){
        $post_list = array();
        if($default){
            $post_list['-1']   = esc_html__('Default','techrona');
            $post_list['0'] = esc_html__('Disable','techrona');
        }

        $posts = get_posts(array('post_type' => $post_type,'posts_per_page' => '-1','orderby' => 'date', 'order' => 'ASC'));
         
        foreach($posts as $post){
            if($post->post_name == 'default-kit') continue;
            $post_list[$post->post_name] = $post->post_title;
        }
        return $post_list;
    }
}
 
if(!function_exists('techrona_list_post_header')){
    function techrona_list_post_header($post_type = 'post', $meta_value = 'default', $default = false){
        $post_list = array();
        if($default){
            $post_list['-1'] = esc_html__('Default Theme Option','techrona');
        }
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'       => 'kng_header_type',
                    'value'     => $meta_value,
                    'compare'   => '='
                )
            )
        );

        $posts = get_posts($args);
        
        foreach($posts as $post){ 
            $post_list[$post->post_name] = $post->post_title;
        }
         
        return $post_list;
    }
}

if(!function_exists('techrona_list_post_elementor_library')){
    function techrona_list_post_elementor_library($meta_value = 'df'){
        $args = array(
            'post_type' => 'elementor_library',
            'posts_per_page' => '-1',
            'orderby' => 'date',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key'       => 'kng_panel_type',
                    'value'     => $meta_value,
                    'compare'   => '='
                )
            )
        );

        $posts = get_posts($args);
         
        return $posts;
    }
}

function techrona_get_id_by_slug($slug, $post_type){
    $content = get_page_by_path($slug, OBJECT, $post_type);
    if(is_object($content)) 
        return $content->ID;
    else
        return;
}
function techrona_get_content_by_slug($slug, $post_type){
    $content = get_posts(
        array(
            'name'      => $slug,
            'post_type' => $post_type
            )
        );
    if(!empty($content))
        return $content[0]->post_content;
    else 
        return;
}

/**
 * get list menu.
 * @return array
 */
if(!function_exists('techrona_get_nav_menu')){
    function techrona_get_nav_menu($args = []){
        $args = wp_parse_args($args, [
            'default' => false, 
            'none'    => false
        ]);
        $menus = array(
            '0' => esc_html__('Primary Menu','techrona')
        );
        $obj_menus = wp_get_nav_menus();
        if($args['default']) $menus['-1'] = esc_html__('Default','techrona');
        if($args['none']) $menus['none'] = esc_html__('None','techrona');

        foreach ($obj_menus as $obj_menu){
            $menus[$obj_menu->slug] = $obj_menu->name;
        }
        return $menus;
    }
}
/**
 * Get list of user by user role for post options
 * 
 * @param $user_role
*/
function techrona_list_user_by_role_for_opts($args = []){
    $args = wp_parse_args($args, [
        'role'    => 'subcrible',
        'orderby' => 'user_nicename',
        'order'   => 'ASC'
    ]);
    $users = get_users( $args );
    $options = [];
    foreach ( $users as $user ) {
        $options[$user->user_email] = $user->display_name;
    }
    return $options;
}
/**
 * Get RevSlider List 
 * @return array
*/
if(!function_exists('techrona_get_list_rev_slider')){
    function techrona_get_list_rev_slider() {
        if (class_exists('RevSlider')) {
            $slider = new RevSlider();
            $arrSliders = $slider->getArrSliders();
            $revsliders = array();
            if ($arrSliders) {
                foreach ($arrSliders as $slider) {
                    /* @var $slider RevSlider */
                    $revsliders[$slider->getAlias()] = $slider->getTitle();
                }
            }
            return $revsliders;
        }
    }
}

/**
 * Get Contact Form 7 List
 * @return array
*/
if(!function_exists('techrona_get_list_cf7')){
    function techrona_get_list_cf7($defaule = false) {
        if(!class_exists('WPCF7')) return;
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
        $contact_forms = array();
        if($defaule){
            $contact_forms['-1'] = esc_html__('Default From Theme Option','techrona');
        }

        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->post_title;
        }
        
        return $contact_forms;
    }
}