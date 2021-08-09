<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strt
 */

get_header();
?>

	<div class="site container">
		<div class="row">
			<main class="site-main col-12" id="content">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->



					<div class="button-group filters-button-group">
						<button class="button is-checked" data-filter="*">show all</button>
						<button class="button" data-filter=".home_status-beschikbaar">Beschikbaar</button>
						<button class="button" data-filter=".transition">transition</button>
						<button class="button" data-filter=".alkali, .alkaline-earth">alkali and alkaline-earth</button>
						<button class="button" data-filter=":not(.transition)">not transition</button>
						<button class="button" data-filter=".metal:not(.transition)">metal but not transition</button>
						<button class="button" data-filter="numberGreaterThan50">number > 50</button>
						<button class="button" data-filter="ium">name ends with &ndash;ium</button>
					</div>

					<?php
					/* Start the Loop */
					echo '<div class="row grid">';
					while ( have_posts() ) :
						the_post();
						/*
						* Include the Post-Type-specific template for the content.
						* If you want to override this in a child theme, then include a file
						* called content-___.php (where ___ is the Post Type name) and that will be used instead.
						*/
						get_template_part( 'template-parts/content', get_post_type() );
						
						
					endwhile;
					echo '</div>';

					the_posts_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>

			</main><!-- #content -->
		</div>
	</div><!-- .site -->

<?php 
get_footer();
