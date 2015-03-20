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
	'lib/utils.php',                    // Utility functions
	'lib/init.php',                     // Initial theme setup and constants
	'lib/wrapper.php',                  // Theme wrapper class
	'lib/conditional-tag-check.php',    // ConditionalTagCheck class
	'lib/config.php',                   // Configuration
	'lib/assets.php',                   // Scripts and stylesheets
	'lib/titles.php',                   // Page titles
	'lib/nav.php',                      // Custom nav modifications
	'lib/extras.php',                   // Custom functions
	'lib/acf.php',                      // Advanced custom fields settings
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
 *
 * @param string $type Type of component
 * @param string $component File name of the component
 * @param string|array[object|number $value Value param to pass to the compenent
 * @param string $componentType Alternativ template
 * @param string $path Path to the components
 *
 */

function inc($type, $component, $value = null, $componentType = '', $path = 'components') {
	$component = $path.'/'.$type.'/'.$component;
	$templates = array();
	if ( '' !== $componentType )
		$templates[] = $component."-".$componentType.".php";

	$templates[] = $component.".php";

	$template = locate_template($templates);

	if('' !== $template) {
		include $template;
	}  else if ( WP_DEBUG ) {
		echo 'CANNOT FIND COMPONENT(S): "' . implode("\" or \"", $templates).'"';
	}
}

