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

<div class="forum-topic__comment forum-comment">
    <div class="forum-comment__author forum-comment-author">
        <div class="forum-comment-author__avatar">
			<?php echo bbp_get_reply_author_avatar( $reply_id, $r['size'] ); ?>
        </div>
        <div class="forum-comment-author__name">
            <?php 
                 $user_id = bbp_get_reply_author_id( get_the_ID() ); 
                 $user_meta = get_userdata($user_id);
                 $lastname = $user_meta->last_name;
                 $firstname = $user_meta->first_name;
                 $nickname = $user_meta->nickname;
                 $login = $user_meta->user_login;
                 
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
                <use href="svg-symbols.svg#icon-comment"></use>
            </svg>
			<?php echo bbp_get_user_reply_count( get_current_user_id() ); ?>
        </div>
    </div>
    <div class="forum-comment__main">
        <div>
			<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

			<?php bbp_reply_admin_links(); ?>

			<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>
        </div>
        <div class="forum-comment__text">
			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

			<?php bbp_reply_content(); ?>

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>
        </div>

		<?php if ( is_user_logged_in() ) : ?>

            <button class="forum-comment__btn">Ответить</button>

		<?php endif; ?>

		<?php //echo bbp_get_reply_to_link(); ?>

    </div>
</div>
