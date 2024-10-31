<?php 

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Registering scripts and styles for later
function pre_tag_for_wp_editor__register_scripts_and_styles_admin_action() {
	$pre_tag_for_wp_editor                       = pre_tag_for_wp_editor();
	$includes_url                            = $pre_tag_for_wp_editor->includes_url;
	$version                                 = $pre_tag_for_wp_editor->version;
	
	// pre tag to wp_editor
	wp_register_script( 'pre-tag-for-wp-editor',    $includes_url . 'admin/js/pre-tag-for-wp-editor.js',    array(), $version, true );
}

// Function for enqueue styles and scripts in the footer and header for custom pages in WordPress Dashboard
function pre_tag_for_wp_editor__enqueue_style_scripts_by_hook_suffix_action_action() {
	global $hook_suffix;

	$settings = apply_filters( 'pre_tag_for_wp_editor__enqueue_style_scripts_admin_settings', array() );
	
	if ( ! empty ( $settings ) ) {
		foreach ( (array) $settings as $set ) {
			if ( ! empty ( $set['menu_slug'] ) ) {
				if ( (string) $hook_suffix == (string) $set['menu_slug'] ) {
					if ( ! empty ( $set['scripts'] ) ) {
						foreach ( (array) $set['scripts'] as $script => $k ) {
							wp_enqueue_script( $k  );
						}
					}
					if ( ! empty ( $set['styles'] ) ) {
						foreach ( (array) $set['styles'] as $script => $k ) {
							wp_enqueue_style( $k );
						}
					}
				}
			}
		}
	}
}

// List of dashboard pages and what to add
function pre_tag_for_wp_editor__enqueue_style_scripts_admin_settings( $settings_options = array() ) {

	// Edit post page
	$settings_options[] = array(
		'menu_slug' => 'post.php',
		'scripts'   => array(
			'pre-tag-for-wp-editor',
		),
		'styles'   => array(
		
		)
	);

	// Create post page
	$settings_options[] = array(
		'menu_slug' => 'post-new.php',
		'scripts'   => array(
			'pre-tag-for-wp-editor',
		),
		'styles'   => array(
		
		)
	);
	
	// Widgets.php page
	$settings_options[] = array(
		'menu_slug' => 'widgets.php',
		'scripts'   => array(
			'pre-tag-for-wp-editor',
		),
		'styles'   => array(
		
		)
	);
	
	// Customize.php page
	$settings_options[] = array(
		'menu_slug' => 'customize.php',
		'scripts'   => array(
			'pre-tag-for-wp-editor',
		),
		'styles'   => array(

		)
	);
	
	return $settings_options;
}