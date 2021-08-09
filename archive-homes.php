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

					<div class="btn-group filters-button-group">
						<button class="btn btn-primary btn-sm active" data-filter="*">show all</button>
						<button class="btn btn-primary btn-sm" data-filter=".home_status-beschikbaar">Beschikbaar</button>
						<button class="btn btn-primary btn-sm" data-filter=".transition">transition</button>
						<button class="btn btn-primary btn-sm" data-filter=".alkali, .alkaline-earth">alkali and alkaline-earth</button>
						<button class="btn btn-primary btn-sm" data-filter=":not(.transition)">not transition</button>
						<button class="btn btn-primary btn-sm" data-filter=".metal:not(.transition)">metal but not transition</button>
						<button class="btn btn-primary btn-sm" data-filter="numberGreaterThan50">number > 50</button>
						<button class="btn btn-primary btn-sm" data-filter="ium">name ends with &ndash;ium</button>
					</div>

					<select class="filters-select form-select form-select-sm mb-2 w-10">
						<option value="*">show all</option>
						<option value=".home_status-beschikbaar">beschikbaar</option>
						<option value=".home_status-later-in-verhuur">later-in-verhuur</option>
						<option value=".home_status-onder-optie">onder-optie</option>
						<option value=".home_status-verhuurd">verhuurd</option>
						<option value=".home_status-verhuurd-onder-voorbehoud">verhuurd-onder-voorbehoud</option>
					</select>

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
