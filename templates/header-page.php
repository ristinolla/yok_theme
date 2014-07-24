<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package edgeone
 */
?>

<?php
$index= false;
if (  is_front_page() ) {
	$index = true;

}?>
<div id="big-banner" class="big-banner full-height-banner" data-index="<?php echo $index; ?>" data-bguri="<?php echo home_url('/'); ?>/big_photo.jpg">
	<div class="banner-caption">
		<span><?php _e('Photo by:', 'edgeone'); ?> <a href="#" id="photographer-link" target="_blank">name</a> | <a href="https://www.flickr.com/groups/yokamerat/" target="_blank"><?php _e('Yokamerat Flickr Group'); ?>.</span></a>
	</div>
</div>

<header id="main-header" class=" main-header">
	<div class="row relative">
		<a class="text-hide logo" id="logo" href="<?php echo home_url('/'); ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
		<?php get_template_part( 'templates/nav', 'bs-normal' ); ?>
		<div class="">
	</div>
</header>
