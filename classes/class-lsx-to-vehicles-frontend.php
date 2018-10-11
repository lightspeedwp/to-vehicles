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
	 * Holds the $page_links array while its being built on the single team page.
	 *
	 * @var array
	 */
	public $page_links = false;

	/**
	 * Holds the array of options.
	 *
	 * @var array
	 */
	public $options = false;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->set_vars();

		add_action( 'wp_head', array( $this, 'wp_head' ), 20, 1 );

		//add_filter( 'lsx_to_entry_class', array( $this, 'entry_class' ) );
		//add_action( 'init', array( $this, 'init' ) );

		if ( ! class_exists( 'LSX_TO_Template_Redirects' ) ) {
			require_once( LSX_TO_VEHICLES_PATH . 'classes/class-lsx-to-template-redirects.php' );
		}
		$this->redirects = new LSX_TO_Template_Redirects( LSX_TO_VEHICLES_PATH, array_keys( $this->post_types ) );
		add_action( 'lsx_vehicle_content', array( $this->redirects, 'content_part' ), 10, 2 );

		add_filter( 'lsx_to_page_navigation', array( $this, 'page_links' ) );

		//add_action( 'lsx_entry_top', array( $this, 'archive_entry_top' ), 15 );
		//add_action( 'lsx_entry_bottom', array( $this, 'archive_entry_bottom' ) );
		add_action( 'lsx_content_bottom', array( $this, 'single_content_bottom' ) );

		add_action( 'lsx_banner_allowed_post_types', array( $this, 'theme_allowed_post_type_banners' ) );
	}

	function wp_head() {
		if ( is_singular( 'vehicle' ) ) {
			remove_action( 'lsx_entry_bottom', 'lsx_to_single_entry_bottom' );
		}
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
			} //lsx_to_review_posts();
		}
	}

	/**
	 * Adds our navigation links to the team single post
	 *
	 * @param $page_links array
	 * @return $page_links array
	 */
	public function page_links( $page_links ) {
		if ( is_singular( 'vehicle' ) ) {
			$this->page_links = $page_links;
			$this->get_gallery_link();
			$this->get_videos_link();

			$page_links = $this->page_links;
		}

		return $page_links;
	}

	/**
	 * Tests for the Gallery and returns a link for the section
	 */
	public function get_gallery_link() {
		$gallery_ids = get_post_meta( get_the_ID(), 'gallery', false );
		$envira_gallery = get_post_meta( get_the_ID(), 'envira_gallery', true );

		if ( ( ! empty( $gallery_ids ) && is_array( $gallery_ids ) ) || ( function_exists( 'envira_gallery' ) && ! empty( $envira_gallery ) && false === lsx_to_enable_envira_banner() ) ) {
			if ( function_exists( 'envira_gallery' ) && ! empty( $envira_gallery ) && false === lsx_to_enable_envira_banner() ) {
				// Envira Gallery.
				$this->page_links['gallery'] = esc_html__( 'Gallery', 'to-vehicles' );
				return;
			} else {
				if ( function_exists( 'envira_dynamic' ) ) {
					// Envira Gallery - Dynamic.
					$this->page_links['gallery'] = esc_html__( 'Gallery', 'to-vehicles' );
					return;
				} else {
					// WordPress Gallery.
					$this->page_links['gallery'] = esc_html__( 'Gallery', 'to-vehicles' );
					return;
				}
			}
		}
	}

	/**
	 * Tests for the Videos and returns a link for the section
	 */
	public function get_videos_link() {
		$videos_id = false;

		if ( class_exists( 'Envira_Videos' ) ) {
			$videos_id = get_post_meta( get_the_ID(), 'envira_video', true );
		}

		if ( empty( $videos_id ) && function_exists( 'lsx_to_videos' ) ) {
			$videos_id = get_post_meta( get_the_ID(), 'videos', true );
		}

		if ( ! empty( $videos_id ) ) {
			$this->page_links['videos'] = esc_html__( 'Videos', 'to-vehicles' );
		}
	}

}
new LSX_TO_Vehicles_Frontend();
