<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Garage_Girard
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'garage-girard' ),
				'after'  => '</div>',
			)
		);
		?>
		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- page #post-<?php the_ID(); ?> -->
