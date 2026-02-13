<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Garage_Girard
 */

?>

	<footer id="colophon" class="site-footer">
	<div class="container">
		<?php 
dynamic_sidebar( 'sidebar-footer' );
?>
	</div>
	<div class="site-info">
		<div class="container">
		<!--<span class="sep"> | </span>-->
		© Garage Girard | webdesign & code : Didier Grand - <a href="https://www.digitalgarage.ch?ref=garage-girard">digitalgarage.ch</a>
		</div>
	</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
