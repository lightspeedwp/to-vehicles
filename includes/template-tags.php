<?php
/**
 * Template Tags
 *
 * @package   LSX_Vehicles
 * @license   GPL-2.0+
 */

/**
 * Find the content part in the plugin
 *
 * @package     to-vehicles
 * @subpackage  template-tag
 * @category    content
 */
function lsx_vehicle_content( $slug, $name = null ) {
	do_action( 'lsx_vehicle_content', $slug, $name );
}

/* ================  VEHICLES =========================== */
/**
 * Outputs the current vehicles code.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_code( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'code', $before, $after, $echo );
}
/**
 * Outputs the current vehicles vehicle_type.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_type( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'vehicle_type', $before, $after, $echo );
}
/**
 * Outputs the current vehicles price.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_price( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'price', $before, $after, $echo );
}
/**
 * Outputs the current vehicles engine_type.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_engine_type( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'engine_type', $before, $after, $echo );
}
/**
 * Outputs the current vehicles gearbox.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_gearbox( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'gearbox', $before, $after, $echo );
}
/**
 * Outputs the current vehicles engine_size.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_engine_size( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'engine_size', $before, $after, $echo );
}
/**
 * Outputs the current vehicles gears.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_gears( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'gears', $before, $after, $echo );
}
/**
 * Outputs the current vehicles seating.
 *
 * @param       $before | string
 * @param       $after  | string
 * @param       $echo   | boolean
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_seating( $before = '', $after = '', $echo = true ) {
	lsx_to_custom_field_query( 'seating', $before, $after, $echo );
}

/**
 * Checks if the current vehicle has featured
 * @return      string
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_has_vehicle_features() {
	return lsx_to_has_custom_field_query( 'features', get_the_ID() );
}
/**
 * Outputs the Vehicles Custom Fields on the Single Vehicle Templates
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_features() {
	if ( is_singular( 'vehicle' ) ) {
		$features = lsx_to_custom_field_query( 'features', '', '', false );
		if ( null !== $features ) { ?>
			<section id="features">
				<div class="row">						
					<?php if ( null !== $features ) { ?>
						<div class=" col-sm-12">
							<h3 class="section-title"><?php esc_html_e( 'Features', 'to-vehicles' ); ?></h3>
							<div class="entry-content">
								<?php
									$the_feature = apply_filters( 'the_content', $features );
								?>
								<?php echo wp_kses_post( $the_feature ); ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</section>
			<?php
		}
	}
}

/**
 * Outputs the connected accommodation for a vehicle
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_accommodation() {
	global $lsx_archive;
	if ( post_type_exists( 'accommodation' ) && is_singular( 'vehicle' ) ) {
		$args = array(
			'from'   => 'accommodation',
			'to'     => 'vehicle',
			'column' => '3',
			'before' => '<section id="accommodation"><h2 class="section-title">' . lsx_to_get_post_type_section_title( 'accommodation', '', 'Featured Accommodations' ) . '</h2>',
			'after'  => '</section>',
		);
		lsx_to_connected_panel_query( $args );
	}
}

/**
 * Outputs the connected vehicles for a destination
 *
 * @package 	lsx-tour-operators
 * @subpackage	template-tags
 * @category 	vehicle
 */
function lsx_to_destination_vehicles() {
	global $lsx_archive;

	if ( post_type_exists( 'vehicle' ) && is_singular( 'destination' ) ) {
		$args = array(
			'from'		=> 'vehicle',
			'to'		=> 'destination',
			'column'	=> '3',
			'before'	=> '<section id="vehicle" class="lsx-to-section lsx-to-collapse-section"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" data-toggle="collapse" data-target="#collapse-special">' . lsx_to_get_post_type_section_title( 'vehicle', '', __( 'Featured Vehicles', 'to-vehicles' ) ) . '</h2><div id="collapse-vehicle" class="collapse in"><div class="collapse-inner">',
			'after'		=> '</div></div></section>',
		);

		lsx_to_connected_panel_query( $args );
	}
}

/**
 * Outputs the connected tours only a vehicle
 *
 * @package     lsx-tour-operators
 * @subpackage  template-tags
 * @category    vehicle
 */
function lsx_vehicle_tours() {
	global $lsx_archive;
	if ( post_type_exists( 'tour' ) && is_singular( 'vehicle' ) ) {
		$args = array(
			'from'   => 'tour',
			'to'     => 'vehicle',
			'column' => '3',
			'before' => '<section id="tours"><h2 class="section-title">' . lsx_to_get_post_type_section_title( 'tour', '', 'Featured Tours' ) . '</h2>',
			'after'  => '</section>',
		);
		lsx_to_connected_panel_query( $args );
	}
}
