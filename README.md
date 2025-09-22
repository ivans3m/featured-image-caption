# Featured Image - Show Caption

A simple WordPress plugin that adds caption functionality to the Featured Image block.

[![WordPress](https://img.shields.io/badge/WordPress-5.0+-blue.svg)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.0+-green.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-GPLv2-red.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

## Features

- ✅ Adds a "Show Caption" checkbox setting to the Featured Image block
- ✅ Displays the image caption (or title if no caption) below the featured image
- ✅ Works with the Gutenberg block editor and templates
- ✅ Clean, minimal styling that works with most themes
- ✅ Right-aligned caption with light grey color

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

## Screenshots

1. Featured Image block settings panel showing the "Show Caption" toggle
2. Frontend display of featured image with caption below

## Changelog

### 1.0.0
- Initial release
- Added Show Caption toggle to Featured Image blocks
- Displays image caption or title below featured image
- Works with Gutenberg block editor and templates
- Right-aligned caption styling with light grey color

## FAQ

### How do I use this plugin?

1. Add a Featured Image block to your post, page, or template
2. Set a featured image for the post/page
3. In the block settings panel, toggle "Show Caption" to ON
4. The plugin will automatically display the image caption (or title) below the image

### Does this work with WordPress templates?

Yes! The plugin works with both regular posts/pages and WordPress templates (like Single Post templates).

### Can I customize the caption styling?

Yes, you can customize the appearance by targeting the `.featured-image-caption` class in your theme's CSS.

### What if my image doesn't have a caption?

The plugin will automatically use the image title as a fallback if no caption is set.

## Author

**Ivan Diuldia** - [ivan.diuldia.com](https://ivan.diuldia.com)

## License

This project is licensed under the GPLv2 License - see the [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html) file for details.

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Support

If you have any questions or need help with this plugin, please [open an issue](https://github.com/ivans3m/featured-image-caption/issues) on GitHub.