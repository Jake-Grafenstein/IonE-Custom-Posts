<?php
/*
* Theme: IonE Mana Child
*	Title: Content Staff Single Archive
*	Original Author: Jake Grafenstein
*	Author URI: https://github.com/Jake-Grafenstein
*	Description: Template for displaying a staff member profile thumbnail.
*/
?>

<article id="post-<?php the_ID(); ?>" class="people-page">
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail">
		  <a href="<?php the_field('bio'); ?>"><?php the_post_thumbnail( array(200, 230) ); ?></a>
		</div>
		<?php endif; ?>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'themeton' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	<?php endif; ?>
	</header>

	<div class="entry-content-archive">
			<div class="employee_info">
				<?php if(get_field('bio')) : ?>
						<a href="<?php the_field('bio'); ?>"><?php the_title(); ?></a><br />
			  <?php else : the_title();
						echo '<br />';
				endif;
        $year = get_field('year');
        $dept = get_field('department');
        $college = get_field('college');
	  		if ($year) :
          	echo '<em>' . 'Fellow since ' . $year . '</em>';
          	echo '<br />';
	  		endif;
        echo '<strong>' . $dept . '</strong>';
	  		echo '<br />';
        echo $college;
	  		echo '<br />';
	  		$post_objects = get_field('projects');
	  		if (!empty($post_objects)) :
						echo '<hr class="project_line">';
	  				$lastElement = end($post_objects);
	  		endif;
	  		if( $post_objects ):
						echo 'Related Projects: ';
						foreach( $post_objects as $post): // variable must be called $post (IMPORTANT)
        				setup_postdata($post); ?>
            		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php if ($post != $lastElement) :
										echo '| ';
								endif;
   	 				endforeach;
    				wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
	  		endif; ?>
			</div>
	</div>
</article>
