<?php
/**
 * Plugin Name:       Passster WpBakery Integration
 * Plugin URI:        https://patrickposner.dev
 * Description:       A simple extension to add row protection with Passster to WPBakery Pagebuilder.
 * Version:           1.0
 * Author:            Patrick Posner
 * Author URI:        https://patrickposner.dev
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       passster-wpbakery
 * Domain Path:       /languages
 *
 */

define( 'PSWB_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'PSWB_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );


// localize.
$textdomain_dir = plugin_basename( dirname( __FILE__ ) ) . '/languages';
load_plugin_textdomain( 'passster-wpbakery', false, $textdomain_dir );

// run plugin.
if ( ! function_exists( 'pswb_before_init_actions' ) ) {

	if ( in_array( 'js_composer/js_composer.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_action( 'vc_before_init', 'pswb_before_init_actions' );

		/**
		 * Add new element and modify row before init.
		 *
		 * @return void
		 */
		function pswb_before_init_actions() {
			require_once( PSWB_PATH . '/src/class-pswb-wpbakery.php' );

			if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
				vc_set_shortcodes_templates_dir( PSWB_PATH . '/src/elements' );
			}
		}
	}
}
