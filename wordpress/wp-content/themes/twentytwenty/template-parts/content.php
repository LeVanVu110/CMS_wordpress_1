<?php
// Bắt đầu cấu trúc mới cho danh sách bài viết (trang chủ, danh mục, tìm kiếm,...)
if ( ! is_singular() ) :
    ?>

<article <?php post_class( 'custom-post-item' ); ?> id="post-<?php the_ID(); ?>">

    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="full-link-wrap">

        <div class="custom-post-wrap">
            <div class="custom-post-date">
                <div class="day-large">
                    <?php the_time( 'd' ); ?>
                </div>
                <div class="month-small">
                    <?php
                    // Lấy Tháng bằng số và thêm chữ THÁNG (Tiếng Việt)
                    echo 'THÁNG ' . get_the_time( 'm' );
                    ?>
                </div>
            </div>

            <div class="custom-post-divider"></div>

            <div class="custom-post-content">
                <h2 class="entry-title">
                    <?php the_title(); ?>
                </h2>
                <div class="entry-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                
            </div>
        </div></a></article><?php
else :
    // Giữ nguyên code gốc Twenty Twenty cho trang đơn lẻ
    ?>

    <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
        <div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">
            <div class="entry-content">
                <?php the_content( __( 'Continue reading', 'twentytwenty' ) ); ?>
            </div>
        </div>
        <div class="section-inner">
            <?php
            wp_link_pages( array(/* ... */) );
            edit_post_link();
            twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );
            if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {
                get_template_part( 'template-parts/entry-author-bio' );
            }
            ?>
        </div>
        
        <?php
        // KIỂM TRA: Nếu là trang đơn lẻ
        if ( is_single() ) { 
            // Bước 1: Gọi phần điều hướng (navigation) của TT
            get_template_part( 'template-parts/navigation' ); 
            
            // BƯỚC 2: THÊM THÔNG TIN TÁC GIẢ NGAY SAU NAVIGATION
            // Chúng ta dùng class 'section-inner' của TT để căn chỉnh đúng
            ?>
            <div class="entry-author section-inner">
                <span class="author-label">Đăng bởi:</span>
                <?php the_author_posts_link(); // Tác giả cho bài viết đơn lẻ ?>
            </div>
            <?php
        }
        
        // Phần comments
        if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
            ?><div class="comments-wrapper section-inner"><?php comments_template(); ?></div><?php
        }
        
        if ( is_single() ) { get_template_part( 'template-parts/navigation' ); }
        
        ?>
    </article>

<?php
endif; // Kết thúc is_singular()
?>