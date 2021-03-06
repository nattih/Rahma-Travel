<?php
if (!class_exists('Resoto_Welcome')) :

    class Resoto_Welcome {

        public $tab_sections = array();
        public $theme_name = ''; // For storing Theme Name
        public $theme_version = ''; // For Storing Theme Current Version Information
        public $free_plugins = array(); // For Storing the list of the Recommended Free Plugins

        /**
         * Constructor for the Welcome Screen
         */

        public function __construct() {

            /** Useful Variables */
            $theme = wp_get_theme();
            $this->theme_name = $theme->Name;
            $this->theme_version = $theme->Version;

            /** Define Tabs Sections */
            $this->tab_sections = array(
                'getting_started' => esc_html__('Getting Started', 'resoto'),
                'recommended_plugins' => esc_html__('Recommended Plugins', 'resoto'),
                'support' => esc_html__('Support', 'resoto'),
                'free_vs_pro' => esc_html__('Free Vs Pro', 'resoto')
            );

            /** List of Recommended Free Plugins */
            $this->free_plugins = array(
                'elementor' => array(
                    'name' => 'Elementor',
                    'slug' => 'elementor',
                    'filename' => 'elementor'
                ),
                'mystical-companion' => array(
                    'name' => 'Mystical Companion',
                    'slug' => 'mystical-companion',
                    'filename' => 'mystical-companion'
                ),
                'wp-hotel-booking' => array(
                    'name' => 'WP Hotel Booking',
                    'slug' => 'wp-hotel-booking',
                    'filename' => 'wp-hotel-booking'
                ),
            );

            /* Create a Welcome Page */
            add_action('admin_menu', array($this, 'welcome_register_menu'));

            /* Enqueue Styles & Scripts for Welcome Page */
            add_action('admin_enqueue_scripts', array($this, 'welcome_styles_and_scripts'));

            /* Adds Footer Rating Text */
            add_filter('admin_footer_text', array($this, 'admin_footer_text'));

            /* Hide Notice */
            add_filter('wp_loaded', array($this, 'hide_admin_notice'), 10);

            /* Create a Welcome Page */
            add_action('wp_loaded', array($this, 'admin_notice'), 20);

            add_action('after_switch_theme', array($this, 'erase_hide_notice'));

            add_action('wp_ajax_resoto_activate_plugin', array($this, 'activate_plugin'));
        }

        /** Trigger Welcome Message Notification */
        public function admin_notice() {
            $hide_notice = get_option('resoto_hide_notice');
            if (!$hide_notice) {
                add_action('admin_notices', array($this, 'admin_notice_content'));
            }
        }

        /** Welcome Message Notification */
        public function admin_notice_content() {
            $screen = get_current_screen();

            if ('appearance_page_resoto-welcome' === $screen->id || (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) || 'theme-install' === $screen->id) {
                return;
            }

            ?>
            <div class="updated notice resoto-welcome-notice">
                <div class="resoto-welcome-notice-wrap">
                    <h2><?php esc_html_e('Congratulations!', 'resoto'); ?></h2>
                    <p><?php printf(esc_html__('%1$s is now installed and ready to use. You can learn to create the site using a straight forward Documentation.', 'resoto'), $this->theme_name); ?></p>

                    <div class="resoto-welcome-info">
                        <div class="resoto-welcome-thumb">
                            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php echo esc_attr__('Resoto', 'resoto'); ?>">
                        </div>

                        <?php
                        if ('appearance_page_hdi-demo-importer' !== $screen->id) {
                            ?>
                            <div class="resoto-welcome-import">
                                <h3><?php esc_html_e('Read Documentation', 'resoto'); ?></h3>
                                <p><?php esc_html_e('Click on the link below to learn on how to setup your site using the theme from the scratch.', 'resoto'); ?></p>
                                <p><a class="button button-primary" target="_blank" href="http://doc.mysticalthemes.com/resoto"><?php esc_html_e( 'Documentation', 'resoto' ); ?></a></p>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="resoto-welcome-getting-started">
                            <h3><?php esc_html_e('Get Started', 'resoto'); ?></h3>
                            <p><?php printf(esc_html__('Here you will find all the necessary links and settings on how to use %s.', 'resoto'), $this->theme_name); ?></p>
                            <p><a href="<?php echo esc_url(admin_url('/themes.php?page=resoto-welcome')); ?>" class="button button-primary"><?php esc_html_e('Go to Setting Page', 'resoto'); ?></a></p>
                        </div>
                    </div>

                    <a href="<?php echo wp_nonce_url(add_query_arg('resoto_hide_notice', 1), 'resoto_hide_notice_nonce', '_resoto_notice_nonce'); ?>" class="notice-close"><?php esc_html_e('Dismiss', 'resoto'); ?></a>
                </div>

            </div>
            <?php
        }

        /** Hide Admin Notice */
        public function hide_admin_notice() {
            if (isset($_GET['resoto_hide_notice']) && isset($_GET['_resoto_notice_nonce']) && current_user_can('manage_options')) {
                if (!wp_verify_nonce(wp_unslash($_GET['_resoto_notice_nonce']), 'resoto_hide_notice_nonce')) {
                    wp_die(esc_html__('Action Failed. Something is Wrong.', 'resoto'));
                }

                update_option('resoto_hide_notice', true);
            }
        }

        /** Register Menu for Welcome Page */
        public function welcome_register_menu() {
            add_theme_page(esc_html__('Welcome', 'resoto'), sprintf(esc_html__('%s Settings', 'resoto'), $this->theme_name), 'edit_theme_options', 'resoto-welcome', array($this, 'welcome_screen'));
        }

        /** Welcome Page */
        public function welcome_screen() {
            $tabs = $this->tab_sections;
            ?>
            <div class="welcome-wrap">
                <div class="welcome-main-content">
                    <?php require_once get_template_directory() . '/welcome/sections/header.php'; ?>

                    <div class="welcome-section-wrapper">
                        <?php $section = isset($_GET['section']) && array_key_exists($_GET['section'], $tabs) ? $_GET['section'] : 'getting_started'; ?>

                        <div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
                            <?php require_once get_template_directory() . '/welcome/sections/' . $section . '.php'; ?>
                        </div>
                    </div>
                </div>

                <div class="welcome-footer-content">
                    <?php require_once get_template_directory() . '/welcome/sections/footer.php'; ?>
                </div>
            </div>
            <?php
        }

        /** Enqueue Necessary Styles and Scripts for the Welcome Page */
        public function welcome_styles_and_scripts($hook) {
            if ('theme-install.php' !== $hook) {
                $importer_params = array(
                    'installing_text' => esc_html__('Installing Demo Importer Plugin', 'resoto'),
                    'activating_text' => esc_html__('Activating Demo Importer Plugin', 'resoto'),
                    'importer_page' => esc_html__('Go to Demo Importer Page', 'resoto'),
                    'importer_url' => admin_url('themes.php?page=hdi-demo-importer'),
                    'error' => esc_html__('Error! Reload the page and try again.', 'resoto'),
                );
                wp_enqueue_style('resoto-welcome', get_template_directory_uri() . '/welcome/css/welcome.css', array(), $this->theme_version);
                wp_enqueue_script('resoto-welcome', get_template_directory_uri() . '/welcome/js/welcome.js', array('plugin-install', 'updates'), $this->theme_version);
                wp_localize_script('resoto-welcome', 'importer_params', $importer_params);
            }
        }

        /* Check if plugin is installed */

        public function check_plugin_installed_state($slug, $filename) {
            return file_exists(ABSPATH . 'wp-content/plugins/' . $slug . '/' . $filename . '.php') ? true : false;
        }

        /* Check if plugin is activated */

        public function check_plugin_active_state($slug, $filename) {
            return is_plugin_active($slug . '/' . $filename . '.php') ? true : false;
        }

        /** Generate Url for the Plugin Button */
        public function plugin_generate_url($status, $slug, $file_name) {
            switch ($status) {
                case 'install':
                    return wp_nonce_url(add_query_arg(array(
                        'action' => 'install-plugin',
                        'plugin' => esc_attr($slug)
                                    ), network_admin_url('update.php')), 'install-plugin_' . esc_attr($slug));
                    break;

                case 'inactive':
                    return add_query_arg(array(
                        'action' => 'deactivate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('deactivate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                            ), network_admin_url('plugins.php'));
                    break;

                case 'active':
                    return add_query_arg(array(
                        'action' => 'activate',
                        'plugin' => rawurlencode(esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                        'plugin_status' => 'all',
                        'paged' => '1',
                        '_wpnonce' => wp_create_nonce('activate-plugin_' . esc_attr($slug) . '/' . esc_attr($file_name) . '.php'),
                            ), network_admin_url('plugins.php'));
                    break;
            }
        }

        /** Ajax Plugin Activation */
        public function activate_plugin() {
            $slug = isset($_POST['slug']) ? $_POST['slug'] : '';
            $file = isset($_POST['file']) ? $_POST['file'] : '';
            $success = false;

            if (!empty($slug) && !empty($file)) {
                $result = activate_plugin($slug . '/' . $file . '.php');
                update_option('resoto_hide_notice', true);
                if (!is_wp_error($result)) {
                    $success = true;
                }
            }
            echo wp_json_encode(array('success' => $success));
            die();
        }

        /** Adds Footer Notes */
        public function admin_footer_text($text) {
            $screen = get_current_screen();

            if ('appearance_page_resoto-welcome' == $screen->id) {
                $text = sprintf(esc_html__('Please leave us a %s rating if you like our theme . A huge thank you from MysticalThemes in advance!', 'resoto'), '<a href="https://wordpress.org/support/theme/resoto/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a>');
            }

            return $text;
        }

        /** Generate Plugin Thumb */
        public function plugin_thumb($plugin_slug) {
            if (empty($plugin_slug)) {
                return;
            }
            /** Generate a key that would hold the plugin image url */
            $key = 'resoto-' . $plugin_slug;

            /** Check transient. If it's there - use that, if not re fetch the theme */
            if (false === ( $image_url = get_transient($key) )) {
                $image_types = array('icon-256x256.png', 'icon-256x256.jpg', 'icon-128x128.png', 'icon-128x128.jpg');

                foreach ($image_types as $image_type) {
                    $image_url = 'https://ps.w.org/' . $plugin_slug . '/assets/' . $image_type;
                    if ($this->image_exist($image_url)) {
                        set_transient($key, $image_url, 60 * 60 * 24 * 30);
                        break;
                    }
                }
            }

            return $image_url;
        }

        /** Check for Available Image */
        public function image_exist($url = NULL) {
            if (!$url)
                return FALSE;

            $headers = get_headers($url);
            return stripos($headers[0], "200 OK") ? TRUE : FALSE;
        }

        public function erase_hide_notice() {
            delete_option('resoto_hide_notice');
        }

    }

    new Resoto_Welcome();

endif;
