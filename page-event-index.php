<?php
/**
 * Template name: pr_event_index
 *
 *
 *
 * @package edgeone
 */

get_header(); ?>

<?php get_template_part( 'templates/header', 'page' ); ?>

<div class="light">
	<div class="container">
		<div class="row">
			<h1 class="col-xs-12"><?php echo __('Events Calendar', 'edgeone'); ?></h1>
			<main role="main" class="col-xs-12 ">
				<?php
				$args = array(
						'length' => -1,
						'item_class' => "col-xs-4 event-item",
						'past' => false,
						'paged' => true,
						'posts_per_page' => 40,
				);
				pr_event_list($args);
				?>

			</main>
		</div>
		<?php edgeone_paging_nav(); ?>
		<div class="row">
			<div class="col-xs-12 text-left">
				<a class="" href="<?php echo get_home_url(); ?>/events/"><?php echo __('&laquo; Past events', 'edgeone'); ?></a>
			</div>
		</div>
	</div>
</div>

<?php if( !edgeone_device('mobile') ) {
	echo '<div class="semidark">';
 	get_template_part('templates/section', 'features-4');
 	echo '</div>';
}
?>



<?php get_footer(); ?>
