<?php 
    require get_theme_file_path('/inc/rest-api.php');  // Inc rest-api.php file

    function load_assets() {
        // import css file
        wp_enqueue_style("bootstrapCss", get_theme_file_uri('/assets/vendors/css/bootstrap.min.css'), array(), "5.0.2", "all");
        wp_enqueue_style("fontAwesome", get_theme_file_uri('/assets/vendors/css/font-awesome.min.css'), array(), "6.5.1", "all");
        wp_enqueue_style("favicon", get_theme_file_uri('/assets/images/favicon.ico'), array(), "1.0.0", "all");
        wp_enqueue_style("cssCustom", get_theme_file_uri('/assets/css/style.css'), array(), "1.0.0", "all");
        
        // import js file
        wp_enqueue_script("jQueryJs", get_theme_file_uri() . '/assets/vendors/js/jquery.min.js', array('jquery'), "5.0.2", true);
        wp_enqueue_script("fontAwesomeJs", get_theme_file_uri() . '/assets/vendors/js/font-awesome.min.js', array('jquery'), "6.5.1", true);
        wp_enqueue_script("bootstrapJs", get_theme_file_uri() . '/assets/vendors/js/bootstrap.min.js', array('jquery'), "5.0.2", true);
        wp_enqueue_script("wowJs", get_theme_file_uri() . '/assets/vendors/js/wow.min.js', array('jquery'), "1.0.2", true);
        wp_enqueue_script("buildIndex", get_theme_file_uri() . '/build/index.js', array('jquery'), '1.0.2', true);
        wp_localize_script("variableGlobal", 'variableGlobal', array('root_url' => get_site_url()));
    }
    add_action("wp_enqueue_scripts", "load_assets");

    // Register Menu
    function leo_register_my_menu() {
        register_nav_menu('top-menu',__( 'Menu Top' ));
        register_nav_menu('bottom-menu',__( 'Menu Bottom' ));
    }
    add_action( 'init', 'leo_register_my_menu' );

    // Register widget
    if (function_exists('register_sidebar')){
        register_sidebar(
            array(
                'name'=> 'Cột bên',
                'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
                'before_widget' => '<div id="%1$s menu-cot-ben" class="widget %2$s">',
                'after_widget'  => '</div>',
                'id' => 'sidebar',
            ),
        );
    }

    // Create theme options
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title' 	=> 'Theme options', // Title hiển thị khi truy cập vào Options page
            'menu_title'	=> 'Theme options', // Tên menu hiển thị ở khu vực admin
            'menu_slug' 	=> 'theme-settings', // Url hiển thị trên đường dẫn của options page
            'capability'	=> 'edit_posts',
            'redirect'	=> false
        ));
    }

    // Switch to the home page when the user clicks on the wordpress icon
    add_filter('login_headerurl', 'leo_redirectHomePage');
    function leo_redirectHomePage() {
        return esc_url(site_url('/'));
    }

    
