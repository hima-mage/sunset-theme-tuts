<h1>Sunset Sidebar Options</h1>
 
<?php 
    settings_errors();
    $profile_picture = esc_attr( get_option('profile_picture') );  
    $firstName = esc_attr( get_option('first_name') );  
    $lastName = esc_attr( get_option('last_name') ); 
    $fullName = $firstName . " " . $lastName;
    $user_description = esc_attr( get_option('user_description') ); 
   
?>

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


<form action="options.php" method="post" class="sunset-general-form">
    <?php 
        settings_fields('sunset-settings-group'); 
        do_settings_sections( 'sunset_options' );
        //  here  i change name/id into btnSubmit To get Js Ability for submiting
        submit_button('Save Changes', 'primary', 'btnSubmit');
    ?>
</form>