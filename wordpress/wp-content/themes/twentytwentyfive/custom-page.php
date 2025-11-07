<?php
/* Template Name: DB Connection Test */
get_header();
?>

<h2>Kiểm tra kết nối Database</h2>

<?php
global $wpdb;

// Thử query đơn giản
$result = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts}");

if ($result !== null) {
    echo "<p style='color:green;'>✅ Kết nối thành công! Có tổng cộng $result bài viết trong bảng wp_posts.</p>";
} else {
    echo "<p style='color:red;'>❌ Kết nối thất bại!</p>";
}
?>

<?php get_footer(); ?>
