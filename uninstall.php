<?php

/**
 * Trigger this file on pluguin uninstall
 * 
 * @package MHamdyPlugin
 */

 if( ! defined('WP_UNINSTALL_PLUGIN')){
    die;
 }

 // Clear Dtabase stored data => first method
 //  $books = get_posts([
     //     'post_type'=> 'book',
     //     'numberposts' => -1  // this means to get all posts
     //  ]);
     
     //  foreach($books as $book){
         //     wp_delete_post($book->ID, true);
         //  }




// Clear Dtabase stored data => Second method

global $wpdp;
$wpdp->query("DELETE FROM wp_posts WHERE post_type = 'book'"); 
$wpdp->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)"); 
$wpdp->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)"); 