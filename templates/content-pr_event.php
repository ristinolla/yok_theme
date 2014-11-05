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
