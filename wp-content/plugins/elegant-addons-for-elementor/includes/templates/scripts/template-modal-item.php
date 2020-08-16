<?php
/**
 * Template Item
 */

use ElegantAddons\Includes\Templates;
?>

<div class="elementor-template-library-template-body">
	<div class="elementor-template-library-template-screenshot">
		<div class="elementor-template-library-template-preview">
			<i class="fa fa-search-plus"></i>
		</div>
		<img src="{{ thumbnail }}" alt="{{ title }}">
	</div>
</div>
<div class="elementor-template-library-template-controls">
	<# if ( 'valid' === window.PremiumTempsData.license.status || ! pro ) { #>
        <button class="elementor-template-library-template-action premium-template-insert elementor-button elementor-button-success">
            <i class="eicon-file-download"></i>
                <span class="elementor-button-title"><?php echo __( 'Insert', 'elegant-addons-for-elementor' ); ?></span>
        </button>
	<# } else if ( pro ) { #>
            <?php
                printf(
                    '<a class="template-library-activate-license" href="%1$s" target="_blank">%2$s %3$s</a>',
                    Templates\premium_templates()->config->get('license_page'),
                    '<i class="fa fa-external-link" aria-hidden="true"></i>',
                    Templates\premium_templates()->config->get('pro_message')
                );
            ?>
    <# } #>
</div>

<!--<div class="elementor-template-library-template-name">{{{ title }}}</div>-->
