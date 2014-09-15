<?php
/**
 * Template name: Empty page
 *
 *
 *
 * @package edgeone
 */

get_header(); ?>


<body <?php body_class('empty-page'); ?> style="background: white;">
<?php
	if (have_posts()):
		while (have_posts()) : the_post();



				the_content();

		endwhile;
	else:
		?>
		<div class="col-xs-12">
			<?php edgeone_no_content(); ?>
		</div>
	<?php
	endif;



wp_footer();

?>

</body>
</html>
