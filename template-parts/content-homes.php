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
			<p class="card-text">Description?</p>
			<?php
			$term_obj_list = get_the_terms( $post->ID, 'home_status' );
			$terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
			echo 'Status: ' . $terms_string . '<br>';
			echo 'Oppervlakte: ' . get_field('oppervlakte') . '<br>';
			echo 'Aantal kamers: ' . get_field('aantal_kamers') . '<br>';
			echo 'Aantal slaapkamers: ' . get_field('slaapkamers') . '<br>';
			echo 'Woningtype: ' . get_field('woning_type') . '<br>';
			echo 'Huurtype: ' . get_field('phase') . '<br>';
			?>
		</div>
		<footer class="card-footer">
			<a href="<?php the_permalink() ?>" class="btn btn-primary d-block">View</a>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
