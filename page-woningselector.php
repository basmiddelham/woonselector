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
		<a class="btn btn-sm btn-secondary" id="viewswitch" href="#">Switch View</a>
		<?php get_template_part('template-parts/woningselector-filters') ?>
		<?php get_template_part('template-parts/woningselector-sorts') ?>

		<?php if ( $homes ) : ?>
			<?php $homes_count = wp_count_posts($post_type = 'homes'); ?>
			<div class="hs_filtercount"><span></span><?php echo ' ' . __('of', 'strt') . ' ' . $homes_count->publish . ' ' . __('Homes', 'strt'); ?></div>
			<div class="hs hs_cards">
				<ul class="hs_heading">
					<li class="name"><?php esc_html_e('Name', 'strt'); ?></li>
					<li class="building"><?php esc_html_e('Building', 'strt'); ?></li>
					<li class="category"><?php esc_html_e('Category', 'strt'); ?></li>
					<li class="type"><?php esc_html_e('Type', 'strt'); ?></li>
					<li class="surface"><?php esc_html_e('Surface', 'strt'); ?></li>
					<li class="price"><?php esc_html_e('Price', 'strt'); ?></li>
				</ul>
				<ul class="grid row">
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
							$availability_color = 'bg-success';
						elseif ( $availability === 'onder optie' || $availability === 'later in verhuur' || $availability === 'verhuurd onder voorbehoud' ) :
							$availability_color = 'bg-warning';
						elseif ( $availability === 'verhuurd' ) :
							$availability_color = 'bg-danger';
						endif;
					?>
					<li class="grid-item hs_card col-12 col-md-6 col-lg-4 col-xxl-3 <?php echo $building_slug . ' ' . $type_slug . ' '.  str_replace(' ', '_', $availability) . ' ' . str_replace(' ', '_', $category) ?>"
						data-surface="<?php echo $surface; ?>"
						data-price="<?php echo $price; ?>"
					>
						<ul class="hs_card_content">
							<li class="name"><a href="<?php the_permalink($post->ID) ?>"><?php echo get_the_title($post->ID) ?></a></li>
							<li class="building">
								<span class="hs_card_data"><?php _e('Building', 'strt') ?>: </span>
								<span class="hs_card_value"><?php echo $building_name ?></span>
							</li>
							<li class="category">
								<span class="hs_card_data"><?php _e('Category', 'strt') ?>: </span>
								<span class="hs_card_value"><?php echo $category ?></span>
							</li>
							<li class="type">
								<span class="hs_card_data"><?php _e('Type', 'strt') ?>: </span>
								<span class="hs_card_value"><?php echo $type_name ?></span>
							</li>
							<li class="surface">
								<span class="hs_card_data"><?php _e('Surface', 'strt') ?>: </span>
								<span class="hs_card_value"><?php echo ($surface ? $surface . 'm<sup>2</sup>' : ''); ?></span>
							</li>
							<li class="price <?php echo $availability_color ?>" data-price="<?php echo $price; ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $availability ?>">
								<span class="hs_card_value"><?php echo ($price ? $price . ',-' : ''); ?></span>
							</li>
						</ul>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

	</main><!-- #content -->
</div><!-- .site -->

<?php
get_footer();
