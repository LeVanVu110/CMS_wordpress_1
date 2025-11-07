<?php
get_header(); // Gọi header.php
?>

<main id="site-content">
    <div class="container">
        <h1>Bài viết mới nhất</h1>
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <hr>
            <?php
            endwhile;
        else :
            echo '<p>Không có bài viết nào.</p>';
        endif;
        ?>
    </div>
</main>

<?php
get_footer(); // Gọi footer.php
?>
