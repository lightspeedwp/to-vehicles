<?php
/**
 * Vehicle Archive
 *
 * @package   lsx-tour-operators
 * @category  vehicle
 */

get_header(); ?>

	<?php lsx_content_wrap_before(); ?>

	<section id="primary" class="content-area <?php echo esc_html( lsx_main_class() ); ?>">

		<?php lsx_content_before(); ?>

		<main id="main" class="site-main" role="main">

		<?php lsx_content_top(); ?>

		<?php if ( have_posts() ) : ?>

			<div class="row lsx-to-archive-items lsx-to-archive-template-grid lsx-to-archive-template-image-max-height">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="lsx-to-archive-item col-xs-12 col-sm-6 col-md-4 <?php echo esc_attr( lsx_to_archive_class( 'lsx-to-archive-item' ) ); ?>">
						<?php lsx_vehicle_content( 'content', 'vehicle' ); ?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php lsx_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		<div class="lsx-full-width vehicles-bottom text-center">
			<h2><?php esc_html_e( 'See our vehicles in action in our gallery', 'to-vehicles' ); ?></h2>
			<a href="/vehicles/" class="btn border-btn"><?php esc_html_e( 'See Gallery', 'to-vehicles' ); ?></a>
		</div>

		<?php lsx_content_bottom(); ?>

		</main><!-- #main -->

		<?php lsx_content_after(); ?>

	</section><!-- #primary -->

<?php lsx_content_wrap_after(); ?>	

<?php get_sidebar(); ?>

<?php
	get_footer();
