<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Garage_Girard
 */

get_header();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		garage_girard_display_header_image();
		break; // Only need to display header once
	endwhile;
	rewind_posts();
endif;
?>

	<main id="primary" class="site-main">
		<div class="container container-small">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'post' );

				endwhile; // End of the loop.
				?>
		</div>
	</main><!-- #main -->

	<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
		<div class="footer-widgets">
			<div class="container">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php
	// Post navigation outside main
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>
			<div class="container container-small">
				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Précédent:', 'garage-girard' ) . '</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Suivant:', 'garage-girard' ) . '</span> <span class="nav-title">%title</span>',
					)
				);
				?>
			</div>
			<?php
			break; // Only need navigation once
		endwhile;
		rewind_posts();
	endif;
	?>

<?php
get_footer();
