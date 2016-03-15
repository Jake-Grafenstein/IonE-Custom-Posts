<?php
/*
*	Theme: IonE Mana Child
*	Title: Staff Archive
*	Template: archive.php
*	Original Author: Jake Grafenstein
*	Author URI: https://github.com/Jake-Grafenstein
*	Description: Template for displaying the archive page for staff members.
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
$layout_container = 'col-xs-12 col-md-12 col-lg-12 col-sm-12';
if ($smof_data[$prefix.'_sidebar_type'] == 'left') {
    $layout_sidebar = 'left';
    $layout_container .= ' pull-right';
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
<!-- Start Feature -->
<div id="feature" class="<?php text_brightness_indicator('title'); ?>">

    <!-- Start Container -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-9 col-sm-12">
                <?php
                    if (is_author()) {
                        echo '<div class="item-author clearfix">';
                        $author_email = get_the_author_meta('email');
                        echo get_avatar($author_email, $size = '60');
                        if(have_posts()) {
                            the_post();
                            echo '<h3>'.__("Written by ", "themeton") . get_the_author().'</h3>';

                            rewind_posts();
                        }

                        $description = get_the_author_meta('description');
                        if ($description != '') {
                            echo '<div class="author-title-line"></div><p>';
                            echo $description;
                        } else {
                            _e('The author didnt add any Information to his profile yet', 'themeton');
                        }
                        echo '</p></div>';
                    } else {
                ?>
                <h1 class="page_title">
                    <?php
                    if (is_category()) {
                        printf(__('Category : %s', 'themeton'), single_cat_title('', false));
                    } elseif (is_tag()) {
                        printf(__('Tag Archives: %s', 'themeton'), single_tag_title('', false));
                    } elseif (is_archive()) {
                        if (is_day()) :
                            printf(__('Daily Archives: %s', 'themeton'), get_the_date());
                        elseif (is_month()) :
                            printf(__('Monthly Archives: %s', 'themeton'), get_the_date(_x('F Y', 'monthly archives date format', 'themeton')));
                        elseif (is_year()) :
                            printf(__('Yearly Archives: %s', 'themeton'), get_the_date(_x('Y', 'yearly archives date format', 'themeton')));
                        elseif (is_post_type_archive( 'staff' )) :
                        	printf(__('IonE Staff', 'themeton'));
                        else :
                            _e('Archive', 'themeton');
                        endif;
                    }
                    ?>
                </h1>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-3 col-sm-12">
                <?php tt_breadcrumbs(); ?>
            </div>
        </div><!-- end row -->
    </div><!-- End Container -->

</div><!-- End Feature -->

<!-- Start Content -->
<section id="content" class="<?php text_brightness_indicator('content'); ?>">
    <!-- Start Container -->
    <div class="container">
        <div class="row">
            <div class="<?php echo $layout_container; ?>">
                <div id="primary" class="content">
                	<?php // Loops through one array of slugs, populates page?>
					<?php
						// Slug Names
						$group_slugs = array(
							"'leadership'",
							"'acara'",
							"'boreas'",
							"'etl'",
							"'ensia'",
							"'gli'",
							"'gwi'",
							"'natcap'",
							"'nise'",
							"'susteducation'",
							"'administration'",
							"'communications'",
						);
						// Program full names
						$groups = array(
							"Institute Leadership",
							"Acara Social Entrepreneurship",
							"Boreas Leadership Program",
							"Energy Transition Lab",
							"Ensia",
							"Global Landscapes Initiative",
							"Global Water Initiative",
							"Natural Capital Project",
							"NorthStar Initiative for Sustainable Enterprise",
							"Sustainability Education",
							"Administration",
							"Communications",
						);
					?>
 					<?php
 						foreach ($group_slugs as $slug): 				//loop through slugs
 							$group_name = array_shift($groups);			//Pop off first value in $groups array
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
							<h2 id="<?php echo $slug; ?>"><?php echo $group_name; ?></h2>
							<ul class="people-list">
							<?php foreach ($my_query as $post):
								setup_postdata($post) ?>
								<li class="individual-posts">
									<?php get_template_part( 'content-staff-single-archive', get_post_format() ); //calls content-staff-single-archive.php
									?>
								</li>
								<?php wp_reset_postdata(); ?>
							<?php endforeach; ?>
							</ul>
						<?php endforeach; ?>
                </div><!-- end #primary -->
            </div><!-- end grid -->

        </div><!-- end row -->
    </div><!-- end container -->
</section>
<?php get_footer(); ?>
