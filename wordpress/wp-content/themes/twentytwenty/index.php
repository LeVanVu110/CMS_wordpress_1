<?php
/**
 * The main template file (Modified with 3-column layout)
 */

get_header();
?>

<main id="site-content">
    <?php
    $archive_title    = '';
    $archive_subtitle = '';

    if ( is_search() ) {
        global $wp_query;

        $archive_title = sprintf(
            '%1$s %2$s',
            '<span class="color-accent">' . __( 'Search:', 'twentytwenty' ) . '</span>',
            '&ldquo;' . get_search_query() . '&rdquo;'
        );

        if ( $wp_query->found_posts ) {
            $archive_subtitle = sprintf(
                _n(
                    'We found %s result for your search.',
                    'We found %s results for your search.',
                    $wp_query->found_posts,
                    'twentytwenty'
                ),
                number_format_i18n( $wp_query->found_posts )
            );
        } else {
            $archive_subtitle = __( 'We could not find any results for your search. Try again below.', 'twentytwenty' );
        }
    } elseif ( is_archive() && ! have_posts() ) {
        $archive_title = __( 'Nothing Found', 'twentytwenty' );
    } elseif ( ! is_home() ) {
        $archive_title    = get_the_archive_title();
        $archive_subtitle = get_the_archive_description();
    }

    if ( $archive_title || $archive_subtitle ) :
        ?>
    <!--        <header class="archive-header has-text-align-center header-footer-group">-->
    <!--            <div class="archive-header-inner section-inner medium">-->
    <!--                --><?php //if ( $archive_title ) : ?>
    <!--                    <h1 class="archive-title">--><?php //echo wp_kses_post( $archive_title ); ?>
    <!--</h1>-->
    <!--                --><?php //endif; ?>
    <!---->
    <!--                --><?php //if ( $archive_subtitle ) : ?>
    <!--                    <div class="archive-subtitle section-inner thin max-percentage intro-text">-->
    <!--                        --><?php //echo wp_kses_post( wpautop( $archive_subtitle ) ); ?>
    <!--                    </div>-->
    <!--                --><?php //endif; ?>
    <!--            </div>-->
    <!--        </header>-->
    <div class="no-search-results-form section-inner thin">
        <?php
            get_search_form(
                array(
                    'aria_label' => __( 'search again', 'twentytwenty' ),
                )
            );
            ?>
    </div>
    <?php endif; ?>


    <!-- ✅ Bắt đầu layout 3 cột -->
    <div class="custom-layout">

        <!-- Cột trái -->
        <div class="custom-col col-left">
            <?php
            if(!is_search()){
                if ( is_active_sidebar( 'sidebar-left' ) ) {
                    dynamic_sidebar( 'sidebar-left' );
                } else {
                    // Lấy 8 bài viết mới nhất
                    $recent_posts = new WP_Query(array(
                        'posts_per_page' => 8,
                        'post_status' => 'publish',
                        'orderby' => 'date',
'order' => 'DESC'
                    ));
                    ?>

            <div class="popular-posts">
                <h3 class="section-title">Xem nhiều</h3>
                <div class="posts-grid">
                    <?php
                            $count = 1;
                            if ( $recent_posts->have_posts() ) :
                                while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
                                    ?>
                    <div class="post-item">
                        <div class="post-rank"><?php echo $count; ?></div>
                        <div class="post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                    </div>
                    <?php
                                    $count++;
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                </div>
            </div>

            <?php }} else {?>
            <div class="custom-col col-left">
                <h2 class="section-title">Trang mới nhất</h2>

                <?php
                    $recent_posts = wp_get_recent_posts(array(
                        'numberposts' => 3, // 👉 chỉ lấy 3 bài viết mới nhất
                        'post_status' => 'publish'
                    ));
                    foreach ($recent_posts as $post) :
                        $categories = get_the_category($post['ID']);
                        $category_name = !empty($categories) ? $categories[0]->name : 'Chưa phân loại';
                        ?>
                <div class="latest-post-item">
                    <h3 class="latest-post-heading">
                        <a href="<?php echo get_permalink($post['ID']); ?>">
                            <?php echo wp_trim_words($post['post_title'],8,'...'); ?>
                        </a>
                    </h3>
                    <a href="<?php echo get_permalink($post['ID']); ?>" class="latest-post-thumbnail">
                        <?php echo get_the_post_thumbnail($post['ID'], 'large'); ?>
                    </a>
                    <p class="latest-post-excerpt">
                        <?php echo wp_trim_words($post['post_content'], 25, '...'); ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>


            <?php }?>
        </div>

        <!-- Cột giữa -->
        <div class="custom-col col-center">
            <?php
            if ( have_posts() ) :
                $i = 0;
while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content', get_post_type() );
                    $i++;
                endwhile;

                get_template_part( 'template-parts/pagination' );
            elseif ( is_search() ) :
                ?>

            <?php

            endif;
            ?>
        </div>

        <!-- Cột phải -->

        <?php if(!is_search()){ ?>

        <div class="custom-col col-right">
            <div class="comments" id="comments">
                <div class="comments-inner section-inner thin max-percentage">
                    <div class="comments-box">
                        <h2 class="comments-box-title">Comments</h2>
                        <div class="comments-box-line"></div>

                        <?php
                        // Lấy 5 comment mới nhất
                        $recent_comments = get_comments(array(
                            'number' => 5,
                            'status' => 'approve',
                        ));

                        if ($recent_comments) :
                            ?>
                        <ul class="comments-list">
                            <?php foreach ($recent_comments as $comment) : ?>
                            <li><a href="<?php echo esc_url(get_comment_link($comment)); ?>">
                                    <?php echo esc_html($comment->comment_content); ?>
                                </a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>



                </div>
            </div>
            <?php } else { ?>
            <div class="custom-col col-right">
                <div class="latest-comments-widget">
                    <h3 class="section-title">Bình luận mới nhất</h3>

                    <?php
                        // Lấy 5 bình luận mới nhất đã được duyệt
                        $recent_comments = get_comments(array(
                            'number' => 5,
                            'status' => 'approve',
                            'hierarchical' => 'threaded',
                            'parent' => 0, // chỉ lấy bình luận cha để hiển thị phân cấp
                        ));

                        if ($recent_comments) :
                            ?>
                    <ul class="styled-comment-list">
                        <?php
                                foreach ($recent_comments as $comment) :
                                    $avatar = get_avatar($comment, 55);
                                    $author = get_comment_author($comment);
                                    $content = wp_trim_words($comment->comment_content, 35, '...');
                                    ?>
                        <li class="styled-comment-item">
                            <div class="comment-avatar-wrap">
                                <?php echo $avatar; ?>
                            </div>
                            <div class="comment-body-wrap">
                                <h4 class="comment-author-name"><?php echo esc_html($author); ?></h4>
                                <p class="comment-text-content"><?php echo esc_html($content); ?></p>

                                <?php
                                            // Lấy các bình luận con (reply)
                                            $child_comments = get_comments(array(
                                                'parent' => $comment->comment_ID,
                                                'status' => 'approve',
                                            ));

                                            if ($child_comments) :
                                                echo '<ul class="children">';
                                                foreach ($child_comments as $child) :
                                                    $child_avatar = get_avatar($child, 45);
                                                    $child_author = get_comment_author($child);
                                                    $child_content = wp_trim_words($child->comment_content, 30, '...');
                                                    ?>
                        <li class="styled-comment-item">
                            <div class="comment-avatar-wrap">
                                <?php echo $child_avatar; ?>
                            </div>
                            <div class="comment-body-wrap">
                                <h4 class="comment-author-name"><?php echo esc_html($child_author); ?></h4>
                                <p class="comment-text-content"><?php echo esc_html($child_content); ?></p>
                            </div>
                        </li>
                        <?php
                                                endforeach;
                                                echo '</ul>';
                                            endif;
                                            ?>
                </div>
                </li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php } ?>
    </div>

    </div>

</main>
<?php
get_template_part('template-parts/template-latest-news');

?>
<?php
get_template_part( 'template-parts/footer-menus-widgets' );
get_footer();
?>