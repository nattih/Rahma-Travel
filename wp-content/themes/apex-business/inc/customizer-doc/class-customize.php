<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Apex_Business_Customize_Doc {

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
		require_once get_template_directory() . '/inc/customizer-doc/section-pro.php';

		// Register custom section types.
		$manager->register_section_type( 'Apex_Business_Customize_Section_Doc' );

		// Register sections.
		$manager->add_section(
			new Apex_Business_Customize_Section_Doc(
				$manager,
				'apex-business-doc',
				array(
					'title'    => esc_html__( 'Theme Documentation', 'apex-business' ),
					'pro_text' => esc_html__( 'View Docs',  'apex-business' ),
					'pro_url'  => 'https://www.crafthemes.com/go/documentation',
					'priority' => 200
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
		require_once get_template_directory() . '/inc/customizer-doc/section-pro.php';


		wp_enqueue_script( 'apex-business-customize-controls-doc', trailingslashit( get_template_directory_uri() ) . '/inc/customizer-doc/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'apex-business-customize-controls-doc', trailingslashit( get_template_directory_uri() ) . '/inc/customizer-doc/customize-controls.css' );
	}
}

// Doing this customizer thang!
Apex_Business_Customize_Doc::get_instance();
