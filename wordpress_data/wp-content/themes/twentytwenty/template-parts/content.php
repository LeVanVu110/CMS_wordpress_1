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

$class = '';
if (!is_single()) {
	$class = 'danh-sach';
}
?>

<article <?php post_class($class); ?> id="post-<?php the_ID(); ?>">

	<?php if (!is_single()) : ?>
		<!-- Cột ngày tháng -->
		<div class="post-date">
			<div class="day"><?php echo get_the_date('d'); ?></div>
			<div class="month"><?php echo strtoupper(get_the_date('M')); ?></div>
		</div>

		<!-- Thumbnail -->
		<!-- <?php if (has_post_thumbnail()) : ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail('medium'); ?>
				</a>
			</div>
		<?php endif; ?> -->

		<!-- Nội dung bài viết -->
		<div class="entry-content">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<p>
				<?php echo wp_trim_words(get_the_content(), 100, '...'); ?>
			</p>
		</div>
	<?php else : ?>
		<!-- Nếu đang ở trang chi tiết -->
		<?php
		get_template_part('template-parts/entry-header');
		get_template_part('template-parts/featured-image');
		?>

		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	<?php endif; ?>

</article>