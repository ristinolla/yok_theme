<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package edgeone
 */

get_header(); ?>

<?php get_template_part( 'templates/header', 'page' ); ?>


<div class="light">
	<section id="primary" class="container">
		<main id="main" class="row" role="main">

			<aside class="col-xs-12 col-xs-3">
				<?php get_sidebar(); ?>
			</aside>
		<?php if ( have_posts() ) : ?>
			<header class="page-header col-xs-9">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', 'edgeone' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'edgeone' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'edgeone' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'edgeone' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'edgeone' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'edgeone' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'edgeone' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', 'edgeone');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'edgeone');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'edgeone' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'edgeone' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'edgeone' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', 'edgeone' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', 'edgeone' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', 'edgeone' );

						else :
							_e( 'Archives', 'edgeone' );

						endif;
					?>
				</h1>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->
			<div class="col-xs-9">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'templates/content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php edgeone_paging_nav(); ?>
			</div>
		<?php else : ?>
			<div class="col-xs-9">
				<?php get_template_part( 'templates/content', 'none' ); ?>
			</div>
		<?php endif; ?>
		</main><!-- #main -->
	</section><!-- #primary -->
</div>

<?php if( !edgeone_device('mobile') ) {
	echo '<div class="semidark">';
 	get_template_part('partials/section', 'features-4');
 	echo '</div>';
}
?>

<?php get_footer(); ?>
