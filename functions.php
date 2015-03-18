<?php
/**
 * Ripples includes
 *
 * The $ripples_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */
$ripples_includes = [
	'lib/utils.php',                 // Utility functions
	'lib/init.php',                  // Initial theme setup and constants
	'lib/wrapper.php',               // Theme wrapper class
	'lib/conditional-tag-check.php', // ConditionalTagCheck class
	'lib/config.php',                // Configuration
	'lib/assets.php',                // Scripts and stylesheets
	'lib/titles.php',                // Page titles
	'lib/nav.php',                   // Custom nav modifications
	'lib/extras.php',                // Custom functions
];

foreach ($ripples_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'ripples'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

/**
 * Load atomic components from the components folder
 */
function inc($type, $component, $value = null, $path = 'components') {
	$component .= '.php';
	$filename = dirname(__FILE__) . '/'.$path.'/'.$type.'/'.$component;
	if (file_exists($filename)) {
		return include $filename;
	} else {
		echo 'CANNOT FIND COMPONENT: ' . $filename;
	}
}

