<?php
/**
 * Template part for displaying post blog posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( esc_attr( apex_business_blog_layout() ) ); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="blog-image image-container thumbnail-image">
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php the_post_thumbnail( '', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
            </a>
            <?php if ( get_theme_mod( 'apex_business_display_date_setting', 1 ) ) : ?>
                <span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
            <?php endif; ?>
        </div><!-- /.image-container -->
    <?php endif; ?>

    <div class="entry-container">
        <div class="entry-header">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="author-container">
                    <div class="author-border"></div><!-- /.author-border -->
                    <div class="author-img">
                        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ) ); ?></a>
                    </div><!-- /.author-img -->
                </div><!-- /.author-container -->
            <?php endif; ?>

            <?php
                the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
            ?>

            <ul class="entry-meta">
                <?php if( get_theme_mod( 'apex_business_display_author_setting', 1 ) ) : ?>
                    <li><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><span class="fa-user"></span><?php the_author(); ?></a></li>
                <?php endif; ?>

                <?php
                     if ( get_theme_mod( 'apex_business_display_date_setting', 1 ) ) :
                        if ( !has_post_thumbnail() ) :
                            echo '<li><span class="fa-calendar post-date"></span><a href="' . esc_html( get_the_permalink() ) . '">' . esc_html( get_the_date() ) . '</a></li>';
                        endif;
                    endif;
                ?>

                <?php if( get_theme_mod( 'apex_business_display_comment_setting', 1 ) ) : ?>
                    <li><span class="fa-comment"></span><?php comments_popup_link( esc_html__( 'Leave a comment', 'apex-business' ), esc_html__( '1 Comment', 'apex-business' ), /* translators: number of comments */ esc_html__( '% Comments', 'apex-business' ), 'comments-link' ); ?></li>
                <?php endif; ?>


                <?php if( get_theme_mod( 'apex_business_display_category_setting', 1 ) ) : ?>
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

                    if ( get_theme_mod( 'apex_business_display_tags_setting', 1 ) ) :
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
            </ul><!-- /.entry-meta -->
        </div><!-- /.entry-header -->
        <div class="entry-content">
            <?php
                if ( get_theme_mod( 'apex_business_post_content_style_setting', 'excerpt' ) == 'excerpt' ) {
                    the_excerpt();
                } else {
                    the_content();
                }

                if ( get_theme_mod( 'apex_business_readmore_link_switch_setting', 1 ) ) {
                    echo '<a class="read-more ' . esc_attr( apex_business_dynamic_class( 'apex_business_readmore_button_setting', 'button', 0 ) ) . '" href="' . esc_url ( get_the_permalink() ) . '">' . esc_html ( get_theme_mod( 'apex_business_readmore_text_setting', __( 'Read More', 'apex-business' ) ) ) . '</a>' ;
                }
            ?>
        </div><!-- /.entry-content -->
    </div><!-- /.entry-container -->
</div><!-- /.col-md-4 .grid-item -->
