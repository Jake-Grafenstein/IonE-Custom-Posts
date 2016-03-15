<?php
function add_staff( $program ) {
	$args = array(
		'program'=>$program,
		'post_type'=>'staff',
		'posts_per_page'=> -1,
		'post_status'=>'publish',
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_key' => 'order',
	);
	$my_query = new WP_Query($args);
	if ($my_query) {
		$output = '<ul class="people-list program-list">';
		while ($my_query->have_posts()) {
			$my_query->the_post();
      $thumbnail =  get_the_post_thumbnail($page->ID, array(200,230));
      $permalink = get_the_permalink();
      $title = get_the_title($page->ID);
      $email = get_field('email', $page->ID);
      $number = get_field('phone', $page->ID);
      $twitter = get_field('twitter', $page->ID);
			$output .= '<li class="individual-posts">';
			if ($thumbnail) {
				$output .= '<div class="entry-thumbnail"><a href="' . $permalink . '" rel="bookmark">' . $thumbnail . '</a></div>';
			}
			$output .= '<div class="entry-content-archive"><div class="employee_info"><a href="' . $permalink . '" rel="bookmark">' . $title . '</a><br />';
			$output .= $title . '<br />';
		  	if ($email) {
 				$output .= '<a href="mailto:' . $email . '">' . $email . '</a><br />';
			}
			if ($number) {
  				$my_number = str_split($number);
  				for ($i=0; $i <= strlen($number); $i++) {
  					if ($i == 3 || $i == 6) {
  						$output .= '-' . $my_number[$i];
   					}
  					else {
  						$output .= $my_number[$i];
  					}
   				}
			  	$output .= '<br />';
   			}
   		    if($twitter) {
  				$output .= '<a href="http://twitter.com/' . $twitter . '">@' . $twitter . '</a>';
  			}
			$output .= '</div></div></li>';
		}
		$output .= '</ul>';
	} else {
	  // no posts found
	}
  	wp_reset_postdata();
	return $output;
}

function add_fellow( $fellow_type ) {
  $args = array(
		'type'=>$fellow_type,
		'post_type'=>'fellow',
		'posts_per_page'=> -1,
		'post_status'=>'publish',
		'orderby' => 'title',
		'order' => 'ASC',
	);
  $my_query = new WP_Query($args);
	if ($my_query) :
    $output = '<p>This is my fellow_type: ' . $fellow_type[type] . '</p>' . '<ul class="people-list">';
    while ($my_query->have_posts()) :
      $my_query->the_post();
      $thumbnail = get_the_post_thumbnail($page->ID, array(200,230));
      $title = get_the_title($page->ID);
      $bio = get_field('bio', $page->ID);
      $year = get_field('year', $page->ID);
      $dept = get_field('department', $page->ID);
      $college = get_field('college', $page->ID);
      $post_objects = get_field('projects', $page->ID);
      $output .= '<li class="individual-posts">';
			if ($thumbnail) :
        if ($bio) :
				      $output .= '<div class="entry-thumbnail"><a href="' . $bio . '" rel="bookmark">' . $thumbnail . '</a></div>';
              $output .= '<div class="entry-content-archive"><div class="employee_info"><a href="' . $bio . '" rel="bookmark">' . $title . '</a><br />';
        else :
              $output .= '<div class="entry-thumbnail">' . $thumbnail . '</div>';
              $output .= '<div class="entry-content-archive"><div class="employee_info">' . $title . '<br />';
			  endif;
      else :
        if ($bio) :
          $output .= '<div class="entry-content-archive"><div class="employee_info"><a href="' . $bio . '" rel="bookmark">' . $title . '</a><br />';
        else :
          $output .= '<div class="entry-content-archive"><div class="employee_info">' . $title . '<br />';
        endif;
      endif;
      //$output .= get_field('title', $page->ID) . '<br />';
      if ($year) :
          $output .= '<em>' . 'Fellow since ' . $year . '</em>' . '<br />';
      endif;
      $output .= '<strong>' . $dept . '</strong>' . '<br />';
      $output .= $college . '<br />';
      if ($fellow_type[type] == 'project-leads') :
          if (!empty($post_objects)) :
              $output .= '<hr class="project_line">';
              $lastElement = end($post_objects);
          endif;
          if( $post_objects ):
              $output .= 'Related Projects: ';
              foreach( $post_objects as $post): // variable must be called $post (IMPORTANT)
                  setup_postdata($post);
                  $output .= '<a href="' . get_the_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a>';
                  if ($post != $lastElement) :
                    $output .= '| ';
                  endif;
              endforeach;
              wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
          endif;
      endif;
      $output .= '</div></li>';
    endwhile;
    $output .= '</ul>';
  else :
    // No Posts found
  endif;
  wp_reset_postdata();
  return $output;
}
add_shortcode( 'add_staff', 'add_staff' );
add_shortcode( 'add_fellow', 'add_fellow');
