<?php
/**
 * Admin Panel and Settings (Module Loader)
 *
 * This file loads admin-related modules for better organization and maintainability.
 *
 * @package Kashis_Studio
 * @since 1.0.7
 */

// Load admin modules
require_once get_stylesheet_directory() . '/includes/admin-settings.php';
require_once get_stylesheet_directory() . '/includes/admin-dummy-data.php';
require_once get_stylesheet_directory() . '/includes/admin-help.php';
require_once get_stylesheet_directory() . '/includes/admin-dashboard-widget.php';
