<?php
/**
 * LSX_TO_Vehicles_Frontend
 *
 * @package   LSX_TO_Vehicles_Frontend
 * @author    LightSpeed
 * @license   GPL-3.0+
 * @link
 * @copyright 2016 LightSpeedDevelopment
 */

/**
 * Main plugin class.
 *
 * @package LSX_TO_Vehicles_Frontend
 * @author  LightSpeed
 */

class LSX_TO_Vehicles_Frontend extends LSX_TO_Vehicles {

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->set_vars();

		add_action( 'wp_head', array( $this, 'change_single_vehicles_layout' ), 20, 1 );

		add_filter( 'lsx_to_entry_class', array( $this, 'entry_class' ) );
		add_action( 'init', array( $this, 'init' ) );

		if ( ! class_exists( 'LSX_Template_Redirects' ) ) {
			require_once( LSX_TO_VEHICLES_PATH . 'classes/class-lsx-template-redirects.php' );
		}
		$this->redirects = new LSX_Template_Redirects( LSX_TO_VEHICLES_PATH, array_keys( $this->post_types ) );
		add_action( 'lsx_vehicle_content', array( $this->redirects, 'content_part' ), 10, 2 );

		add_filter( 'lsx_to_page_navigation', array( $this, 'page_links' ) );

		add_action( 'lsx_entry_top', array( $this, 'archive_entry_top' ), 15 );
		add_action( 'lsx_entry_bottom', array( $this, 'archive_entry_bottom' ) );
		add_action( 'lsx_content_bottom', array( $this, 'single_content_bottom' ) );
		add_action( 'lsx_to_fast_facts', array( $this, 'single_fast_facts' ) );
	}

	/**
	 * A filter to set the content area to a small column on single
	 */
	public function entry_class( $classes ) {
		global $post;
		if ( is_main_query() && is_singular( $this->plugin_slug ) ) {
			$classes[] = 'col-sm-9';
		}
		return $classes;
	}
}
new LSX_TO_Vehicles_Frontend();
