<?php 
/**
 * @package sunset-theme
 * ======================================
 * ADMIN ENQUEUE FUNCTIONS
 * ======================================
 */
function sunset_load_admin_scripts($hook){
    
     if('toplevel_page_sunset_options' != $hook){
        return;
    }
    wp_register_style( 
                    'sunset_admin',
                    get_template_directory_uri() . '/css/sunset.admin.css',
                    [],
                    '1.0.0',
                    'all' 
                );

    wp_enqueue_style( 'sunset_admin');
    wp_enqueue_media();
    wp_register_script( 
                    'sunset-admin-script',
                    get_template_directory_uri(  ) . '/js/sunset.admin.js',
                    ['jquery'],
                    '1.0.0',
                    true
                );
    wp_enqueue_script( 'sunset-admin-script');
                
}
// here i hook this style to be loaded only in admin panel
add_action( 'admin_enqueue_scripts', 'sunset_load_admin_scripts');