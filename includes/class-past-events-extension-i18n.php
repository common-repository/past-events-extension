<?php
/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://datamad.co.uk
 * @since      1.0.0
 *
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Past_Events_Extension
 * @subpackage Past_Events_Extension/includes
 * @author     Todd Halfpenny <todd@toddhalfpenny.com>
 */
class Past_Events_Extension_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'past-events-extension',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}
}
