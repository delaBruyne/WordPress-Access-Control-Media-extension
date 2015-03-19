<?php
/*
	Plugin Name:	WordPress Access Control - Media extension
	Plugin URI:		http://laetitiadebruyne.com
	Description:	Extend WordPress Access Control plugin features, with media/attachment content type support.

	Version:			1.0

	Author:				Laetitia Debruyne
	Author URI:		http://laetitiadebruyne.com
*/


add_action( 'plugins_loaded', 'wpacm_init' );

// Add WordPress Access Control metabox in media
add_action( 'add_meta_boxes', 'wpacm_add_wp_access_meta_boxes' );
add_action( 'edit_attachment', array('WordPressAccessControl', 'save_postdata') );

// Add access column in media library
add_action('manage_media_custom_column', array('WordPressAccessControl', 'show_column'));
add_filter('manage_media_columns', array('WordPressAccessControl', 'add_column'));

// Add access column in posts list
add_action('manage_posts_custom_column', array('WordPressAccessControl', 'show_column'));
add_filter('manage_posts_columns', array('WordPressAccessControl', 'add_column'));


// Get original class

function wpacm_init() {
	if ( class_exists('WordPressAccessControl') ) {

	} else {
		add_action('admin_notices', 'wpac_not_loaded');
	}
}

function wpac_not_loaded() {
	printf(
	'<div class="error"><p>%s</p></div>',
	__('Sorry cannot create media metabox because WordPress Access Control is not loaded. Please install and/or activate this plugin.')
	);
}


function wpacm_add_wp_access_meta_boxes() {
	add_meta_box('wpac_controls_meta', 'WordPress Access Control', array('WordPressAccessControl', 'add_wpac_meta_box'), 'attachment', 'side', 'high');
}
