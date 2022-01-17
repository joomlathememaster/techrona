<?php
if(!function_exists('techrona_get_sidebar')){
    function techrona_get_sidebar($check = true){
        global $wp_query; 
        if ( isset($_GET['post_type'])) {
            $sidebar = 'sidebar-'.sanitize_text_field($_GET['post_type']);
        } elseif (isset($wp_query->post->post_type) && !is_search()){ 
            $page_template = get_page_template_slug($wp_query->post);  
            if(is_singular('product')){
                $sidebar = 'sidebar-single-product';
            }
            else{ 
                if(is_page_template( 'template-parts/blog-classic.php' ))
                    $sidebar = 'sidebar-post';
                else
                    $sidebar = 'sidebar-'.$wp_query->post->post_type;
            }
        }elseif ( is_search() ) {
            $sidebar = 'sidebar-post';
        } else {
            $sidebar = 'sidebar-post';
        }
        
        if($check)
            return is_active_sidebar($sidebar);
        else 
            return $sidebar;
    }
}
if(!function_exists('techrona_sidebar_position')){
    function techrona_sidebar_position($args = []){ 
        global $wp_query;
        $args = wp_parse_args($args, [
            'sidebar_pos' => 'archive_sidebar_pos'
        ]);
        //var_dump(techrona_get_opts('single_sidebar_pos',''));
        $sidebar_pos = isset($_GET['sidebar_pos']) ? sanitize_text_field($_GET['sidebar_pos']) : techrona_get_opts($args['sidebar_pos'], techrona_configs('blog')['archive_sidebar_pos']);
        return $sidebar_pos;
    }
}
/*
 * Sidebar area css class
*/
function techrona_sidebar_css_class($args=[]){
    $args = wp_parse_args($args, [
        'content_col' => 'archive_content_col',
        'sidebar_pos' => 'archive_sidebar_pos',
        'class'       => ''
    ]);
    $classes = [
        'kng-sidebar-area',
        'kng-sidebar-area-'.techrona_sidebar_position(['sidebar_pos' => $args['sidebar_pos']])
    ];
    $sidebar_position   = techrona_sidebar_position(['sidebar_pos' => $args['sidebar_pos']]);
    if( in_array($sidebar_position, ['0', 'none', 'bottom']) ){
        $classes[] = 'col-12';
    } else {
        $content_grid_class = (int) techrona_get_opts($args['content_col'], techrona_configs('blog')['archive_content_col']);
        $sidebar_grid_class = 12 - $content_grid_class;
        $classes[] = 'col-lg-'.$sidebar_grid_class; 
    }
    $classes[] = $args['class'];
    echo trim(implode(' ', $classes));
}
/**
 * Show Sidebar
*/
function techrona_sidebar($args = []){
    $args = wp_parse_args($args, [
        'content_col' => 'archive_content_col',
        'sidebar_pos' => 'archive_sidebar_pos',
        'class'       => '',
        'inner_class' => ''
    ]);
    $sidebar            = techrona_get_sidebar(false);
    $sidebar_position   = techrona_sidebar_position([
        'sidebar_pos' => $args['sidebar_pos']
    ]);
    if( in_array($sidebar_position, ['0','none']) ) return;
    if ( class_exists('Woocommerce') && (is_cart() || is_checkout() || is_account_page() || get_option( 'woosw_page_id',0) == get_the_ID() )) return;
    ?>
    <div id="kng-sidebar-area" class="<?php techrona_sidebar_css_class(['content_col' => $args['content_col'], 'sidebar_pos' => $args['sidebar_pos'],'class' => $args['class']]); ?>">
        <div class="kng-sidebar-area-inner <?php echo esc_attr($args['inner_class']);?>"><?php
            get_sidebar(); 
        ?></div>
    </div>
    <?php
}
 
 