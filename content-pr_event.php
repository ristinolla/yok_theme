<?php
/**
 * @package edgeone
 */
?>

<?php
  $classes = array(
    'col-xs-12'
  );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
	
	<header class="col-xs-12">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="col-xs-12 col-sm-4">
		<?php pr_event_metalist($post); ?>
		<a class="center-block text-left back-link" href="<?php echo get_home_url() . '/events/';?>"><?php _e('&laquo; Back to Calendar', 'edgeone'); ?></a>
	</div>

	<div class="col-xs-12 col-sm-8">
		<?php edgeone_featured_img(); ?>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'edgeone' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php/*
				// translators: used between list items, there is a space after the comma
				$category_list = get_the_category_list( __( ', ', 'edgeone' ) );

				// translators: used between list items, there is a space after the comma
				$tag_list = get_the_tag_list( '', __( ', ', 'edgeone' ) );

				if ( ! edgeone_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
					} else {
						$meta_text = __( 'Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
					}

				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
					} else {
						$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" rel="bookmark">permalink</a>.', 'edgeone' );
					}

				} // end check for categories on this blog

				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
				);
				*/
			?>

			<?php edit_post_link( __( 'Edit', 'edgeone' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() != '0' ) :
				comments_template();
			endif;		
		?>
	</div>
</article><!-- #post-## -->
