<?php
/* Template Name: DB Test */
get_header();
?>

<h2>Kiểm tra kết nối Database trong WordPress</h2>

<?php
// Biến toàn cục $wpdb
global $wpdb;

// Lấy thông tin DB từ wp-config.php
$db_name = DB_NAME;
$db_user = DB_USER;
$db_host = DB_HOST;

// Test query đơn giản
$count_posts = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->posts}");

if ($count_posts !== null) {
    echo "<p style='color:green;'>✅ Kết nối thành công!</p>";
    echo "<p><b>Database:</b> $db_name</p>";
    echo "<p><b>User:</b> $db_user</p>";
    echo "<p><b>Host:</b> $db_host</p>";
    echo "<p><b>Số bài viết:</b> $count_posts</p>";
} else {
    echo "<p style='color:red;'>❌ Kết nối thất bại!</p>";
}
?>

<?php get_footer(); ?>
