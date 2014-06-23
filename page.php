<?php
/**
 * The normal page template
 *
 * @package edgeone
 */

get_header(); ?>
<div class="light">
<div class="container">
	<div class="row">
	<?php 
	if (have_posts()):
		while (have_posts()) : the_post(); ?>
			<aside class="col-xs-12 col-sm-4 col-md-3 hidden-xs sidebar">
				<?php top_parent_sidenav($post); ?>
				<?php dynamic_sidebar ('Page Widgets'); ?>
			</aside>
			
			<main  role="main" class="col-xs-12 col-sm-8 col-md-9 page-content">

				<?php get_template_part( 'content', 'page' ); ?>
				
				<?php
				/*
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				*/
				?>
			</main>
		<?php endwhile;
	else:
		?>
		<div class="col-xs-12">
			<?php edgeone_no_content(); ?>
		</div>
	<?php
	endif;
	?>
	</div>
</div>
</div>


<?php get_footer(); ?>