<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


$pre_tag_for_wp_editor = pre_tag_for_wp_editor();
$plugin_file = $pre_tag_for_wp_editor->file;

// Plugin Activation
register_activation_hook( $plugin_file,                               'pre_tag_for_wp_editor__activation_action'                          );

// Plugin Deactivation
register_deactivation_hook( $plugin_file,                             'pre_tag_for_wp_editor__deactivation_action'                        );