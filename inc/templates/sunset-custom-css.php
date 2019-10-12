<?php 
/**
 * =====================================================
 *  Sunset - Csutom - Css - Template
 * =====================================================
 */
?>
<h1>Sunset Custom Css</h1>
<?php 
    settings_errors(); // setting errors
 ?> 
<form id="save-custom-css-form" action="options.php" method="post" class="sunset-general-form">
    <?php 
        settings_fields('sunset-custom-css-options'); // this function take settings group name and display all it's fields call-back function
        do_settings_sections('sunset_options_css_settings'); // Prints out all settings sections added to a particular settings page
        submit_button( ); // echo the submit button
    ?>
</form>