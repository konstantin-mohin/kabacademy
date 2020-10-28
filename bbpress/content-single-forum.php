<?php

/**
 * Single Forum Content Part
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;
?>

<?php
do_action('op_forum_view');

$query = kab_help()->forum->getPinnedTopics( get_the_ID() );

if ( $query && $query->have_posts() ) :?>
    <div class="online-club__title">ЗАКРЕПЛЕНЫЕ ТЕМЫ:</div>

    <ul class="online-club__list online-club-list online-club-list--flex">
		<?php while ( $query->have_posts() ) : $query->the_post();
			$post_count = (int) get_post_meta( get_the_ID(), '_bbp_reply_count', true ) + 1; ?>

            <li class="online-club-list__item">
                <svg class="icon__icon-comment" width="21" height="20">
                    <use href="/svg-symbols.svg#icon-comment"></use>
                </svg>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span>(<?php echo $post_count; ?>)</span>
            </li>


		<?php endwhile;
		wp_reset_postdata();
		?>
    </ul>
<?php endif; ?>

<?php do_action( 'bbp_template_before_single_forum' ); ?>

<?php if ( post_password_required() ) : ?>

	<?php bbp_get_template_part( 'form', 'protected' ); ?>

<?php else : ?>

    <!-- Notice block -->
	<?php //bbp_single_forum_description(); ?>

	<?php /* if ( bbp_has_forums() ) : ?>

			<?php bbp_get_template_part( 'loop', 'forums' ); ?>

		<?php endif; */ ?>

	<?php if ( ! bbp_is_forum_category() && bbp_has_topics() ) : ?>

		<?php bbp_get_template_part( 'loop', 'topics' ); ?>

		<?php bbp_get_template_part( 'pagination', 'topics' ); ?>

	<?php elseif ( ! bbp_is_forum_category() ) : ?>

		<?php bbp_get_template_part( 'feedback', 'no-topics' ); ?>

		<?php bbp_get_template_part( 'form', 'topic' ); ?>

	<?php endif; ?>

<?php endif; ?>

<?php do_action( 'bbp_template_after_single_forum' ); ?>

<?php if ( bbp_current_user_can_access_create_topic_form() ) : ?>

    <div id="new-topic-<?php bbp_topic_id(); ?>" class="forum-answer__form">

        <form id="new-post" name="new-post" method="post">

			<?php do_action( 'bbp_theme_before_topic_form' ); ?>

            <fieldset class="bbp-form">
                <legend>

					<?php
					if ( bbp_is_topic_edit() ) :
						printf( esc_html__( 'Now Editing &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_topic_title() );
					else :
						( bbp_is_single_forum() && bbp_get_forum_title() )
							? printf( esc_html__( 'Create New Topic in &ldquo;%s&rdquo;', 'bbpress' ), bbp_get_forum_title() )
							: esc_html_e( 'Create New Topic', 'bbpress' );
					endif;
					?>

                </legend>

				<?php do_action( 'bbp_theme_before_topic_form_notices' ); ?>

				<?php if ( ! bbp_is_topic_edit() && bbp_is_forum_closed() ) : ?>

                    <div class="bbp-template-notice">
                        <ul>
                            <li><?php esc_html_e( 'This forum is marked as closed to new topics, however your posting capabilities still allow you to create a topic.', 'bbpress' ); ?></li>
                        </ul>
                    </div>

				<?php endif; ?>

				<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>

                    <!--div class="bbp-template-notice" >
                        <ul>
                            <li><?php esc_html_e( 'Your account has the ability to post unrestricted HTML content.', 'bbpress' ); ?></li>
                        </ul>
                    </div-->

				<?php endif; ?>
				
				<br><br>

				<?php do_action( 'bbp_template_notices' ); ?>

                <div>

					<?php bbp_get_template_part( 'form', 'anonymous' ); ?>

					<?php do_action( 'bbp_theme_before_topic_form_title' ); ?>

                    <p>
                        <label for="bbp_topic_title"><?php printf( esc_html__( 'Topic Title (Maximum Length: %d):', 'bbpress' ), bbp_get_title_max_length() ); ?></label><br />
                        <input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
                    </p>

					<?php do_action( 'bbp_theme_after_topic_form_title' ); ?>

					<?php do_action( 'bbp_theme_before_topic_form_content' ); ?>

					<?php bbp_the_content( array( 'context' => 'topic' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_form_content' ); ?>

					<?php //if ( ! ( bbp_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

                        <!--p class="form-allowed-tags">
                            <label><?php printf( esc_html__( 'You may use these %s tags and attributes:', 'bbpress' ), '<abbr title="HyperText Markup Language">HTML</abbr>' ); ?></label><br />
                            <code><?php bbp_allowed_tags(); ?></code>
                        </p-->

					<?php //endif; ?>

					<?php if ( bbp_allow_topic_tags() && current_user_can( 'assign_topic_tags', bbp_get_topic_id() ) ) : ?>

						<?php do_action( 'bbp_theme_before_topic_form_tags' ); ?>

                        <p>
                            <label for="bbp_topic_tags"><?php esc_html_e( 'Topic Tags:', 'bbpress' ); ?></label><br />
                            <input type="text" value="<?php bbp_form_topic_tags(); ?>" size="40" name="bbp_topic_tags" id="bbp_topic_tags" <?php disabled( bbp_is_topic_spam() ); ?> />
                        </p>

						<?php do_action( 'bbp_theme_after_topic_form_tags' ); ?>

					<?php endif; ?>

					<?php if ( ! bbp_is_single_forum() ) : ?>

						<?php do_action( 'bbp_theme_before_topic_form_forum' ); ?>

                        <p>
                            <label for="bbp_forum_id"><?php esc_html_e( 'Forum:', 'bbpress' ); ?></label><br />
							<?php
							bbp_dropdown( array(
								'show_none' => esc_html__( '&mdash; No forum &mdash;', 'bbpress' ),
								'selected'  => bbp_get_form_topic_forum()
							) );
							?>
                        </p>

						<?php do_action( 'bbp_theme_after_topic_form_forum' ); ?>

					<?php endif; ?>

					<?php if ( current_user_can( 'moderate', bbp_get_topic_id() ) ) : ?>

						<?php do_action( 'bbp_theme_before_topic_form_type' ); ?>

                        <p>

                            <label for="bbp_stick_topic"><?php esc_html_e( 'Topic Type:', 'bbpress' ); ?></label><br />

							<?php bbp_form_topic_type_dropdown(); ?>

                        </p>

						<?php do_action( 'bbp_theme_after_topic_form_type' ); ?>

						<?php do_action( 'bbp_theme_before_topic_form_status' ); ?>

                        <p>

                            <label for="bbp_topic_status"><?php esc_html_e( 'Topic Status:', 'bbpress' ); ?></label><br />

							<?php bbp_form_topic_status_dropdown(); ?>

                        </p>

						<?php do_action( 'bbp_theme_after_topic_form_status' ); ?>

					<?php endif; ?>

					<?php if ( bbp_is_subscriptions_active() && ! bbp_is_anonymous() && ( ! bbp_is_topic_edit() || ( bbp_is_topic_edit() && ! bbp_is_topic_anonymous() ) ) ) : ?>

						<?php do_action( 'bbp_theme_before_topic_form_subscriptions' ); ?>

                        <p>
                            <input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> />

							<?php if ( bbp_is_topic_edit() && ( bbp_get_topic_author_id() !== bbp_get_current_user_id() ) ) : ?>

                                <label for="bbp_topic_subscription"><?php esc_html_e( 'Notify the author of follow-up replies via email', 'bbpress' ); ?></label>

							<?php else : ?>

                                <label for="bbp_topic_subscription"><?php esc_html_e( 'Notify me of follow-up replies via email', 'bbpress' ); ?></label>

							<?php endif; ?>
                        </p>

						<?php do_action( 'bbp_theme_after_topic_form_subscriptions' ); ?>

					<?php endif; ?>

					<?php if ( bbp_allow_revisions() && bbp_is_topic_edit() ) : ?>

						<?php do_action( 'bbp_theme_before_topic_form_revisions' ); ?>

                        <fieldset class="bbp-form">
                            <legend>
                                <input name="bbp_log_topic_edit" id="bbp_log_topic_edit" type="checkbox" value="1" <?php bbp_form_topic_log_edit(); ?> />
                                <label for="bbp_log_topic_edit"><?php esc_html_e( 'Keep a log of this edit:', 'bbpress' ); ?></label><br />
                            </legend>

                            <div>
                                <label for="bbp_topic_edit_reason"><?php printf( esc_html__( 'Optional reason for editing:', 'bbpress' ), bbp_get_current_user_name() ); ?></label><br />
                                <input type="text" value="<?php bbp_form_topic_edit_reason(); ?>" size="40" name="bbp_topic_edit_reason" id="bbp_topic_edit_reason" />
                            </div>
                        </fieldset>

						<?php do_action( 'bbp_theme_after_topic_form_revisions' ); ?>

					<?php endif; ?>

					<?php do_action( 'bbp_theme_before_topic_form_submit_wrapper' ); ?>

                    <div class="bbp-submit-wrapper">

						<?php do_action( 'bbp_theme_before_topic_form_submit_button' ); ?>

                        <button type="submit" id="bbp_topic_submit" name="bbp_topic_submit" class="button submit"><?php esc_html_e( 'Submit', 'bbpress' ); ?></button>

						<?php do_action( 'bbp_theme_after_topic_form_submit_button' ); ?>

                    </div>

					<?php do_action( 'bbp_theme_after_topic_form_submit_wrapper' ); ?>

                </div>

				<?php bbp_topic_form_fields(); ?>

            </fieldset>

			<?php do_action( 'bbp_theme_after_topic_form' ); ?>

        </form>
    </div>

<?php elseif ( bbp_is_forum_closed() ) : ?>

    <div id="forum-closed-<?php bbp_forum_id(); ?>" class="bbp-forum-closed">
        <div class="bbp-template-notice">
            <ul>
                <li><?php printf( esc_html__( 'The forum &#8216;%s&#8217; is closed to new topics and replies.', 'bbpress' ), bbp_get_forum_title() ); ?></li>
            </ul>
        </div>
    </div>

<?php else : ?>

    <div id="no-topic-<?php bbp_forum_id(); ?>" class="bbp-no-topic">
        <div class="bbp-template-notice">
            <ul>
                <li><?php is_user_logged_in()
						? esc_html_e( 'You cannot create new topics.',               'bbpress' )
						: esc_html_e( 'You must be logged in to create new topics.', 'bbpress' );
					?></li>
            </ul>
        </div>

		<?php if ( ! is_user_logged_in() ) : ?>

			<?php bbp_get_template_part( 'form', 'user-login' ); ?>

		<?php endif; ?>

    </div>

<?php endif; ?>