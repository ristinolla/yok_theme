<?php
/**
 * The template part for displaying features element
 *
 * 
 *
 * @package edgeone
 */
?>

<div class="container">
	<section class="row">
		<?php 
		$args = array(
			'before_item' => '<article class="col-xs-12 col-sm-6 col-md-3 featured-item">',
			'after_item' => '</article>',
			'location' => 'etusivu',
			'type' => 'cards'
		);

		pr_features_show($args);


		?>
	</section>
</div>