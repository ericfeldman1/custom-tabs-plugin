# Custom Tabs Plugin

A custom WordPress plugin that renders a responsive, shortcode-based tabs component inspired by the provided Figma design and the interaction pattern shown on the live Riskified website.

---

# Features

- Custom WordPress plugin
- Shortcode implementation
- Interactive tab switching with JavaScript
- Reusable structured content model
- Responsive desktop and mobile layouts
- SCSS architecture compiled to CSS
- Proxima Nova font integration
- Clean, portable install with no paid dependencies required

---

# Installation

## 1. Add Plugin to WordPress

Copy the `custom-tabs-plugin` folder into:

    /wp-content/plugins/

## 2. Activate Plugin

In WordPress Admin:

**Plugins → Custom Tabs Plugin → Activate**

## 3. Install Frontend Dependencies

From the plugin root folder:

    npm install

## 4. Compile SCSS to CSS

    npm run build

---

# How to Use

Create or edit any WordPress page/post and insert the shortcode below:

    [custom_tabs]

The shortcode will render the complete tabs component.

---

# Build Process

SCSS source files are compiled into production CSS using npm scripts.

## Compile Once

    npm run build

## Watch During Development

    npm run watch

---

# Content Management Approach

The original implementation plan explored managing tab content through an ACF-powered Options Page.

During development, I found that ACF Options Pages are available only in **ACF Pro** in this environment.

Because the brief allowed using **ACF or another method**, the final implementation uses a structured PHP data array inside the plugin to manage all tab content.

This approach keeps the plugin:

- self-contained
- easy to install
- portable
- free of paid plugin dependencies

In a future iteration, the same component could be extended into:

- ACF Pro Options Page
- Custom admin settings screen
- Gutenberg block-based editing experience
- API-driven dynamic content source

---

# Fonts

This component loads the required Proxima Nova font via the provided Adobe Typekit stylesheet:

    https://use.typekit.net/wuz0gtr.css

---

# File Structure

    custom-tabs-plugin/
    ├── custom-tabs-plugin.php
    ├── README.md
    ├── package.json
    ├── .gitignore
    └── assets/
        ├── css/custom-tabs.css
        ├── scss/custom-tabs.scss
        └── js/custom-tabs.js

---

# Development Notes

The Git history reflects the development process, including:

- initial plugin scaffold
- shortcode architecture
- tab interaction logic
- styling iterations
- responsive improvements
- ACF options page exploration
- final self-contained content model
- documentation and build setup

---

# Browser / Theme Compatibility

Built for modern WordPress environments and tested as a standard frontend plugin component.

Some themes apply default content-width constraints. The component includes styles to break out of constrained containers and render full-width as designed.

---

# Author

Eric Feldman