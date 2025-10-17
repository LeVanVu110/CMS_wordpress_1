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
		<header class="archive-header has-text-align-center header-footer-group">
			<div class="archive-header-inner section-inner medium">
				<?php if ( $archive_title ) : ?>
					<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
				<?php endif; ?>

				<?php if ( $archive_subtitle ) : ?>
					<div class="archive-subtitle section-inner thin max-percentage intro-text">
						<?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</header>
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
	<?php }} ?>
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
					if ( $i > 0 ) {
						echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
					}
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
<?php } else {?>
	<?php }?>
		<div class="custom-col col-right">

	</div>
	<!-- ✅ Kết thúc layout 3 cột -->

</main>

<?php
get_template_part( 'template-parts/footer-menus-widgets' );
get_footer();
?>
