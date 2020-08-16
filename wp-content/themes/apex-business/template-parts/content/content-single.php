<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-image thumbnail-image">
            <?php the_post_thumbnail( '', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
        </div><!-- /.post-image -->
    <?php endif; ?>

    <div class="entry-container">
        <div class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

            <?php
                if ( get_theme_mod( 'apex_business_single_display_author_setting', 1 )
                    || get_theme_mod( 'apex_business_single_display_date_setting', 1 )
                    || get_theme_mod( 'apex_business_single_display_comment_setting', 1 )
                    || get_theme_mod( 'apex_business_single_display_category_setting', 1 )
                    || get_theme_mod( 'apex_business_single_display_tags_setting', 1 ) ) :
            ?>

            <?php if( !post_password_required() ) : ?>
                <ul class="entry-meta">
                    <?php if( get_theme_mod( 'apex_business_single_display_author_setting', 1 ) ) : ?>
                        <li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><span class="fa-user"></span><?php the_author(); ?></a></li>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'apex_business_single_display_date_setting', 1 ) ) : ?>
                        <li><span class="fa-calendar"></span><?php echo esc_html( get_the_date() ); ?></li>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'apex_business_single_display_comment_setting', 1 ) ) : ?>
                        <li><span class="fa-comment"></span><?php comments_popup_link( esc_html__( 'Leave a comment', 'apex-business' ), esc_html__( '1 Comment', 'apex-business' ), /* translators: number of comments */ esc_html__( '% Comments', 'apex-business' ), 'comments-link' ); ?></li>
                    <?php endif; ?>

                    <?php if( get_theme_mod( 'apex_business_single_display_category_setting', 1 ) ) : ?>
                        <li>
                            <?php
                                $apex_business_categories_list = get_the_category_list( esc_html__( ', ', 'apex-business' ) );
                                if ( $apex_business_categories_list ) {
                                    printf(
                                        /* translators: 1: SVG icon. */
                                        '<span class="fa-folder"></span>%1$s',
                                        wp_kses( $apex_business_categories_list, array( 'a' => array() ) )
                                    );
                                }
                            ?>
                        </li>
                    <?php endif; ?>

                    <?php
                        if( get_theme_mod( 'apex_business_single_display_tags_setting', 1 ) ) :
                            if( $apex_business_tags = get_the_tags() ) {
                                echo '<li><span class="fa-tags"></span>';
                                foreach( $apex_business_tags as $apex_business_tag ) {
                                    $apex_business_sep = ( $apex_business_tag === end( $apex_business_tags ) ) ? '' : ', ';
                                    echo '<a href="' . esc_url( get_term_link( $apex_business_tag, $apex_business_tag->taxonomy ) ) . '">' . esc_html( $apex_business_tag->name ) . '</a>' . esc_html( $apex_business_sep );
                                }
                                echo '</li>';
                            }
                        endif;
                    ?>
                </ul>
            <?php
                    endif;
                endif;
            ?>
        </div><!-- /.post-headline -->

        <div class="entry-content clearfix">
            <?php
                the_content(
                    sprintf(
                        /* translators: %s: Name of current post */
                        __( '<p> "%s"</p>', 'apex-business' ),
                        get_the_title()
                    )
                );
            ?>
        </div><!-- /.post-texts -->

        <?php
            wp_link_pages(
                array(
                    'before'      => '<div class="link-pages-wrap clearfix"><div class="link-pages">' . esc_html__( 'Continue Reading:', 'apex-business' ),
                    'after'       => '</div></div>',
                    'link_before' => '<span class="page-numbers button">',
                    'link_after'  => '</span>',
                )
            );

            if ( function_exists( 'apex_business_social_share_output' ) ) {
                apex_business_social_share_output();
            }

        ?>

        <div class="row ">
            <div class="post-next-prev-nav clearfix">
                <div class="col-md-6">
                    <div class="post-next-prev">
                        <p><?php previous_post_link(); ?></p>
                    </div><!-- /.post-next-prev -->
                </div><!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="post-next-nav">
                        <p><?php next_post_link(); ?></p>
                    </div><!-- /.post-next-nav -->
                </div><!-- /.col-md-6 -->
            </div><!-- /.post-next-prev-nav -->
        </div><!-- /.row -->
    </div><!-- /.entry-container -->
</div><!-- /.post -->
