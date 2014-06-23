<?php
/**
 * The template part for displaying bootsrap style menu.
 *
 * needs  wp_bootstrap_navwalker
 *
 * @package edgeone
 */
?>

<div class="navbar" role="navigation">
    <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
         <span class="sr-only"><?php _e('Toggle navigation', 'edgeone'); ?></span>
         <i class="fa fa-bars"></i>
       </button>

     </div>
     <nav class="navbar-collapse collapse navbar-right" id="main-nav" role="navigation">
		<?php
            wp_nav_menu( array(
                'menu'              => 'primary',
                'theme_location'    => 'primary',
                'depth'             => 3,
                'container'         => '',
                'container_class'   => '',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
            );
        ?>
	</nav>
</div>