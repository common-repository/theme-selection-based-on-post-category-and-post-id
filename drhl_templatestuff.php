<?php
/*
Plugin Name: Theme selection based on post category and post id
Description: If it exists, themefile single-category-(category id).php and single-post-(post id).php is used
Version: 1.1
Author: David Leonard
Author URI: http://www.festbogen.dk/davids-plugins
Donate link: https://www.amazon.co.uk/gp/registry/wishlist/2WTALOFOBOZNL
Tags: theme selection, themes selection, theme, theme colors, Theme customization, theme styles, theme tweaking
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


/* avoid direct calls */
if(!function_exists("add_action")){
header("Status: 403 Forbidden");
header("HTTP/1.1 403 Forbidden");
exit();
} 

function drhl_templatestuff($single_template) {
/* if there is a file for the category use it */
foreach( (array) get_the_category() as $cat ) { if ( file_exists(TEMPLATEPATH . "/single-category-{$cat->term_id}.php") ) $single_template= TEMPLATEPATH . "/single-category-{$cat->term_id}.php";  } 

/* but if there is one for id (more specific) use that instead */
if(file_exists(TEMPLATEPATH . "/single-post-".get_the_ID().".php") ) $single_template= TEMPLATEPATH . "/single-post-".get_the_ID().".php";  

/* if nothing is found, variable will hold the template wordpress will use */
return $single_template;
}


add_filter( "single_template", "drhl_templatestuff" ) ;
?>