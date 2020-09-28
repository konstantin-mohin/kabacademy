<?php

/**
 * Topics Loop - Single
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>

<div class="forum__topic forum-topic">
    <div class="forum-topic__title">
        <svg class="icon__icon-comment" width="21" height="20">
            <use href="/svg-symbols.svg#icon-comment"></use>
        </svg>
        <a href="<?php bbp_topic_permalink(); ?>"><?php bbp_topic_title(); ?></a>
        <span>( <?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?> )</span>
    </div>
</div>