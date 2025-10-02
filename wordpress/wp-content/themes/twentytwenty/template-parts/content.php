<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <?php

    // Lời gọi này sẽ tải template-parts/entry-header.php, nơi chứa Tiêu đề bài viết.
    get_template_part( 'template-parts/entry-header' );

    // >>> BẮT ĐẦU VỊ TRÍ CHÈN CODE CUSTOM DATE <<<
    // Đảm bảo chỉ hiển thị trên Bài viết (Post)
   

    if ( ! is_search() ) {
        get_template_part( 'template-parts/featured-image' );
    }

    ?>
	

    <div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

        <div class="entry-content">
<!-- 		
        <div class="custom-date-display">
            <span class="day-number"><?php echo get_the_date('d'); ?></span>
            <div class="month-year-group">
                <span class="month-name">THÁNG <?php echo get_the_date('n'); ?></span>
                <span class="year-number"><?php echo get_the_date('Y'); ?></span>
            </div>
        </div> -->
     
    
            <?php
			
            if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
                the_excerpt();
            } else {
                the_content( __( 'Continue reading', 'twentytwenty' ) );
            }
            ?>
            

        </div><!-- .entry-content -->

    </div><!-- .post-inner -->

    <div class="section-inner">
        <?php
        wp_link_pages(
            array(
                'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
                'after'       => '</nav>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            )
        );

        edit_post_link();

        // Single bottom post meta.
        twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

        if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

            get_template_part( 'template-parts/entry-author-bio' );

        }
        ?>

    </div><!-- .section-inner -->

    <?php

    if ( is_single() ) {

        get_template_part( 'template-parts/navigation' );

    }

    /*
     * Output comments wrapper if it's a post, or if comments are open,
     * or if there's a comment number – and check for password.
     */
    if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
        ?>

    <div class="comments-wrapper section-inner">

        <?php comments_template(); ?>

    </div><!-- .comments-wrapper -->

    <?php
    }
    ?>

</article><!-- .post -->
