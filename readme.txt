=== Diuldia Featured Image - Show Caption ===
Contributors: ivans3m
Tags: featured image, caption, gutenberg, blocks
Requires at least: 5.0
Tested up to: 6.8
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds caption functionality to Featured Image blocks with a simple checkbox setting.

== Description ==

Diuldia Featured Image - Show Caption is a simple WordPress plugin that extends the core Featured Image block with caption functionality. When enabled, it displays the image caption (or title if no caption exists) below the featured image.

**Key Features:**

* Adds a "Show Caption" checkbox setting to the Featured Image block
* Displays the image caption (or title if no caption) below the featured image
* Works with the Gutenberg block editor and templates
* Clean, minimal styling that works with most themes
* Right-aligned caption with light grey color

**How it Works:**

* The plugin extends the core Featured Image block with additional settings
* When "Show Caption" is enabled, it checks for a caption on the featured image
* If no caption exists, it falls back to using the image title
* The caption is displayed in a `<div class="featured-image-caption">` element
* Works with both regular posts/pages and WordPress templates

**Styling:**

The plugin includes default CSS styling for the caption:
* Text aligned to the right
* Light grey color (#999)
* Italic font style
* Small font size

You can easily customize the appearance by targeting the `.featured-image-caption` class in your theme's CSS. The plugin uses standard CSS specificity, so your theme styles will override the defaults.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Edit a post, page, or template and add a Featured Image block
4. In the block settings panel, you'll see a new "Show Caption" option

== Frequently Asked Questions ==

= How do I use this plugin? =

1. Add a Featured Image block to your post, page, or template
2. Set a featured image for the post/page
3. In the block settings panel, toggle "Show Caption" to ON
4. The plugin will automatically display the image caption (or title) below the image

= Does this work with WordPress templates? =

Yes! The plugin works with both regular posts/pages and WordPress templates (like Single Post templates).

= Can I customize the caption styling? =

Yes, you can customize the appearance by targeting the `.featured-image-caption` class in your theme's CSS.

= What if my image doesn't have a caption? =

The plugin will automatically use the image title as a fallback if no caption is set.

== Screenshots ==

1. Featured Image block settings panel showing the "Show Caption" toggle
2. Frontend display of featured image with caption below

== Changelog ==

= 1.0.0 =
* Initial release
* Added Show Caption toggle to Featured Image blocks
* Displays image caption or title below featured image
* Works with Gutenberg block editor and templates
* Right-aligned caption styling with light grey color

== Upgrade Notice ==

= 1.0.0 =
Initial release of Diuldia Featured Image - Show Caption plugin.
