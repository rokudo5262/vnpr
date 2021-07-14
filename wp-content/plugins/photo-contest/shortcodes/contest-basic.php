<?php

//Secure file from direct access
if ( ! defined( 'WPINC' ) ) {
	die;
}


//Get basic values
//Current URL
$current_url = get_permalink($post->ID);
//Curren User
$current_user = wp_get_current_user();
//Animation
$animation = get_option('pcplugin-allow-animation');
if (!empty($animation)){
  if ($animation == 1){
    $animation = ' photo-contest-animation';
  }else{
    $animation = '';
  }
}else{
  $animation = ' photo-contest-animation';
}
//Font Size
$font_size = get_option( 'pcplugin-font-size' );
if (empty($font_size)){
  $font_size = 'pcfontsize';
}
