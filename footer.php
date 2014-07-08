<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package edgeone
 */
?>
</div>
<div class="dark">
	<footer id="main-footer" class="site-footer container" role="contentinfo">
		<div class="row">
			<div class="col-xs-12 col-md-3">
					<a class="text-hide logo footer-logo logo-light" href="<?php echo home_url('/'); ?>" title="<?php bloginfo( 'name' ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
			</div>
			<div class="col-xs-12 col-md-7">
				<div class="footer-menu-wrapper">
					<span class="copy"><?php
						printf(__('&copy %1$s Edgeone', 'edgeone'), date("Y"));
					?>
					</span>
					<?php
						wp_nav_menu( array(
							'theme_location'  => 'footer',
							'menu'            => 'footer',
							'container'       => 'div',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'footer-menu',
							'menu_id'         => 'footer-menu',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => ' ',
							'link_after'      => ' ',
							'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
							)
						);
					?>


				</div>
			</div>
			<div class="col-xs-12 col-md-2 social-links">
				<a href="https://www.facebook.com/yokamerat" title="Yokamerat Facebook" style="color: #3B5998 ;">
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<a href="https://www.flickr.com/groups/yokamerat/" title="Yokamerat on Flickr" style="color: #ff0084 ;">
					<span class="fa-stack fa-lg">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-flickr fa-stack-1x fa-inverse"></i>
					</span>
				</a>
			</div>
		</div>

	</footer>
	<small class="center-block text-center" style="font-size: 8px; padding-bottom: 13px; opacity: 0.8; color: white;">Site built by <a href="http://www.pertturistimella.com" target="_blank">Perttu</a>.</small>
</div>

<?php wp_footer(); ?>



</body>
</html>