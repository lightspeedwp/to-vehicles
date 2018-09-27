<?php
/**
 * Vehicle Single Template
 *
 * @package 	tour-operator
 * @category	vehicle
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<div id="primary" class="content-area <?php echo esc_attr( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

			<?php lsx_content_top(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<section id="summary" class="lsx-to-section <?php lsx_to_collapsible_class( 'vehicle', false ); ?>">
					<h2 class="lsx-to-section-title lsx-to-collapse-title lsx-title hidden-lg" data-toggle="collapse" data-target="#collapse-summary"><?php esc_html_e( 'Summary', 'lsx-vehicles' ); ?></h2>

					<div id="collapse-summary" class="collapse in">
						<div class="collapse-inner">
							<div class="row">
								<?php lsx_vehicle_content( 'content', 'vehicle' ); ?>
							</div>
						</div>
					</div>
				</section>

			<?php endwhile; ?>

			<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</div><!-- #primary -->

<?php lsx_content_wrap_after(); ?>

<?php get_sidebar(); ?>
<?php get_sidebar( 'alt' ); ?>

<?php get_footer();
