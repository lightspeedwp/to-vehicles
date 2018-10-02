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
		//add_action( 'lsx_to_fast_facts', array( $this, 'single_fast_facts' ) );
	}

	/**
	 * Adds the template tags to the bottom of the single review
	 */
	public function single_content_bottom() {
		if ( is_singular( 'vehicle' ) ) {
			// lsx_to_review_accommodation();

			// lsx_to_review_tour();

			// lsx_to_review_destination();

			lsx_to_gallery( '<section id="gallery" class="lsx-to-section lsx-to-collapse-section"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" data-toggle="collapse" data-target="#collapse-gallery">' . esc_html__( 'Gallery', 'to-reviews' ) . '</h2><div id="collapse-gallery" class="collapse in"><div class="collapse-inner">', '</div></div></section>' );

			if ( function_exists( 'lsx_to_videos' ) ) {
				lsx_to_videos( '<section id="videos" class="lsx-to-section lsx-to-collapse-section"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" data-toggle="collapse" data-target="#collapse-videos">' . esc_html__( 'Videos', 'to-reviews' ) . '</h2><div id="collapse-videos" class="collapse in"><div class="collapse-inner">', '</div></div></section>' );
			} elseif ( class_exists( 'Envira_Videos' ) ) {
				lsx_to_envira_videos( '<section id="videos" class="lsx-to-section lsx-to-collapse-section"><h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title" data-toggle="collapse" data-target="#collapse-videos">' . esc_html__( 'Videos', 'to-reviews' ) . '</h2><div id="collapse-videos" class="collapse in"><div class="collapse-inner">', '</div></div></section>' );
			}

			//lsx_to_review_posts();
		}
	}

}
new LSX_TO_Vehicles_Frontend();
