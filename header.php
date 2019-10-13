<?php 
/*
    Header Template
    @package  sunset
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <!-- meta for fonts type -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!-- meta for multi devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- it's neccessary for validate html5 -->
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <!-- this is check if the page is single post / page and if that pingback is active or not -->
    <!-- is_singular is for single post/page not the front/search ... -->
    <!-- check if the pings is open / get_queried_object get current queried object -->
    <?php if(is_singular() && pings_open(get_queried_object()) ) :  ?> 
        <!-- this used to raising up the web scale in search - more active with another plateform -->
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif;?>
    <?php wp_head(); ?>
    <title>Document</title>
</head>
<!-- this class used by wordpress to style the body -->
<body <?php body_class(); ?>> 
    

 
 