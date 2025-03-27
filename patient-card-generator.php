<?php
/*
Plugin Name: Patient Card System
Description: Complete patient management with ID card generation
Version: 1.0.0
Author: Your Name
Text Domain: patient-card-system
*/

defined('ABSPATH') or die('Direct access not allowed!');

// Define constants
define('PCS_VERSION', '1.0.0');
define('PCS_PATH', plugin_dir_path(__FILE__));
define('PCS_URL', plugin_dir_url(__FILE__));

// Autoloader
spl_autoload_register(function($class) {
    $prefix = 'PCS\\';
    $base_dir = PCS_PATH . 'includes/';
    
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) require $file;
});

// Initialize modules
require_once PCS_PATH . 'includes/modules/patient-manager/init.php';
require_once PCS_PATH . 'includes/modules/card-engine/init.php';
require_once PCS_PATH . 'includes/modules/qr-system/init.php';

register_activation_hook(__FILE__, ['PCS\Core\Installer', 'activate']);
register_deactivation_hook(__FILE__, ['PCS\Core\Installer', 'deactivate']);