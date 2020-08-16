<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Apex_Business_Customize_Notification {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );

		add_action( 'wp_ajax_apex_business_customizer_dismissed_notice_handler', array( $this, 'apex_business_customizer_ajax_notice_handler' ) );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once get_template_directory() . '/inc/customizer-notification/section-notification.php';

		// Register custom section types.
		$manager->register_section_type( 'Apex_Business_Customize_Section_Notification' );

		// Register sections.
		$manager->add_section(
			new Apex_Business_Customize_Section_Notification(
				$manager,
				'apex-business-notify',
				array(
					'title'    => esc_html__( 'Get Started with Apex Business', 'apex-business' ),
					'get_started_text' => esc_html__( 'Get Started with Apex Business',  'apex-business' ),
					'get_started_title' => esc_html__( 'Checkout our 19+ Pre-Made Demos',  'apex-business' ),
					'get_started_desc' => esc_html__( 'Clicking the button below will install and activate the Crafthemes demo import plugin.',  'apex-business' ),
					'priority' => 0
				)
			)
		);
	}


	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		require_once get_template_directory() . '/inc/customizer-notification/section-notification.php';

		wp_enqueue_script( 'apex-business-notify-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/customizer-notification/customize-controls.js', array( 'customize-controls' ) );
		wp_localize_script(
			'apex-business-notify-customize-controls', 'ct_customizer_notice_data', array(
				'ajaxurl'                  => admin_url( 'admin-ajax.php' ),
			)
		);

		wp_enqueue_style( 'apex-business-notify-customize-controls', trailingslashit( get_template_directory_uri() ) . '/inc/customizer-notification/customize-controls.css' );
	}


		/**
		 * AJAX handler to store the state of dismissible notices.
		 */
		public function apex_business_customizer_ajax_notice_handler() {
		    if ( isset( $_POST['type'] ) ) {
		        // Pick up the notice "type" - passed via jQuery (the "data-notice" attribute on the notice)
		        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
		        // Store it in the options table
		        update_option( 'dismissed-' . $type, TRUE );
		    }
		}
}

// Doing this customizer thng!
Apex_Business_Customize_Notification::get_instance();
