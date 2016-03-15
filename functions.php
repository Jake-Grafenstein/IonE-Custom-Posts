<?php
/*
*	Theme: IonE Mana Child
*	Title: Theme Functions
*	Original Author: Jake Grafenstein
*	Author URI: http://github.com/Jake-Grafenstein
*/

require 'ione_shortcodes.php';
require 'custom-post-factory.php';
add_post_type('staff', 'staff', 'dashicons-groups');
add_post_type('fellow', 'fellows', 'dashicons-businessman');
add_taxonomy('program', 'staff');
add_taxonomy('type', 'fellow');
add_theme_support( 'post-thumbnails' );
add_image_size( 'blog-image', 570, 9999, false );

// Adds a new image size to default options
add_action('after_setup_theme', 'image_setup');
function image_setup() {
	add_image_size( 'blog-full-width-image', 570, 9999, false );
}

// Adds the new image size to the array of selectable sizes
add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
        'blog-full-width-image' => 'Blog Full Width Image'
    );
    return array_merge( $sizes, $custom_sizes );
}

// Registers a secondary menu to be used within the menu interface
function register_menu() {
	register_nav_menu('secondary-menu', __('Secondary Menu'));
}
add_action('init', 'register_menu');

// Changes the admin menu to display "Grants" instead of "Portfolio"
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[29][0] = 'Grants';
    $submenu['edit.php?post_type=portfolio'][5][0] = 'Grants';
    $submenu['edit.php?post_type=portfolio'][10][0] = 'Add Grants';
    $submenu['edit.php?post_type=portfolio'][15][0] = 'Grant Type'; // Change name for categories
    echo '';
}

// Changes internal buttons and text to reflect "grants" instead of "portfolio"
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['portfolio']->labels;
        $labels->name = 'Grants';
        $labels->singular_name = 'Grant';
        $labels->add_new = 'Add Grant';
        $labels->add_new_item = 'Add new Grant';
        $labels->edit_item = 'Edit Grants';
        $labels->new_item = 'Grant';
        $labels->view_item = 'View Grant';
        $labels->search_items = 'Search Grants';
        $labels->not_found = 'No Grants found';
        $labels->not_found_in_trash = 'No Grants found in Trash';
}
add_action( 'init', 'change_post_object_label', 999 );
add_action( 'admin_menu', 'change_post_menu_label' );

// Changes the menu icon of the grants section to be a folder
function replace_admin_menu_icons_css() {
    ?>
    <style>
        #adminmenu > #menu-posts-portfolio > .menu-icon-portfolio > .wp-menu-image:before {
    		content: "\f322" !important;
	}
    </style>
    <?php
}
add_action( 'admin_head', 'replace_admin_menu_icons_css' );

// A function for displaying the author information in a post
function sidebar_author_info() { ?>
	<div class="item-author clearfix">
        	<?php
            	$author_email = get_the_author_meta('email');
		$author_description = get_the_author_meta('description');
            	echo get_avatar($author_email, $size = '110');
            	?><br />
        <h3><?php if (is_author()) the_author(); else the_author_posts_link(); ?></h3>
	<p><?php echo $author_description; ?></p>
	<p><a href="mailto:<?php echo $author_email; ?>"><?php echo $author_email; ?></a></p>
        <?php
}
?>
