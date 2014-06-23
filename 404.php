<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package edgeone
 */

get_header(); ?>
<div class="semidark">
	<div class="container">
		<main class="row" role="main">

			<section class="col-xs-12 error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'edgeone' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'edgeone' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<div class="light">
	<?php get_template_part('partials/section', 'features-4'); ?>
</div>

<?php get_footer(); ?>