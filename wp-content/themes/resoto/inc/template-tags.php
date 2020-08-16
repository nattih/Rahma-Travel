<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Resoto
 */

if ( ! function_exists( 'resoto_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function resoto_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'resoto_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function resoto_posted_by( $author_avatar ) {
		?>
		<span class="posted-by">
			<?php if( $author_avatar ) : ?>
				<?php echo wp_kses_post( get_avatar( get_the_author_meta( 'user_email' ), 30 ) ); ?>
			<?php endif; ?>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
				<?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?>	
			</a>
		</span>
		<?php
	}
endif;

if( ! function_exists( 'resoto_posted_category' ) ) :
	/**
	* Prints first Category of the post
	*/
	function resoto_posted_category( $post_id ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'resoto' ) );
			if ( $categories_list ) {
				?>
				<span class="cat-links"><?php echo wp_kses( $categories_list, array( 'a' => array( 'href' => array(), 'rel' => array() ) ) ); ?></span>
				<?php
			}
		}
	}

endif;

if ( ! function_exists( 'resoto_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function resoto_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'resoto' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'resoto' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'resoto' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'resoto' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'resoto' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'resoto' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'resoto_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function resoto_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

/** Comment Icon Box **/
function resoto_comment_box() {
	if( get_comments_number() ) :
	?>
		<span class="post-comments">
			<i class="lni-bubble"></i>
			<?php comments_number( 'no responses', 'one response', '% responses' ); ?>
		</span>
	<?php
	endif;
}

/** Get Page Title According to the page type **/
function resoto_get_page_title() {
	$post = get_queried_object();
	if( is_single() || is_page() || is_home() ) {
		return $post->post_title;
	} elseif( is_archive() ) {
		return get_the_archive_title();
	} elseif( is_search() ) {
		/* translators: %s: search query. */
		printf( esc_html__( 'Search Results for: %s', 'resoto' ), '<span>' . get_search_query() . '</span>' );
	} elseif( is_404() ) {
		esc_html_e( 'Page Not Found', 'resoto' );
	}

}