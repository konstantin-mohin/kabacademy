<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

do_action( 'bbp_template_before_replies_loop' ); ?>

    <a href="<?php echo home_url( get_option( '_bbp_root_slug', 'forums' ) ); ?>/forum/forum-kluba/"
       class="online-club__label">← НАЗАД НА СПИСОК ТЕМ</a>

    <div class="forum__topics">
        <div class="forum__topic forum-topic">
            <div class="forum-topic__title">
                <svg class="icon__icon-comment" width="21" height="20">
                    <use href="/svg-symbols.svg#icon-comment"></use>
                </svg>
                <a href="#"><?php the_title(); ?></a>
                <span>( <?php bbp_show_lead_topic() ? bbp_topic_reply_count() : bbp_topic_post_count(); ?> )</span>
            </div>

            <div class="forum-topic__content">

				<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

					<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

				<?php endwhile; ?>

            </div>

        </div> <!-- /.forum__topics -->
    </div>


<?php do_action( 'bbp_template_after_replies_loop' );

