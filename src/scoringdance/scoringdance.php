<?php
/**
 * Plugin Name: scoring.dance Competition Plugin
 * Plugin URI: https://github.com/andreaskasper/
 * Description: Important functions for goo1 websites
 * Author: Andreas Kasper
 * Version: 0.1.101
 * Author URI: https://github.com/andreaskasper/
 * Network: True
 * Text Domain: scoringdance
 */

spl_autoload_register(function ($class_name) {
	if (substr($class_name,0,26) != "plugins\\goo1\\scoringdance\\") return false;
	$files = array(
		__DIR__."/classes/".str_replace("\\", DIRECTORY_SEPARATOR,substr($class_name, 26)).".php"
	);
	foreach ($files as $file) {
		if (file_exists($file)) {
			include($file);
			return true;
		}
	}
	return false;
});

add_action( "plugins_loaded", function() {
    load_plugin_textdomain( "scoringdance", FALSE, basename( dirname( __FILE__ ) ) . "/languages/" );
});
\plugins\goo1\scoringdance\core::init();

if (!class_exists("Puc_v4_Factory")) {
	require_once(__DIR__."/plugin-update-checker/plugin-update-checker.php");
}
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    "https://raw.githubusercontent.com/andreaskasper/wordpress-scoring/main/dist/updater.json",
    __FILE__, //Full path to the main plugin file or functions.php.
    "scoringdance"
);

