<?php
/*
* 	Theme: IonE Mana Child
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
		  <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( array(200, 230) ); ?></a>
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
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a><br />
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
					echo "<br />";
					} ?>
				<?php } ?>
				<?php if(get_field('twitter')) {
					$handle = get_field('twitter');
					echo '<a href="http://twitter.com/' . $handle . '">@' . $handle . '</a>';
				} ?>
			</div>
	</div>
</article>
