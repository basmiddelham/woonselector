<?php
/**
 * Template Name: Woning selector Cards
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strt
 */


get_header();

// Get the posts:
$args = array(
	'numberposts' => -1,
	'post_type'   => 'homes',
	'orderby'     => 'name',
	'order'       => 'ASC'
);
$homes = get_posts( $args );

?>


<div class="site">
	<main class="site-main container" id="content">
		<?php get_template_part('template-parts/woningselector-filters') ?>
		<?php get_template_part('template-parts/woningselector-sorts') ?>
		<a id="viewswitch" href="#">Switch View</a>

		<?php if ( $homes ) : ?>
			<?php $homes_count = wp_count_posts($post_type = 'homes'); ?>
			<caption class="filter-count"><span></span><?php echo ' ' . __('of', 'strt') . ' ' . $homes_count->publish . ' ' . __('Homes', 'strt'); ?></caption>
			<ul>
				<li scope="col" class="name"><?php esc_html_e('Name', 'strt'); ?></li>
				<li scope="col" class="building"><?php esc_html_e('Building', 'strt'); ?></li>
				<li scope="col" class="category"><?php esc_html_e('Category', 'strt'); ?></li>
				<li scope="col" class="type"><?php esc_html_e('Type', 'strt'); ?></li>
				<li scope="col" class="surface"><?php esc_html_e('Surface', 'strt'); ?></li>
				<li scope="col" class="price"><?php esc_html_e('Price', 'strt'); ?></li>
			</ul>
			<div class="grid">
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
					$category      = get_post_meta( $post->ID, 'category', true );
					if ( $availability === 'beschikbaar') :
						$availability_color = 'table-success';
					elseif ( $availability === 'onder optie' || $availability === 'later in verhuur' || $availability === 'verhuurd onder voorbehoud' ) :
						$availability_color = 'table-warning';
					elseif ( $availability === 'verhuurd' ) :
						$availability_color = 'table-danger';
					endif;
				?>
				<ul class="grid-item <?php echo $building_slug . ' ' . $type_slug . ' '.  str_replace(' ', '_', $availability) . ' ' . str_replace(' ', '_', $category) ?>"
					data-surface="<?php echo $surface; ?>"
					data-price="<?php echo $price; ?>"
				>
					<li class="name" scope="row"><a href="<?php the_permalink($post->ID) ?>"><?php echo get_the_title($post->ID) ?></a></li>
					<li class="building"><?php echo $building_name ?></li>
					<li class="category"><?php echo $category ?></li>
					<li class="type"><?php echo $type_name ?></li>
					<li class="surface"><?php echo ($surface ? $surface . 'm<sup>2</sup>' : ''); ?></li>
					<li class="price <?php echo $availability_color ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $availability ?>"><?php echo ($price ? $price . ',-' : ''); ?></li>
				</ul>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

	</main><!-- #content -->
</div><!-- .site -->

<?php
get_footer();
