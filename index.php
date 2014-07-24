<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package edgeone
 */

get_header(); ?>

<?php get_template_part( 'templates/header', 'page' ); ?>


<div class="light">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-3">
				<h1 class="sidebar-title"><a href="/news/"><?php echo __('News', 'edgeone'); ?></a></h1>
				<aside class="hidden-xs">
					<?php get_sidebar(); ?>
				</aside>
			</div>
			<main class="col-xs-12 col-sm-9">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'templates/content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php edgeone_paging_nav(); ?>

			<?php else : ?>

				<?php get_template_part( 'templates/content', 'none' ); ?>

			<?php endif; ?>

			</main><!-- #main -->
		</div>
	</div><!-- #primary -->
</div>
<?php if( !edgeone_device('mobile') ) {
	echo '<div class="semidark">';
 	get_template_part('templates/section', 'features-4');
 	echo '</div>';
}
?>


<?php get_footer(); ?>
