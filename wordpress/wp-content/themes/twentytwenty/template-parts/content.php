<?php
// Bắt đầu cấu trúc mới cho danh sách bài viết (trang chủ, danh mục, tìm kiếm,...)
if ( ! is_singular() ) :
    ?>
<div><article <?php post_class( 'custom-post-item' ); ?> id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="full-link-wrap">
        <div class="custom-post-wrap">
            <?php
            // START: THÊM ẢNH ĐẠI DIỆN VÀO ĐÂY
            if ( is_search() ) {
                ?>
            <div class="custom-post-thumbnail">
                <?php 
                    // the_post_thumbnail('thumbnail') sẽ lấy ảnh đại diện với kích thước thumbnail (150x150)
                    // Bạn có thể đổi thành 'medium' hoặc 'large' nếu muốn ảnh to hơn.
                    the_post_thumbnail( 'thumbnail' ); 
                    ?>
            </div>
            <?php
            }
            // END: THÊM ẢNH ĐẠI DIỆN
            
            ?>

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
        </div>
        <!-- end ct -->
    </a>
</article></div>
<?php
else :
    // Giữ nguyên code gốc Twenty Twenty cho trang đơn lẻ
    ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <div class="post-inner <?php echo is_page_template('templates/template-full-width.php') ? '' : 'thin'; ?> ">

        <!-- START: Wrapper cho bố cục 3 cột -->
        <!-- Post Layout Wrapper mới này sẽ dùng Flexbox để chia thành 3 cột (Categories | Content | Next Post) -->
        <div class="post-layout-wrapper-3-col">

            <!-- Cột 1: HIỂN THỊ TẤT CẢ categories (sẽ cố định hoặc nằm bên trái) -->
            <div class="post-sidebar-categories post-col-1">
                <div class="all-categories-list-container">
                    <h2 class="categories-list-header">Categories</h2>
                    <ul class="categories-list-ul">
                        <?php
                            // Lấy danh sách tất cả các danh mục
                            $args = array(
                                'orderby'    => 'name',
                                'show_count' => 0, // Không hiển thị số lượng bài viết
                                'title_li'   => '', // Không hiển thị tiêu đề mặc định
                                'echo'       => 0,  // Trả về chuỗi thay vì in ra
                            );

                            // Hiển thị danh sách categories dưới dạng <li> và <a>
                            $category_list = wp_list_categories( $args );

                            echo $category_list;
                            ?>
                    </ul>
                </div>
            </div>
            <!-- END: Cột 1 Categories -->

            <!-- Cột 2 (Giữa): NỘI DUNG BÀI VIẾT (Tin tức content) -->
            <div class="post-content-main post-col-2">
                <div class="post-content">
                    <div class="entry-content strainline">
                        <div class="date-circle-container">
                            <div class="date-d-m-group">
                                <span class="date-day"><?php echo get_the_date('d'); ?></span>
                                <span class="date-month"><?php echo get_the_date('m'); ?></span>
                            </div>
                            <span class="date-year"><?php echo get_the_date('y'); ?></span>
                        </div>
                        <?php the_content(__('Continue reading', 'twentytwenty')); ?>
                    </div>
                </div>
                <!-- Di chuyển post-date-circle vào đây nếu nó là phần của content -->
                <div class="post-date-circle"></div>
            </div>
            <!-- END: Cột 2 Content -->

            <!-- Cột 3 (Phải): Bài viết tiếp theo/Liên quan (ĐÃ CẬP NHẬT THEO MẪU ẢNH) -->
                <div class="post-sidebar-next post-col-3">
                    <?php
                    $current_post_id = get_the_ID();
                    // Lấy 3 bài viết gần đây nhất, loại trừ bài viết hiện tại
                    $recent_posts = get_posts(array(
                        'numberposts'  => 3,
                        'post_status'  => 'publish',
//                        'post__not_in' => array($current_post_id)
                    ));

                    if ( $recent_posts ) :
                        ?>
                        <!-- Khối tin tức mới nhất (Áp dụng CSS để tạo màu nền xanh teal và bố cục) -->
                        <div class="latest-news-block">
                            <!-- Bạn có thể thêm tiêu đề ở đây nếu cần, ví dụ: <h3 class="block-title">Tin tức mới nhất</h3> -->

                            <?php foreach ( $recent_posts as $post ) : setup_postdata( $post ); ?>
                                <a href="<?php the_permalink(); ?>" class="news-item-link">
                                    <div class="news-item-row">
                                        <!-- Date Group: Ngày / Tháng - Năm -->
                                        <div class="date-group">
                                            <div class="date-info">
                                                <div class="date-d-m">
                                                    <span class="date-day"><?php echo get_the_date('d'); ?></span>
                                                    <!-- Dấu gạch ngang dọc được mô phỏng bằng border-bottom của date-d-m -->
                                                    <span class="date-month"><?php echo get_the_date('m'); ?></span>
                                                </div>
                                                <span class="date-separator"></span> <!-- Dấu gạch ngang ngang (—) -->
                                                <span class="date-year-display"><?php echo get_the_date('y'); ?></span>
                                            </div>
                                        </div>
                                        <!-- POST TITLE (Lấy lại tiêu đề bài viết) -->
                                        <div class="post-title category-heading">
                                            <?php the_title(); ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; wp_reset_postdata(); ?>

                            
                        </div>
                        <!-- Nút Xem Tất Cả Tin Tức -->
                            <?php
                            // Lấy URL của trang tin tức/blog chính (Page for Posts)
$news_page_id = get_option('page_for_posts');
                            $news_archive_url = $news_page_id ? get_permalink($news_page_id) : get_home_url();
                            ?>
                            <a href="<?php echo esc_url($news_archive_url); ?>" class="view-all-news-button">
                                XEM TẤT CẢ TIN TỨC
                            </a>
                    <?php endif; ?>
                </div>
                <!-- END: Cột 3 Next Post -->

        </div>
        <!-- END: Wrapper cho bố cục 3 cột -->

        <?php
            function display_make_a_post_form() {
                // ... (phần code form make a post không thay đổi)
                ?>
        <div class="make-post-wrapper section-inner">
            <div class="make-post-header">Make a Post</div>
            <div class="make-post-body">
                <textarea class="make-post-input" placeholder="What are you thinking..." rows="3"></textarea>
                <button class="make-post-share">share</button>
            </div>
        </div>
        <?php
            }
            ?>
        <div class="section-inner">
            <?php
                wp_link_pages(array(/* ... */));
                edit_post_link();
                twentytwenty_the_post_meta(get_the_ID(), 'single-bottom');
                if (post_type_supports(get_post_type(get_the_ID()), 'author') && is_single()) {
                    get_template_part('template-parts/entry-author-bio');
                }
                ?>
        </div>
        <?php
            if (is_single()) {
                get_template_part('template-parts/navigation');
            }
                // display_make_a_post_form();
                if (is_single() && (comments_open() || get_comments_number())) {
                comments_template();
            }else{
                if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) {
                    ?>
        <div class="comments-wrapper section-inner"><?php comments_template(); ?></div>
        <?php
                }
            }
            ?>
</article>

<?php
endif; // Kết thúc is_singular()
?>