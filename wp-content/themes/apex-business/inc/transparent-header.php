<?php

/**
* Transparent Header Metabox Option
*/

add_action( 'add_meta_boxes', 'apex_business_add_meta_box' );
add_action( 'save_post', 'apex_business_save_header_option_data' );

function apex_business_add_meta_box() {
    $name = esc_html__( 'Header Option', 'apex-business' );
    add_meta_box( 'header_option', $name, 'apex_business_header_option_callback', 'page', 'side' );
}

function apex_business_header_option_callback( $post ) {
    wp_nonce_field( 'apex_business_save_header_option_data', 'apex_business_header_option_meta_box_nonce' );

    $value = ( !empty( get_post_meta( $post->ID, '_header_option_value_key', true ) ) ) ? get_post_meta( $post->ID, '_header_option_value_key', true ) : 'ct-default';

    echo '<label for="apex_business_page_header_field">' . esc_html__( 'Page Header:', 'apex-business' ) . '</label><br>';
    ?>
        <form>
          <input type="radio" name="apex_business_header_option" value="ct-default" <?php checked( esc_attr( $value ), 'ct-default' ); ?>><?php esc_html_e( 'Default', 'apex-business' ); ?>
          <input type="radio" name="apex_business_header_option" value="ct-transparent-header" <?php checked( esc_attr( $value ), 'ct-transparent-header' ); ?>><?php esc_html_e( 'Transparent', 'apex-business' ); ?>
        </form>
    <?php
}

function apex_business_save_header_option_data( $post_id ) {

    if( ! isset( $_POST['apex_business_header_option_meta_box_nonce'] ) ){
        return;
    }

    if( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['apex_business_header_option_meta_box_nonce'] ) ), 'apex_business_save_header_option_data') ) {
        return;
    }

    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        return;
    }

    if( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if( ! isset( $_POST['apex_business_header_option'] ) ) {
        return;
    }

    $my_data = sanitize_text_field( wp_unslash( $_POST['apex_business_header_option'] ) );

    update_post_meta( $post_id, '_header_option_value_key', $my_data );

}
