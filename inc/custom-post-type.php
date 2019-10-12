<?php 
/**
 * @package sunset-theme
 * ======================================
 * THEME CUSTOM POST TYPES - MESSAGES
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
    // add filter to modify the columns name
    add_filter( 
        'manage_sunset-contact-form_posts_columns', // this custom  tag made for managing the this post type columns
        'sunset_set_sunset_contact_form_columns'  // call-back function to modify the columns 
    );
    //  add action to add the contact of the title
    add_action( 
        'manage_sunset-contact-form_posts_custom_column', // custom made id
        'sunset_contact_form_custom_column', // call-back function
        10, // priority of the action 10 is the default as it will wait until all done but if it  was 1 it will done first
        2 // no of args for function to collect
    );

    //  activate the meta box
    add_action( 
        'add_meta_boxes', // this hook to add the meta box
        'sunset_contact_add_meta_box' , // function filling the meta box
    );
    // saving meta box - but here i make sure that this action will not be usable if contact not declared
    add_action('save_post', 'sunset_save_contact_email_data' );
}

/**
 * HERE ALL OPTION FOR CUSTOM POST CONTACT_FORM
 */
function sunset_contact_custom_post_type(){
    $labels = array(
        'name'              => 'Messages', // general name and usually will be plural
        'singular_name'     => 'Message', // Name for one object of this post type
        'menu_name'         => 'Messages', // Label for the menu name
        'name_admin_bar'    => 'Message',

    );
    $args = array(
        'labels'             => $labels, // array 
        'show_ui'            => true, //(bool)  Whether to generate and allow a UI for managing this post type in the admin. Default is value of  public.
        'show_in_menu'       => true, // (bool) Where to show the post type in the admin menu. To work, $show_ui must be true.
        'capability_type'    => 'post', // (string) The string to use to build the read, edit, and delete capabilities
        'hierarchical'       => false,  // (bool) Whether the post type is hierarchical (e.g. page). Default false.
        'menu_position'      => 26, // position
        'menu_icon'          => 'dashicons-email-alt', // icon
        'supports'           => ['title', 'editor', 'author'] // (array) Core feature(s) the post type supports. Serves as an alias for calling add_post_type_support() directly. Core features include 'title', 'editor', 'comments', 'revisions', 'trackbacks' ... etc
    ); 
    register_post_type(
        'sunset-contact-form', // this is the post type key
         $args // array of arguments contain the properties of that post type
    );
}

// call-back function for filter the columns  and modify it for the contact display
function sunset_set_sunset_contact_form_columns($columns) {
    // unset($columns['author']); // here i modify the author  from shown 
    $newColumns = [];
    $newColumns['title']        = 'Username';
    $newColumns['message']      = 'Message';
    $newColumns['email']        = 'Email';
    $newColumns['date']         = 'Date';
    return  $newColumns;
}
//  to edit the column content - loop function on each post so it take post_id and the column name as array
function sunset_contact_form_custom_column($column , $post_id){
     switch($column){
        case 'message':
           echo get_the_excerpt();
            break;
        case 'email':
            $email = get_post_meta( 
                        $post_id, // the id the post need get the meta of
                        '_contact_email_value_key', // this unique key to update it must start with _ 
                        true // mean that is single value not array or anything
                    );
            echo '<a href="mailto:' . $email . '">' .  $email . '</a>';
            break;
     }
} 

 /* CONTACT META BOXES */
 function sunset_contact_add_meta_box(){
    add_meta_box( 
        'contact_email',//(string) (Required) Meta box ID
        'User Email', // (string) (Required) Title of the meta box.
        'sunset_contact_email_callback', // (callable) (Required) Function that fills the box with the desired content
        'sunset-contact-form',// (string|array|WP_Screen) (Optional) The screen or screens on which to show the box (such as a post type, 'link', or 'comment'). Accepts a single screen ID
        'side', // this for the postion of the meta box content
        'high' // poirity for high / low 
    );
 }

//  call-back function of the meta box of contact mail 
function sunset_contact_email_callback($post) { // this post para is automatically pass by the meta box and carry it's information related to screen 
    wp_nonce_field( // this nonce help me protect my data from hack
        'sunset_save_contact_email_data', // (int|string) (Optional) Action name. used as function to save data
        'sunset_contact_email_meta_box_nonce' // (string) (Optional) Nonce name. used as checking for post request
    );
    $value = get_post_meta( 
        $post->id, // the id the post need get the meta of
        '_contact_email_value_key', // this unique key to update it must start with _ 
        true // mean that is single value not array or anything
    );
    echo '<label for="sunset_contact_email_field">User Email Address:'.$value .' </label>'; 
    echo '<input type="email" id="sunset_contact_email_field" name="sunset_contact_email_field" value="' . esc_attr( $value ) . '" size="25" />';
}
// this is using wp_nonce_field  to save to data post_id will pass automatically
function sunset_save_contact_email_data($post_id) {

    // this means will stop the action
    if( !isset( $_POST['sunset_contact_email_meta_box_nonce'] ) ){
        return;
    }
    //  this check if this nonce  is valid made by wordpress not anonymous user
    if( !wp_verify_nonce(
            $_POST['sunset_contact_email_meta_box_nonce'],// this will take action nonce as post request
             'sunset_save_contact_email_data' // actual function that saving my meta data 
              ) 
        ){  return; } 
    //  check if that auto / manual save - DOING_AUTOSAVE is global variable defined by wordpress
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return; // this will stop autosave the meta box
    }
    //  check if the user has permission to maniplate that data
    if( !current_user_can('edit_post', $post_id) ){
        return ; // this will stop save that meta box for unauthorized user
    }
    // check if the input is set - input define by me
    if( !isset($_POST['sunset_contact_email_field'])){
        return ;
    }
    $my_data = sanitize_text_field( $_POST['sunset_contact_email_field'] );  // this function premade by wordpress to sanitize the data

    update_post_meta( 
        $post_id , // this post id that meta box belong to 
        '_contact_email_value_key', // this is the key of that meta box
        $my_data // this is inputed data
    );
}