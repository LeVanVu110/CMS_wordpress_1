<?php
/**
 * Template Name: Latest News Timeline
 * Description: Hiển thị 3 bài viết mới nhất theo dạng timeline.
 */

get_header(); ?>

<section class="latest-news-section">
    <h2 class="latest-news-title">Latest News</h2>

    <div class="timeline">
        <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 3, // hiển thị 3 bài viết mới nhất
        );
        $latest_posts = new WP_Query($args);

        if ($latest_posts->have_posts()) :
            while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
                <div class="timeline-item">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <a href="<?php the_permalink(); ?>" class="timeline-title"><?php the_title(); ?></a>
                            <span class="timeline-date"><?php echo get_the_date('j F, Y'); ?></span>
                        </div>
                        <p class="timeline-excerpt"><?php echo wp_trim_words(get_the_content(), 50, '...'); ?></p>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <p>No news found.</p>
        <?php endif; ?>
    </div>
</section>

