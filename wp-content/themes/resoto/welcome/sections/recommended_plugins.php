<?php
$free_plugins = $this->free_plugins;

if (!empty($free_plugins)) {
    ?>
    <h3><?php echo esc_html__('Recommended Plugins', 'resoto'); ?></h3>
    <p><?php echo esc_html__('Please install these free plugins. These plugins are complementary that adds more features to the theme.', 'resoto'); ?></p>
    <div class="recomended-plugin-wrap">
        <?php
        foreach ($free_plugins as $plugin) {
            $slug = $plugin['slug'];
            $name = $plugin['name'];
            $filename = $plugin['filename'];
            ?>
            <div class="recommended-plugins">
                <div class="plugin-image">
                    <img src="<?php echo esc_url($this->plugin_thumb($slug)) ?>" />
                </div>

                <div class="plugin-title-wrap">
                    <div class="plugin-title">
                        <?php echo esc_html($name); ?>	
                    </div>

                    <div class="plugin-btn-wrapper">
                        <?php if ($this->check_plugin_installed_state($slug, $filename) && !$this->check_plugin_active_state($slug, $filename)) : ?>
                            <a target="_blank" href="<?php echo esc_url($this->plugin_generate_url('active', $slug, $filename)) ?>" class="button button-primary"><?php esc_html_e('Activate', 'resoto'); ?></a>
                        <?php elseif ($this->check_plugin_installed_state($slug, $filename)) :
                            ?>
                            <button type="button" class="button button-disabled" disabled="disabled"><?php esc_html_e('Installed', 'resoto'); ?></button>
                        <?php else :
                            ?>
                            <a target="_blank" class="install-now button-primary" href="<?php echo esc_url($this->plugin_generate_url('install', $slug, $filename)) ?>" >
                                <?php esc_html_e('Install Now', 'resoto'); ?></a>							
                            <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
    <?php
}