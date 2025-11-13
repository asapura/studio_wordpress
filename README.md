# 🎨 Kashis Studio WordPress Theme

**Version**: 1.0.8
**Requires at least**: WordPress 6.4
**Tested up to**: WordPress 6.8
**Requires PHP**: 7.4+
**License**: GPLv2 or later
**License URI**: https://www.gnu.org/licenses/gpl-2.0.html

Modern WordPress theme for studio rental businesses, built with Atlassian Design System and Full Site Editing (FSE) support.

---

## 📋 Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Custom Blocks](#custom-blocks)
- [Shortcodes](#shortcodes)
- [Customization](#customization)
- [Development](#development)
- [Changelog](#changelog)
- [Support](#support)

---

## ✨ Features

### 🎯 Core Features
- **Full Site Editing (FSE)** - Built on WordPress Block Editor
- **Atlassian Design System** - Professional color palette and design tokens
- **Custom Post Type** - Studio Room management (`studio_room`)
- **SWELL/SANGO Level UX** - Premium theme-level user experience
- **Performance Optimized** - 61% JavaScript reduction, optimized CSS
- **Accessibility Ready** - WAI-ARIA compliant, screen reader friendly
- **Mobile Responsive** - Fully responsive on all devices
- **PHP 7.4+ Type Hints** - Modern, type-safe PHP code

### 🧱 Custom Gutenberg Blocks (6 blocks)

1. **Dynamic Room List Block** (`kashis-studio/room-list`)
   - Grid/List view toggle
   - Category filtering
   - Customizable columns (1-4)
   - Pagination support

2. **Pricing Table Block** (`kashis-studio/pricing-table`)
   - Up to 3 pricing plans
   - Featured plan highlighting
   - Customizable features list
   - Call-to-action buttons

3. **Accordion/FAQ Block** (`kashis-studio/accordion`)
   - Smooth animations
   - Multiple items support
   - Icon customization
   - Accessibility features

4. **Timeline Block** (`kashis-studio/timeline`)
   - Vertical timeline layout
   - Date/title/description
   - Icon support
   - Responsive design

5. **Testimonial Block** (`kashis-studio/testimonial`)
   - 5-star rating system
   - Customer photo support
   - Quote styling
   - Author attribution

6. **Call-to-Action Block** (`kashis-studio/cta`)
   - 4 background color variants
   - Button customization
   - Headline/description
   - Full-width option

### 🎨 Block Style Variations

#### Button Styles (5 variants)
- **Secondary** - Blue background
- **Subtle** - Transparent with border
- **Success** - Green for positive actions
- **Warning** - Yellow for caution
- **Danger** - Red for critical actions

#### Group Styles (3 variants)
- **Elevated** - Shadow and hover effects
- **Bordered** - Clean border styling
- **Flat** - Minimal background color

#### Image Styles (2 variants)
- **Circle** - Circular crop
- **Shadow** - Depth shadow effect

### 🛠️ Advanced Features

- **WordPress Customizer Integration**
  - 5 color presets (Default, Warm, Cool, Professional, Elegant)
  - Typography settings
  - Layout options
  - Live preview

- **Favorites System**
  - localStorage-based persistence
  - Heart icon toggle
  - No database required

- **Room Comparison**
  - Compare up to 3 rooms
  - Side-by-side comparison table
  - Quick feature analysis

- **Advanced Search Widget**
  - Keyword search
  - Category filtering
  - Real-time results

- **Theme Activation Wizard**
  - Welcome screen on activation
  - One-click sample content
  - Quick setup options

- **Breadcrumb Navigation**
  - Hierarchical navigation
  - Schema.org markup
  - Customizable separator

### 📦 Shortcodes (4 shortcodes)

1. `[kashis_rooms]` - Display room grid
2. `[kashis_contact]` - Contact information
3. `[kashis_hours]` - Business hours
4. `[kashis_access]` - Location/access info

### 🎬 CSS Animations (10+ animations)

- `fade-in`, `fade-up`, `fade-down`, `fade-left`, `fade-right`
- `zoom-in`, `zoom-out`
- `slide-up`, `slide-down`
- `rotate-in`

Usage: `<div data-animate="fade-up">Content</div>`

---

## 📥 Installation

### Method 1: WordPress Admin
1. Download the theme ZIP file
2. Go to **Appearance → Themes → Add New → Upload Theme**
3. Choose the ZIP file and click **Install Now**
4. Click **Activate** after installation

### Method 2: FTP Upload
1. Extract the ZIP file
2. Upload the `kashis-studio` folder to `/wp-content/themes/`
3. Go to **Appearance → Themes** and activate **Kashis Studio**

### Method 3: Git Clone (for developers)
```bash
cd /path/to/wordpress/wp-content/themes/
git clone https://github.com/yourusername/kashis-studio.git
```

---

## 🚀 Quick Start

### 1. Theme Activation
Upon activation, you'll see a **Welcome Screen** with:
- One-click sample content generation
- Quick links to Customizer
- Feature overview
- Setup wizard

### 2. Create Your First Room
1. Go to **Studio Rooms → Add New**
2. Add title, description, featured image
3. Set room category (if needed)
4. Add custom fields (optional)
5. Publish

### 3. Customize Colors
1. Go to **Appearance → Customize → Kashis Studio Settings**
2. Choose a preset or customize manually:
   - Primary Color
   - Secondary Color
   - Container Width
   - Typography
3. Click **Publish**

### 4. Add Blocks to Pages
1. Edit any page/post
2. Click **+** to add block
3. Search for "Kashis Studio" blocks
4. Configure block settings in the sidebar
5. Save and preview

---

## 🧱 Custom Blocks

### Room List Block

**Attributes:**
- `postsPerPage` (number): Number of rooms to display (default: 6)
- `columns` (number): Grid columns 1-4 (default: 3)
- `showFilters` (boolean): Show category filters (default: false)
- `orderBy` (string): Sort order - title, date, modified (default: 'date')

**Example:**
```html
<!-- wp:kashis-studio/room-list {"postsPerPage":9,"columns":3,"showFilters":true} /-->
```

### Pricing Table Block

**Attributes:**
- `plans` (string): JSON-encoded array of plan objects

**Example:**
```html
<!-- wp:kashis-studio/pricing-table /-->
```

### Accordion Block

**Attributes:**
- `items` (string): JSON-encoded array of accordion items
- `openFirst` (boolean): Open first item by default (default: false)

**Example:**
```html
<!-- wp:kashis-studio/accordion {"openFirst":true} /-->
```

---

## 🎨 Shortcodes

### [kashis_rooms]

Display a grid of studio rooms.

**Parameters:**
- `limit` (int): Number of rooms to show (default: 6)
- `category` (string): Filter by category slug
- `columns` (int): Grid columns 1-4 (default: 3)
- `style` (string): Display style - 'grid' or 'list' (default: 'grid')

**Examples:**
```php
// Show 9 rooms in 3 columns
[kashis_rooms limit="9" columns="3"]

// Show rooms from "large" category
[kashis_rooms category="large" limit="12"]

// List view with 6 rooms
[kashis_rooms style="list" limit="6"]
```

### [kashis_contact]

Display contact information.

**Example:**
```php
[kashis_contact]
```

### [kashis_hours]

Display business hours.

**Example:**
```php
[kashis_hours]
```

### [kashis_access]

Display location and access information.

**Example:**
```php
[kashis_access]
```

---

## 🎨 Customization

### Color Presets

The theme includes 5 built-in color presets:

1. **Default** - Atlassian Blue (`#0052CC`) + Green (`#00875A`)
2. **Warm** - Red (`#FF5630`) + Amber (`#FFAB00`)
3. **Cool** - Cyan (`#00B8D9`) + Blue (`#2684FF`)
4. **Professional** - Navy (`#172B4D`) + Gray (`#42526E`)
5. **Elegant** - Purple (`#6554C0`) + Lavender (`#8777D9`)

### CSS Custom Properties

The theme uses CSS variables for easy customization:

```css
:root {
  /* Colors */
  --atlassian-blue-500: #0052CC;
  --atlassian-green-500: #00875A;
  --atlassian-red-500: #DE350B;

  /* Spacing */
  --space-8: 0.5rem;
  --space-16: 1rem;
  --space-24: 1.5rem;

  /* Animation */
  --transition-fast: 150ms;
  --transition-base: 200ms;
  --transition-slow: 300ms;

  /* Shadows */
  --shadow-sm: 0 1px 1px rgba(9, 30, 66, 0.25);
  --shadow-md: 0 4px 8px rgba(9, 30, 66, 0.15);
}
```

### Child Theme

To create a child theme:

1. Create a new directory: `/wp-content/themes/kashis-studio-child/`
2. Create `style.css`:

```css
/*
Theme Name: Kashis Studio Child
Template: kashis-studio
Version: 1.0.0
*/
```

3. Create `functions.php`:

```php
<?php
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri(), array('parent-style'));
});
```

---

## 💻 Development

### File Structure

```
kashis-studio/
├── assets/
│   ├── css/
│   │   └── admin.css
│   └── js/
│       ├── theme.js
│       └── advanced-features.js
├── blocks/
│   ├── room-list/
│   ├── pricing-table/
│   ├── accordion/
│   ├── timeline/
│   ├── testimonial/
│   └── cta/
├── includes/
│   ├── admin-dashboard-widget.php
│   ├── block-patterns.php
│   ├── block-showcase.php
│   ├── blocks.php
│   ├── custom-post-types.php
│   ├── customizer.php
│   ├── helpers.php
│   ├── shortcodes.php
│   ├── theme-activation.php
│   └── widgets.php
├── parts/
│   ├── header.html
│   └── footer.html
├── patterns/
│   └── (block patterns)
├── templates/
│   ├── archive-studio_room.html
│   ├── page-full-width.html
│   ├── page-landing.html
│   └── single-studio_room.html
├── functions.php
├── style.css
├── theme.json
└── README.md
```

### Requirements

- PHP 7.4 or higher
- WordPress 6.4 or higher
- MySQL 5.7 or higher / MariaDB 10.3 or higher

### Coding Standards

- **PHP**: WordPress Coding Standards
- **CSS**: BEM methodology where applicable
- **JavaScript**: ES6+ with vanilla JS (no jQuery)
- **Type Hints**: All PHP functions use scalar type hints
- **Security**: All outputs escaped, all inputs sanitized

### Hooks

The theme provides several action hooks for extensibility:

```php
// After theme activation
do_action('kashis_studio_after_activation');

// Before rendering room list
do_action('kashis_studio_before_room_list', $query);

// After rendering room list
do_action('kashis_studio_after_room_list', $query);
```

### Filters

```php
// Modify room query arguments
apply_filters('kashis_studio_room_query_args', $args);

// Modify breadcrumb output
apply_filters('kashis_studio_breadcrumbs', $output);

// Modify customizer sections
apply_filters('kashis_studio_customizer_sections', $sections);
```

---

## 📝 Changelog

### Version 1.0.8 (2025-11-13)
- ✅ Complete refactoring completed
- ✅ Security enhancements (XSS protection, sanitization)
- ✅ Performance optimization (61% JavaScript reduction)
- ✅ Phase 1: UX Foundation (6 features)
- ✅ Phase 2: Custom Gutenberg Blocks (6 blocks)
- ✅ Phase 3: Advanced Features (6 features)
- ✅ Theme Activation Wizard
- ✅ Customizer Presets
- ✅ Block Showcase Page Generator

### Version 1.0.7 (2025-11-11)
- 🔧 Code quality improvements
- 📚 Documentation updates
- 🎨 Comment quality enhancement

### Version 1.0.0 (Initial Release)
- 🎉 Initial theme release
- 🏢 Studio Room custom post type
- 🎨 Basic styling and layout

---

## 🤝 Support

### Documentation
- [User Manual](docs/USER_MANUAL.md)
- [Developer Guide](docs/DEVELOPER_GUIDE.md)
- [Block Reference](docs/BLOCKS.md)

### Help & Issues
- GitHub Issues: [Report a bug or request a feature](https://github.com/yourusername/kashis-studio/issues)
- WordPress Support Forums: [Get community help](https://wordpress.org/support/theme/kashis-studio)

### Resources
- [WordPress Codex](https://codex.wordpress.org/)
- [Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [Atlassian Design System](https://atlassian.design/)

---

## 📄 License

This theme is licensed under the GNU General Public License v2 or later.

**License URI**: https://www.gnu.org/licenses/gpl-2.0.html

This theme bundles the following third-party resources:

- **Twenty Twenty-Four Theme** - Parent theme (GPL v2 or later)
- **Atlassian Design System** - Design tokens and color palette (Open Source)

---

## 👨‍💻 Credits

**Developed by**: Kashis Studio Team
**Design System**: Atlassian Design System
**Built with**: WordPress Full Site Editing (FSE)

---

## 🌟 Show Your Support

If you like this theme, please consider:
- ⭐ Starring the repository
- 📢 Sharing with others
- 💬 Leaving a review
- 🐛 Reporting bugs or suggesting features

---

**Made with ❤️ for Studio Rental Businesses**
