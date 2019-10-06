<?php 
/**
 * @package sunset-theme
 * ======================================
 * THEME SUPPORT OPTIONS
 * ======================================
 */
$options = get_option('post_formats') ;
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
foreach($formats as $format){
    $output[]  = ( @$options[$format] == 1  ?  $format : '' );
}
if (!empty($options)){
    add_theme_support( 'post-formats',  $output); 
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
