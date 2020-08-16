<?php
/**
 * Sync functions for control.
 *
 * @package customizer-controls
 */

define( 'APEX_BUSINESS_CUSTOMIZER_PAGE_EDITOR_VERSION', '1.0.0' );

/**
 * Require class file
 */
get_template_part( '/inc/customizer/customizer-page-editor/class/class-customizer-page-editor' );

/**
 * Display editor for page editor control.
 */
function apex_business_customizer_editor() {
	?>
	<div id="wp-editor-widget-container" style="display: none;">
		<a class="close" href="javascript:WPEditorWidget.hideEditor();"><span class="icon"></span></a>
		<div class="editor">
			<?php
			$settings = array(
				'textarea_rows' => 55,
				'editor_height' => 260,
			);
			wp_editor( '', 'wpeditorwidget', $settings );
			?>
			<p><a href="javascript:WPEditorWidget.updateWidgetAndCloseEditor(true);" class="button button-primary"><?php esc_html_e( 'Save and close', 'apex-business' ); ?></a></p>
		</div>
	</div>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'apex_business_customizer_editor', 1 );

/**
 * Hestia allow all HTML tags in TinyMce editor.
 *
 * @param array $init_array TinyMce settings.
 *
 * @return array
 */
function apex_business_customizer_editor_override_mce_options( $init_array ) {
	$opts                                  = '*[*]';
	$init_array['valid_elements']          = $opts;
	$init_array['extended_valid_elements'] = $opts;
	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'apex_business_customizer_editor_override_mce_options' );
