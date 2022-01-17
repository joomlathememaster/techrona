<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}
 
$opt_name = techrona_get_theme_opt_name();
$theme = wp_get_theme();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => class_exists('Kngtheme_Core') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'techrona'),
    'page_title'           => esc_html__('Theme Options', 'techrona'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'show_options_object' => false,
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => class_exists('Kngtheme_Core') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => false,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'             => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'techrona'),
    'icon'   => 'el-icon-home',
    'fields' => array()
));
/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Colors', 'techrona'),
    'icon'       => 'dashicons dashicons-dashboard',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'techrona'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'second_color',
            'type'        => 'color',
            'title'       => esc_html__('Secondary Color', 'techrona'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'second_color2',
            'type'        => 'color',
            'title'       => esc_html__('Secondary Color 2', 'techrona'),
            'transparent' => false,
            'default'     => '#FFF6F0'
        ),
        array(
            'id'          => 'third_color',
            'type'        => 'color',
            'title'       => esc_html__('Third Color', 'techrona'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'rating_color',
            'type'        => 'color',
            'title'       => esc_html__('Rating Color', 'techrona'),
            'transparent' => false,
            'default'     => ''
        ),
        
        array(
            'id'          => 'link_color',
            'type'        => 'link_color',
            'title'       => esc_html__('Link Color', 'techrona')
        )
    )
));

/*--------------------------------------------------------------
# Tools
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Tools', 'techrona'),
    'icon'       => 'el-icon-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'show_page_loading',
            'type'     => 'button_set',
            'title'    => esc_html__('Page loading', 'techrona'),
            'options' => array(
                '0'  => esc_html__('Off', 'techrona'),
                '1'  => esc_html__('Style 1', 'techrona'),
                '2' => esc_html__('Style 2', 'techrona')
            ), 
            'default' => '0',
        ),
        array(
            'id'       => 'loading_img',
            'type'     => 'media',
            'title'    => esc_html__('Loading icon image ', 'techrona'),
            'default' => array(
                'url'=>''
            ),
            'required' => array( 'show_page_loading' , '=', '1' )
        ),
        array(
            'id'       => 'back_totop_on',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Back To Top', 'techrona'),
            'default'  => '1'
        ),
        array(
            'id'       => 'dev_mode',
            'type'     => 'switch',
            'title'    => esc_html__('Dev Mode (not recommended)', 'techrona'),
            'description' => esc_html__('no minimize , generate css over time...', 'techrona'),
            'default'  => false
        )
    )
));
/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'techrona'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'       => 'body_typo',
            'type'     => 'select',
            'title'    => esc_html__('Body Typography', 'techrona'),
            'options'  => array(
                'default' => esc_html__('Default', 'techrona'),
                'custom'  => esc_html__('Custom', 'techrona'),
            ),
            'default'  => 'default',

        ),
        array(
            'id'             => 'body_font_typo',
            'type'           => 'typography',
            'title'          => esc_html__('Body Google Font', 'techrona'),
            'subtitle'       => esc_html__('This will be the default font of your website.', 'techrona'),
            'letter-spacing' => true,
            'text-align'     => false,
            'units'          => 'px',
            'required'       => array( 0 => 'body_typo', 1 => 'equals', 2 => 'custom' ),
            'output'           => 'body'
        ),
        array(
            'id'       => 'heading_font_typo',
            'type'     => 'select',
            'title'    => esc_html__('Heading Typography', 'techrona'),
            'options'  => array(
                'default' => esc_html__('Default', 'techrona'),
                'custom'  => esc_html__('Google Font', 'techrona'),
            ),
            'default'  => 'default',
        ),
        array(
            'id'             => 'h1_typo',
            'type'           => 'typography',
            'title'          => esc_html__('H1', 'techrona'),
            'subtitle'       => esc_html__('This will be the default font for all H1 tags of your website.', 'techrona'),
            'letter-spacing' => true,
            'text-align'     => false,
            'units'          => 'px',
            'output'      => array('h1', '.h1'),
            'required'       => array( 0 => 'heading_font_typo', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'             => 'h2_typo',
            'type'           => 'typography',
            'title'          => esc_html__('H2', 'techrona'),
            'subtitle'       => esc_html__('This will be the default font for all H2 tags of your website.', 'techrona'),
            'letter-spacing' => true,
            'text-align'     => false,
            'units'          => 'px',
            'output'      => array('h2', '.h2'),
            'required'       => array( 0 => 'heading_font_typo', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'             => 'h3_typo',
            'type'           => 'typography',
            'title'          => esc_html__('H3', 'techrona'),
            'subtitle'       => esc_html__('This will be the default font for all H3 tags of your website.', 'techrona'),
            'letter-spacing' => true,
            'text-align'     => false,
            'units'          => 'px',
            'output'      => array('h3', '.h3'),
            'required'       => array( 0 => 'heading_font_typo', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'             => 'h4_typo',
            'type'           => 'typography',
            'title'          => esc_html__('H4', 'techrona'),
            'subtitle'       => esc_html__('This will be the default font for all H4 tags of your website.', 'techrona'),
            'letter-spacing' => true,
            'text-align'     => false,
            'units'          => 'px',
            'output'      => array('h4', '.h4'),
            'required'       => array( 0 => 'heading_font_typo', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'             => 'h5_typo',
            'type'           => 'typography',
            'title'          => esc_html__('H5', 'techrona'),
            'subtitle'       => esc_html__('This will be the default font for all H5 tags of your website.', 'techrona'),
            'letter-spacing' => true,
            'text-align'     => false,
            'units'          => 'px',
            'output'      => array('h5', '.h5'),
            'required'       => array( 0 => 'heading_font_typo', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'             => 'h6_typo',
            'type'           => 'typography',
            'title'          => esc_html__('H6', 'techrona'),
            'subtitle'       => esc_html__('This will be the default font for all H6 tags of your website.', 'techrona'),
            'letter-spacing' => true,
            'text-align'     => false,
            'units'          => 'px',
            'output'      => array('h6', '.h6'),
            'required'       => array( 0 => 'heading_font_typo', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        )
    )
));
$custom_font_selectors_1 = Redux::getOption($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Custom Fonts', 'techrona'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_1',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'techrona'),
            'subtitle'    => esc_html__('This will be the font that applies to the class selector.', 'techrona'),
            'text-align'  => false,
            'output'      => $custom_font_selectors_1,
            'units'       => 'px',
        ),
        array(
            'id'       => 'custom_font_selectors_1',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'techrona'),
            'subtitle' => esc_html__('Add class selectors to apply above font.', 'techrona'),
            'validate' => 'no_html'
        )
    )
));
  
// Header layout
Redux::setSection(
    $opt_name, 
    array(
        'title'  => esc_html__('Header', 'techrona'),
        'icon'   => 'el-icon-website',
        'fields' => array_merge(
            techrona_header_opts()
        )
    )
);

Redux::setSection(
    $opt_name, 
    array(
        'title'  => esc_html__('Header Mobile', 'techrona'),
        'icon'       => 'el-icon-website',
        'fields' => array_merge(
            techrona_header_mobile_opts(),
            array(
                array(
                    'id'       => 'header_mobile_is_sticky',
                    'title'    => esc_html__('Header Mobile Sticky', 'techrona'),
                    'type'     => 'switch',
                    'default'  => false,
                )
            )       
        )
    )
);
 
/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, techrona_page_title_opts());

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/
Redux::setSection($opt_name, array(
        'title'  => esc_html__('Content', 'techrona'),
        'icon'   => 'el-icon-pencil',
        'fields' => array(
        array(
            'id'       => 'content_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Background Color', 'techrona'),
            'subtitle' => esc_html__('Content background color.', 'techrona'),
            'output'   => array('background-color' => '.kng-main')
        ),
        array(
            'id'             => 'content_padding',
            'type'           => 'spacing',
            'output'         => array('#kng-main'),
            'right'          => false,
            'left'           => false,
            'mode'           => 'padding',
            'units'          => array('px'),
            'units_extended' => 'false',
            'title'          => esc_html__('Content Padding', 'techrona'),
            'desc'           => esc_html__('Default: Top-90px, Bottom-90px', 'techrona'),
            'default'        => array(
                'padding-top'    => '',
                'padding-bottom' => '',
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'search_field_placeholder',
            'type'    => 'text',
            'title'   => esc_html__('Search Form - Text Placeholder', 'techrona'),
            'default' => '',
            'desc'           => esc_html__('Default: Search...', 'techrona'),
        )
    )
));
// Single Page
Redux::setSection($opt_name, techrona_page_layout_opts() );

// Archive
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive', 'techrona'),
    'icon'       => 'el-icon-list',
    'subsection' => true,
    'fields'     => array(
        techrona_sidebar_opts([
            'name'          => 'archive_sidebar_pos',
            'fields_only'   =>  true,
            'default_value' => techrona_configs('blog')['archive_sidebar_pos']  
        ]),
        array(
            'id'            => 'archive_content_col',
            'title'         => esc_html__('Content Columns', 'techrona'),
            'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
            'type'          => 'slider',
            'default'       => techrona_configs('blog')['archive_content_col'],
            'min'           => 1,
            'step'          => 1,
            'max'           => 11,
            'display_value' => 'label',
            'required'      => [ 
                ['archive_sidebar_pos', '!=', '0'],
                ['archive_sidebar_pos', '!=', 'bottom']
            ],
        ),
        array(
            'id'       => 'archive_categories_on',
            'title'    => esc_html__('Categories', 'techrona'),
            'subtitle' => esc_html__('Show category names on each post.', 'techrona'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'archive_author_on',
            'title'    => esc_html__('Author', 'techrona'),
            'subtitle' => esc_html__('Show author name on each post.', 'techrona'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_date_on',
            'title'    => esc_html__('Date', 'techrona'),
            'subtitle' => esc_html__('Show date posted on each post.', 'techrona'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_comments_on',
            'title'    => esc_html__('Comments', 'techrona'),
            'subtitle' => esc_html__('Show comments count on each post.', 'techrona'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_share_on',
            'title'    => esc_html__('Share', 'techrona'),
            'subtitle' => esc_html__('Show Share on each post.', 'techrona'),
            'type'     => 'switch',
            'default'  => true,
        )
    )
));
// Sinlge post
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'techrona'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'single_post_title_layout',
            'type'     => 'button_set',
            'title'    => esc_html__('Post title layout', 'techrona'),
            'options'  => array(
                '0' => esc_html__('Default', 'techrona'),
                '1' => esc_html__('Custom Post Title', 'techrona'),
            ),
            'default'  => '0'
        ),
        array(
            'id'       => 'post_custom_title',
            'title'    => esc_html__('Custom Post Title', 'techrona'),
            'subtitle' => esc_html__('Show custom post title instead of post title.', 'techrona'),
            'type'     => 'text',
            'default'  => esc_html__('Blog details', 'techrona'),
            'required'      => [ 'single_post_title_layout', '=', '1']
        ),
        techrona_sidebar_opts([
            'name'          => 'single_sidebar_pos',
            'fields_only'   =>  true,
            'default_value' => techrona_configs('blog')['single_sidebar_pos']  
        ]),
        array(
            'id'            => 'single_content_col',
            'title'         => esc_html__('Content Columns', 'techrona'),
            'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
            'type'          => 'slider',
            'default'       => techrona_configs('blog')['single_content_col'],
            'min'           => 1,
            'step'          => 1,
            'max'           => 12,
            'display_value' => 'label',
            'required'      => [ 
                ['single_sidebar_pos', '!=', '0'],
                ['single_sidebar_pos', '!=', 'bottom']
            ],
        ),
        array(
            'id'       => 'post_feature_image_on',
            'title'    => esc_html__('Feature Image', 'techrona'),
            'subtitle' => esc_html__('Show feature image on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_feature_image_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Feature Image Type', 'techrona'),
            'subtitle' => esc_html__('Feature image Type on single post.', 'techrona'),
            'options' => array(
                'cropped'  => esc_html__('Cropped Image', 'techrona'),
                'full'  => esc_html__('Full Image', 'techrona'),
                'background' => esc_html__('Background image', 'techrona')
            ), 
            'default' => 'cropped',
            'required' => [
               'post_feature_image_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_author_info_on',
            'title'    => esc_html__('Author Info (Biographical Info must not empty)', 'techrona'),
            'subtitle' => esc_html__('Show author info name on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0'
        ),        
        array(
            'id'       => 'post_tags_on',
            'title'    => esc_html__('Tags', 'techrona'),
            'subtitle' => esc_html__('Show tag names on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_comments_on',
            'title'    => esc_html__('Comments', 'techrona'),
            'subtitle' => esc_html__('Show comments count on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_share_this',
            'title'    => esc_html__('Social Share on above post title', 'techrona'),
            'subtitle' => esc_html__('Show all social share icon on popup.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0',
        ),
        array(
            'id'       => 'post_social_share_on',
            'title'    => esc_html__('Social Share', 'techrona'),
            'subtitle' => esc_html__('Show social share on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'post_social_share_icon',
            'type'     => 'button_set',
            'title'    => esc_html__('Select Social Share', 'techrona'),
            'subtitle' => esc_html__('Show social share on single post.', 'techrona'),
            'multi'    => true,
            'options' => array(
                'facebook'  => esc_html__('Facebook', 'techrona'),
                'instagram' => esc_html__('Instagram', 'techrona'),
                'twitter'   => esc_html__('Twitter', 'techrona'),
                'linkedin'  => esc_html__('Linkedin', 'techrona'),
                'pinterest' => esc_html__('Pinterest', 'techrona')
            ), 
            'default' => array('facebook', 'instagram', 'twitter', 'linkedin', 'Pinterest'),
            'required' => [
               'post_social_share_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_nav_link_on',
            'title'    => esc_html__('Post Navigation', 'techrona'),
            'subtitle' => esc_html__('Show next/preview Navigation.', 'techrona'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'post_nav_thumbnail_on',
            'title'    => esc_html__('Post Title Thumbnail ', 'techrona'),
            'subtitle' => esc_html__('Show next/preview Post Title Thumbnail.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0',
            'required' => [
               'post_nav_link_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_nav_title_on',
            'title'    => esc_html__('Post Title Navigation ', 'techrona'),
            'subtitle' => esc_html__('Show next/preview Post Title.', 'techrona'),
            'type'     => 'switch',
            'default'  => '1',
            'required' => [
               'post_nav_link_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_comments_form_on',
            'title'    => esc_html__('Comments Form', 'techrona'),
            'subtitle' => esc_html__('Show comments form on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '1'
        ),
        array(
            'id'       => 'post_comments_phone_on',
            'title'    => esc_html__('Comments Phone', 'techrona'),
            'subtitle' => esc_html__('Show comments Phone field on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0',
            'required' => [
               'post_comments_form_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_comments_subject_on',
            'title'    => esc_html__('Comments Subject', 'techrona'),
            'subtitle' => esc_html__('Show comments Subject field on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0',
            'required' => [
               'post_comments_form_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_comments_subject_option',
            'type'     => 'multi_text',
            'title'    => esc_html__('Subject options values', 'techrona'),
            'subtitle' => esc_html__('Add subject option values', 'techrona'),
            'required' => [
               'post_comments_subject_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_comments_rating_on',
            'title'    => esc_html__('Comments Rating', 'techrona'),
            'subtitle' => esc_html__('Show comments rating field on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0',
            'required' => [
               'post_comments_form_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'post_related_on',
            'title'    => esc_html__('Related Post', 'techrona'),
            'subtitle' => esc_html__('Show related on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0'
        ),
        array(
            'id'       => 'recent_post_on',
            'title'    => esc_html__('Recent Post', 'techrona'),
            'subtitle' => esc_html__('Show Recent on single post.', 'techrona'),
            'type'     => 'switch',
            'default'  => '0'
        ),
        array(
            'id'       => 'recent_post_title',
            'type'     => 'text',
            'title'    => esc_html__('Recent Post Title', 'techrona'),
            'default'  => esc_html__('From Our Blog', 'techrona'),
            'required' => [
               'recent_post_on',
               'equals',
               '1' 
            ]
        ),
        array(
            'id'       => 'recent_post_style',
            'type'     => 'button_set',
            'title'    => esc_html__('Recent Post Style', 'techrona'),
            'options' => array(
                'style-1'  => esc_html__('Style 1', 'techrona'),
                'style-2'  => esc_html__('Style 2', 'techrona'),
            ), 
            'default' => 'style-1',
            'required' => [
               'recent_post_on',
               'equals',
               '1' 
            ]
        )
    )
));
// Archive case
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive Case', 'techrona'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        techrona_sidebar_opts([
            'name'          => 'archive_case_sidebar_pos',
            'fields_only'   =>  true,
            'default_value' => 'right'  
        ]),
        array(
            'id'            => 'archive_case_content_col',
            'title'         => esc_html__('Content Columns', 'techrona'),
            'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
            'type'          => 'slider',
            'default'       => 8,
            'min'           => 1,
            'step'          => 1,
            'max'           => 12,
            'display_value' => 'label',
            'required'      => [ 
                ['single_case_sidebar_pos', '!=', '0'],
                ['single_case_sidebar_pos', '!=', 'bottom']
            ],
        )
    )
));
// Sinlge Service
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Service', 'techrona'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        techrona_sidebar_opts([
            'name'          => 'single_service_sidebar_pos',
            'fields_only'   =>  true,
            'default_value' => 'right'  
        ]),
        array(
            'id'            => 'single_service_content_col',
            'title'         => esc_html__('Content Columns', 'techrona'),
            'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
            'type'          => 'slider',
            'default'       => 8,
            'min'           => 1,
            'step'          => 1,
            'max'           => 12,
            'display_value' => 'label',
            'required'      => [ 
                ['single_service_sidebar_pos', '!=', '0'],
                ['single_service_sidebar_pos', '!=', 'bottom']
            ],
        )
    )
));
 
// Sinlge case
Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Practice', 'techrona'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        techrona_sidebar_opts([
            'name'          => 'single_practice_sidebar_pos',
            'fields_only'   =>  true,
            'default_value' => 'right'  
        ]),
        array(
            'id'            => 'single_practice_content_col',
            'title'         => esc_html__('Content Columns', 'techrona'),
            'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
            'type'          => 'slider',
            'default'       => 8,
            'min'           => 1,
            'step'          => 1,
            'max'           => 12,
            'display_value' => 'label',
            'required'      => [ 
                ['single_practice_sidebar_pos', '!=', '0'],
                ['single_practice_sidebar_pos', '!=', 'bottom']
            ],
        ),
        array(
            'id'       => 'show_practice_feature_image',
            'title'    => esc_html__('Show feature image', 'techrona'),
            'subtitle' => esc_html__('Show/Hide feature image', 'techrona'),
            'type'     => 'switch',
            'default'  => '1',
        ),
        array(
            'id'       => 'show_practice_title',
            'title'    => esc_html__('Show title', 'techrona'),
            'subtitle' => esc_html__('Show/Hide title', 'techrona'),
            'type'     => 'switch',
            'default'  => '1',
        )
    )
));
//Redux::setSection($opt_name, techrona_sidebar_opts());
/* 404 Page /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'      => esc_html__('404 Page', 'techrona'),
    'icon'       => 'el-cog-alt el',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'img_404_logo',
            'type'     => 'media',
            'title'    => esc_html__('Image', 'techrona'),
            'default' => array()
        ),
        array(
            'id'       => 'img_404_page',
            'type'     => 'media',
            'title'    => esc_html__('Image', 'techrona'),
            'default' => array()
        ),
        array(
            'id'       => 'heading_404_page',
            'type'     => 'text',
            'title'    => esc_html__('Heading', 'techrona'),
            'subtitle' => esc_html__('Enter your text', 'techrona'),
            'desc'     => esc_html__('Leave blank to use default text', 'techrona'),
            'default'  => '',
        ),
        array(
            'id'       => 'btn_text_404_page',
            'type'     => 'text',
            'title'    => esc_html__('Button Text', 'techrona'),
            'subtitle' => esc_html__('Enter your text', 'techrona'),
            'default'  => '',
            'desc'     => esc_html__('Leave blank to use default text', 'techrona')
        )
    )
));

/*--------------------------------------------------------------
# Shop
--------------------------------------------------------------*/
if(class_exists('Woocommerce')) {
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Shop', 'techrona'),
        'icon'   => 'el el-shopping-cart',
        'fields' => array_merge(
            array(
                techrona_sidebar_opts([
                    'name'          => 'product_page_sidebar_pos',
                    'fields_only'   =>  true,
                    'default_value' => techrona_configs('blog')['single_sidebar_pos']  
                ]),
                array(
                    'id'            => 'product_page_content_col',
                    'title'         => esc_html__('Content Columns', 'techrona'),
                    'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
                    'type'          => 'slider',
                    'default'       => techrona_configs('blog')['archive_content_col'],
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 11,
                    'display_value' => 'label',
                    'required'      => [ 
                        ['product_page_sidebar_pos', '!=', '0'],
                        ['product_page_sidebar_pos', '!=', 'bottom']
                    ],
                ),
                array(
                    'title'         => esc_html__('Products displayed per row', 'techrona'),
                    'id'            => 'products_columns',
                    'type'          => 'slider',
                    'subtitle'      => esc_html__('Number product to show per row', 'techrona'),
                    'default'       => 3,
                    'min'           => 2,
                    'step'          => 1,
                    'max'           => 6,
                    'display_value' => 'text'
                ),
                array(
                    'title'         => esc_html__('Products displayed per page', 'techrona'),
                    'id'            => 'product_per_page',
                    'type'          => 'slider',
                    'subtitle'      => esc_html__('Number product to show', 'techrona'),
                    'default'       => 9,
                    'min'           => 3,
                    'step'          => 1,
                    'max'           => 50,
                    'display_value' => 'text'
                ), 
                array(
                    'id'       => 'product_image_cropped',
                    'title'    => esc_html__('Image Cropped', 'techrona'),
                    'subtitle' => esc_html__('Crop image for thumbnail, single, gallery', 'techrona'),
                    'type'     => 'switch',
                    'default'  => '1',
                )
            )
        )
    ));
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Single Products', 'techrona'),
        'icon'       => 'el el-shopping-cart',
        'subsection' => true,
        'fields'     => array_merge(
            array(
                techrona_sidebar_opts([
                    'name'          => 'product_single_sidebar_pos',
                    'fields_only'   =>  true,
                    'default_value' => techrona_configs('blog')['single_sidebar_pos']  
                ]),
                array(
                    'id'            => 'product_single_content_col',
                    'title'         => esc_html__('Content Columns', 'techrona'),
                    'subtitle'      => esc_html__('Choose content Columns', 'techrona'),
                    'type'          => 'slider',
                    'default'       => techrona_configs('blog')['archive_content_col'],
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 11,
                    'display_value' => 'label',
                    'required'      => [ 
                        ['product_single_sidebar_pos', '!=', '0'],
                        ['product_single_sidebar_pos', '!=', 'bottom']
                    ],
                ),
                array(
                    'id'       => 'disable_product_title',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Disable Product title', 'techrona'),
                    'options'  => array(
                        '0' => esc_html__('No', 'techrona'),
                        '1' => esc_html__('Yes', 'techrona'),
                    ),
                    'default'  => '1'
                ),
                 
                array(
                    'id'       => 'product_addition_tab',
                    'title'    => esc_html__('Show Additional information', 'techrona'),
                    'type'     => 'switch',
                    'default'  => '0',
                ),
                array(
                    'id'       => 'product_variation_style',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Product Variation Style', 'techrona'),
                    'subtitle' => esc_html__('Dropdown or selected list', 'techrona'),
                    'options' => array(
                        'dropdown'  => esc_html__('Dropdown', 'techrona'),
                        'list' => esc_html__('List', 'techrona')
                    ), 
                    'default' => 'dropdown'
                ),
                array(
                    'id'       => 'product_social_share_on',
                    'title'    => esc_html__('Social Share', 'techrona'),
                    'subtitle' => esc_html__('Show social share on single product.', 'techrona'),
                    'type'     => 'switch',
                    'default'  => '0',
                ),
                array(
                    'id'       => 'product_social_share_icon',
                    'type'     => 'button_set',
                    'title'    => esc_html__('Social Share', 'techrona'),
                    'subtitle' => esc_html__('Show social share on single post.', 'techrona'),
                    'multi'    => true,
                    'options' => array(
                        'facebook'  => esc_html__('Facebook', 'techrona'),
                        'instagram' => esc_html__('Instagram', 'techrona'),
                        'twitter'   => esc_html__('Twitter', 'techrona'),
                        'linkedin'  => esc_html__('Linkedin', 'techrona'),
                        'pinterest' => esc_html__('Pinterest', 'techrona'),
                        'google'    => esc_html__('Google Plus', 'techrona')
                    ), 
                    'default' => array('facebook', 'instagram', 'twitter', 'linkedin', 'google'),
                    'required' => [
                       'product_social_share_on',
                       'equals',
                       '1' 
                    ]
                ),
                // UpSells Product
                array(
                    'id'       => 'product_upsell',
                    'title'    => esc_html__('Up-Sells Product', 'techrona'),
                    'subtitle' => esc_html__('Show/Hide Up-Sells product', 'techrona'),
                    'type'     => 'switch',
                    'default'  => '1',
                ),
                array(
                    'id'            => 'product_upsell_total',
                    'title'         => esc_html__('Up-Sells Total', 'techrona'),
                    'subtitle'      => esc_html__('Total Up-Sells product display', 'techrona'),
                    'type'          => 'slider',
                    'default'       => '4',
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 12,
                    'display_value' => 'label',
                    'required' => [
                        ['product_upsell', '!=', '0'],
                    ]
                ),
                array(
                    'id'            => 'product_upsell_column',
                    'title'         => esc_html__('Up-Sells Columns', 'techrona'),
                    'subtitle'      => esc_html__('Choose your Columns', 'techrona'),
                    'type'          => 'slider',
                    'default'       => '4',
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 6,
                    'display_value' => 'label',
                    'required' => [
                        ['product_upsell', '!=', '0'],
                    ]
                ),
                // Related Product
                array(
                    'id'       => 'product_related',
                    'title'    => esc_html__('Product Related', 'techrona'),
                    'subtitle' => esc_html__('Show/Hide related product', 'techrona'),
                    'type'     => 'switch',
                    'default'  => '1',
                ),
                array(
                    'id'            => 'product_related_total',
                    'title'         => esc_html__('Related Total', 'techrona'),
                    'subtitle'      => esc_html__('Total related product display', 'techrona'),
                    'type'          => 'slider',
                    'default'       => '4',
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 12,
                    'display_value' => 'label',
                    'required' => [
                        ['product_related', '!=', '0'],
                    ]
                ),
                array(
                    'id'            => 'product_related_column',
                    'title'         => esc_html__('Related Columns', 'techrona'),
                    'subtitle'      => esc_html__('Choose your Columns', 'techrona'),
                    'type'          => 'slider',
                    'default'       => '4',
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 6,
                    'display_value' => 'label',
                    'required' => [
                        ['product_related', '!=', '0'],
                    ]
                )
            ),
            techrona_product_single_opts_wishlist_compare()
        )
    ));
    Redux::setSection($opt_name, array(
        'title'      => esc_html__('Cart Page', 'techrona'),
        'icon'       => 'el el-shopping-cart',
        'subsection' => true,
        'fields'     => array_merge(
            array(
                array(
                    'id'       => 'cart_cross_sell',
                    'title'    => esc_html__('Cross Sells', 'techrona'),
                    'subtitle' => esc_html__('Show/Hide Cross Sells product', 'techrona'),
                    'type'     => 'switch',
                    'default'  => '1',
                ),
                array(
                    'id'            => 'cart_cross_sell_total',
                    'title'         => esc_html__('Cross Sells Total', 'techrona'),
                    'subtitle'      => esc_html__('Total cross sell product display', 'techrona'),
                    'type'          => 'slider',
                    'default'       => '4',
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 12,
                    'display_value' => 'label',
                    'required' => [
                        ['cart_cross_sell', '!=', '0'],
                    ]
                ),
                array(
                    'id'            => 'cart_cross_sell_column',
                    'title'         => esc_html__('Cross Sells Columns', 'techrona'),
                    'subtitle'      => esc_html__('Choose your Columns', 'techrona'),
                    'type'          => 'slider',
                    'default'       => '4',
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 6,
                    'display_value' => 'label',
                    'required' => [
                        ['cart_cross_sell', '!=', '0'],
                    ]
                )
            )
        )
    ));
}

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/
Redux::setSection($opt_name, techrona_footer_opts());
 