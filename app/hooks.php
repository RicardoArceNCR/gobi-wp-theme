<?php

/**
 * Theme integration hooks.
 *
 * Simple extension points for gobi-core plugin.
 * No business logic - only WordPress hooks for integration.
 */

namespace App;

/**
 * Theme is ready for plugin integration.
 *
 * Fires after theme setup, before template rendering.
 * gobi-core can use this to register its functionality.
 */
do_action('gobi_theme_ready');

/**
 * Filter theme context data.
 *
 * Allows gobi-core to inject data into all views.
 * Use in composers: apply_filters('gobi_theme_context', $context)
 */
apply_filters('gobi_theme_context', []);

/**
 * Filter available theme templates.
 *
 * Allows gobi-core to add or modify template paths.
 * Useful for custom CPT templates.
 */
apply_filters('gobi_theme_templates', []);

/**
 * Filter theme asset paths.
 *
 * Allows gobi-core to override or extend CSS/JS assets.
 */
apply_filters('gobi_theme_assets', []);

/**
 * Theme initialization complete.
 *
 * Fires after all theme setup is complete.
 * Final hook for any last-minute integrations.
 */
do_action('gobi_theme_init');
