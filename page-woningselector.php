<?php
/**
 * Template Name: Woning selector
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strt
 */


get_header();
?>

<div class="site">
	<main class="site-main container" id="content">

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

		<div class="btn-group filters-button-group">
			<button class="btn btn-primary btn-sm active" data-filter="*">show all</button>
			<button class="btn btn-primary btn-sm" data-filter=".home_building-de-warmoes">De Warmoes</button>
			<button class="btn btn-primary btn-sm" data-filter=".transition">transition</button>
			<button class="btn btn-primary btn-sm" data-filter=".alkali, .alkaline-earth">alkali and alkaline-earth</button>
			<button class="btn btn-primary btn-sm" data-filter=":not(.transition)">not transition</button>
			<button class="btn btn-primary btn-sm" data-filter=".metal:not(.transition)">metal but not transition</button>
			<button class="btn btn-primary btn-sm" data-filter="numberGreaterThan50">number > 50</button>
			<button class="btn btn-primary btn-sm" data-filter="ium">name ends with &ndash;ium</button>
		</div>

		<select class="filters-select form-select form-select-sm mb-2 w-10">
			<option value="*">show all</option>
			<option value=".home_building-de-warmoes">De Warmoes</option>
			<option value=".home_building-de-fortuin">De Fortuin</option>
			<option value=".home_building-de-flora">De Flora</option>
			<option value=".home_status-verhuurd">verhuurd</option>
			<option value=".home_status-verhuurd-onder-voorbehoud">verhuurd-onder-voorbehoud</option>
		</select>

		<?php 
		$args = array(
			'post_type'      => array( 'homes' ),
			'nopaging'       => true,
			'posts_per_page' => '-1',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) :
		?>
		<div class="row">
			<!-- <table class="table">
				<thead>
					<tr>
						<td>Adres</td>
						<td>Huurcategorie</td>
						<td>Gebouw</td>
						<td>Verdieping</td>
						<td>Type</td>
						<td>Beschikbaarheid</td>
						<td>Huurprijs</td>
						<td>Oppervlakte</td>
						<td>Aantal kamers</td>
						<td>Slaapkamers</td>
						<td>Buitenruimte type</td>
						<td>Buitenruimte oppervlakte</td>
						<td>Buitenruimte ligging</td>
						<td>Parkeer plaatsen</td>
					</tr>
				</thead>
				<tbody class="grid">
					<?php 
					while ( $query->have_posts() ) : $query->the_post(); 
						$building_term_list = get_the_terms( $post->ID, 'home_building' );
						$building_term_string = join(', ', wp_list_pluck($building_term_list, 'name'));
						$type_term_list = get_the_terms( $post->ID, 'home_type' );
						$type_term_string = join(', ', wp_list_pluck($type_term_list, 'name'));
					?>
					<tr <?php post_class('element-item') ?>>
						<td><a href="<?php the_permalink() ?>"><?php the_title() ?></a></td>
						<td><?php the_field('huurcategorie') ?></td>
						<td><?php echo $building_term_string ?></td>
						<td><?php the_field('verdieping') ?></td>
						<td><?php echo $type_term_string ?></td>
						<td><?php the_field('beschikbaarheid') ?></td>
						<td><?php the_field('huurprijs') ?></td>
						<td><?php the_field('oppervlakte') ?></td>
						<td><?php the_field('aantal_kamers') ?></td>
						<td><?php the_field('slaapkamers') ?></td>
						<td><?php the_field('buitenruimte_type') ?></td>
						<td><?php the_field('buitenruimte_oppervlakte') ?></td>
						<td><?php the_field('buitenruimte_ligging') ?></td>
						<td><?php the_field('parkeer_plaatsen') ?></td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table> -->

			<ul class="ws-list grid">
				<?php 
				while ( $query->have_posts() ) : $query->the_post(); 
					$building_term_list = get_the_terms( $post->ID, 'home_building' );
					$building_term_string = join(', ', wp_list_pluck($building_term_list, 'name'));
					$type_term_list = get_the_terms( $post->ID, 'home_type' );
					$type_term_string = join(', ', wp_list_pluck($type_term_list, 'name'));
				?>
				<li <?php post_class('element-item') ?>>
					<div><a href="<?php the_permalink() ?>"><?php the_title() ?></a></div>
					<div><?php the_field('huurcategorie') ?></div>
					<div><?php echo $building_term_string ?></div>
					<div><?php the_field('verdieping') ?></div>
					<div><?php echo $type_term_string ?></div>
					<div><?php the_field('beschikbaarheid') ?></div>
					<div><?php the_field('huurprijs') ?></div>
					<div><?php the_field('oppervlakte') ?></div>
					<div><?php the_field('aantal_kamers') ?></div>
					<div><?php the_field('slaapkamers') ?></div>
					<div><?php the_field('buitenruimte_type') ?></div>
					<div><?php the_field('buitenruimte_oppervlakte') ?></div>
					<div><?php the_field('buitenruimte_ligging') ?></div>
					<div><?php the_field('parkeer_plaatsen') ?></div>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

	</main><!-- #content -->
</div><!-- .site -->

<?php
get_footer();
