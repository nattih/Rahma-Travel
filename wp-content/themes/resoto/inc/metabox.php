<?php
	/** Resoto Metaboxes **/
	add_action('add_meta_boxes', 'resoto_add_metabox' );
	if( !function_exists( 'resoto_add_metabox' ) ) {
		function resoto_add_metabox() {
			add_meta_box(
				'resoto_lite_sidebar',
				esc_html__( 'Sidebar Layout', 'resoto' ),
				'resoto_sidebar_layout',
				'page',
				'normal',
				'high'
			);
		}
	}

	function resoto_sidebar_layout(){
        global $post;
        $resoto_page_layouts = array(
    	    'no-sidebar' => array(
    	        'value' => 'no-sidebar',
    	        'label' => esc_html__( 'No sidebar', 'resoto' ),
    	        'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
    	    ),
    	    'right-sidebar' => array(
    	        'value'     => 'right-sidebar',
    	        'label'     => esc_html__( 'Right Sidebar', 'resoto' ),
    	        'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
    	    ), 
    	);
        wp_nonce_field( basename( __FILE__ ), 'resoto_page_layout_nonce' );
    
        $resoto_page_layout = get_post_meta( $post->ID, 'resoto_page_layout', true );
    	$resoto_page_layout = $resoto_page_layout ? $resoto_page_layout : 'no-sidebar';
        ?>
        
        <div class="page-meta-layouts">
        	<p><?php esc_html_e( 'Choose a Sidebar Layout for the page', 'resoto' ); ?></p>
            <?php foreach( $resoto_page_layouts as $layout ) : ?>
            	<?php
            		$span_class = '';
            		$span_class = ( $resoto_page_layout == $layout['value'] ) ? 'active' : '';
            	?>
            	<span data-layout="<?php echo esc_attr($layout['value']); ?>" class="<?php echo esc_attr($span_class); ?>">
            		<img src="<?php echo esc_url($layout['thumbnail']); ?>">
            	</span>
            <?php endforeach; ?>
    
            <input type="hidden" id="resoto_page_layout" name="resoto_page_layout" value="<?php echo esc_attr($resoto_page_layout); ?>">
        </div>
    	<?php
    }

    function resoto_save_sidebar_layout( $post_id ) {
	    global $post; 
	    $sidebars = array('no-sidebar', 'right-sidebar');
	    // Verify the nonce before proceeding.
	    if ( !isset( $_POST[ 'resoto_page_layout_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ 'resoto_page_layout_nonce' ] ) ), basename( __FILE__ ) ) ) {
	        return;
	    }

	    // Stop WP from clearing custom fields on autosave
	    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE){
	        return;
	    }

	    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type']) {  
	        if (!current_user_can( 'edit_page', $post_id ) )  
	        return $post_id;  
	    }
	    $resoto_page_layout = isset( $_POST['resoto_page_layout'] ) ? sanitize_text_field( wp_unslash($_POST['resoto_page_layout']) ) : 'no-sidebar';

	    if( in_array( $resoto_page_layout, $sidebars) ) {
        	update_post_meta($post_id, 'resoto_page_layout', $resoto_page_layout);  
	    }
	}
	add_action('save_post', 'resoto_save_sidebar_layout' );