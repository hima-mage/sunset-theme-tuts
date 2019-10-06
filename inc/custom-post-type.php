<?php 
/**
 * @package sunset-theme
 * ======================================
 * THEME CUSTOM POST TYPES
 * ======================================
 */
 
//  custom header Activation 
$contact = get_option('activate_contact_form') ; // option-name of setting register
if(@$contact == 1){
    // activate the Message Post Type
    add_action(
        'init', 
        'sunset_contact_custom_post_type'
    );
}

/**
 * HERE ALL OPTION FOR CUSTOM POST CONTACT_FORM
 */
function sunset_contact_custom_post_type(){
    $labels = array(
        'name'              => 'Message',
        'singular_name'     => 'Message',
        'menu_name'         => 'Messages',
        'name_admin_bar'    => 'Message',

    );
    $args = array(
        'labels'             => $labels,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'capability_type'    => 'post',
        'hierarchical'       => false, 
        'menu_position'      => 26, // position
        'menu_icon'          => 'dashicons-email-alt', // icon
        'supports'           => ['title', 'editor', 'author']
    );

    register_post_type('sunset-contact-form', $args);
}


 