# Featured Image Caption Plugin

A simple WordPress plugin that adds caption functionality to the Featured Image block.

## Features

- Adds a "Show Caption" checkbox setting to the Featured Image block
- Displays the image caption (or title if no caption) below the featured image
- Works with the Gutenberg block editor and templates
- Clean, minimal styling that works with most themes
- Right-aligned caption with light grey color

## Installation

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Edit a post, page, or template and add a Featured Image block
4. In the block settings panel, you'll see a new "Show Caption" option

## Usage

1. Add a Featured Image block to your post, page, or template
2. Set a featured image for the post/page
3. In the block settings panel, toggle "Show Caption" to ON
4. The plugin will automatically display the image caption (or title) below the image

## How it Works

- The plugin extends the core Featured Image block with additional settings
- When "Show Caption" is enabled, it checks for a caption on the featured image
- If no caption exists, it falls back to using the image title
- The caption is displayed in a `<div class="featured-image-caption">` element
- Works with both regular posts/pages and WordPress templates

## Styling

The plugin includes default CSS styling for the caption:
- Text aligned to the right
- Light grey color (#999)
- Italic font style
- Small font size

You can easily customize the appearance by targeting the `.featured-image-caption` class in your theme's CSS. The plugin uses standard CSS specificity, so your theme styles will override the defaults.

## Requirements

- WordPress 5.0 or higher (Gutenberg block editor)
- PHP 7.0 or higher

## Author

**Ivan s3m** - [ivan.diuldia.com](https://ivan.diuldia.com)

## Version

1.0.0
