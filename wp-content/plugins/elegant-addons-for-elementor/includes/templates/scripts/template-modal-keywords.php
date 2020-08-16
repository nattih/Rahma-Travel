<?php
/**
 * Templates Keywords Filter
 */
?>
<#
	if ( ! _.isEmpty( keywords ) ) {
#>
<label><?php echo __('Filter by Widget / Addon', 'elegant-addons-for-elementor'); ?></label>
<select id="elementor-template-library-filter-subtype" class="elementor-template-library-filter-select premium-library-keywords" data-elementor-filter="subtype">
    <option value=""><?php echo __( 'All Widgets/Addons', 'elegant-addons-for-elementor' ); ?></option>
    <# _.each( keywords, function( title, slug ) { #>
    <option value="{{ slug }}">{{ title }}</option>
    <# } ); #>
</select>
<#
	}
#>
