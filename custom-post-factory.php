<?php
/*	Theme Name: IonE Mana Child
*	Title: Custom Post Factory
*	Original Author: Jake Grafenstein
* Author URI: http://github.com/Jake-Grafenstein
*	Description: An interface for the creation of new post types
*/

function add_post_type($name, $plural_name, $dashicon)
{
	add_action('init', function() use($name, $plural_name, $dashicon) {
		$upper_name = str_replace('_', ' ', $name);
		$upper_name = ucwords($upper_name);
		$upper_plural_name = ucwords($plural_name);
		register_post_type( $upper_name, array(
			'public' => true,
			'label' => "$upper_name",
			'menu_icon' => "$dashicon",
			'labels' => array(
					'add_new_item' => "Add New $upper_name",
					'menu_name' => "$upper_plural_name",
					'view_item' => "View $upper_name",
					'edit_item' => "Edit $upper_name",
					'all_items' => "All $upper_plural_name",
					'singular_name' => "$upper_name",
					'not_found' => "No $plural_name found.",
					'not_found_in_trash' => "No $plural_name found in Trash",
					'search_items' =>"Search $plural_name"
	 			),
			'supports' => array('title','editor', 'thumbnail'),
			'has_archive' => true,
			'rewrite' => array('slug' => "$plural_name"),
		));
	});
}

function add_taxonomy($name, $post_type) {
	$name = strtolower($name);
	add_action('init', function() use($name, $post_type) {
		$upper_name = str_replace('_', ' ', $name);
		$plural_name = ucwords($upper_name) . 's';
		$upper_name = ucwords($upper_name);
		register_taxonomy($name, $post_type, array(
			'label' => "$name",
			'labels' => array(
					'name' => "$plural_name",
					'singular_name' => "$name",
					'menu-name' => "$plural_name",
					'all_items' => "All $plural_name",
					'edit_item' => "Edit $upper_name",
					'view_item' => "View $upper_name",
					'update_item' => "Update $upper_name",
					'add_new_item' => "Add New $upper_name",
					'new_item_name' => "New $upper_name Name",
					'search_items' => "Search $plural_name",
					'add_or_remove_items' => "Add or Remove $plural_name",
					'choose_from_most_used' => "Choose from the most used $plural_name",
					'not_found' => "No $plural_name found.",
				),
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_quick_edit' => true,
		));
	});
}

?>
