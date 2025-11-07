<?php
/**
 * Partial hiển thị dạng card cho 1 bài
 * expects global $post
 */
$post_id = get_the_ID();
$permalink = get_permalink($post_id);
$title = get_the_title($post_id);
$excerpt = get_the_excerpt($post_id);
$thumb = get_the_post_thumbnail_url($post_id, 'medium');
$categories = get_the_category_list(', ');
?>
<div class="col-md-6 mb-4">
    <article class="card h-100">
        <?php if ($thumb): ?>
            <img src="<?php echo esc_url($thumb); ?>" class="card-img-top" alt="<?php echo esc_attr($title); ?>">
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h5>
            <p class="card-text"><?php echo wp_kses_post(wp_trim_words($excerpt, 25)); ?></p>
        </div>
        <div class="card-footer text-muted">
            <?php echo $categories; ?> · <?php echo get_the_date('', $post_id); ?>
        </div>
    </article>
</div>
