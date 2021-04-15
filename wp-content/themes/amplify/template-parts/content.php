<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php
	
	if ( is_single() ) {
		the_title( '<div class="entry-title">', '</div>' );
	}
	if ( is_single() ) {
	?>
	<div class="entry-excerpt">
		<?php the_excerpt(); ?>
	</div>
	<?php
	}
	?>
	<?php
	if ( is_single() ) {
	?>
	<div class="single-post-featured-image">
	<?php
	}
	?>
	<?php
	
	if ( ! is_search() ) {
		get_template_part( 'template-parts/featured-image' );
	}

	?>
	<?php
	if ( is_single() ) {
	?>
	</div>
	<?php
	}
	?>
	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; echo is_single() ? ' single-post-content': '';?> ">

		<div class="entry-content">
			
			<?php
			if ( is_single() ) {
				$less_than_1_str = '<span class="span-reading-time rt-reading-time"><span class="rt-label rt-prefix"></span> <span class="rt-time"> &lt; 1</span> <span class="rt-label rt-postfix"></span></span>';
				echo "<div class='post-extra'><div>".get_the_date("l, F j, Y")."</div>";
				echo do_shortcode('[rt_reading_time label="" postfix="minute read"]') == $less_than_1_str ? "Reading Time less than 1 min" : do_shortcode('[rt_reading_time label="" postfix="minute read"]');
				echo "</div>";
			}
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
			?>

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/**
	 *  Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 * */
	if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
