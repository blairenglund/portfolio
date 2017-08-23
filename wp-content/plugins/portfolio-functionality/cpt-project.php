<?php  
/*
Plugin Name: Porfolio Functionality
Plugin URI: http://www.blairenglund.com/
Description: Customise WordPress with powerful, professional and intuitive fields
Version: 0.1
Author: Blair Englund
Author URI: http://www.blairenglund.com/
License: GPL
Copyright: Blair Englund
*/

function create_posttype() {
  register_post_type( 'project',
    array(
      'labels' => array(
        'name' => __( 'Projects' ),
        'singular_name' => __( 'Project' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'projects'),
    )
  );
}
add_action( 'init', 'create_posttype' );

?>
