<?php
/**
 * Plugin Name: Featured Image Caption
 * Description: Adds caption functionality to Featured Image blocks with a simple checkbox setting.
 * Version: 1.0.0
 * Author: Ivan Diuldia
 * Author URI: https://ivan.diuldia.com
 * License: GPL v2 or later
 * Text Domain: featured-caption
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}


// Define plugin constants
define('FIC_PLUGIN_URL', plugin_dir_url(__FILE__));
define('FIC_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('FIC_VERSION', '1.0.0');

/**
 * Main plugin class
 */
class FeaturedImageCaption {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'init'));
    }
    
    /**
     * Initialize the plugin
     */
    public function init() {
        // Only work with Gutenberg block editor
        if (!function_exists('register_block_type')) {
            return;
        }
        
        // Check if we're in the admin area
        if (is_admin()) {
            $this->init_admin();
        }
        
        // Frontend functionality
        $this->init_frontend();
    }
    
    /**
     * Initialize admin functionality
     */
    private function init_admin() {
        // Add block editor assets
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_block_editor_assets'));
    }
    
    /**
     * Initialize frontend functionality
     */
    private function init_frontend() {
        // Add filter to modify featured image block output
        add_filter('render_block', array($this, 'modify_featured_image_block'), 10, 2);
        
        // Also add filter for block data (for templates)
        add_filter('render_block_data', array($this, 'modify_featured_image_block_data'), 10, 2);
        
        // Enqueue frontend styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
    }
    
    /**
     * Enqueue block editor assets
     */
    public function enqueue_block_editor_assets() {
        wp_enqueue_script(
            'featured-image-caption-editor',
            FIC_PLUGIN_URL . 'assets/editor.js',
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n', 'wp-hooks'),
            FIC_VERSION,
            true
        );
        
        wp_enqueue_style(
            'featured-image-caption-editor',
            FIC_PLUGIN_URL . 'assets/editor.css',
            array(),
            FIC_VERSION
        );
    }
    
    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        wp_enqueue_style(
            'featured-image-caption-frontend',
            FIC_PLUGIN_URL . 'assets/frontend.css',
            array(),
            FIC_VERSION
        );
    }
    
    /**
     * Modify featured image block output on frontend
     */
    public function modify_featured_image_block($block_content, $block) {
        // Only process featured image blocks
        if ($block['blockName'] !== 'core/post-featured-image') {
            return $block_content;
        }
        
        // Check if show caption is enabled
        $show_caption = false;
        
        // First check block attributes
        if (isset($block['attrs']['showCaption'])) {
            $show_caption = $block['attrs']['showCaption'];
        }
        // Check for our internal flag (for templates)
        else if (isset($block['attrs']['_fic_show_caption'])) {
            $show_caption = $block['attrs']['_fic_show_caption'];
        }
        // Check for data attribute in the HTML
        else if (strpos($block_content, 'data-show-caption="true"') !== false) {
            $show_caption = true;
        }
        // Check for our comment marker (most reliable for templates)
        else if (strpos($block_content, '<!-- featured-image-caption-enabled -->') !== false) {
            $show_caption = true;
        }
        
        if (!$show_caption) {
            return $block_content;
        }
        
        // Get the current post (works for both posts and templates)
        global $post;
        if (!$post) {
            return $block_content;
        }
        
        // Get featured image ID
        $featured_image_id = get_post_thumbnail_id($post->ID);
        if (!$featured_image_id) {
            return $block_content;
        }
        
        // Get caption or title
        $caption = $this->get_image_caption($featured_image_id);
        if (empty($caption)) {
            return $block_content;
        }
        
        // Add caption after the img tag
        $caption_html = '<div class="featured-image-caption">' . esc_html($caption) . '</div>';
        
        // Insert caption after the img tag
        $block_content = $this->insert_caption_after_img($block_content, $caption_html);
        
        return $block_content;
    }
    
    /**
     * Modify featured image block data (for templates)
     */
    public function modify_featured_image_block_data($parsed_block, $source_block) {
        // Only process featured image blocks
        if ($parsed_block['blockName'] !== 'core/post-featured-image') {
            return $parsed_block;
        }
        
        // Check if show caption is enabled in block attributes
        if (isset($parsed_block['attrs']['showCaption']) && $parsed_block['attrs']['showCaption']) {
            // Store the setting in a way that can be accessed during rendering
            $parsed_block['attrs']['_fic_show_caption'] = true;
        }
        
        return $parsed_block;
    }
    
    /**
     * Get image caption or title
     */
    private function get_image_caption($image_id) {
        // First try to get the caption
        $caption = wp_get_attachment_caption($image_id);
        
        // If no caption, use the title
        if (empty($caption)) {
            $attachment = get_post($image_id);
            if ($attachment) {
                $caption = $attachment->post_title;
            }
        }
        
        return $caption;
    }
    
    /**
     * Insert caption HTML after img tag within the same container
     */
    private function insert_caption_after_img($content, $caption_html) {
        // Find the img tag and insert caption immediately after it
        // This ensures the caption appears within the same container as the image
        $pattern = '/(<img[^>]*>)/i';
        $replacement = '$1' . $caption_html;
        
        return preg_replace($pattern, $replacement, $content, 1);
    }
}

// Initialize the plugin
new FeaturedImageCaption();
