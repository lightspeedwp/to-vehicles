<?php
/**
 * Vehicle Content Part
 *
 * @package  lsx-tour-operator
 * @category vehicle
 */
global $lsx_archive;
if ( 1 !== $lsx_archive ) {
	$lsx_archive = false;
}
?>

<?php lsx_entry_before(); ?>

<article id="vehicle-<?php echo esc_attr( $post->post_name ); ?>" <?php post_class( 'lsx-to-archive-container' ); ?>>
	<?php lsx_entry_top(); ?>

	<?php lsx_vehicle_content( 'content', get_post_type() ); ?>

	<?php lsx_vehicle_accommodation(); ?>

	<?php //lsx_vehicle_tours(); ?>

	<?php lsx_vehicle_features(); ?>

	<?php lsx_entry_bottom(); ?>

</article>

<?php lsx_entry_after();
