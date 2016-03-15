<?php
get_header();

while (have_posts()) : the_post();

if(is_front_page()) {} else { ?>
    <!-- Start Feature -->
    <div id="feature" class="<?php text_brightness_indicator(); ?> post_feature">

        <!-- Start Container -->
        <div class="container">
            <div class="row">
                <!--<div class="col-xs-12 col-md-12 col-lg-9 col-sm-12">
                    <h1 class="page_title"><?php the_title(); ?></h1>
                </div>-->
                <div class="post_breadcrumbs">
                    <?php tt_breadcrumbs(); ?>
                </div>
            </div>
        </div>
        <!-- End Container -->


    </div>
    <!-- End Feature -->
<?php } ?>
    <!-- Start Content -->
    <section id="content" class="<?php text_brightness_indicator('content'); ?>">
        <!-- Start Container -->
        <div class="container post_container">
            <div class="row">

                <div class="col-xs-12 col-md-9 col-lg-9 col-sm-8 <?php echo $layout_class; ?>">
                    <div id="primary" class="content left_content post_content">
                    	<h1 class="page_title post_title"><?php the_title(); ?></h1>
                        <article itemscope="" itemtype="http://schema.org/BlogPosting" class="entry employee_entry <?php echo format_class(get_the_ID()); ?> blog_medium medium_top_image clearfix">
                            <div class="entry_content employee_content">
                            	<div class="featured_image alignleft employee">
                            		<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail(array(200,230));
							echo '<div class="thumbnail_caption employee_info">'; ?>
							<p><?php the_title(); ?><br />
							<?php the_field('title'); ?><br />
							<?php if(get_field('email')) { ?>
								<a href="mailto:<?php the_field('email'); ?>"><?php the_field('email'); ?></a><br />
							<?php } ?>
							<?php if(get_field('phone')) {
								$number = get_field('phone');
								$my_number = str_split($number);
								for ($i=0; $i <= strlen($number); $i++) {
									if ($i == 3 || $i == 6) {
										echo '-' . $my_number[$i];
									}
									else {
										echo $my_number[$i];
									}
								}
								echo "<br />";
							} ?>
							<?php if(get_field('twitter')) {
								$handle = get_field('twitter');
								echo '<a href="http://twitter.com/' . $handle . '">@' . $handle . '</a></p>';
							} ?>
              <?php echo "hello!!!!";
              $myTerms = get_the_terms(the_ID(), 'program');
              foreach ($myTerms as $term) :
                echo $term->slug;
              endforeach;
              ?>
						</div>
					<?php } ?>
				</div>
                                <?php the_content();
                                    // WP pages
                                    wp_link_pages(array(
                                        'before' => '<div class="page-link"><span>' . __('Pages:', 'themeton') . '</span>',
                                        'after' => '</div>',
                                        'link_before' => '<span>',
                                        'link_after' => '</span>'
                                    ));
                                ?>
                            </div>
                        </article>
                    </div><!-- end #primary -->
                </div><!-- end grid -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>

    <?php
dynamic_sidebar( 'Global Landscapes Initiative' );
endwhile; // end of the loop.
get_footer();
?>
