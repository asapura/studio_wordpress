# 🛠️ Kashis Studio Developer Guide

**Version**: 1.0.8
**Last Updated**: 2025-11-13

This guide is intended for developers who want to extend, customize, or contribute to the Kashis Studio theme.

---

## 📋 Table of Contents

- [Getting Started](#getting-started)
- [Architecture](#architecture)
- [File Structure](#file-structure)
- [Coding Standards](#coding-standards)
- [Custom Post Types](#custom-post-types)
- [Custom Blocks](#custom-blocks)
- [Hooks & Filters](#hooks--filters)
- [Theme Customizer](#theme-customizer)
- [JavaScript APIs](#javascript-apis)
- [Performance](#performance)
- [Security](#security)
- [Testing](#testing)
- [Contributing](#contributing)

---

## 🚀 Getting Started

### Prerequisites

- **PHP**: 7.4 or higher with type hints support
- **WordPress**: 6.4 or higher
- **MySQL**: 5.7+ or MariaDB 10.3+
- **Node.js**: Not required (no build process)
- **Composer**: Optional (for development tools)

### Development Environment Setup

1. **Clone the repository**:
```bash
cd /path/to/wordpress/wp-content/themes/
git clone <repository-url> kashis-studio
cd kashis-studio
```

2. **Enable WordPress Debug Mode** in `wp-config.php`:
```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('SCRIPT_DEBUG', true);
```

3. **Install development tools** (optional):
```bash
composer require --dev squizlabs/php_codesniffer
composer require --dev wp-coding-standards/wpcs
```

4. **Activate the theme** in WordPress admin or via WP-CLI:
```bash
wp theme activate kashis-studio
```

---

## 🏗️ Architecture

### Design Patterns

The theme follows these architectural principles:

1. **Modular Architecture**: Features are separated into individual files in `includes/`
2. **No Build Process**: All blocks are PHP-based, no npm/webpack required
3. **Type-Safe PHP**: All functions use PHP 7.4+ scalar type hints
4. **DRY Principle**: Constants for repeated values
5. **Progressive Enhancement**: JavaScript enhances but doesn't break without it

### Core Concepts

- **FSE (Full Site Editing)**: Built on WordPress block editor
- **theme.json**: Central configuration for design tokens
- **Dynamic Blocks**: PHP-rendered blocks with `render_callback`
- **Atlassian Design System**: Design tokens and color palette
- **localStorage APIs**: Client-side persistence for favorites/comparison

---

## 📁 File Structure

```
kashis-studio/
├── assets/
│   ├── css/
│   │   └── admin.css              # Admin-only styles
│   └── js/
│       ├── theme.js               # Main theme JavaScript
│       └── advanced-features.js   # Favorites & comparison
│
├── blocks/                        # Custom Gutenberg blocks
│   ├── room-list/
│   │   └── block.php              # Room list block
│   ├── pricing-table/
│   │   └── block.php              # Pricing table block
│   ├── accordion/
│   │   └── block.php              # Accordion/FAQ block
│   ├── timeline/
│   │   └── block.php              # Timeline block
│   ├── testimonial/
│   │   └── block.php              # Testimonial block
│   └── cta/
│       └── block.php              # Call-to-action block
│
├── includes/                      # Core functionality
│   ├── admin-dashboard-widget.php # Admin dashboard widget
│   ├── block-patterns.php         # Block styles & patterns
│   ├── block-showcase.php         # Showcase page generator
│   ├── blocks.php                 # Block registration loader
│   ├── custom-post-types.php      # Studio Room CPT
│   ├── customizer.php             # WordPress Customizer
│   ├── helpers.php                # Helper functions
│   ├── shortcodes.php             # Theme shortcodes
│   ├── theme-activation.php       # Activation wizard
│   └── widgets.php                # Custom widgets
│
├── parts/                         # Template parts
│   ├── header.html                # Site header
│   └── footer.html                # Site footer
│
├── patterns/                      # Block patterns
│   └── (pattern files)
│
├── templates/                     # FSE templates
│   ├── archive-studio_room.html   # Room archive
│   ├── page-full-width.html       # Full-width page
│   ├── page-landing.html          # Landing page
│   └── single-studio_room.html    # Single room
│
├── docs/                          # Documentation
│   ├── DEVELOPER_GUIDE.md         # This file
│   ├── USER_MANUAL.md             # User documentation
│   └── BLOCKS.md                  # Block reference
│
├── functions.php                  # Theme entry point
├── style.css                      # Main stylesheet
├── theme.json                     # Theme configuration
└── README.md                      # Project readme
```

---

## 📐 Coding Standards

### PHP Standards

Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/) with these additions:

#### 1. Type Hints (Required)
```php
// ✅ Good - All parameters and return types declared
function kashis_studio_get_rooms(int $limit, string $category = ''): array {
    // ...
    return $rooms;
}

// ❌ Bad - No type hints
function kashis_studio_get_rooms($limit, $category = '') {
    return $rooms;
}
```

#### 2. Return Type Declarations
```php
// ✅ Good - Explicit return type
function kashis_studio_render_block(array $attributes): string {
    return '<div>...</div>';
}

// ✅ Good - Void for no return
function kashis_studio_enqueue_scripts(): void {
    wp_enqueue_script('theme-js', ...);
}
```

#### 3. Naming Conventions
- **Functions**: `kashis_studio_` prefix, snake_case
- **Classes**: `Kashis_Studio_` prefix, PascalCase
- **Constants**: `KASHIS_STUDIO_` prefix, UPPER_CASE
- **Variables**: snake_case

```php
// Functions
function kashis_studio_get_room_count(): int {}

// Classes
class Kashis_Studio_Room_Widget extends WP_Widget {}

// Constants
define('KASHIS_STUDIO_VERSION', '1.0.8');

// Variables
$room_count = 10;
```

#### 4. Security Best Practices
```php
// ✅ Sanitize inputs
$room_id = absint($_GET['room_id']);
$search_query = sanitize_text_field($_POST['search']);

// ✅ Escape outputs
echo esc_html($room_title);
echo esc_url($room_link);
echo esc_attr($room_class);

// ✅ Verify nonces
if (!wp_verify_nonce($_POST['_wpnonce'], 'kashis_action')) {
    wp_die('Security check failed');
}
```

### JavaScript Standards

- **ES6+**: Use modern JavaScript (arrow functions, const/let, template literals)
- **Vanilla JS**: No jQuery dependency
- **Strict Mode**: Use `'use strict';` at the top of files
- **JSDoc**: Document complex functions

```javascript
'use strict';

/**
 * Toggle favorite status for a room
 * @param {number} roomId - The room ID
 * @returns {boolean} New favorite status
 */
function toggleFavorite(roomId) {
    const favorites = getFavorites();
    const index = favorites.indexOf(roomId);

    if (index > -1) {
        favorites.splice(index, 1);
    } else {
        favorites.push(roomId);
    }

    saveFavorites(favorites);
    return index === -1;
}
```

### CSS Standards

- **BEM**: Use BEM methodology for component classes
- **CSS Variables**: Use theme CSS variables
- **Mobile First**: Write mobile styles first, desktop in media queries

```css
/* BEM naming */
.kashis-room-card {}
.kashis-room-card__title {}
.kashis-room-card__image {}
.kashis-room-card--featured {}

/* CSS Variables */
.button {
    background-color: var(--atlassian-blue-500);
    padding: var(--space-16);
    transition: all var(--transition-base);
}

/* Mobile First */
.kashis-room-grid {
    grid-template-columns: 1fr;
}

@media (min-width: 768px) {
    .kashis-room-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .kashis-room-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}
```

---

## 🗃️ Custom Post Types

### Studio Room CPT

Defined in `includes/custom-post-types.php`:

```php
function kashis_studio_register_post_types(): void {
    register_post_type('studio_room', array(
        'labels' => array(
            'name' => __('Studio Rooms', 'kashis-studio'),
            'singular_name' => __('Studio Room', 'kashis-studio'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'rooms'),
        'show_in_rest' => true, // Enable Gutenberg
    ));
}
add_action('init', 'kashis_studio_register_post_types');
```

### Custom Taxonomies

Add custom taxonomies for rooms:

```php
function kashis_studio_register_taxonomies(): void {
    register_taxonomy('room_category', 'studio_room', array(
        'labels' => array(
            'name' => __('Room Categories', 'kashis-studio'),
            'singular_name' => __('Room Category', 'kashis-studio'),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'room-category'),
    ));
}
add_action('init', 'kashis_studio_register_taxonomies');
```

---

## 🧱 Custom Blocks

### Creating a New Block

1. **Create block directory**: `blocks/my-block/`
2. **Create `block.php`**:

```php
<?php
/**
 * My Custom Block
 *
 * @package Kashis_Studio
 * @since 1.0.8
 */

/**
 * Register the block
 */
function kashis_studio_register_my_block(): void {
    register_block_type('kashis-studio/my-block', array(
        'attributes' => array(
            'title' => array(
                'type' => 'string',
                'default' => 'Default Title',
            ),
            'showDescription' => array(
                'type' => 'boolean',
                'default' => true,
            ),
        ),
        'render_callback' => 'kashis_studio_render_my_block',
    ));
}

/**
 * Render the block
 *
 * @param array $attributes Block attributes.
 * @return string Block HTML.
 */
function kashis_studio_render_my_block(array $attributes): string {
    $title = esc_html($attributes['title']);
    $show_description = $attributes['showDescription'];

    ob_start();
    ?>
    <div class="kashis-my-block">
        <h2><?php echo $title; ?></h2>
        <?php if ($show_description): ?>
            <p>Description here...</p>
        <?php endif; ?>
    </div>
    <style>
        .kashis-my-block {
            padding: var(--space-24);
            background: var(--atlassian-neutral-0);
            border-radius: 4px;
        }
    </style>
    <?php
    return ob_get_clean();
}
```

3. **Register in `includes/blocks.php`**:

```php
require_once get_stylesheet_directory() . '/blocks/my-block/block.php';

function kashis_studio_register_blocks(): void {
    // ... existing blocks
    kashis_studio_register_my_block();
}
```

### Block Attributes

Common attribute types:

```php
'attributes' => array(
    'stringAttr' => array(
        'type' => 'string',
        'default' => 'Default value',
    ),
    'numberAttr' => array(
        'type' => 'number',
        'default' => 10,
    ),
    'booleanAttr' => array(
        'type' => 'boolean',
        'default' => false,
    ),
    'arrayAttr' => array(
        'type' => 'array',
        'default' => array(),
    ),
    'objectAttr' => array(
        'type' => 'object',
        'default' => array(),
    ),
),
```

---

## 🔌 Hooks & Filters

### Action Hooks

#### Theme Activation
```php
/**
 * Runs after theme activation
 */
do_action('kashis_studio_after_activation');

// Usage:
add_action('kashis_studio_after_activation', function(): void {
    // Your custom activation logic
});
```

#### Before/After Room List
```php
/**
 * Before rendering room list
 *
 * @param WP_Query $query The rooms query.
 */
do_action('kashis_studio_before_room_list', $query);

/**
 * After rendering room list
 *
 * @param WP_Query $query The rooms query.
 */
do_action('kashis_studio_after_room_list', $query);

// Usage:
add_action('kashis_studio_before_room_list', function(WP_Query $query): void {
    echo '<div class="custom-wrapper">';
});
```

### Filter Hooks

#### Modify Room Query
```php
/**
 * Filter room query arguments
 *
 * @param array $args WP_Query arguments.
 * @return array Modified arguments.
 */
$args = apply_filters('kashis_studio_room_query_args', $args);

// Usage:
add_filter('kashis_studio_room_query_args', function(array $args): array {
    $args['posts_per_page'] = 12;
    return $args;
});
```

#### Modify Breadcrumbs
```php
/**
 * Filter breadcrumb output
 *
 * @param string $output Breadcrumb HTML.
 * @return string Modified HTML.
 */
$output = apply_filters('kashis_studio_breadcrumbs', $output);

// Usage:
add_filter('kashis_studio_breadcrumbs', function(string $output): string {
    return '<div class="custom-breadcrumbs">' . $output . '</div>';
});
```

#### Modify Customizer Sections
```php
/**
 * Filter customizer sections
 *
 * @param array $sections Customizer sections.
 * @return array Modified sections.
 */
$sections = apply_filters('kashis_studio_customizer_sections', $sections);

// Usage:
add_filter('kashis_studio_customizer_sections', function(array $sections): array {
    $sections['my_section'] = array(
        'title' => 'My Section',
        'priority' => 100,
    );
    return $sections;
});
```

---

## 🎨 Theme Customizer

### Adding Custom Settings

```php
/**
 * Add custom customizer settings
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function my_custom_customizer(WP_Customize_Manager $wp_customize): void {
    // Add section
    $wp_customize->add_section('my_section', array(
        'title' => __('My Settings', 'kashis-studio'),
        'panel' => 'kashis_studio_panel',
        'priority' => 100,
    ));

    // Add setting
    $wp_customize->add_setting('my_custom_color', array(
        'default' => '#0052CC',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ));

    // Add control
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'my_custom_color',
        array(
            'label' => __('Custom Color', 'kashis-studio'),
            'section' => 'my_section',
        )
    ));
}
add_action('customize_register', 'my_custom_customizer');
```

### Retrieving Settings

```php
// Get theme mod
$color = get_theme_mod('my_custom_color', '#0052CC');

// Use in CSS
function my_custom_styles(): void {
    $color = get_theme_mod('my_custom_color', '#0052CC');
    ?>
    <style>
        .my-element {
            background-color: <?php echo esc_attr($color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'my_custom_styles');
```

---

## 💻 JavaScript APIs

### Favorites API

Defined in `assets/js/advanced-features.js`:

```javascript
// Get all favorites
const favorites = Favorites.getFavorites();

// Toggle favorite
const isNowFavorite = Favorites.toggle(roomId);

// Check if favorited
const isFavorite = Favorites.isFavorite(roomId);

// Clear all favorites
Favorites.clear();
```

### Comparison API

```javascript
// Get comparison list
const compared = Comparison.getItems();

// Add to comparison
const added = Comparison.add(roomId);

// Remove from comparison
Comparison.remove(roomId);

// Check if in comparison
const isCompared = Comparison.has(roomId);

// Check if full (max 3)
const isFull = Comparison.isFull();

// Clear all
Comparison.clear();
```

### Scroll Animations

```javascript
// Initialize animations
initScrollAnimations();

// Add to element
<div data-animate="fade-up">Content</div>

// Available animations:
// fade-in, fade-up, fade-down, fade-left, fade-right
// zoom-in, zoom-out, slide-up, slide-down, rotate-in
```

---

## ⚡ Performance

### Best Practices

1. **Lazy Load Images**: Use WordPress built-in lazy loading
```html
<img src="image.jpg" loading="lazy" alt="...">
```

2. **Conditional Loading**: Only load scripts when needed
```php
if (is_singular('studio_room')) {
    wp_enqueue_script('room-details', ...);
}
```

3. **Static Caching**: Cache expensive operations
```php
function kashis_studio_get_room_count(): int {
    static $count = null;

    if ($count === null) {
        $count = wp_count_posts('studio_room')->publish;
    }

    return $count;
}
```

4. **Database Optimization**: Use efficient queries
```php
// ✅ Good - Single query with meta
$args = array(
    'post_type' => 'studio_room',
    'meta_query' => array(
        array(
            'key' => 'room_size',
            'value' => 20,
            'compare' => '>',
        ),
    ),
);

// ❌ Bad - Multiple queries in loop
foreach ($rooms as $room) {
    $size = get_post_meta($room->ID, 'room_size', true);
}
```

---

## 🔒 Security

### Input Validation

```php
// Sanitize text input
$input = sanitize_text_field($_POST['input']);

// Sanitize email
$email = sanitize_email($_POST['email']);

// Sanitize URL
$url = esc_url_raw($_POST['url']);

// Validate integers
$id = absint($_GET['id']);

// Validate arrays
$ids = array_map('absint', $_POST['ids']);
```

### Output Escaping

```php
// HTML escape
echo esc_html($text);

// Attribute escape
echo '<div class="' . esc_attr($class) . '">';

// URL escape
echo '<a href="' . esc_url($url) . '">';

// JavaScript escape
echo '<script>var data = ' . wp_json_encode($data) . ';</script>';
```

### Nonce Verification

```php
// In form
wp_nonce_field('kashis_action', 'kashis_nonce');

// In handler
if (!isset($_POST['kashis_nonce']) ||
    !wp_verify_nonce($_POST['kashis_nonce'], 'kashis_action')) {
    wp_die('Security check failed');
}
```

---

## 🧪 Testing

### PHP Syntax Check

```bash
# Check single file
php -l functions.php

# Check all PHP files
find . -name "*.php" -exec php -l {} \;
```

### Code Standards Check

```bash
# Install PHPCS
composer require --dev squizlabs/php_codesniffer
composer require --dev wp-coding-standards/wpcs

# Configure
./vendor/bin/phpcs --config-set installed_paths vendor/wp-coding-standards/wpcs

# Run check
./vendor/bin/phpcs --standard=WordPress .
```

### Manual Testing Checklist

- [ ] Theme activates without errors
- [ ] All custom blocks render correctly
- [ ] Customizer settings save and apply
- [ ] Room post type CRUD works
- [ ] Favorites persist across sessions
- [ ] Comparison works (max 3 items)
- [ ] Search widget filters correctly
- [ ] Responsive on mobile/tablet/desktop
- [ ] Accessibility (keyboard navigation, screen readers)
- [ ] Cross-browser (Chrome, Firefox, Safari, Edge)

---

## 🤝 Contributing

### Workflow

1. **Fork the repository**
2. **Create a feature branch**: `git checkout -b feature/my-feature`
3. **Make your changes** following coding standards
4. **Test thoroughly**
5. **Commit**: `git commit -m "Add my feature"`
6. **Push**: `git push origin feature/my-feature`
7. **Create a Pull Request**

### Commit Messages

Follow conventional commits:

- `feat:` New feature
- `fix:` Bug fix
- `docs:` Documentation only
- `style:` Code style changes (formatting)
- `refactor:` Code refactoring
- `perf:` Performance improvements
- `test:` Adding tests
- `chore:` Maintenance tasks

Examples:
```
feat: add room comparison widget
fix: resolve favorites localStorage bug
docs: update developer guide with hooks
refactor: extract room query to helper function
```

---

## 📚 Additional Resources

- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [Block Editor Handbook](https://developer.wordpress.org/block-editor/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Atlassian Design System](https://atlassian.design/)
- [PHP Type Declarations](https://www.php.net/manual/en/language.types.declarations.php)

---

## 💬 Support

For developer support:
- GitHub Issues: Report bugs or request features
- Developer Slack: Join our developer community
- Email: dev@kashis-studio.example.com

---

**Last Updated**: 2025-11-13
**Maintained by**: Kashis Studio Team
