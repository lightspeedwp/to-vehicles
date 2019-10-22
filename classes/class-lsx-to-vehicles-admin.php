<?php
/**
 * LSX_TO_Vehicles_Admin
 *
 * @package   LSX_TO_Vehicles_Admin
 * @author    LightSpeed
 * @license   GPL-3.0+
 * @link
 * @copyright 2016 LightSpeedDevelopment
 */

/**
 * Main plugin class.
 *
 * @package LSX_TO_Vehicles_Admin
 * @author  LightSpeed
 */

class LSX_TO_Vehicles_Admin extends LSX_TO_Vehicles {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_filter( 'cmb_meta_boxes', array( $this, 'register_metaboxes' ) );

		//add_filter( 'lsx_get_post-types_configs', array( $this, 'post_type_config' ), 10, 1 );
		//add_filter( 'lsx_get_metaboxes_configs', array( $this, 'meta_box_config' ), 10, 1 );

		add_filter( 'lsx_to_destination_custom_fields', array( $this, 'custom_fields' ) );
		add_filter( 'lsx_to_tour_custom_fields', array( $this, 'custom_fields' ) );
		add_filter( 'lsx_to_accommodation_custom_fields', array( $this, 'custom_fields' ) );
		add_filter( 'lsx_to_team_custom_fields', array( $this, 'custom_fields' ) );
		add_filter( 'lsx_to_special_custom_fields', array( $this, 'custom_fields' ) );
		add_filter( 'lsx_to_activity_custom_fields', array( $this, 'custom_fields' ) );
	}

	/**
	 * Register the activity post type config
	 *
	 * @param  $objects
	 * @return   array
	 */
	public function post_type_config( $objects ) {

		foreach ( $this->post_types as $key => $label ) {
			if ( file_exists( LSX_TO_VEHICLES_PATH . 'includes/post-types/config-' . $key . '.php' ) ) {
				$objects[ $key ] = include LSX_TO_VEHICLES_PATH . 'includes/post-types/config-' . $key . '.php';
			}
		}

		return 	$objects;
	}

	/**
	 * Register the activity metabox config
	 *
	 * @param  $meta_boxes
	 * @return   array
	 */
	public function meta_box_config( $meta_boxes ) {
		foreach ( $this->post_types as $key => $label ) {
			if ( file_exists( LSX_TO_VEHICLES_PATH . 'includes/metaboxes/config-' . $key . '.php' ) ) {
				$meta_boxes[ $key ] = include LSX_TO_VEHICLES_PATH . 'includes/metaboxes/config-' . $key . '.php';
			}
		}
		return 	$meta_boxes;
	}

	/**
	 * Register the landing pages post type.
	 */
	public function register_post_types() {

		$labels = array(
			'name'               => _x( 'Vehicles', 'to-vehicles' ),
			'singular_name'      => _x( 'Vehicle', 'to-vehicles' ),
			'add_new'            => _x( 'Add New', 'to-vehicles' ),
			'add_new_item'       => _x( 'Add New Vehicle', 'to-vehicles' ),
			'edit_item'          => _x( 'Edit Vehicle', 'to-vehicles' ),
			'new_item'           => _x( 'New Vehicle', 'to-vehicles' ),
			'all_items'          => _x( 'Vehicles', 'to-vehicles' ),
			'view_item'          => _x( 'View Vehicle', 'to-vehicles' ),
			'search_items'       => _x( 'Search Vehicles', 'to-vehicles' ),
			'not_found'          => _x( 'No vehicles found', 'to-vehicles' ),
			'not_found_in_trash' => _x( 'No vehicles found in Trash', 'to-vehicles' ),
			'parent_item_colon'  => '',
			'menu_name'          => _x( 'Vehicles', 'to-vehicles' ),
		);

		$args = array(
			'menu_icon'          => 'dashicons-performance',
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'tour-operator',
			'menu_position'      => 80,
			'query_var'          => true,
			'rewrite'            => array(
				'slug' => 'vehicle',
			),
			'capability_type'    => 'post',
			'has_archive'        => 'vehicles',
			'hierarchical'       => true,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		);

		register_post_type( 'vehicle', $args );

	}

	function register_metaboxes( array $meta_boxes ) {

		$fields[] = array(
			'id'   => 'title',
			'name' => 'General',
			'type' => 'title',
		);
		$fields[] = array(
			'id'   => 'featured',
			'name' => 'Featured',
			'type' => 'checkbox',
		);
		if ( ! class_exists( 'LSX_Banners' ) ) {
			$fields[] = array(
				'id'   => 'tagline',
				'name' => 'Tagline',
				'type' => 'text',
			);
		}
		$fields[] = array(
			'id'   => 'code',
			'name' => 'Code',
			'type' => 'text',
		);
		$fields[] = array(
			'id'      => 'gearbox',
			'name'    => 'Gearbox Type',
			'type'    => 'radio',
			'options' => array(
				'Automatic' => 'Automatic',
				'Manual'    => 'Manual',
			),
		);
		$fields[] = array(
			'id'      => 'gears',
			'name'    => 'Gears',
			'type'    => 'radio',
			'options' => array(
				'4',
				'5',
				'6',
				'7',
			),
		);
		$fields[] = array(
			'id'   => 'vehicle_type',
			'name' => 'Vehicle Type',
			'type' => 'text',
		);
		$fields[] = array(
			'id'   => 'price',
			'name' => 'Price Guide',
			'type' => 'text',
		);
		$fields[] = array(
			'id'      => 'engine_type',
			'name'    => 'Engine Type',
			'type'    => 'radio',
			'options' => array(
				'Diesel' => 'Diesel',
				'Petrol' => 'Petrol',
			),
		);
		$fields[] = array(
			'id'   => 'engine_size',
			'name' => 'Engine Size',
			'type' => 'text',
		);
		$fields[] = array(
			'id'   => 'seating',
			'name' => 'Seats',
			'type' => 'text',
		);
		$fields[] = array(
			'id'      => 'features',
			'name'    => 'Features',
			'type'    => 'wysiwyg',
			'options' => array(
				'editor_height' => '100',
			),
		);
		$fields[] = array(
			'id'   => 'gallery_title',
			'name' => 'Gallery',
			'type' => 'title',
		);

		//Galleries Block
		$fields[] = array(
			'id'   => 'gallery_title',
			'name' => esc_html__( 'Gallery', 'tour-operator' ),
			'type' => 'title',
		);
		$fields[] = array(
			'id'                  => 'gallery',
			'name'                => '',
			'type'                => 'image',
			'repeatable'          => true,
			'show_size'           => false,
			'sortable'            => true,
			'string-repeat-field' => esc_html__( 'Add new image', 'tour-operator' ),
		);
		if ( class_exists( 'Envira_Gallery' ) ) {
			$fields[] = array(
				'id'   => 'envira_title',
				'name' => esc_html__( 'Envira Gallery', 'tour-operator' ),
				'type' => 'title',
			);
			$fields[] = array(
				'id'         => 'envira_gallery',
				'name'       => esc_html__( 'Envira Gallery', 'to-galleries' ),
				'type'       => 'post_select',
				'use_ajax'   => false,
				'query'      => array(
					'post_type'      => 'envira',
					'nopagin'        => true,
					'posts_per_page' => '-1',
					'orderby'        => 'title',
					'order'          => 'ASC',
				),
				'allow_none' => true,
			);
			if ( class_exists( 'Envira_Videos' ) ) {
				$fields[] = array(
					'id'         => 'envira_video',
					'name'       => esc_html__( 'Envira Video Gallery', 'to-galleries' ),
					'type'       => 'post_select',
					'use_ajax'   => false,
					'query'      => array(
						'post_type'      => 'envira',
						'nopagin'        => true,
						'posts_per_page' => '-1',
						'orderby'        => 'title',
						'order'          => 'ASC',
					),
					'allow_none' => true,
				);
			}
		}

		if ( class_exists( 'LSX_Field_Pattern' ) ) {
			$fields = array_merge( $fields, LSX_Field_Pattern::videos() );
		}

		$fields[] = array(
			'id'   => 'accommodation_title',
			'name' => 'Accommodation',
			'type' => 'title',
		);
		$fields[] = array(
			'id'         => 'accommodation_to_vehicle',
			'name'       => 'Accommodations related with this vehicle',
			'type'       => 'post_select',
			'use_ajax'   => false,
			'query'      => array(
				'post_type'      => 'accommodation',
				'nopagin'        => true,
				'posts_per_page' => 1000,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'repeatable' => true,
			'sortable'   => true,
			'allow_none' => true,
		);
		$fields[] = array(
			'id'   => 'activity_title',
			'name' => 'Activities',
			'type' => 'title',
		);
		$fields[] = array(
			'id'         => 'activity_to_vehicle',
			'name'       => 'Activities related with this vehicle',
			'type'       => 'post_select',
			'use_ajax'   => false,
			'query'      => array(
				'post_type'      => 'activity',
				'nopagin'        => true,
				'posts_per_page' => 1000,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'repeatable' => true,
			'sortable'   => true,
			'allow_none' => true,
		);
		$fields[] = array(
			'id'   => 'destinations_title',
			'name' => 'Destinations',
			'type' => 'title',
		);
		$fields[] = array(
			'id'         => 'destination_to_vehicle',
			'name'       => 'Destinations related with this vehicle',
			'type'       => 'post_select',
			'use_ajax'   => false,
			'query'      => array(
				'post_type'      => 'destination',
				'nopagin'        => true,
				'posts_per_page' => 1000,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'repeatable' => true,
			'sortable'   => true,
			'allow_none' => true,
		);
		$fields[] = array(
			'id'   => 'review_title',
			'name' => 'Reviews',
			'type' => 'title',
		);
		$fields[] = array(
			'id'         => 'review_to_vehicle',
			'name'       => 'Reviews related with this vehicle',
			'type'       => 'post_select',
			'use_ajax'   => false,
			'query'      => array(
				'post_type'      => 'reviews',
				'nopagin'        => true,
				'posts_per_page' => 1000,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'repeatable' => true,
			'sortable'   => true,
			'allow_none' => true,
		);
		$fields[] = array(
			'id'   => 'specials_title',
			'name' => 'Specials',
			'type' => 'title',
		);
		$fields[] = array(
			'id'         => 'special_to_vehicle',
			'name'       => 'Specials related with this vehicle',
			'type'       => 'post_select',
			'use_ajax'   => false,
			'query'      => array(
				'post_type'      => 'special',
				'nopagin'        => true,
				'posts_per_page' => 1000,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'repeatable' => true,
			'sortable'   => true,
			'allow_none' => true,
		);
		$fields[] = array(
			'id'   => 'team_title',
			'name' => 'Team Members',
			'type' => 'title',
		);
		$fields[] = array(
			'id'         => 'team_to_vehicle',
			'name'       => 'Team members related with this vehicle',
			'type'       => 'post_select',
			'use_ajax'   => false,
			'query'      => array(
				'post_type'      => 'team',
				'nopagin'        => true,
				'posts_per_page' => 1000,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'repeatable' => true,
			'sortable'   => true,
			'allow_none' => true,
		);
		$fields[] = array(
			'id'   => 'tours_title',
			'name' => 'Tours',
			'type' => 'title',
		);
		$fields[] = array(
			'id'         => 'tour_to_vehicle',
			'name'       => 'Tours related with this vehicle',
			'type'       => 'post_select',
			'use_ajax'   => false,
			'query'      => array(
				'post_type'      => 'tour',
				'nopagin'        => true,
				'posts_per_page' => 1000,
				'orderby'        => 'title',
				'order'          => 'ASC',
			),
			'repeatable' => true,
			'sortable'   => true,
			'allow_none' => true,
		);

		$fields = apply_filters( 'lsx_to_vehicle_custom_fields', $fields );

		$meta_boxes[] = array(
			'title'  => 'Tour Operator Plugin',
			'pages'  => 'vehicle',
			'fields' => $fields,
		);
		return $meta_boxes;

	}

	/**
	 * Adds in the gallery fields to the Tour Operators Post Types.
	 */
	public function custom_fields( $fields ) {
		global $post, $typenow, $current_screen;

		$post_type = false;
		if ( $post && $post->post_type ) {
			$post_type = $post->post_type;
		} elseif ( $typenow ) {
			$post_type = $typenow;
		} elseif ( $current_screen && $current_screen->post_type ) {
			$post_type = $current_screen->post_type;
		} elseif ( isset( $_REQUEST['post_type'] ) ) {
			$post_type = sanitize_key( $_REQUEST['post_type'] );
		} elseif ( isset( $_REQUEST['post'] ) ) {
			$post_type = get_post_type( sanitize_key( $_REQUEST['post'] ) );
		}
		//$post_type = get_post_type();
		if ( false !== $post_type ) {
			$fields[]  = array(
				'id'   => 'vehicle_title',
				'name' => 'Vehicles',
				'type' => 'title',
				'cols' => 12,
			);
			$fields[]  = array(
				'id'         => 'vehicle_to_' . $post_type,
				'name'       => 'Vehicles related with this ' . $post_type,
				'type'       => 'post_select',
				'use_ajax'   => false,
				'query'      => array(
					'post_type'      => 'vehicle',
					'nopagin'        => true,
					'posts_per_page' => '-1',
					'orderby'        => 'title',
					'order'          => 'ASC',
				),
				'repeatable' => true,
				'allow_none' => true,
				'cols'       => 12,
			);
		}
		return $fields;
	}
}
new LSX_TO_Vehicles_Admin();
