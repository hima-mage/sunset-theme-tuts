<?php 
/**
 * @package sunset-theme
 * ======================================
 * THEME SUPPORT OPTIONS
 * ======================================
 */

$options = get_option('post_formats') ;// option asign the this name
// formate types of the theme
$formats = array(
                    'aside',
                    'gallery',
                    'link',
                    'image',
                    'quote',
                    'status',
                    'video',
                    'audio',
                    'chat'
                );
$output = [];

// formats that checked in and save it to outputs
foreach($formats as $format){
    $output[]  = ( @$options[$format] == 1  ?  $format : '' );
}

if (!empty($options)){
    add_theme_support('post-formats',  $output); 
}


//  custom header Activation 
$header = get_option('custom_header') ;
if(@$header == 1){
    add_theme_support( 'custom-header');  
}



//  custom background Activation 
$background = get_option('custom_background') ;
if(@$background == 1){
    add_theme_support( 'custom-background');  
}
