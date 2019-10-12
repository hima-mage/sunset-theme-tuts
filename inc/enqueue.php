<?php 
/**
 * @package sunset-theme
 * ======================================
 * ADMIN ENQUEUE FUNCTIONS
 * ======================================
 */
function sunset_load_admin_scripts($hook){
    
    //  check if i was on the sunset-them page
    if('toplevel_page_sunset_options' != $hook){
        return;
    }

    //  register sunset_admin css file
    wp_register_style( 
                    'sunset_admin', // name of the stylesheet which should be unique
                    get_template_directory_uri() . '/css/sunset.admin.css', // URL to the stylesheet
                    [], // this deps para define any stylesheet that file depend on
                    '1.0.0', // this version num
                    'all'  // define the media that file support
                );

    // Enqueue a sunset_admin stylesheet.
    wp_enqueue_style( 'sunset_admin');

    // Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.  
    wp_enqueue_media();

    //  register the sunset-admin-script script to use it 
    wp_register_script( 
                    'sunset-admin-script', // name of the script
                    get_template_directory_uri(  ) . '/js/sunset.admin.js',// URL to the script
                    ['jquery'],// this deps para define any script that file depend on
                    '1.0.0',// this version num
                    true // in footer
                );

    // Enqueue a sunset-admin-script script.            
    wp_enqueue_script( 'sunset-admin-script');         
}


// here i hook this function to be loaded only in admin panel
add_action( 
    'admin_enqueue_scripts', //Enqueue scripts for all admin pages.
    'sunset_load_admin_scripts' // function name
);