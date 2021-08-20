<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strt
 */

 // Home Attributes
// $post_classes = array(
// 	// 'col-sm-6',
// 	// 'col-lg-4',
// 	'mb-4',
// 	'element-item'
// );

$building_term_list = get_the_terms( $post->ID, 'home_building' );
$building_term_string = join(', ', wp_list_pluck($building_term_list, 'name'));
$type_term_list = get_the_terms( $post->ID, 'home_type' );
$type_term_string = join(', ', wp_list_pluck($type_term_list, 'name'));

?>
<tr>
	<th scope="row"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></th>
	<td><?php the_field('huurcategorie') ?></td>
	<td><?php // echo $building_term_string ?></td>
	<td><?php the_field('verdieping') ?></td>
	<td><?php // echo $type_term_string ?></td>
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
