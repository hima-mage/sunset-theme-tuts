 <?php
 /*
    ***************************************************** 
    * Side-bar Sub-menu page template                   *
    *****************************************************
*/  
?>
<!-- title of the template -->
<h1>Sunset Sidebar Options</h1> 
 
<?php  
    settings_errors(); // setting errors
    // declare  variable defined in the sidebar attributes
    $profile_picture = esc_attr( get_option('profile_picture') ); // escape the html attribute  for option profile-picture
    $firstName = esc_attr( get_option('first_name') );  // escape the html attribute  for option first-name
    $lastName = esc_attr( get_option('last_name') );  // escape the html attribute  for option last-name
    $fullName = $firstName . " " . $lastName;
    $user_description = esc_attr( get_option('user_description') );   // escape the html attribute  for option user-description
?>

<!-- here a simply preview of the sidebar live as i input data -->
<div class="sunset-sidebar-preview">
    <div class="sunset-sidebar">
        <div class="image-container">
            <div id="profile-picture-preview" class="profile-picture" style="background-image:url(<?php print $profile_picture; ?>)">  </div>
        </div>
        <h1 class="sunset-username"><?php print $fullName; ?></h1>
        <h2 class="sunset-description"><?php print $user_description; ?></h2>
        <div class="icons-wrapper">

        </div>
    </div>
</div>

<!-- form to input the sidebar data -->
<form action="options.php" method="post" class="sunset-general-form">
    <?php 
        settings_fields('sunset-settings-group');  // this function take settings group name and display all it's fields call-back function
        do_settings_sections( 'sunset_options' ); // Prints out all settings sections added to a particular settings page
        submit_button('Save Changes', 'primary', 'btnSubmit'); // echo the submit button here i change the name/id  of it to be able to submit it using js
    ?>
</form>