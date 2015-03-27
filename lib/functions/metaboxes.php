<?php
/**
 * Metaboxes
 *
 * This file registers any custom metaboxes
 */

/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'mc_wcsd_metaboxes' );
require_once WCSD_DIR . '/lib/functions/cmb2-post-search-field.php';
function mc_wcsd_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mcwcsd_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_group = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => __( 'SLIDES', 'cmb2' ),
		'object_types' => array( 'presentation', ),
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_group->add_field( array(
		'id'          => $prefix . 'slides',
		'type'        => 'group',
		'description' => __( 'Add all your slides for this Presentation', 'cmb2' ),
		'options'     => array(
			'group_title'   => __( 'Slide {#}', 'cmb2' ), // {#} gets replaced by row number
			'add_button'    => __( 'Add Another Slide', 'cmb2' ),
			'remove_button' => __( 'Remove Slide', 'cmb2' ),
			'sortable'      => true, // beta
		),
	) );


	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => __( 'Slide Title', 'cmb2' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Slide Content', 'cmb2' ),
		'description' => __( 'Write a short description for this slide', 'cmb2' ),
		'id'          => 'description',
		'type'        => 'wysiwyg',
		'options' => array(
			'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
			'dfw' => false,
			'quicktags' => false),
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Slide Background Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name' => __( 'Accent Image', 'cmb2' ),
		'description' => __( 'Add another image to the slide', 'cmb2' ),
		'id'   => 'accent_image',
		'type' => 'file',
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'       => __( 'FooGallery', 'cmb2' ),
		'description' => __( 'Add a FooGallery Shortcode here to include it at the bottom of the slide', 'cmb2' ),
		'id'         => 'foogallery',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Add Code Example', 'cmb2' ),
		'id'          => 'code',
		'type'        => 'textarea',
		// 'repeatable'  -> true,

	) );
	$cmb_group->add_group_field( $group_field_id, array(
		'name'        => __( 'Code Language', 'cmb2' ),
		'id'          => 'codelanguage',
		'type'        => 'select',
		'options'     => array(
			'css' => 'CSS',
			'javascript' => 'JS',
			'php' => 'PHP',
			'html' => 'General',
		),

	) );

}

add_action( 'cmb2_init', 'mcslides_register_return_link_metabox' );

function mcslides_register_return_link_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_mcslides_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$mcslides = new_cmb2_box( array(
		'id'            => $prefix . 'return_link',
		'title'         => __( 'Test Metabox', 'cmb2' ),
		'object_types'  => array( 'presentation', ), // Post type
		'context'       => 'side',
		'priority'      => 'default',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );

	$mcslides->add_field( array(
		'name'       => __( 'Return URL', 'cmb2' ),
		'desc'       => __( 'field description (optional)', 'cmb2' ),
		'id'         => $prefix . 'return_url',
		'type'       => 'post_search_text',
	) );
}
