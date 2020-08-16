<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Apex_Business_Customize_Section_Notification extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'apex-business-notify';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $get_started_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $get_started_url = '';

	/**
	 * Custom pro description
	 */
	public $get_started_desc = '';

	/**
	 * Custom pro title
	 */
	public $get_started_title = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['get_started_title'] = $this->get_started_title;
		$json['get_started_text'] = $this->get_started_text;
		$json['get_started_url']  = esc_url( $this->get_started_url );
		$json['get_started_desc']  = $this->get_started_desc;

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
		if ( ! get_option('dismissed-customizer_get_started', FALSE ) ) {
			?>
			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}
				</h3>

				<div class="notice notice-info ct-notice-box js-customizer-notice-get-started-class" data-notice="customizer_get_started" style="position: relative; margin-top:0; margin-bottom: 1px;">
					<button type="button" id="crafthemes_customizer_get_started" class="notice-dismiss" data-action="dismiss" data-hide="hide-accordian" style="z-index: 1;"></button>

					<h3 style="padding-right: 36px">
						{{ data.get_started_title }}
					</h3>
					<p>{{ data.get_started_desc }}</p>
					<a href="{{ data.get_started_url }}" class="jquery-btn-get-started ct-customizer-getstarted button button-primary">{{ data.get_started_text }}</a>
				</div>
			</li>
			<?php }
		}
}
