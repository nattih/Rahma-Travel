<?php
/**
 * The template for displaying comments
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="block">
        <?php
        // You can start editing here -- including this comment!
        if ( have_comments() ) : ?>
            <h3 class="comments-title">
                <?php comments_number(
                    esc_html__( 'No Responses', 'apex-business' ),
                    esc_html__( 'One Response', 'apex-business' ),
                    esc_html__( '% Responses', 'apex-business' )
                    );
                ?>
            </h3>

            <ul class="comment-area">
                <?php
                    wp_list_comments( array(
                        'avatar_size' => 42,
                        'style'       => 'ul',
                        'short_ping'  => true,
                    ) );
                ?>
            </ul> <!-- /.comment-area -->

            <?php the_comments_pagination( array(
                'prev_text' => esc_html__( 'Previous', 'apex-business' ),
                'next_text' => esc_html__( 'Next', 'apex-business' ),
            ) );

        endif; // Check for have_comments().

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
            <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'apex-business' ); ?></p>
        <?php
        endif;
        comment_form();
        ?>
</div><!-- #comments -->
