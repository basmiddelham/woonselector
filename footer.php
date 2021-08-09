<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .site div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package strt
 */

?>

	<footer class="site-footer">
		<div class="container">
			<?php echo social_menu() ?>
			<?php echo date("Y") ?> &copy; <a href="<?php echo home_url('/'); ?>" rel="home"><?php echo get_bloginfo('name'); ?></a><span class="sep"> | </span><?php echo get_bloginfo( 'description' ) ?>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
