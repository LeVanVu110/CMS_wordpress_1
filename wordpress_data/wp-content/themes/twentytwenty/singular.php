<?php

/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main id="site-content">

	<?php

	if (have_posts()) {

		while (have_posts()) {
			the_post();

			get_template_part('template-parts/content', get_post_type());
		}
	}

	?>
	<?php
	if (is_singular('post')) { // Chỉ hiển thị cho post
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
	}
	?>

</main><!-- #site-content -->

<?php get_template_part('template-parts/footer-menus-widgets'); ?>

<?php
get_footer();
