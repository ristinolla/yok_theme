<?php
/**
 * Template Name: Etusivu
 *The normal page template
 *
 * @package edgeone
 */

get_header(); ?>

<?php require get_template_directory() . "/header_page.php"; ?>


<div class="light">
	<div class="container">
		<div class="row">
			<section class="col-xs-12 col-md-8">
				<h2 class="section-title"><?php echo __('Incoming events', 'edgeone'); ?></h2>
				<div class="row event-list">
					<?php pr_event_list(array('length' => 4, 'item_class' => "col-xs-12 col-md-6 event-item", 'item_class_one' => 'col-xs-12 event-item event-only-one')); ?>
				</div>
				<div class="row text-center">
					<a class="" href="<?php echo get_home_url(); ?>/tapahtumat/"><?php echo __('More events &raquo;', 'edgeone'); ?></a>
				</div>
			</section>

			<section class="col-xs-12 col-md-4 news-section">
				<h2 class="section-title"><?php echo __('News', 'edgeone'); ?></h2>
				<?php pr_short_list_posts(array('before_list' => '<ul class="list-unstyled">', 'after_list' => '</ul>', 'length' => 5	)); ?>
				<a class="center-block text-center" href="<?php echo get_home_url(); ?>/uutiset/"><?php echo __('More news &raquo;','edgeone'); ?></a>
			</section>
		</div>
	</div>
</div>
<div class="semidark">
	<?php get_template_part('partials/section', 'features-4'); ?>
</div>
<div class="light">
	<div class="container hidden-xs hidden-sm">
		<div class="row">
			<section class="col-xs-6">
				<?php dynamic_sidebar ('index_1'); ?>
			</section>

			<section class="col-xs-6">
				<?php //dynamic_sidebar ('index_2'); ?>
				<h3 class="element-title"><?php _e('Yokamerat on facebook', 'edgeone');?></h3>
				<div class="fb-like-box" data-href="http://www.facebook.com/yokamerat" data-width="600px" data-height="580px" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="true" data-show-border="false"></div>
			</section>
		</div>

	</div>
</div>
<div class="semidark">
	<div class="container">
		<div class="row">
			<aside class="col-xs-12">
				<h3 class="section-title">Yhteistyössä</h3>
				<ul class="list-inline" id="collaboration-list">
					<?php get_template_part('partials/section', 'collaboration'); ?>
				</ul>
			</aside>
		</div>
	</div>
</div>

<?php get_footer(); ?>
