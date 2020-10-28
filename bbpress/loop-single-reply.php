<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<div class="forum-topic__comment forum-comment" id="go-id-topick-block" data-id="<?php echo bbp_get_reply_id(); ?>">
    <div class="forum-comment__author forum-comment-author">
        <div class="forum-comment-author__avatar">
			<?php 
                $reply_id = bbp_get_reply_id();
                echo bbp_get_reply_author_avatar( $reply_id, $r['size'] ); 
            ?>
        </div>
        <div class="forum-comment-author__name">
            <?php 
                 $user_id = bbp_get_reply_author_id( $reply_id ); 
                 $user_meta = get_userdata($user_id);
                 $lastname = $user_meta->last_name;
                 $firstname = $user_meta->first_name;
                 $nickname = $user_meta->nickname;
                 $login = $user_meta->user_login;
                 $count = bbp_get_user_reply_count( bbp_get_reply_author_id( $reply_id ) );
                 
                if ($firstname) {
                    echo $firstname;
                    if ($lastname != '-') {
                        echo ' ' . $lastname;
                    }
                } else if ($nickname) {
                    echo $nickname;
                } else {
                    echo $login;
                }
            ?>
        </div>
        <div class="forum-comment-author__status"><?php echo bbp_get_reply_author_role( array( 'reply_id' => $reply_id ) ); ?></div>

        <div class="forum-comment-author__comments">
            <svg class="icon__icon-comment" width="21" height="20">
                <use href="<?php echo get_stylesheet_directory_uri(); ?>/static/img/minified-svg/svg-symbols.svg#icon-comment"></use>
            </svg>
			<?php if ($count != 0 ) { echo $count; } else {echo '1'; } ?>
        </div>
    </div>
    <div class="forum-comment__main">
        <div id="post-<?php bbp_reply_id(); ?>" class="bbp-reply-header"></div>
        <div>
			<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

			<?php bbp_reply_admin_links(); ?>

			<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
        </div>
        <div class="forum-comment__text">
			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

			<?php bbp_reply_content(); ?>

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>
            <div class="forum-comment__text__date">
                <?php bbp_reply_post_date(); ?>
            </div>
        </div>
        <button class="forum-comment__btn">Ответить</button>

		<?php //echo bbp_get_reply_to_link(); ?>

    </div>
</div>

