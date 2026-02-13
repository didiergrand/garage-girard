<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Garage_Girard
 */

get_header();
?>
<div class="header-image">
	<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
	<div class="container">
		<div class="header-image-content">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$garage_girard_description = get_bloginfo( 'description', 'display' );
			if ( $garage_girard_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $garage_girard_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>
	<main id="primary" class="site-main">
		<div class="container">
			<div class="content-wrapper">
				<div id="news">
					<h2>Actualités</h2>
					<div class="news-content">
					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) :
							?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
							<?php
						else:
							?>
							<header>
								<h2 class="page-title screen-reader-text"><?php single_post_title(); ?></h2>
							</header>
							<?php
						endif;

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', 'home' );

						endwhile;
					else :
						get_template_part( 'template-parts/content', 'none' );
					endif;
					?>
					<?php
					global $wp_query;
					if ( $wp_query->found_posts > 4 ) :
						?>
						<div class="news-button-wrapper">
							<a href="<?php echo esc_url( home_url( '/categorie/actualites/' ) ); ?>" class="btn-default"><?php esc_html_e( 'Voir toutes les actualités', 'garage-girard' ); ?></a>
						</div>
						<?php
					endif;
					?>
					</div>
				</div>
				<div id="right-sidebar">
					<?php dynamic_sidebar( 'sidebar-right' );?>
				</div>
			</div>
		</div>
	</main><!-- #main -->
<?php
get_footer();
