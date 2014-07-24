<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package edgeone
 */

get_header(); ?>

<?php require get_template_directory() . "/header_page.php"; ?>


<div class="light">
<section id="primary" class="container">
	<div class="row">
		<aside class="hidden-xs hidden-sm col-md-3">
			<?php get_sidebar(); ?>
		</aside>

		<main id="main" class="col-xs-12 col-md-9" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'edgeone' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php edgeone_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div>
</section><!-- #primary -->
</div>

<?php if( !edgeone_device('mobile') ) {
	echo '<div class="semidark">';
 	get_template_part('partials/section', 'features-4');
 	echo '</div>';
}
?>

<?php get_footer(); ?>
