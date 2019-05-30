<?php

/**
 * Plugin Name: Movable Stack Cards Larbizard
 * Plugin URI:  https://larbizard.com/movable-stack-cards-larbizard
 * Description: WordPress Plugin display the last posts in a Movable stack cards style like in CSS-Tricks
 * Version:     1.0.0
 * Author:      Gharib Larbi
 * Author URI:  https://larbizard.com
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: movable-stack-cards-larbizard
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

wp_register_style( 'movable-cards-namespace', '/wp-content/plugins/movable-stack-cards-larbizard/css/style.css' );


function make_movable_stack_cards_posts(){

	wp_enqueue_style('movable-cards-namespace');
	
	$args = array(
		'numberposts' => 8,
		'offset' => 0,
		'category' => 0,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' =>'',
		'post_type' => 'post',
		'post_status' => 'publish',
		'suppress_filters' => true
	);
	$recent_posts = wp_get_recent_posts($args);

	$posts_cards = '<div class="cards">';

	foreach( $recent_posts as $recent ){
		$posts_cards = $posts_cards . '<div class="card"><h4> <a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a></h4></div>';
	}

	$posts_cards = $posts_cards . '</div>';

	wp_reset_query();

	return $posts_cards;

}

add_shortcode( 'last_posts_movable_stack_cards', 'make_movable_stack_cards_posts' );

?>