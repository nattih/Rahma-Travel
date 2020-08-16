<?php if ( get_theme_mod( 'apex_business_navigation_last_item_setting', 'none' ) == 'search-icon' ) : ?>
    <span class="fa fa-search search-icon"></span>
<?php endif; ?>

<div class="search-dropdown search-default">
    <div class="header-search-form clearfix">
        <?php get_search_form( $echo = true ); ?>
    </div><!-- /.search-form -->
</div><!-- /.search-dropdown -->
