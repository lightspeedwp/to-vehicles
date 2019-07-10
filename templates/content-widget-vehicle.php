<?php
/**
 * Vehicle Widget Content Part
 *
 * @package    lsx-tour-operators
 * @category   vehicle
 * @subpackage widget
 */
global $disable_placeholder, $disable_text, $post;

$has_single = ! lsx_to_is_single_disabled();
$permalink = '';

if ( $has_single ) {
	$permalink = get_the_permalink();
} elseif ( ! is_post_type_archive( 'vehicle' ) ) {
	$has_single = true;
	$permalink = get_post_type_archive_link( 'vehicle' ) . '#vehicle-' . $post->post_name;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php lsx_widget_entry_top(); ?>

	<?php if ( empty( $disable_placeholder ) ) { ?>
		<div class="lsx-to-widget-thumb">
			<?php if ( $has_single ) { ?><a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
				<?php lsx_thumbnail( 'lsx-thumbnail-single' ); ?>
			<?php if ( $has_single ) { ?></a><?php } ?>
		</div>
	<?php } ?>

	<div class="lsx-to-widget-content">
		<?php lsx_widget_entry_content_top(); ?>

		<h4 class="lsx-to-widget-title text-center">
			<?php if ( false !== $has_single ) { ?>
				<a href="<?php echo esc_url( $permalink ); ?>"><?php } ?>
				<?php the_title(); ?>
			<?php if ( false !== $has_single ) { ?>
				</a>
			<?php } ?>
		</h4>

		<div class="lsx-to-widget-meta-data">
			<?php
				$meta_class = 'lsx-to-meta-data lsx-to-meta-data-';
			?>
			<?php if ( false !== get_post_meta( get_the_ID(), 'vehicle_type', true ) ) { ?>
				<div <?php echo 'class="' . esc_html( $meta_class ) . 'type"'; ?>><span class="lsx-to-meta-data-key"><?php esc_html_e( 'Type', 'to-vehicles' ); ?>:</span> <?php echo esc_attr( get_post_meta( get_the_ID(), 'vehicle_type', true ) ); ?></div>
			<?php } ?>
			<?php if ( false !== get_post_meta( get_the_ID(), 'seating', true ) ) { ?>
				<div <?php echo 'class="' . esc_html( $meta_class ) . 'seating"'; ?>><span class="lsx-to-meta-data-key"><?php esc_html_e( 'Seats', 'to-vehicles' ); ?>:</span> <?php echo esc_attr( get_post_meta( get_the_ID(), 'seating', true ) ); ?></div>
			<?php } ?>
			<?php if ( false !== get_post_meta( get_the_ID(), 'price', true ) ) { ?>
				<div <?php echo 'class="' . esc_html( $meta_class ) . 'price"'; ?>><span class="lsx-to-meta-data-key"><?php esc_html_e( 'Price Guide', 'to-vehicles' ); ?>:</span> <?php echo esc_attr( get_post_meta( get_the_ID(), 'price', true ) ); ?></div>
			<?php } ?>
		</div>
		<?php
			ob_start();
			lsx_to_widget_entry_content_top();
			the_excerpt();
			lsx_to_widget_entry_content_bottom();
			$excerpt = ob_get_clean();

			if ( empty( $disable_text ) && ! empty( $excerpt ) ) {
				echo wp_kses_post( $excerpt );
			} elseif ( $has_single ) { ?>
				<p><a href="<?php echo esc_url( $permalink ); ?>" class="moretag"><?php esc_html_e( 'View more', 'tour-operator' ); ?></a></p>
			<?php
		}
		?>
		<?php lsx_widget_entry_content_bottom(); ?>
	</div>	
	<?php lsx_widget_entry_bottom(); ?>

</article>
<?php lsx_widget_entry_after(); ?>
