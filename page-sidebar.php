<?php
/**
 * Template Name: Sidebar
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strt
 */

get_header();
?>

	<div class="site container">
		<div class="row">
			<main class="site-main col-12 col-lg-9" id="content">

				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #content -->
			<?php get_sidebar(); ?>
		</div>
	</div><!-- .site -->

<?php 
get_footer();
