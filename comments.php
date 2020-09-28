<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kabacedemy
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="mak-comments-csection comments-area">

    <?php if (have_comments()) : ?>

        <?php the_comments_navigation(); ?>

        <ol class="mak-comments-clist comment-list">
            <?php
            wp_list_comments(
              array(
                'style' => 'div',
                'short_ping' => true,
                'avatar_size' => 50,
              )
            );
            ?>
        </ol><!-- .comment-list -->

        <?php the_comments_navigation(); if (!comments_open()) : ?>
        
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'kabacedemy'); ?></p>
            
        <?php endif; ?>
    
    
    <?php endif; // Check for have_comments().

        comment_form();
    ?>

</div><!-- #comments -->
