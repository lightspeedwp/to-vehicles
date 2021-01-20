<?php
/*
 * Plugin Name: LSX Tour Operator Vehicles
 * Plugin URI:  https://www.lsdev.biz/product/tour-operator-vehicles/
 * Description: The Tour Operator Vehicles extension adds the Vehicles post type, with fields to specify each of your company’s vehicle specs to ensure prospective travellers of their safety and comfort on your tours.
 * Version:     1.0.5
 * Author:      LightSpeed
 * Author URI:  https://www.lsdev.biz/
 * License:     GPL3+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: to-vehicles
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'LSX_TO_VEHICLES_PATH', plugin_dir_path( __FILE__ ) );
define( 'LSX_TO_VEHICLES_CORE', __FILE__ );
define( 'LSX_TO_VEHICLES_URL', plugin_dir_url( __FILE__ ) );
define( 'LSX_TO_VEHICLES_VER', '1.0.5' );

/* ======================= Below is the Plugin Class init ========================= */

require_once LSX_TO_VEHICLES_PATH . '/classes/class-lsx-to-vehicles.php';
