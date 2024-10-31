<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://datamad.co.uk
 * @since             1.0.0
 * @package           Past_Events_Extension
 *
 * @wordpress-plugin
 * Plugin Name:       Past Events Extension
 * Plugin URI:        https://datamad.co.uk/wordpress-plugins/past-events-extension
 * Description:       Adds "Past Events" support to sites running the Tyler events theme.
 * Version:           1.0.1
 * Author:            Todd Halfpenny
 * Author URI:        https://datamad.co.uk
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       past-events-extension
 * Domain Path:       /languages
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( !function_exists( 'pee_fs' ) ) {
    /**
     * Freemius Stuff.
     * Create a helper function for easy SDK access.
     */
    function pee_fs()
    {
        global  $pee_fs ;
        
        if ( !isset( $pee_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $pee_fs = fs_dynamic_init( array(
                'id'             => '1475',
                'slug'           => 'past-events-extension',
                'type'           => 'plugin',
                'public_key'     => 'pk_0839d2325a96f1f03b4ec5d5acf54',
                'is_premium'     => false,
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug'           => 'past-events-extension',
                'override_exact' => true,
                'first-path'     => 'admin.php?page=past-events-extension',
                'contact'        => false,
                'support'        => false,
            ),
                'is_live'        => true,
            ) );
        }
        
        return $pee_fs;
    }
    
    // Init Freemius.
    pee_fs();
    // Signal that SDK was initiated.
    do_action( 'pee_fs_loaded' );
    define( 'PLUGIN_NAME_VERSION', '1.0.1' );
    /**
     * The code that runs during plugin activation.
     * This action is documented in includes/class-past-events-extension-activator.php
     */
    function activate_past_events_extension()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-past-events-extension-activator.php';
        Past_Events_Extension_Activator::activate();
    }
    
    /**
     * The code that runs during plugin deactivation.
     * This action is documented in includes/class-past-events-extension-deactivator.php
     */
    function deactivate_past_events_extension()
    {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-past-events-extension-deactivator.php';
        Past_Events_Extension_Deactivator::deactivate();
    }
    
    register_activation_hook( __FILE__, 'activate_past_events_extension' );
    register_deactivation_hook( __FILE__, 'deactivate_past_events_extension' );
    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require plugin_dir_path( __FILE__ ) . 'includes/class-past-events-extension.php';
    /**
     * Begins execution of the plugin.
     *
     * Since everything within the plugin is registered via hooks,
     * then kicking off the plugin from this point in the file does
     * not affect the page life cycle.
     *
     * @since    1.0.0
     */
    function run_past_events_extension()
    {
        $plugin = new Past_Events_Extension();
        $plugin->run();
    }
    
    run_past_events_extension();
}
