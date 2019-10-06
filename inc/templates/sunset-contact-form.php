<h1>Sunset Contact Form</h1>
<?php 
    settings_errors();
    // $profile_picture = esc_attr( get_option('profile_picture') );   
?> 
<form action="options.php" method="post" class="sunset-general-form">
    <?php 
        settings_fields('sunset-contact-options');
        do_settings_sections('sunset_contact_form');
        submit_button( );
    ?>
</form>