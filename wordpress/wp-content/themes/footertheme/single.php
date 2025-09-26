<?php get_header(); ?>

<div class="row">
    <div class="col-lg-8">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
                <article>
                    <img src="" alt="">
                    <h1>Đỗ Đức Anh</h1>
                    <h4>Sinh viên TDC</h4>
                    <div class="mb-3 text-muted">
                        <?php the_category(', '); ?> · <?php the_time('j F, Y'); ?>
                    </div>

                    <?php if ( has_post_thumbnail() ): ?>
                        <div class="mb-3"><?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?></div>
                    <?php endif; ?>

                    <div class="content"><?php the_content(); ?></div>
                </article>

                <!-- related posts same category -->
                <?php
                $cats = wp_get_post_categories(get_the_ID());
                if (!empty($cats)):
                    $related = new WP_Query(array(
                        'category__in' => $cats,
                        'post__not_in' => array(get_the_ID()),
                        'posts_per_page' => 3
                    ));
                    if ($related->have_posts()):
                        echo '<h4 class="mt-5">Bài viết cùng danh mục</h4><div class="row">';
                        while ($related->have_posts()): $related->the_post();
                            get_template_part('parts/content', 'card');
                        endwhile;
                        echo '</div>';
                        wp_reset_postdata();
                    endif;
                endif;
                ?>

            <?php endwhile;
        endif;
        ?>
    </div>

    <aside class="col-lg-4">
        <?php get_search_form(); ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
</div>

<?php get_footer(); ?>
