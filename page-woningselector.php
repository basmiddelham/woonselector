<?php
/**
 * Template Name: Woning selector
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strt
 */


get_header();

// Get the posts:
$args = array(
	'numberposts' => -1,
	'post_type'   => 'homes'
);
$homes = get_posts( $args );

?>

<div class="site">
	<main class="site-main container" id="content">
		<div class="row">
			<div class="col">
				<label for="buildingSelect" class="form-label"><?php esc_html_e('Building', 'strt'); ?></label>
				<select id="buildingSelect" class="filters-select form-select form-select-sm mb-2" value-group="building">
					<option value="*">show all</option>
					<?php 
					foreach ( get_terms( array('taxonomy' => 'home_building') ) as $building ) :
						echo '<option value=".' . $building->slug . '">' . $building->name . '</option>';
					endforeach;
					?>
				</select>
			</div>
			<div class="col">
				<label for="typeSelect" class="form-label"><?php esc_html_e('Type', 'strt'); ?></label>
				<select id="typeSelect" class="filters-select form-select form-select-sm mb-2" value-group="type">
					<option value="*">show all</option>
					<?php 
					foreach ( get_terms( array('taxonomy' => 'home_type') ) as $type ) :
						echo '<option value=".' . $type->slug . '">' . $type->name . '</option>';
					endforeach;
					?>
				</select>
			</div>
			<div class="col">
				<label for="priceRange" class="form-label"><?php esc_html_e('Price range:', 'strt'); ?>
					<span class="price-range-output"></span>
				</label>
				<div id="priceRange" class="price-range"></div>

			</div>
		</div>

		<div id="sorts" class="button-group">
			<button class="btn btn-primary btn-sm button is-checked" data-sort-value="original-order">original order</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="name">name</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="category">category</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="building">building</button>
			<button class="btn btn-primary btn-sm button" data-sort-value="type">type</button>
		</div>

		<?php if ( $homes ) : ?>
		<div class="table-responsive">
			<table class="table table-sm caption-top">
				<?php $homes_count = wp_count_posts($post_type = 'homes'); ?>
				<caption class="filter-count"><span></span><?php echo $homes_count->publish; ?></caption>
				<thead class="table-dark">
					<tr class="grid-item">
						<th scope="col" class="name text-nowrap"><?php esc_html_e('Name', 'strt'); ?></th>
						<th scope="col" class="building text-nowrap"><?php esc_html_e('Building', 'strt'); ?></th>
						<th scope="col" class="category text-nowrap"><?php esc_html_e('Category', 'strt'); ?></th>
						<th scope="col" class="type"><?php esc_html_e('Type', 'strt'); ?></th>
						<th scope="col" class="surface text-end"><?php esc_html_e('Surface', 'strt'); ?></tdth>
						<th scope="col" class="price text-end"><?php esc_html_e('Price', 'strt'); ?></th>
					</tr>
				</thead>
				<tbody class="grid">
					<?php 
					foreach ( $homes as $post ) : 
						$building_list = get_the_terms( $post->ID, 'home_building' );
						$building_name = join(', ', wp_list_pluck($building_list, 'name'));
						$building_slug = join(', ', wp_list_pluck($building_list, 'slug'));
						$type_list     = get_the_terms( $post->ID, 'home_type' );
						$type_name     = join(', ', wp_list_pluck($type_list, 'name'));
						$type_slug     = join(', ', wp_list_pluck($type_list, 'slug'));
						$category      = get_post_meta( $post->ID, 'category', true );
						$availability  = get_post_meta( $post->ID, 'availability', true );
						$surface       = get_post_meta( $post->ID, 'surface', true );
						$price         = get_post_meta( $post->ID, 'price', true );
						if ( $availability === 'beschikbaar') :
							$availability_color = 'table-success';
						elseif ( $availability === 'onder optie' || $availability === 'later in verhuur' || $availability === 'verhuurd onder voorbehoud' ) :
							$availability_color = 'table-warning';
						elseif ( $availability === 'verhuurd' ) :
							$availability_color = 'table-danger';
						endif;
					?>
					<tr class="grid-item <?php echo $building_slug . ' ' . $type_slug ?>">
						<th class="name text-nowrap" scope="row"><a href="<?php the_permalink($post->ID) ?>"><?php echo get_the_title($post->ID) ?></a></th>
						<td class="building text-nowrap"><?php echo $building_name ?></td>
						<td class="category text-nowrap"><?php echo $category ?></td>
						<td class="type"><?php echo $type_name ?></td>
						<td class="surface text-end"><?php echo ($surface ? $surface . 'm<sup>2</sup>' : ''); ?></td>
						<td class="price text-end <?php echo $availability_color ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $availability ?>"><?php echo ($price ? $price . ',-' : ''); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<?php endif; ?>

	</main><!-- #content -->
</div><!-- .site -->

<?php
get_footer();
