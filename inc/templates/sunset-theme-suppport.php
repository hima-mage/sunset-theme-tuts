<h1>Sunset Theme Support</h1>
<?php 
    settings_errors();
    // $profile_picture = esc_attr( get_option('profile_picture') );   
?> 
<form action="options.php" method="post" class="sunset-general-form">
    <?php 
        settings_fields( 'sunset-theme-support' );
        do_settings_sections( 'sunset_theme_support' );
        submit_button( );
    ?>
</form>