<?php
/**
 * The Template for displaying all single posts.
 *
 * @package edgeone
 */

get_header(); ?>

<?php get_template_part( 'templates/header', 'page' ); ?>


<div class="light">
	<div class="container">
		<main class="row" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php	get_template_part( 'templates/content', 'pr_event' ); ?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php  //get_sidebar(); ?>

<?php if( !edgeone_device('mobile') ) {
?>
	<div class="semidark">
	  	<div class="container">
			<section role="main" class="row">
				<div class="col-xs-12">
					<h2 class="section-title"><?php echo __('Next events', 'edgeone'); ?></h2>
				</div>
				<?php
				$args = array(
						'length' => 4,
						'item_class' => "col-xs-6 col-md-3 event-item",
						'past' => false,
						'paged' => true,
						'posts_per_page' => 40,
				);
				pr_event_list($args);
				?>
			</section>
		</div>
	</div>
  <?php
}
?>
</div>
<?php get_footer(); ?>
