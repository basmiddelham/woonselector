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
		<div id="filters" class="button-group">
			<button class="btn btn-primary btn-sm is-checked" data-filter="*">show all</button>
			<button class="btn btn-primary btn-sm" data-filter=".home_building-the-w">The W</button>
			<button class="btn btn-primary btn-sm" data-filter=".home_building-the-n">The N</button>
			<button class="btn btn-primary btn-sm" data-filter=".alkali, .alkaline-earth">alkali and alkaline-earth</button>
			<button class="btn btn-primary btn-sm" data-filter=":not(.transition)">not transition</button>
			<button class="btn btn-primary btn-sm" data-filter=".metal:not(.transition)">metal but not transition</button>
			<button class="btn btn-primary btn-sm" data-filter="numberGreaterThan50">number > 50</button>
			<button class="btn btn-primary btn-sm" data-filter="ium">name ends with &ndash;ium</button>
		</div>

		<select class="filters-select form-select form-select-sm mb-2 w-10">
			<option value="*">show all</option>
			<option value=".home_building-the-w">The W</option>
			<option value=".home_building-the-n">The N</option>
			<option value=".home_building-de-flora">De Flora</option>
		</select>

		<div id="sorts" class="button-group">
			<button class="btn btn-primary btn-sm button is-checked" data-sort-value="original-order">original order</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="name">name</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="category">category</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="building">building</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="type">type</button>
		</div>

		<?php 
		$args = array(
			'post_type'      => array( 'homes' ),
			'nopaging'       => true,
			'posts_per_page' => '-1',
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) :
		?>
		<div class="table-responsive">
			<table class="table table-sm caption-top">
				<caption class="filter-count">List of users</caption>
				<thead class="table-dark">
					<tr class="element-item">
						<th scope="col" class="name text-nowrap"><?php esc_html_e('Name', 'strt'); ?></th>
						<th scope="col" class="category text-nowrap"><?php esc_html_e('Category', 'strt'); ?></th>
						<th scope="col" class="building text-nowrap"><?php esc_html_e('Building', 'strt'); ?></th>
						<th scope="col" class="type"><?php esc_html_e('Type', 'strt'); ?></th>
						<th scope="col" class="surface text-end"><?php esc_html_e('Surface', 'strt'); ?></tdth>
						<th scope="col" class="price text-end"><?php esc_html_e('Price', 'strt'); ?></th>
					</tr>
				</thead>
				<tbody class="grid">
					<?php 
					while ( $query->have_posts() ) : $query->the_post(); 
						$building_term_list   = get_the_terms( $post->ID, 'home_building' );
						$building_term_string = join(', ', wp_list_pluck($building_term_list, 'name'));
						$type_term_list       = get_the_terms( $post->ID, 'home_type' );
						$type_term_string     = join(', ', wp_list_pluck($type_term_list, 'name'));
						$category             = get_field('category');
						$availability         = get_field('availability');
						$surface              = get_field('surface');
						$price                = get_field('price');
						if ( $availability === 'beschikbaar') :
							$availability_color = 'table-success';
						elseif ( $availability === 'onder optie' || $availability === 'later in verhuur' || $availability === 'verhuurd onder voorbehoud' ) :
							$availability_color = 'table-warning';
						elseif ( $availability === 'verhuurd' ) :
							$availability_color = 'table-danger';
						endif;
					?>
					<tr class="element-item">
						<th class="name" scope="row"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></th>
						<td class="category"><?php echo $category ?></td>
						<td class="building"><?php echo $building_term_string ?></td>
						<td class="type"><?php echo $type_term_string ?></td>
						<td class="surface text-end"><?php echo ($surface ? $surface . 'm<sup>2</sup>' : ''); ?></td>
						<td class="price text-end <?php echo $availability_color ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $availability ?>"><?php echo ($price ? $price . ',-' : ''); ?></td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

		

	</main><!-- #content -->
</div><!-- .site -->

<?php
get_footer();
