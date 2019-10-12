<?php
 /*
    ***************************************************** 
    * Theme-support Sub-menu page template                   *
    *****************************************************
*/  
?>

<h1>Sunset Theme Support</h1>
<?php 
    settings_errors(); // setting errors
    // $profile_picture = esc_attr( get_option('profile_picture') );   
?> 
<form action="options.php" method="post" class="sunset-general-form">
    <?php 
        settings_fields( 'sunset-theme-support' ); // this function take settings group name and display all it's fields call-back function
        do_settings_sections( 'sunset_theme_support' ); // Prints out all settings sections added to a particular settings page
        submit_button( ); // echo the submit button
    ?>
</form>