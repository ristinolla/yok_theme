<?php
/**
 * The template for displaying Events Archives pages.
 *
 *
 *
 * @package edgeone
 */

get_header(); ?>

<?php require get_template_directory() . "/header_page.php"; ?>

<div class="light">
	<div class="container">
		<div class="row">
			<main role="main" class="col-xs-12 ">
				<h1 class="page-title"><?php echo __('Events Archive', 'edgeone'); ?></h1>
				<?php

				if(have_posts()) :
					while(have_posts()) : the_post();

						$startdate = get_post_meta(get_the_ID(), 'pr_event_startdate', true);
						$enddate = get_post_meta(get_the_ID(), 'pr_event_startdate', true);
						$today3am = strtotime('today 3:00') + ( get_option( 'gmt_offset' ) * 3600 );
						//if($enddate < $today3am){
						?>
							<h3 class="list-block"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<span><?php echo date("j.n.Y", $startdate);?></span>
								<?php the_title(); ?>
							</a>
							</h3>
					<?php
						//}
					endwhile;
				endif;

				?>
			</main>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<?php edgeone_paging_nav(); ?>
			</div>
		</div>
	</div>
</div>

<?php if( !edgeone_device('mobile') ) {
	echo '<div class="semidark">';
 	get_template_part('partials/section', 'features-4');
 	echo '</div>';
}
?>



<?php get_footer(); ?>

