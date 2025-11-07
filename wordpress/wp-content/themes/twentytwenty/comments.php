<script>
    document.addEventListener("DOMContentLoaded", function () {
        const comments = document.querySelectorAll(".comment-body");
        const respond = document.getElementById("respond"); // form comment
        const cancelReply = document.getElementById("cancel-comment-reply-link");

        comments.forEach(function (comment) {
            comment.addEventListener("click", function () {
                const commentId = this.closest("li").id.replace("comment-", "");
                const parent = this.closest("li");

                // Di chuyển form trả lời vào dưới comment được click
                if (parent && respond) {
                    parent.appendChild(respond);
                    respond.scrollIntoView({ behavior: "smooth", block: "center" });

                    // Cập nhật giá trị comment_parent ẩn
                    const input = document.getElementById("comment_parent");
                    if (input) input.value = commentId;
                }
            });
        });

        // Nếu bấm “Cancel reply”, form quay lại vị trí ban đầu
        if (cancelReply) {
            cancelReply.addEventListener("click", function (e) {
                e.preventDefault();
                const commentFormWrapper = document.querySelector(".comments-inner");
                if (commentFormWrapper && respond) {
                    commentFormWrapper.appendChild(respond);
                    const input = document.getElementById("comment_parent");
                    if (input) input.value = 0;
                }
            });
        }
    });
</script>

<?php

/**
 * The template file for displaying the comments and comment form for the
 * Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
*/
if (post_password_required()) {
    return;
}

if ($comments) {
    ?>

    <div class="comments" id="comments">

        <?php
        $comments_number = get_comments_number();
        ?>

        <div class="comments-header section-inner small max-percentage">

        </div><!-- .comments-header -->

        <div class="comments-inner section-inner thin max-percentage">

            <div class="comments-box">
                <h2 class="comments-box-title">Comments</h2>
                <div class="comments-box-line"></div>
                <ul class="comments-list">
                    <?php
                    wp_list_comments(array(
                        'style'      => 'ul',
                        'short_ping' => true,
                        'avatar_size'=> 30,
                        'callback'   => null, // dùng layout mặc định
                        'reply_text' => '',
                    ));
                    ?>
                </ul>
            </div>

            <?php
$comment_pagination = paginate_comments_links(
                array(
                    'echo' => false,
                    'end_size' => 0,
                    'mid_size' => 0,
                    'next_text' => __('Newer Comments', 'twentytwenty') . ' <span aria-hidden="true">&rarr;</span>',
                    'prev_text' => '<span aria-hidden="true">&larr;</span> ' . __('Older Comments', 'twentytwenty'),
                )
            );

            if ($comment_pagination) {
                $pagination_classes = '';

                // If we're only showing the "Next" link, add a class indicating so.
                if (false === strpos($comment_pagination, 'prev page-numbers')) {
                    $pagination_classes = ' only-next';
                }
                ?>

                <nav class="comments-pagination pagination<?php echo $pagination_classes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static output
                ?>" aria-label="<?php esc_attr_e('Comments', 'twentytwenty'); ?>">
                    <?php echo wp_kses_post($comment_pagination); ?>
                </nav>

                <?php
            }
            ?>

        </div><!-- .comments-inner -->

    </div><!-- comments -->

    <?php
}

if (comments_open() || pings_open()) {

    if ($comments) {
//        echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
    }

    comment_form(array(
        'class_form' => 'section-inner thin max-percentage',
        'title_reply' => 'Make a post',
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
        'title_reply_after' => '</h2>',
        'label_submit' => 'share',
        'comment_field' => '
        
<textarea class="comment-text" id="comment" name="comment" rows="5" placeholder="What are you thinking..."></textarea>
        ',
        'fields' => is_user_logged_in() ? array() : array(
            'author' => '<p><input id="author" name="author" type="text" placeholder="Tên của bạn"></p>',
            'email' => '<p><input id="email" name="email" type="email" placeholder="Email"></p>',
        )
    ));
} elseif (is_single()) {

    if ($comments) {
        echo '<hr class="styled-separator is-style-wide" aria-hidden="true" />';
    }

    ?>

    <div class="comment-respond" id="respond">

        <p class="comments-closed"><?php _e('Comments are closed.', 'twentytwenty'); ?></p>

    </div><!-- #respond -->

    <?php
}