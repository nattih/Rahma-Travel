<?php

function CT_CTDI_import_files() {

    $premium_buy_url = 'https://www.crafthemes.com/theme/minimalist-blog-pro/';

    return array(
        array(
            'import_file_name'           => __( 'Free Version', 'ct-ctdi' ),
            'categories'                 => array( 'Blog' ),
            'import_file_url'            => 'https://dc.crafthemes.com/minimalist/free/minimalistblog.xml',
            'import_widget_file_url'     => 'https://www.crafthemes.com/wp-content/uploads/2019/04/minimalist-pro-widgets.wie',
            'import_preview_image_url'   => 'https://www.crafthemes.com/wp-content/uploads/edd/2019/03/screenshot.png',
            'preview_url'                => 'https://www.crafthemes.com/go/minimalist-demo',
        ),
        array(
            'import_file_name'           => __( 'Premium Version', 'ct-ctdi' ),
            'categories'                 => array( 'Blog' ),
            'import_file_url'            => 'https://dc.crafthemes.com/minimalist/pro/minimalistpro.xml',
            'import_customizer_file_url' => 'https://dc.crafthemes.com/minimalist/pro/minimalist-pro-customizer.dat',
            'import_widget_file_url'     => 'https://dc.crafthemes.com/minimalist/pro/minimalist-pro-widgets.wie',
            'import_preview_image_url'   => 'https://www.crafthemes.com/wp-content/uploads/edd/2019/04/minimalist-pro.png',
            'preview_url'                => 'https://www.crafthemes.com/go/minimalist-pro-demo',
            'premium_url'                => $premium_buy_url,
        ),
    );
}
