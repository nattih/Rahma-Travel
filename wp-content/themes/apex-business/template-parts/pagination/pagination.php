<?php
    /**
     * Pagination for blog.
     */

    global $wp_query;
    $apex_business_big = 999999999; // need an unlikely integer

    if ( $wp_query->max_num_pages <= 1 ) {
        return;
    }
?>


<div class="row">
    <div class="col-md-12">
           <?php
                the_posts_pagination( array(
                    'base' => str_replace( $apex_business_big, '%#%', esc_url(get_pagenum_link( $apex_business_big ) ) ),
                    'format' => '?paged=%#%',
                    'add_args' => false,
                    'current' => max( 1, get_query_var( 'paged' ) ),
                    'total' => $wp_query->max_num_pages,
                    'mid_size' => 4,
                    'prev_text' => __( '<span class="pagination-prev fa-chevron-left"></span>', 'apex-business' ),
                    'next_text' => __( '<span class="pagination-next fa-chevron-right"></span>', 'apex-business' ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'apex-business' ) . ' </span>',
                ) );
            ?>
    </div><!-- /.col-md-12 -->
</div><!-- /.row -->
