<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strt
 */

 // Home Attributes
$post_classes = array(
	'col-sm-6',
	'col-lg-4',
	'mb-4',
	'element-item'
);
if (get_field('phase')) {
	$phase = get_field('phase');
	array_push($home_atts, $phase);
}
if (get_field('aantal_kamers')) {
	$aantal_kamers = 'kamers-' . get_field('aantal_kamers');
	array_push($home_atts, $aantal_kamers);
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<div class="card h-100 w-100">
		<?php 
			// var_dump($$post_classes);
			// echo implode(' ', $home_atts);
		?>
		<header class="card-header">
			<?php the_title( '<h2 class="card-title mb-0">', '</h2>' ); ?>
		</header><!-- .entry-header -->
		<div class="card-body">
			<?php
			echo 'Huurcategorie: ' . get_field('huurcategorie') . '<br>';
			$building_term_list = get_the_terms( $post->ID, 'home_building' );
			$building_term_string = join(', ', wp_list_pluck($building_term_list, 'name'));
			echo 'Gebouw: ' . $building_term_string . '<br>';
			echo 'Verdieping: ' . get_field('verdieping') . '<br>';
			$type_term_list = get_the_terms( $post->ID, 'home_type' );
			$type_term_string = join(', ', wp_list_pluck($type_term_list, 'name'));
			echo 'Type: ' . $type_term_string . '<br>';
			echo 'Beschikbaarheid: ' . get_field('beschikbaarheid') . '<br>';
			echo 'Huurprijs: ' . get_field('huurprijs') . '<br>';
			echo 'Oppervlakte: ' . get_field('oppervlakte') . '<br>';
			echo 'Aantal kamers: ' . get_field('aantal_kamers') . '<br>';
			echo 'Aantal slaapkamers: ' . get_field('slaapkamers') . '<br>';
			echo 'Buitenruimte Type: ' . get_field('buitenruimte_type') . '<br>';
			echo 'Buitenruimte Oppervlakte: ' . get_field('buitenruimte_oppervlakte') . '<br>';
			echo 'Buitenruimte Ligging: ' . get_field('buitenruimte_ligging') . '<br>';
			echo 'Parkeerplaatsen: ' . get_field('parkeer_plaatsen') . '<br>';
			?>
		</div>
		<footer class="card-footer">
			<a href="<?php the_permalink() ?>" class="btn btn-primary d-block">View</a>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
