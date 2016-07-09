<?php
// Do not delete these lines
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // if there's a password
    if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
        ?>
        <h2><?php _e('Password Protected'); ?></h2>
        <p><?php _e('Enter the password to view comments.'); ?></p>
        <?php
        return;
    }
}
/* This variable is for alternating comment background */
$oddcomment = 'alt';
?>
<!-- You can start editing here. -->
<?php if ('open' == $post->comment_status) : ?>
    <div id="respond">
        <div id="cancel-comment-reply">
            <small><?php cancel_comment_reply_link('Trả lời'); ?></small>
        </div>
        <?php if (get_option('comment_registration') && !$user_ID) : ?>
            <p>Bạn phải <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">đăng nhập</a> để viết bình luận.</p>
        <?php else : ?>
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                <?php if ($user_ID) : ?>
                    <p><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>, <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Đăng xuất">Đăng xuất!</a></p>
                <?php else : ?>
                    <div id="cmm">
                    <input type="text" name="author" id="author" placeholder="Tên bạn" value="<?php echo $comment_author; ?>" size="22" tabindex="1"  <?php if ($req) echo 'required'; ?> class="form">
<br>
                    <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo 'required'; ?> class="form"><br>
                    </div>
                    <?php endif; ?>
                <textarea name="comment" id="comment" placeholder="Nội dung bình luận" cols="22" rows="4" tabindex="4" class="form"></textarea>
                <p><input name="submit" type="submit" id="submit" tabindex="5" class="button" value="Gửi"/></p>
                <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
            </form>
    <?php endif; // If registration required and not logged in ?>
    </div><!--end respond-->
<?php endif; // if you delete this the sky will fall on your head ?>
<?php if ($comments) : ?></div>
        <?php wp_list_comments('type=comment&callback=mytheme_comment&per_page=5'); ?> <div class="navigation"><?php paginate_comments_links('prev_text=<&next_text=>'); ?></div>
<?php else : // this is displayed if there are no comments so far  ?>
    <?php if ('open' == $post->comment_status) : ?>
        <!-- If comments are open, but there are no comments. -->
    <?php else : // comments are closed  ?>
        <!-- If comments are closed. -->
        <p class="nocomments">Bình luận đã ​​đóng.</p></div>
    <?php endif; ?>
<?php endif; ?></div>