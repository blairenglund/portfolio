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
        'singular_name' => __( 'Project' ),
      ),
      'menu_icon' => 'dashicons-format-image',
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'projects'),
      'show_in_rest' => true,
    )
  );
}
add_action( 'init', 'create_posttype' );


if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_projects-cpt',
    'title' => 'Projects-CPT',
    'fields' => array (
      array (
        'key' => 'field_59a44c896e8cc',
        'label' => 'Description',
        'name' => 'description',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'br',
      ),
      array (
        'key' => 'field_59a44cca6e8cd',
        'label' => 'Link',
        'name' => 'link',
        'type' => 'text',
        'instructions' => 'Enter a the project URL',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_59a44d373d1f0',
        'label' => 'Responsibilities',
        'name' => 'responsibilities',
        'type' => 'textarea',
        'default_value' => '',
        'placeholder' => '',
        'maxlength' => '',
        'rows' => '',
        'formatting' => 'html',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'project',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'the_content',
      ),
    ),
    'menu_order' => 0,
  ));
}

?>