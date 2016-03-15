<?php
/*
*	Theme: IonE Mana Child
*	Title: Taxonomy Program
*	Template: archive.php
*	Original Author: Jake Grafenstein
* Author URI: https://github.com/Jake-Grafenstein
*	Description: Built off the template for archive pages, this template
*				 displays all the staff members in a given program.
* 	@package WordPress
* 	@subpackage Twenty_Thirteen
* 	@since Twenty Thirteen 1.0
*/
get_header();
global $smof_data, $layout_sidebar;

$prefix = 'archive';
if (is_category())
    $prefix = 'category';
elseif (is_tag())
    $prefix = 'tag';
elseif(is_author())
    $prefix = 'author';

$layout_container = 'col-xs-12 col-md-9 col-lg-9 col-sm-8';

$layout_sidebar = 'full';
$layout_container .= 'col-xs-12 col-md-12 col-lg-12 col-sm-12';
if ($smof_data[$prefix.'_sidebar_type'] == 'right') {
    $layout_sidebar = 'right';
    $layout_container .= 'pull-left';
} elseif ($smof_data[$prefix.'_sidebar_type'] == 'full') {
    $layout_sidebar = 'full';
    $layout_container = 'col-xs-12 col-md-12 col-lg-12 col-sm-12';
}

$open_grid_container = $open_grid_pager = '';
$loop_layout = (isset($smof_data[$prefix.'_layout']) && $smof_data[$prefix.'_layout'] != '') ? $smof_data[$prefix.'_layout'] : 'regular';
if (strpos($loop_layout,'grid') !== false) {
    $open_grid_container = '<div class="grid_entry"><div class="row">';
    $open_grid_pager = '<div class="grid_pager">';
}
if (strpos($loop_layout,'masonry') !== false) {
    $open_grid_container = '<div class="grid_entry masonry"><div class="row">';
    $open_grid_pager = '<div class="grid_pager">';
}

$close_grid_container = $close_grid_pager = '';
if (strpos($loop_layout,'grid') !== false || strpos($loop_layout,'masonry') !== false) {
    $close_grid_container = '</div></div><!-- end grid_entry -->';
    $close_grid_pager = '</div><!-- .grid_pager -->';
}
?>

<!-- Start Content -->
<section id="content" class="<?php text_brightness_indicator('content'); ?>">
    <!-- Start Container -->
    <div class="container">
        <div class="row">
            <div class="<?php echo $layout_container; ?>">
                <div id="primary" class="content">
					<?php if ( have_posts() ) : ?>
						<header class="archive-header">
							<h1 class="archive-title"><?php

              // Sets the slug for a given taxonomy
								if ( is_tax('program', 'leadership')) :
									printf( __( 'Institute Leadership', 'themeton'));
									$slug = 'leadership';
								elseif ( is_tax('program', 'acara')) :
									printf( __( 'Acara Staff', 'themeton'));
									$slug = 'acara';
								elseif ( is_tax('program', 'boreas')) :
									printf( __( 'Boreas Staff', 'themeton'));
									$slug = 'boreas';
								elseif ( is_tax('program', 'gli')) :
									printf( __( 'Global Landscapes Initiative Staff', 'themeton'));
									$slug = 'gli';
								elseif ( is_tax('program', 'gwi')) :
									printf( __( 'Global Water Initiative', 'themeton'));
									$slug = 'gwi';
								elseif ( is_tax('program', 'natcap')) :
									printf( __( 'Natural Capital Project Staff', 'themeton'));
									$slug = 'natcap';
								elseif ( is_tax('program', 'nise')) :
									printf( __( 'NorthStar Initiative for Sustainable Enterprise Staff', 'themeton'));
									$slug = 'nise';
								elseif ( is_tax('program', 'susteducation')) :
									printf( __( 'Sustainability Education Staff', 'themeton'));
									$slug = 'susteducation';
								else :
									_e( 'Archives', 'themeton' );
								endif;

							?></h1>
						</header><!-- .archive-header -->
						<?php
              // Argument array for query
							$args = array(
								'program'=>$slug,
								'post_type'=>'staff',
								'posts_per_page'=> -1,
								'post_status'=>'publish',
								'orderby' => 'order',
								'order' => 'ASC',
							);
							$my_query = get_posts($args);
						?>
            <!-- Create staff list -->
						<ul class="people-list">
							<?php foreach ($my_query as $post):
								setup_postdata($post) ?>
								<li class="individual-posts">
									<?php get_template_part( 'content-staff-single-archive', get_post_format() ); //calls content-staff-single-archive.php ?>
								</li>
								<?php wp_reset_postdata(); ?>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div><!-- #primary -->
			</div>
		</div>
	</div>
</section>

<?php
    if ($layout_sidebar == 'right') {
        get_sidebar();
    } elseif ($layout_sidebar == 'left') {
        get_sidebar('left');
    }
?>
<?php get_footer(); ?>
