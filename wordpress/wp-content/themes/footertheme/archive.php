<?php get_header(); ?>

<h2 class="mb-4">
    <?php
    if (is_category()) {
        single_cat_title();
    } elseif (is_tag()) {
        single_tag_title();
    } else {
        post_type_archive_title();
    }
    ?>
</h2>

<div class="row">
    <?php
    if (have_posts()):
        while (have_posts()): the_post();
            get_template_part('parts/content', 'card');
        endwhile;
    else:
        echo '<p>Không có bài viết.</p>';
    endif;
    ?>
</div>

<?php get_footer(); ?>
