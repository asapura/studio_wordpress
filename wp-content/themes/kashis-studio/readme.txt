=== Kashis Studio ===
Contributors: kashisstudio
Tags: studio, rental, block-editor, full-site-editing, accessibility-ready
Requires at least: 6.4
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Modern WordPress theme for studio rental businesses with Full Site Editing support and Atlassian Design System.

== Description ==

Kashis Studio is a modern, professional WordPress theme specifically designed for studio rental businesses. Built with the latest WordPress Full Site Editing (FSE) technology and the Atlassian Design System, it provides a beautiful, fast, and easy-to-use solution for showcasing your studio spaces.

= Key Features =

* **Full Site Editing (FSE)** - Built entirely on the WordPress Block Editor
* **6 Custom Blocks** - Specialized blocks for studio rental content
* **Atlassian Design System** - Professional color palette and design tokens
* **Performance Optimized** - 61% JavaScript reduction, optimized CSS
* **Accessibility Ready** - WAI-ARIA compliant, keyboard navigation, screen reader friendly
* **Mobile Responsive** - Looks perfect on all devices
* **Custom Post Type** - Dedicated Studio Room post type
* **5 Color Presets** - Quick theme styling with one click
* **PHP 7.4+ Type Hints** - Modern, type-safe PHP code
* **No Build Process** - Works out of the box, no npm/webpack needed

= Custom Blocks =

1. **Room List Block** - Display studio rooms in grid or list view with filtering
2. **Pricing Table Block** - Beautiful pricing plans with featured highlighting
3. **Accordion/FAQ Block** - Collapsible Q&A sections
4. **Timeline Block** - Show history or process steps
5. **Testimonial Block** - Customer reviews with 5-star ratings
6. **Call-to-Action Block** - Prominent conversion sections

= Advanced Features =

* **WordPress Customizer Integration** - Live preview of color and layout changes
* **Favorites System** - Let visitors save favorite rooms (localStorage-based)
* **Room Comparison** - Compare up to 3 rooms side-by-side
* **Advanced Search Widget** - Keyword and category filtering
* **Theme Activation Wizard** - Quick setup on first activation
* **Breadcrumb Navigation** - Hierarchical site navigation
* **Scroll Animations** - 10+ CSS animations for engaging content

= Block Style Variations =

* **Button Styles** (5 variants) - Secondary, Subtle, Success, Warning, Danger
* **Group Styles** (3 variants) - Elevated, Bordered, Flat
* **Image Styles** (2 variants) - Circle, Shadow

= Shortcodes =

* `[kashis_rooms]` - Display room grid with customizable options
* `[kashis_contact]` - Contact information display
* `[kashis_hours]` - Business hours table
* `[kashis_access]` - Location and access information

= Perfect For =

* Recording studios
* Photography studios
* Dance studios
* Yoga studios
* Meeting rooms
* Event spaces
* Creative workspaces
* Any rental space business

= Documentation =

* User Manual: docs/USER_MANUAL.md
* Developer Guide: docs/DEVELOPER_GUIDE.md
* Block Reference: docs/BLOCKS.md
* Main README: README.md

== Installation ==

= Automatic Installation =

1. Log in to your WordPress admin panel
2. Go to Appearance > Themes > Add New
3. Search for "Kashis Studio"
4. Click "Install" and then "Activate"

= Manual Installation =

1. Download the theme ZIP file
2. Log in to your WordPress admin panel
3. Go to Appearance > Themes > Add New > Upload Theme
4. Choose the ZIP file and click "Install Now"
5. Click "Activate" after installation completes

= After Activation =

1. You'll see a Welcome Screen with setup options
2. Click "Generate Sample Content" to create example rooms (optional)
3. Go to Appearance > Customize to choose colors and settings
4. Visit Studio Rooms > Add New to create your first room
5. Start building pages with custom blocks!

== Frequently Asked Questions ==

= Do I need coding skills to use this theme? =

No! All features can be used through the WordPress admin interface. The theme is designed for non-technical users while still being developer-friendly.

= Is the theme translation-ready? =

Yes, the theme is fully translation-ready with text domain 'kashis-studio'. You can use plugins like Loco Translate to create translations.

= Does it work with page builders? =

Yes, though the theme is optimized for the native WordPress Block Editor (Gutenberg). It works with popular page builders like Elementor and Beaver Builder.

= Can I use this for other types of businesses? =

While designed specifically for studio rentals, the theme can be adapted for other rental businesses, event spaces, or service-based businesses.

= Does the theme include booking functionality? =

No, but it integrates well with popular booking plugins like Booking Calendar, WooCommerce Bookings, and Amelia.

= Is it compatible with WooCommerce? =

Yes, the theme is compatible with WooCommerce, though it's not specifically styled for e-commerce.

= What's the parent theme? =

The theme extends Twenty Twenty-Four, the official WordPress default theme for 2024.

= How do I change colors? =

Go to Appearance > Customize > Kashis Studio Settings > Colors. Choose from 5 presets or customize manually.

= Can I create a child theme? =

Yes! See the Developer Guide (docs/DEVELOPER_GUIDE.md) for instructions on creating a child theme.

= Where can I get support? =

* Documentation in the docs/ folder
* WordPress.org support forums
* GitHub issues for bug reports

== Screenshots ==

1. Homepage with Room List block and modern design
2. Single room page with full details and booking CTA
3. Pricing Table block showing three plans
4. FAQ page with Accordion block
5. WordPress Customizer with theme settings
6. Admin dashboard with custom widget
7. Mobile responsive design
8. Testimonial block with customer reviews

== Changelog ==

= 1.0.8 - 2025-11-13 =
* Complete refactoring completed
* Security enhancements (XSS protection, input sanitization, output escaping)
* Performance optimization (61% JavaScript reduction)
* Phase 1: UX Foundation (6 features)
  - Block style variations (Button, Group, Image)
  - theme.json extension (animation, elevation, presets)
  - Custom templates (archive, full-width, landing)
  - Admin dashboard widget
  - Enhanced shortcodes (4 shortcodes)
  - CSS animations (10+ animations)
* Phase 2: Custom Gutenberg Blocks (6 blocks)
  - Dynamic Room List block
  - Pricing Table block
  - Accordion/FAQ block
  - Timeline block
  - Testimonial block
  - Call-to-Action block
* Phase 3: Advanced Features (6 features)
  - WordPress Customizer integration
  - Advanced search widget
  - Favorites system (localStorage)
  - Room comparison feature
  - Enhanced navigation (breadcrumbs)
  - Performance optimization
* Theme Activation Wizard
* Customizer Presets (5 color schemes)
* Block Showcase Page Generator
* Comprehensive documentation (User Manual, Developer Guide)
* Security improvements (number escaping in blocks)

= 1.0.7 - 2025-11-11 =
* Code quality improvements
* Documentation updates
* Comment quality enhancement

= 1.0.0 - Initial Release =
* Initial theme release
* Studio Room custom post type
* Basic styling and layout
* FSE template support

== Upgrade Notice ==

= 1.0.8 =
Major update with 27 new components, enhanced security, performance improvements, and comprehensive documentation. Recommended for all users.

= 1.0.7 =
Code quality improvements and documentation updates.

== Credits ==

= Third-Party Resources =

* Twenty Twenty-Four - Parent theme (GPL v2 or later)
  https://wordpress.org/themes/twentytwentyfour/

* Atlassian Design System - Design tokens and color palette (Open Source)
  https://atlassian.design/

= Development =

* Developed by: Kashis Studio Team
* Built with: WordPress Full Site Editing (FSE)
* Design System: Atlassian Design System
* Type Safety: PHP 7.4+ scalar type hints
* Performance: Optimized vanilla JavaScript (no jQuery)

== Copyright ==

Kashis Studio WordPress Theme, Copyright 2025 Kashis Studio Team
Kashis Studio is distributed under the terms of the GNU GPL v2 or later.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/gpl-2.0.html.

== Privacy Policy ==

Kashis Studio uses localStorage for the Favorites and Room Comparison features. This data is stored locally in the user's browser and is never transmitted to any server. No personal data is collected or processed by the theme itself.

For full privacy information, please refer to your WordPress installation's privacy policy settings.
