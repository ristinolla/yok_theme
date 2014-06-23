<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package edgeone
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php edgeone_featured_img(); ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'edgeone' ),
				'after'  => '</div>',
			) );
		?>
	</div>
	<?php 
		if(is_user_logged_in() ) {
			edit_post_link( __( 'Edit post', 'edgeone' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); 
		}
	?>
</article>
