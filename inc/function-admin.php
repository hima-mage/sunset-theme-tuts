<?php 
/**
 * @package sunset-theme
 * ======================================
 * ADMIN PAGE
 * ======================================
 */
 function sunset_add_admin_page(){

    //  Generate Sunset admin menu page 
    add_menu_page( 
        'Sunset Theme Options', // the title of the page when selected
        'Sunset', // this is the menu title
        'manage_options', // capability for the user manage_options
        'sunset_options', // slug name for page
        'sunset_theme_create_page', // call-back function to display the page content
        get_template_directory_uri() . '/img/sunset-icon.png', // this page icon in the menu
        110  // postion on the menu
    ); 
 
    // Generate  sub-page Sidebar for Sunset-admin menu page 
    add_submenu_page( 
        'sunset_options', // parent page slug
        'Sunset Sidebar Options', // this sub-page title 
        'Sidebar', // this sub-page title on the menu
        'manage_options', // capability for the use manage_options
        'sunset_options', // this sub-page slug
        'sunset_theme_create_page' // this call-back function to display the content
    );  
 
    // Generate  sub-admin page theme-options for Sunset-admin menu page 
    add_submenu_page( 
        'sunset_options',  // parent page slug
        'Sunset Theme Options', // this sub-page title 
        'Theme Options', // this sub-page title on the menu
        'manage_options', // capability for the use manage_options
        'sunset_theme_support', // this sub-page slug
        'sunset_theme_support_page' // this call-back function to display the content
    ); 

    // Generate Sunset sub-admin page Contact-Form 
    add_submenu_page( 
        'sunset_options', // parent page slug
        'Sunset Contact Form', // this sub-page title 
        'Contact Form',  // this sub-page title on the menu
        'manage_options', // capability for the use manage_options
        'sunset_contact_form', // this sub-page slug
        'sunset_theme_contact_form_page' // this call-back function to display the content
    ); 

    // Generate sub-page Css for the admin page menu
    add_submenu_page( 
        'sunset_options',  // parent page slug
        'Sunset Css Settings', // this sub-page title 
        'Css Setting', // this sub-page title on the menu
        'manage_options', // capability for the use manage_options
        'sunset_options_css_settings', // this sub-page slug
        'sunset_theme_settings_page' // this call-back function to display the content
    );

    // Activate Custom Settings 
    add_action( 
        'admin_init', // this is the tag 
        'sunset_custom_settings' // this the function to be add to the hook
    );
}

add_action(
    'admin_menu', // Runs after the basic admin panel menu structure is in place.
    'sunset_add_admin_page' // this function to hook
); 


// here all custom setting will be declared for the theme
function sunset_custom_settings() {
     
    /*
     ***************************************************** 
     * sidebar settings                                  *  
     *****************************************************
     */
 

    // register profile picture
    register_setting(
        'sunset-settings-group', // this option group to sign the setting to
        'profile_picture' // this option name
    );

    //  register first name
    register_setting(
        'sunset-settings-group',// this option group to sign the setting to
        'first_name' // this option name
    );

    //  register last name
    register_setting(
        'sunset-settings-group',
           'last_name' 
    );

    // register   user_description
    register_setting(
        'sunset-settings-group', // this option group to sign the setting to
        'user_description' // this option name
    );

    // register   twitter_handler
    register_setting(
        'sunset-settings-group', // this option group to sign the setting to
        'twitter_handler', // this option name
        'sunset_sanitize_twitter_handler'  // this args sanitize the input
    );

    // register   facebook_handler
    register_setting(
        'sunset-settings-group', // this option group to sign the setting to
        'facebook_handler'  // this option name
    );

    // register   gplus_handler
    register_setting(
        'sunset-settings-group',  // this option group to sign the setting to
        'gplus_handler'  // this option name
    );

   

    // add sidebar section 
    add_settings_section( 
        'sunset-sidebar-options', // id attribute for tags required
        'Sidebar Option', // section title  required
        'sunset_sidebar_options', // this call-back function to fill the section with it's content must be echo 
        'sunset_options'  // this is the page menu-slug to attach the section to
    );
 
    //  adding sidebar section 
    add_settings_section( 
        'sunset-sidebar-options',  // id attribute for tags required
        'Sidebar Option', // section title  required
        'sunset_sidebar_options',  // this call-back function to fill the section with it's content must be echo 
        'sunset_options' // this is the page menu-slug to attach the section to
    ); 

 
 
    //  add field to sidebar section profile_picture Field
    add_settings_field( 
        'sidebar-profile_picture', // this is id used as slug-name
        'Profile Picture', // this title display as label when output the field
        'sunset_sidebar_profile_picture', // this call-back function to fill the field with required input
        'sunset_options', // The slug-name of the settings page on which to show the section 
        'sunset-sidebar-options'  //  The slug-name of the section of the settings page in which to show the box.
    );

    //  add field to sidebar section Full Name Field
    add_settings_field( 
        'sidebar-fullname', // this is id used as slug-name
        'Full Name', // this title display as label when output the field
        'sunset_sidebar_name',  // this call-back function to fill the field with required input
        'sunset_options',  // The slug-name of the settings page on which to show the section 
        'sunset-sidebar-options'  //  The slug-name of the section of the settings page in which to show the box.
    ); 

    //  add field to sidebar section description Field
    add_settings_field( 
        'sidebar-description', // this is id used as slug-name
        'Description', // this title display as label when output the field
        'sunset_sidebar_description', // this call-back function to fill the field with required input
        'sunset_options',  // The slug-name of the settings page on which to show the section 
        'sunset-sidebar-options'  //  The slug-name of the section of the settings page in which to show the box.
    ); 

    //  add field to sidebar section twitter Field
    add_settings_field( 
        'sidebar-twitter', // this is id used as slug-name
        'Twitter Handler',  // this title display as label when output the field
        'sunset_sidebar_twitter', // this call-back function to fill the field with required input
        'sunset_options',  // The slug-name of the settings page on which to show the section 
        'sunset-sidebar-options'  //  The slug-name of the section of the settings page in which to show the box.
    ); 
    
    //  add field to sidebar section facebook Field
    add_settings_field( 
        'sidebar-facebook', // this is id used as slug-name
        'Facebook Handler',  // this title display as label when output the field
        'sunset_sidebar_facebook', // this call-back function to fill the field with required input
        'sunset_options',  // The slug-name of the settings page on which to show the section
        'sunset-sidebar-options' //  The slug-name of the section of the settings page in which to show the box.
    ); 

    //  add field to sidebar section gplus Field
    add_settings_field( 
        'sidebar-gplus',  // this is id used as slug-name
        'Google+ Handler', // this title display as label when output the field
        'sunset_sidebar_gplus', // this call-back function to fill the field with required input
        'sunset_options', // The slug-name of the settings page on which to show the section
        'sunset-sidebar-options' //  The slug-name of the section of the settings page in which to show the box.
    );

 
    /*
    ***************************************************** 
    * Theme-support  settings                           *
    *****************************************************
    */
    

    // register the theme-support post_formats
    register_setting( 
        'sunset-theme-support', // this is the option group
        'post_formats' // the name of the option to sanitize and save
    );

    // register the theme-support custom_header
    register_setting( 
        'sunset-theme-support', // this is the option group
        'custom_header' // the name of the option to sanitize and save
    ); 

    // register the theme-support custom_header
    register_setting( 
        'sunset-theme-support', // this is the option group
        'custom_background' // the name of the option to sanitize and save
    );

    

    //  add setting to to theme-support section
    add_settings_section(  
        'sunset-theme-support', // this is the option group
        'Theme Options', // this is the section title which will display
        'sunset_theme_options', // call-back function to echo the content of the section
        'sunset_theme_support'  // this slug-name of the page to attach the section to
    );

     
    // this post formats field
    add_settings_field( 
        'post-formats', // slug-name to identify the field
        'Post Formats', // this title of the field display as label
        'sunset_post_formats', // this call-back function to fill the field
        'sunset_theme_support', // this is the page-slug of the setting page to show this field
        'sunset-theme-support' //  The slug-name of the section of the settings page in which to show the box.
    );

    // this post formats custom-header
    add_settings_field( 
        'custom-header', // slug-name to identify the field
        'Custom Header', // this title of the field display as label
        'sunset_custom_header', // this call-back function to fill the field
        'sunset_theme_support', // this is the page-slug of the setting page to show this field
        'sunset-theme-support' //  The slug-name of the section of the settings page in which to show the box.
    );

    // this post formats custom-background
    add_settings_field( 
        'custom-background', // slug-name to identify the field
        'Custom Background', // this title of the field display as label
        'sunset_custom_background', // this call-back function to fill the field
        'sunset_theme_support', // this is the page-slug of the setting page to show this field
        'sunset-theme-support' //  The slug-name of the section of the settings page in which to show the box.
    );         

     

    /*
    ***************************************************** 
    * Contact-Form settings                             *
    *****************************************************
    */ 
 

    // register the Contact-Form activate_contact_form
    register_setting( 
        'sunset-contact-options', // this is the option group
        'activate_contact_form'  // the name of the option to sanitize and save
    ); 

    // Contact-Form  section    
    add_settings_section( 
        'sunset-contact-section', // this is the slug-name for this section 
        'Contact Form', // this is the section title
        'sunset_contact_section', // call-back function to echo the content of the section
        'sunset_contact_form' // this slug-name of the page to attach the section to
    );

     //  field for activation
    add_settings_field( 
        'activate-form',// slug-name to identify the field
        'Activate Form', // this title of the field display as label
        'sunset_activate_contact_form',// this call-back function to fill the field
        'sunset_contact_form',   // this is the page-slug of the setting page to show this field
        'sunset-contact-section' //  The slug-name of the section of the settings page in which to show the box.
    );

    /*
    ***************************************************** 
    * Custom-Css settings                             *
    *****************************************************
    */ 
 

    // register the Contact-Form activate_contact_form
    register_setting( 
        'sunset-custom-css-options', // this is the option group
        'sunset_css',  // the name of the option to sanitize and save   
    ); 

    // Contact-Form  section    
    add_settings_section( 
        'sunset-custom-css-options', // this is the slug-name for this section 
        'Custom Css Options', // this is the section title
        'sunset_custom_css_section_callback', // call-back function to echo the content of the section
        'sunset_options_css_settings' // this slug-name of the page to attach the section to
    );
    
     //  field for activation
    add_settings_field( 
        'custom-css',// slug-name to identify the field
        'Custom Css', // this title of the field display as label
        'sunset_custom_css_field_callback',// this call-back function to fill the field
        'sunset_options_css_settings',  // this is the page-slug of the setting page to show this field
        'sunset-custom-css-options' //  The slug-name of the section of the settings page in which to show the box.
    );
} 
 
 
/*
***************************************************** 
* sidebar call-back functions                       *  
*****************************************************
*/ 

// sidebar section call-back
function sunset_sidebar_options(){
    echo 'Custom Your Sunset Sidebar';
}  


//  function for Profile-Picture field  
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

//  function for Full-name field  
function sunset_sidebar_name(){
    $firstName = esc_attr( get_option('first_name') ); // this id name will be the register one in register settings
    $lastName = esc_attr( get_option('last_name') ); // this id name will be the register one in register settings
    echo "<input type='text' name='first_name' value='". $firstName .  "' placeholder='First Name' />";
    echo "<input type='text' name='last_name' value='". $lastName .  "' placeholder='Last Name' />";
} 

//  function for user_description field  s
function sunset_sidebar_description(){
    $user_description = esc_attr( get_option('user_description') ); // this id name will be the register one in register settings
     echo "
            <input type='text' name='user_description' value='". $user_description .  "' placeholder='Description' />
            <p class='description'>Type Brief Bio</p>
        ";
}

//  function for twitter field  
function sunset_sidebar_twitter(){
    $twitter = esc_attr( get_option('twitter_handler') ); // this id name will be the register one in register settings
     echo "
            <input type='text' name='twitter_handler' value='". $twitter .  "' placeholder='Twitter handler' />
            <p class='description'>Type Twitter Account without '@' letter</p>
          ";
}

//  function for facebook field  
function sunset_sidebar_facebook(){
    $facebook = esc_attr( get_option('facebook_handler') ); // this id name will be the register one in register settings
     echo "<input type='text' name='facebook_handler' value='". $facebook .  "' placeholder='facebook handler' />";
}

 //  function for gplus field  
function sunset_sidebar_gplus(){
    $gplus = esc_attr( get_option('gplus_handler') ); // this id name will be the register one in register settings
     echo "<input type='text' name='gplus_handler' value='". $gplus .  "' placeholder='Google+ handler' />";
} 

// twitter field Sanitization Settings
function sunset_sanitize_twitter_handler($input_value){
    $output = sanitize_text_field($input_value );
    $output = str_replace('@', '', $output);
    return $output;
} 


/*
    ***************************************************** 
    * Theme-support  call-back functions                *
    *****************************************************
*/
 
//  post-formats section call-back fun
function sunset_theme_options() {
    echo "Activate And Deactive Specific Theme Support Options";
}  

// post-formats field
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

// custom-header field
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

// custom-background field
function sunset_custom_background() {
    $options =   get_option('custom_background') ;
    $checked = ( @$options == 1  ? 'checked' : '' );
    echo        '<label>
                    <input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked . ' />  
                        Activate Custom Background
                 </label>
                <br>';
        
}


/*
    ***************************************************** 
    * contact-form  call-back functions                *
    *****************************************************
*/ 

//  activate section call-back function
function sunset_contact_section() {
    echo 'Activate and Deactivate the Built-in Contact-Form';
}
 

// contact-Form field Call-back Function 
function sunset_activate_contact_form(){
    $options =   get_option('activate_contact_form') ;
    $checked = ( @$options == 1  ? 'checked' : '' );
    echo '
        <label>
            <input type="checkbox" id="activate_contact_form" name="activate_contact_form" value="1" '.$checked . ' />  
            </label>
        <br>';
} 


/*
    ***************************************************** 
    * custom-css  call-back functions                *
    *****************************************************
*/ 

//  custom-css section call-back function
function sunset_custom_css_section_callback() {
    echo 'Customize Theme Css';
} 

// custom-css field Call-back Function 
function sunset_custom_css_field_callback(){
    $css =   get_option('sunset_css') ; // option name is the name of the register settings
    
    $css = empty( $css) ? '/* Sunset Custom Css */' :  $css;
    echo '
        <textarea placholder="Sunset Custom Css"> '. 
            $css
        .'</textarea>
        <br>';
} 


/*
    ***************************************************** 
    * submenu pages  call-back functions                *
    *****************************************************
*/


//  sidebar  sub-page
function sunset_theme_create_page() {
    //   generate of our admin page
    require_once(get_template_directory() . '/inc/templates/sunset-admin.php');
} 

// css option call-back function
function sunset_theme_settings_page() {
    //   generate of our admin page css sub-page
    require_once(get_template_directory() . '/inc/templates/sunset-custom-css.php');
}

// for support page
function sunset_theme_support_page() {
    require_once(get_template_directory(  ). '/inc/templates/sunset-theme-suppport.php');
}

// for contact form 
function sunset_theme_contact_form_page() {
    require_once(get_template_directory(  ). '/inc/templates/sunset-contact-form.php');
}