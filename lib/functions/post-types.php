<?php
/**
 * Post Types
 *
 * This file registers any custom post types
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/billerickson/Core-Functionality
 * @author       Bill Erickson <bill@billerickson.net>
 * @copyright    Copyright (c) 2011, Bill Erickson
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Create Rotator post type
 * @since 1.0.0
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */

function wcsd_presentation_post_type() {
	$labels = array(
		'name' => 'Presentations',
		'singular_name' => 'Presentation',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Presentation',
		'edit_item' => 'Edit Presentation',
		'new_item' => 'New Presentation',
		'view_item' => 'View Presentation',
		'search_items' => 'Search Presentations',
		'not_found' =>  'No Presentations found',
		'not_found_in_trash' => 'No Presentations found in trash',
		'parent_item_colon' => '',
		'menu_name' => 'Presentation'
	);
	
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => false, 
		'hierarchical' => false,
		'menu_position' => 4.1,
		'menu_icon'           => 'dashicons-images-alt2',
		'supports' => array('title','thumbnail', 'revisions', 'excerpt')
	); 

	register_post_type( 'presentation', $args );
}
add_action( 'init', 'wcsd_presentation_post_type' );