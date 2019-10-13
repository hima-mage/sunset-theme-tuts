<?php 
/**
 * @package sunset-theme
 * ======================================
 * ADMIN ENQUEUE FUNCTIONS
 * ======================================
 */
function sunset_load_admin_scripts($hook){

    //   check if i was on the sunset-them page
    if('toplevel_page_sunset_options' == $hook){  

        //  register sunset_admin css file
        wp_register_style( 
            'sunset_admin', // name of the stylesheet which should be unique
            get_template_directory_uri() . '/css/sunset.admin.css', // URL to the stylesheet
            [], // this deps para define any stylesheet that file depend on
            '1.0.0', // this version num
            'all'  // define the media that file support
        );

        // Enqueue a sunset_admin stylesheet.
        wp_enqueue_style('sunset_admin');

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

    } else  if('sunset_page_sunset_options_css_settings' == $hook)  {
        // call css to style the ace editor
        wp_enqueue_style(
            'ace',
            get_template_directory_uri() . '/css/sunset.ace.css', // URL to the stylesheet
            [], // this deps para define any stylesheet that file depend on
            '1.0.0', // this version num
            'all'  // define the media that file support
        );
        //  calling ace editor library 
        wp_enqueue_script(  
            'ace', // unique name
            get_template_directory_uri(  ) . '/js/ace/ace.js',// URL to the script
            array('jquery'), // this library depend on it
            '1.4.6',  // version 
            true // in the footer
        );
        // here i will call the editor into the sub-page
        wp_enqueue_script(  
            'sunset-custom-css-script', // unique name
            get_template_directory_uri(  ) . '/js/sunset.custom.css.js',// URL to the script
            array('jquery'), // this library depend on it
            '1.0.0',  // version 
            true // in the footer
        );
    } else {  return ;  }     
}


// here i hook this function to be loaded only in admin panel
add_action( 
    'admin_enqueue_scripts', //Enqueue scripts for all admin pages.
    'sunset_load_admin_scripts' // function name
);


/**
 * @package sunset-theme
 * ======================================
 * FRONT-END ENQUEUE FUNCTIONS
 * ======================================
 */

 function sunset_load_frontend_scripts(){
    //  load bootstrap css file
    wp_enqueue_style(
        'bootstrap', // unique name of the stylesheet
        get_template_directory_uri() . '/css/bootstrap.min.css', // URL to the stylesheet
        [], // this deps para define any stylesheet that file depend on
        '4.3.1', // this version num
        'all'  // define the media that file support
    );
    // load my standard css file
    wp_enqueue_style(
        'sunset', // unique name of the stylesheet
        get_template_directory_uri() . '/css/sunset.css', // URL to the stylesheet
        [], // this deps para define any stylesheet that file depend on
        '1.0.0', // this version num
        'all'  // define the media that file support
    );
    // load my fonts
    wp_enqueue_style(
        'raleway', // unique name of the stylesheet
        "https://fonts.googleapis.com/css?family=Raleway&display=swap"
    );
    // i will work in how to load jquery file 
    // here i unregister jquery
    wp_deregister_script( 'jquery' );
    // register jquery v3.4.1
    wp_register_script(
        'jquery',// unique name of the js script
        get_template_directory_uri() . '/js/jquery.js', // URL to the js file
        false, // this deps para define any stylesheet that file depend on
        '3.4.1', // this version num
        true  // define the media that file support
    );
    // load jquary
    wp_enqueue_script( 'jquery');
    //  load bootstrap js file
    wp_enqueue_script(
        'bootstrap',// unique name of the js script
        get_template_directory_uri() . '/js/bootstrap.min.js', // URL to the js file
        ['jquery'], // this deps para define any stylesheet that file depend on
        '4.3.1', // this version num
        true  // define the media that file support
    );
 }
 add_action( 
     'wp_enqueue_scripts', // this the hook for the add the scripts of js/css
     'sunset_load_frontend_scripts' // name of the function
 );