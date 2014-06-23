<?php
/**
 * @package edgeone
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-meta">
			<?php edgeone_posted_on(); ?>
		</div><!-- .entry-meta -->
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : ?>

		<?php endif; ?>
	</header><!-- .entry-header -->
	
	<?php edgeone_featured_img(); ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( '<span class="meta-nav">&raquo;</span> Read more', 'edgeone' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'edgeone' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-## -->
