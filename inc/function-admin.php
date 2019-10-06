<?php 
/**
 * @package sunset-theme
 * ======================================
 * ADMIN PAGE
 * ======================================
 */
 function sunset_add_admin_page(){
    //  Generate Sunset admin page
    add_menu_page( 
        'Sunset Theme Options',
        'Sunset',
        'manage_options', 
        'sunset_options',
        'sunset_theme_create_page',
        get_template_directory_uri() . '/img/sunset-icon.png',
        110 
    ); 
    // Generate Sunset sub-admin page Sidebar
    add_submenu_page( 
        'sunset_options',
        'Sunset Sidebar Options',
        'Sidebar',
        'manage_options',
        'sunset_options',
        'sunset_theme_create_page'
    );
    // Generate Sunset sub-admin page theme options 
    add_submenu_page( 
        'sunset_options',
        'Sunset Theme Options',
        'Theme Options',
        'manage_options',
        'sunset_theme_support',
        'sunset_theme_support_page'
    ); 
    // Generate Sunset sub-admin page Contact-Form 
    add_submenu_page( 
        'sunset_options',
        'Sunset Contact Form',
        'Contact Form',
        'manage_options',
        'sunset_contact_form', // this id used By the section i identify
        'sunset_theme_contact_form_page'
     );              
    // Generate Sunset sub-admin page 
    add_submenu_page( 
        'sunset_options',
        'Sunset Css Settings',
        'Css Setting',
        'manage_options',
        'sunset_options_css_settings',
        'sunset_theme_settings_page'
    );       
    // Activate Custom Settings 
    add_action('admin_init', 'sunset_custom_settings');
}

add_action('admin_menu','sunset_add_admin_page' );

function sunset_custom_settings() {
    // Sidebar options 
    register_setting('sunset-settings-group',   'profile_picture' );
    register_setting('sunset-settings-group',   'first_name' );
    register_setting('sunset-settings-group',   'last_name' );
    register_setting('sunset-settings-group',   'user_description' );
    register_setting('sunset-settings-group',   'twitter_handler', 'sunset_sanitize_twitter_handler' );
    register_setting('sunset-settings-group',   'facebook_handler' );
    register_setting('sunset-settings-group',   'gplus_handler' );
    //  adding setting section for sidebar
    add_settings_section( 
        'sunset-sidebar-options',
        'Sidebar Option',
        'sunset_sidebar_options',
        'sunset_options'
    );
    //  adding setting section for sidebar
    add_settings_section( 
        'sunset-sidebar-options',
        'Sidebar Option',
        'sunset_sidebar_options',
        'sunset_options'
    );
    //  add field to sidebar section profile_picture Field
    add_settings_field( 
        'sidebar-profile_picture',
        'Profile Picture',
        'sunset_sidebar_profile_picture',
        'sunset_options',
        'sunset-sidebar-options' 
    );
    //  add field to sidebar section Full Name Field
    add_settings_field( 
        'sidebar-fullname',
        'Full Name',
        'sunset_sidebar_name',
        'sunset_options',
        'sunset-sidebar-options' 
    ); 
    //  add field to sidebar section description Field
    add_settings_field( 
        'sidebar-description',
        'Description',
        'sunset_sidebar_description',
        'sunset_options',
        'sunset-sidebar-options' 
    ); 
    //  add field to sidebar section twitter Field
    add_settings_field( 
        'sidebar-twitter',
        'Twitter Handler',
        'sunset_sidebar_twitter',
        'sunset_options',
        'sunset-sidebar-options' 
    ); 
    //  add field to sidebar section facebook Field
    add_settings_field( 
        'sidebar-facebook',
        'Facebook Handler',
        'sunset_sidebar_facebook',
        'sunset_options',
        'sunset-sidebar-options' 
    ); 
    //  add field to sidebar section gplus Field
    add_settings_field( 
        'sidebar-gplus',
        'Google+ Handler',
        'sunset_sidebar_gplus',
        'sunset_options',
        'sunset-sidebar-options' 
    );
    
    //  Theme-support options
    // register the theme-support option 
    register_setting( 
        'sunset-theme-support',
        'post_formats' 
    );
    register_setting( 
        'sunset-theme-support',
        'custom_header' 
    );
    register_setting( 
        'sunset-theme-support',
        'custom_background' 
    );
    //  add setting to to theme-support section
    add_settings_section(  
        'sunset-theme-support',
        'Theme Options',
        'sunset_theme_options',
        'sunset_theme_support' 
    );

    //  add 
    add_settings_field( 
        'post-formats',
        'Post Formats',
        'sunset_post_formats',
        'sunset_theme_support',
        'sunset-theme-support'
    );
    add_settings_field( 
        'custom-header',
        'Custom Header',
        'sunset_custom_header',
        'sunset_theme_support',
        'sunset-theme-support'
    );
    add_settings_field( 
        'custom-background',
        'Custom Background',
        'sunset_custom_background',
        'sunset_theme_support',
        'sunset-theme-support'
    );         

     // Contact Form Options
    register_setting( 
        'sunset-contact-options',// option-group here  i will use it in the form fields
        'activate_contact_form'  // option-name
    );
     // create form section    
     add_settings_section( 
         'sunset-contact-section',
         'Contact Form',
         'sunset_contact_section',
         'sunset_contact_form' // this id
     );
     //  adding field for activation
    add_settings_field( 
        'activate-form',    // id
        'Activate Form', // title
        'sunset_activate_contact_form',// call-back function for activation
        'sunset_contact_form',  // here the  id of the page i create for the contact form 
        'sunset-contact-section'// section id which the field will be attached
    );
 } 

/**
 * Sidebar Function
 */
// function to sidebar options section
function sunset_sidebar_options(){
    echo 'Custom Your Sunset Sidebar';
} 
//  function for Profile Picture field  
function sunset_sidebar_profile_picture(){
    $profile_picture = esc_attr( get_option('profile_picture') );  
    if (empty($profile_picture)){
        echo   "<input type='button' class='button button-secondary'  value='Upload Profile Picture' id='upload-button'> " .
                "<input type='hidden' id='profile-picture' name='profile_picture' value=''  />";
    } else {
        echo   "<input type='button' class='button button-secondary'  value='Replace Profile Picture' id='upload-button' /> " .
                "<input type='hidden'  id='profile-picture' name='profile_picture' value='".$profile_picture."' />".
                "<input type='button' class='button button-secondary' value='Remove Profile Picture' id='remove-profile-picture' />";
    }
     
 } 
//  function for Full name field name
function sunset_sidebar_name(){
    $firstName = esc_attr( get_option('first_name') ); // this id name will be the register one in register settings
    $lastName = esc_attr( get_option('last_name') ); // this id name will be the register one in register settings
    echo "<input type='text' name='first_name' value='". $firstName .  "' placeholder='First Name' />";
    echo "<input type='text' name='last_name' value='". $lastName .  "' placeholder='Last Name' />";
} 
//  function for user_description field name
function sunset_sidebar_description(){
    $user_description = esc_attr( get_option('user_description') ); // this id name will be the register one in register settings
     echo "
            <input type='text' name='user_description' value='". $user_description .  "' placeholder='Description' />
            <p class='description'>Type Brief Bio</p>
        ";
 }

//  function for twitter field name
function sunset_sidebar_twitter(){
    $twitter = esc_attr( get_option('twitter_handler') ); // this id name will be the register one in register settings
     echo "
            <input type='text' name='twitter_handler' value='". $twitter .  "' placeholder='Twitter handler' />
            <p class='description'>Type Twitter Account without '@' letter</p>
          ";
 }

//  function for facebook field name
function sunset_sidebar_facebook(){
    $facebook = esc_attr( get_option('facebook_handler') ); // this id name will be the register one in register settings
     echo "<input type='text' name='facebook_handler' value='". $facebook .  "' placeholder='facebook handler' />";
 }

 //  function for gplus field name
function sunset_sidebar_gplus(){
    $gplus = esc_attr( get_option('gplus_handler') ); // this id name will be the register one in register settings
     echo "<input type='text' name='gplus_handler' value='". $gplus .  "' placeholder='Google+ handler' />";
 }


// Sanitization Settings
function sunset_sanitize_twitter_handler($input_value){
    $output = sanitize_text_field($input_value );
    $output = str_replace('@', '', $output);
    return $output;
} 


/**
 * Post Formats Call-back Function
 */

 // here post_format for theme-support options
 
function sunset_theme_options() {
    echo "Activate And Deactive Specific Theme Support Options";
}


//  this  post formats field
function sunset_post_formats() {
    $options =   get_option('post_formats') ;
    $formats = array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat');
    $output = '';
    foreach($formats as $format){
        $checked = ( @$options[$format] == 1  ? 'checked' : '' );
        $output .= '
                    <label>
                        <input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked . ' />' 
                         .
                         $format 
                         . 
                    '</label>
                    <br>';
        
    }
    echo $output;
}
//  this  custom headerfield
function sunset_custom_header() {
    $options =   get_option('custom_header') ;
    $checked = ( @$options == 1  ? 'checked' : '' );
    echo '
                <label>
                    <input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked . ' />  
                       Activate Custom Header
                 </label>
                <br>';
        
 }
 //  this  custom background
function sunset_custom_background() {
    $options =   get_option('custom_background') ;
    $checked = ( @$options == 1  ? 'checked' : '' );
    echo        '<label>
                    <input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked . ' />  
                        Activate Custom Background
                 </label>
                <br>';
        
 }

//  contact form section call-back function 
function sunset_contact_section() {
    echo 'Activate and Deactivate the Built-in Contact-Form';
}

// contact Form Call-back Function 
function sunset_activate_contact_form(){
    $options =   get_option('activate_contact_form') ;
    $checked = ( @$options == 1  ? 'checked' : '' );
    echo '
        <label>
            <input type="checkbox" id="activate_contact_form" name="activate_contact_form" value="1" '.$checked . ' />  
            </label>
        <br>';
}

/**
 * =====================================
 * sunset Template submenu call-back function
 */

//  sidebar option
function sunset_theme_create_page() {
    //   generate of our admin page
    require_once(get_template_directory() . '/inc/templates/sunset-admin.php');
} 
// css option call-back function
function sunset_theme_settings_page() {
    //   generate of our admin page css sub-page
}
// for support page
function sunset_theme_support_page() {
    require_once(get_template_directory(  ). '/inc/templates/sunset-theme-suppport.php');
}
// for contact form 
function sunset_theme_contact_form_page() {
    require_once(get_template_directory(  ). '/inc/templates/sunset-contact-form.php');
}