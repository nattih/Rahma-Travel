<div class="welcome-getting-started">
    <div class="welcome-manual-setup">
        <h3><?php echo esc_html__('Manual Setup from Customizer Panel', 'resoto'); ?></h3>
        <div class="welcome-theme-thumb">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/welcome/css/customizer-settings.gif'); ?>" alt="<?php echo esc_attr__('Resoto Demo', 'resoto'); ?>">
        </div>

        <ol>
            <li><?php echo esc_html__('Go to Appearance > Customize', 'resoto'); ?></li>
            <li><?php echo esc_html__('Click on any of the setting panels & sections.', 'resoto'); ?> </li>
            <li><?php echo esc_html__('Change the settings and options with the guidance of the documentation.', 'resoto'); ?> </li>
        </ol>
        <a class="button button-primary" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php echo esc_html__('Go to Customizer Panels', 'resoto'); ?></a>
    </div>

    <div class="welcome-demo-import">
        <h3><?php echo esc_html__('Upgrade to Pro', 'resoto'); ?><a href="https://demo.mysticalthemes.com/rezoto" target="_blank" class="button button-primary"><?php esc_html_e('View Demo', 'resoto'); ?></a></h3>
        <div class="welcome-theme-thumb">
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/screenshot.png'); ?>" alt="<?php printf(esc_html__('%s Demo', 'resoto'), $this->theme_name); ?>">
        </div>

        <div class="welcome-demo-import-text">
            <p><?php esc_html_e('Upgrade to pro to have a oneclik demo import feature.', 'resoto'); ?></p>
            <p><?php echo esc_html__('A oneclick demo import feature will enable you to import demo without needing to setup and configure the site from the scratch.', 'resoto'); ?></p>
            <a class="button button-primary" href="https://mysticalthemes.com/theme/rezoto/"><?php echo esc_html__('Upgrade Now', 'resoto'); ?></a>
        </div>
    </div>
</div>