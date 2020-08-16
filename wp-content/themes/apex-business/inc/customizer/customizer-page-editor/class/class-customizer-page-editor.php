<?php
/**
 * Page editor control.
 *
 * @package customizer-controls
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class to create a custom tags control
 */
class Apex_Business_Customizer_Page_Editor extends WP_Customize_Control {

	/**
	 * Customizer_Page_Editor constructor.
	 *
	 * @param WP_Customize_Manager $manager Manager.
	 * @param string               $id Id.
	 * @param array                $args Constructor args.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['needsync'] ) ) {
			$this->needsync = $args['needsync'];
		}
	}

	/**
	 * Enqueue scripts
	 */
	public function enqueue() {
		wp_enqueue_style( 'customizer_text_editor_css', get_template_directory_uri() . '/inc/customizer/customizer-page-editor/css/customizer-page-editor.css', array(), APEX_BUSINESS_CUSTOMIZER_PAGE_EDITOR_VERSION );
		wp_enqueue_script(
			'customizer_text_editor', get_template_directory_uri() . '/inc/customizer/customizer-page-editor/js/customizer-text-editor.js', array(
				'jquery',
				'customize-preview',
			), APEX_BUSINESS_CUSTOMIZER_PAGE_EDITOR_VERSION, true
		);
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_textarea( $this->value() ); ?>" id="<?php echo esc_attr( $this->id ); ?>" class="editorfield">
			<a onclick="javascript:WPEditorWidget.toggleEditor('<?php echo esc_attr( $this->id ); ?>');" class="button edit-content-button"><?php esc_html_e( 'Edit', 'apex-business' ); ?></a>
		</label>
		<?php
	}
}
