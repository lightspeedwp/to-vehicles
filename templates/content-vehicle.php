<?php
/**
 * Vehicle Content Part
 *
 * @package    lsx-tour-operators
 * @category   vehicle
 */

global $lsx_archive, $lsx_to_archive, $post;

if ( 1 !== $lsx_archive ) {
	$lsx_archive = false;
}
?>

<?php lsx_entry_before(); ?>

	<article id="tour-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>

		<?php if ( is_archive() ) { ?>
		<div class="lsx-to-archive-thumb lsx-to-widget-thumb">
			<a href="<?php the_permalink(); ?>">
				<?php lsx_thumbnail( 'lsx-thumbnail-wide' ); ?>
			</a>
		</div>

		<div class="lsx-to-archive-wrapper">
			<div class="lsx-to-archive-content">
				<h3 class="lsx-to-archive-content-title">
					<a href="<?php the_permalink(); ?>" title="<?php esc_html_e( 'Read more', 'tour-operator' ); ?>">
						<?php
						the_title();
						do_action( 'lsx_to_the_title_end', get_the_ID() );
						?>
					</a>
				</h3>
				<!-- .entry-header -->
				<?php } ?>

				<div <?php lsx_to_entry_class( 'entry-content' ); ?>>

					<?php if ( is_single() ) { ?>
						<div <?php lsx_to_entry_class( 'entry-content' ); ?>>
							<div class="col-xs-12 col-sm-12 col-md-7">
								<div class="lsx-to-summary">
									<h2 class="lsx-to-summary-title"><?php the_title(); ?></h2>
								</div>

								<?php lsx_to_price( '<p class="lsx-to-meta-data lsx-to-meta-data-big lsx-to-meta-data-price"><span class="lsx-to-meta-data-key">' . esc_html__( 'From price', 'tour-operator' ) . ':</span> ', '</p>' ); ?>
								<?php the_content(); ?>
								<div class="key-fetures">
									<?php lsx_vehicle_features( '<div class="meta features">' . __( 'Features', 'to-vehicles' ) . ': ', '</div>' ); ?>
								</div>
								<?php lsx_to_sharing(); ?>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5">
							<section id="fast-facts">
								<div class="vehicle-summary">
									<div class="lsx-to-archive-thumb lsx-to-widget-thumb">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'full' ); ?>
										</a>
									</div>
									<div class="lsx-to-section-inner">
										<h3 class="lsx-to-section-title"><?php esc_html_e( 'Vehicle Summary', 'tour-operator' ); ?></h3>
										<div class="lsx-to-single-meta-data">
											<div class="meta taxonomies">
												<?php //lsx_vehicle_code( '<div class="meta code">' . __( 'Code', 'to-vehicles' ) . ': ', '</div>' ); ?>
												<?php lsx_vehicle_type( '<div class="meta vehicle-type"><span class="entry-meta-key">' . __( 'Type', 'to-vehicles' ) . '</span>: ', '</div>' ); ?>
												<?php lsx_vehicle_seating( '<div class="meta seating"><span class="entry-meta-key">' . __( 'Seats', 'to-vehicles' ) . '</span>: ', '</div>' ); ?>
												<?php lsx_vehicle_price( '<div class="meta seating"><span class="entry-meta-key">' . __( 'Price Guide', 'to-vehicles' ) . '</span>: ', '</div>' ); ?>
												<?php //lsx_vehicle_engine_type( '<div class="meta vehicle-type"><span class="entry-meta-key">' . __( 'Engine Type', 'to-vehicles' ) . '</span>: ', '</div>' ); ?>
												<?php //lsx_vehicle_gearbox( '<div class="meta gearbox"><span class="entry-meta-key">' . __( 'Gearbox', 'to-vehicles' ) . '</span>: ', '</div>' ); ?>
												<?php //lsx_vehicle_engine_size( '<div class="meta engine-size"><span class="entry-meta-key">' . __( 'Engine-size', 'to-vehicles' ) . '</span>: ', '</div>' ); ?>
												<?php //lsx_vehicle_gears( '<div class="meta gears"><span class="entry-meta-key">' . __( 'Gears', 'to-vehicles' ) . '</span>: ', '</div>' ); ?>

											</div>
										</div>
									</div>
								</div>
							</section>
							<?php if ( lsx_to_has_enquiry_contact() ) : ?>
								<div class="lsx-to-contact-widget">
									<?php
									if ( function_exists( 'lsx_to_has_team_member' ) && lsx_to_has_team_member() ) {
										lsx_to_team_member_panel( '<div class="lsx-to-contact">', '</div>' );
									} else {
										lsx_to_enquiry_contact( '<div class="lsx-to-contact">', '</div>' );
									}

									lsx_to_enquire_modal();
									?>
								</div>
							<?php endif ?>
						</div>
					<?php } else { ?>
						<div class="lsx-to-archive-meta-data lsx-to-archive-meta-data-grid-mode">
							<div class="vehicle-details">
								<?php if ( false !== get_post_meta( get_the_ID(), 'type', true ) ) { ?>
									<div class="meta type lsx-to-meta-data lsx-to-meta-data-type"><?php esc_html_e( 'Type', 'to-vehicles' ); ?>: <span><?php echo esc_attr( get_post_meta( get_the_ID(), 'vehicle_type', true ) ); ?></span></div>
								<?php } ?>
								<?php if ( false !== get_post_meta( get_the_ID(), 'seating', true ) ) { ?>
									<div class="meta seats lsx-to-meta-data lsx-to-meta-data-seating"><?php esc_html_e( 'Seats', 'to-vehicles' ); ?>: <span><?php echo esc_attr( get_post_meta( get_the_ID(), 'seating', true ) ); ?></span></div>
								<?php } ?>
								<?php if ( false !== get_post_meta( get_the_ID(), 'price', true ) ) { ?>
									<div class="meta price lsx-to-meta-data lsx-to-meta-data-price"><?php esc_html_e( 'Price guide', 'to-vehicles' ); ?>: <span><?php echo esc_attr( get_post_meta( get_the_ID(), 'price', true ) ); ?></span></div>
								<?php } ?>
							</div>
						</div>
						<div class="entry-content">
							<?php the_excerpt(); ?>
						</div>
					<?php } ?>
				</div><!-- .entry-content -->

				<?php if ( is_archive() ) { ?>
			</div>
		</div>
	<?php echo '<a class="moretag" href="' . wp_kses_post( get_permalink() ) . '" title="View more">', 'View More</a>'; ?>
	<?php } ?>

		<?php
		/**
		 * Hooked
		 *
		 *  - lsx_vehicle_metabox() - 10
		 */
		lsx_entry_bottom();
		?>

	</article><!-- #post-## -->

<?php
lsx_entry_after();
