<?php
/**
 * Displays the next and previous post navigation in single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$next_post = get_next_post();
$prev_post = get_previous_post();

if ( $next_post || $prev_post ) {

    $pagination_classes = '';

    if ( ! $next_post ) {
        $pagination_classes = ' only-one only-prev';
    } elseif ( ! $prev_post ) {
        $pagination_classes = ' only-one only-next';
    }

    ?>

    <nav class="pagination-single section-inner<?php echo esc_attr( $pagination_classes ); ?>" aria-label="<?php esc_attr_e( 'Post', 'twentytwenty' ); ?>">

        <div class="pagination-single-inner">

            <?php
            // Hiển thị Bài Viết TRƯỚC (Previous Post)
            if ( $prev_post ) {
                ?>

                <a class="previous-post navigation-item" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
                    <!-- Khối Ngày Tháng -->
                    <div class="post-date-nav">
                        <div class="nav-day-group">
                            <div class="nav-day"><?php echo get_the_time('d', $prev_post->ID); ?></div>
                            <div class="nav-month"><?php echo get_the_time('m', $prev_post->ID); ?></div>
                        </div>
                        <div class="nav-year"><?php echo get_the_time('y', $prev_post->ID); ?></div>
                    </div>
                    <!-- Tiêu đề -->
                    <span class="title-nav">
                        <span class="title-inner"><?php echo wp_kses_post( get_the_title( $prev_post->ID ) ); ?></span>
                    </span>
                    <!-- Mũi tên (Giữ lại nhưng sẽ ẩn bằng CSS) -->
                    <span class="arrow-nav" aria-hidden="true">&larr;</span>
                </a>

                <?php
            }

            // Hiển thị Bài Viết SAU (Next Post)
            if ( $next_post ) {
                ?>

                <a class="next-post navigation-item" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
                    <!-- Mũi tên (Giữ lại nhưng sẽ ẩn bằng CSS) -->
                    <span class="arrow-nav" aria-hidden="true">&rarr;</span> 
                    <!-- Khối Ngày Tháng -->
                    <div class="post-date-nav">
                        <div class="nav-day-group">
                            <div class="nav-day"><?php echo get_the_time('d', $next_post->ID); ?></div>
                            <div class="nav-month"><?php echo get_the_time('m', $next_post->ID); ?></div>
                        </div>
                        <div class="nav-year"><?php echo get_the_time('y', $next_post->ID); ?></div>
                    </div>
                    <!-- Tiêu đề -->
                    <span class="title-nav">
                        <span class="title-inner"><?php echo wp_kses_post( get_the_title( $next_post->ID ) ); ?></span>
                    </span>
                </a>
                <?php
            }
            ?>

        </div><!-- .pagination-single-inner -->

    </nav><!-- .pagination-single -->

    <?php
}
?>
