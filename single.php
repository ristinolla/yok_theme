<?php
/**
 * The Template for displaying all single posts.
 *
 * @package edgeone
 */

get_header(); ?>
<div class="light">	
	<div class="container">
		<div class="row">
			<aside class="col-xs-12 col-sm-3">
				<h1 class="sidebar-title"><a href="/news/"><?php echo __('News', 'edgeone'); ?></a></h1>
				<aside class="hidden-xs">
					<?php get_sidebar(); ?>
				</aside>
			</aside>
			<main class="col-xs-12 col-sm-9">

				<?php 
				while ( have_posts() ) : the_post();

					get_template_part( 'content', 'single' );

					edgeone_post_nav();


				

				endwhile; // end of the loop. 
				?>
			</main>

		</div>
	</div>
</div>
<?php  //get_sidebar(); ?>

<?php if( !edgeone_device('mobile') ) {
  echo "<div class='semidark'>";
  get_template_part('partials/section', 'features-4');
  echo "</div>";
}
?>
</div>
<?php get_footer(); ?>