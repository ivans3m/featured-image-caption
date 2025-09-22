// Featured Image Caption Plugin - Block Editor JavaScript

// Check if WordPress is available
if (typeof wp !== 'undefined' && wp.hooks) {
    
    // Add our custom attribute to the Featured Image block
    wp.hooks.addFilter(
        'blocks.registerBlockType',
        'featured-image-caption/add-show-caption-attribute',
        function(settings, name) {
            if (name === 'core/post-featured-image') {
                // Ensure attributes object exists
                const attributes = settings.attributes || {};
                
                return {
                    ...settings,
                    attributes: {
                        ...attributes,
                        showCaption: {
                            type: 'boolean',
                            default: false
                        }
                    }
                };
            }
            return settings;
        }
    );
    
    // Add our custom setting to the Featured Image block
    wp.hooks.addFilter(
        'editor.BlockEdit',
        'featured-image-caption/add-show-caption-setting',
        function(BlockEdit) {
            return function(props) {
                // Only add our setting to the Featured Image block
                if (props.name !== 'core/post-featured-image') {
                    return wp.element.createElement(BlockEdit, props);
                }
                
                const { attributes, setAttributes } = props;
                const { showCaption = false } = attributes;
                
                return wp.element.createElement('div', null, [
                    // Original block editor
                    wp.element.createElement(BlockEdit, props),
                    
                    // Inspector controls
                    wp.element.createElement(wp.blockEditor.InspectorControls, null,
                        wp.element.createElement(wp.components.PanelBody, {
                            title: wp.i18n.__('Featured Image Settings', 'featured-image-caption'),
                            initialOpen: true
                        },
                            wp.element.createElement(wp.components.ToggleControl, {
                                label: wp.i18n.__('Show Caption', 'featured-image-caption'),
                                help: wp.i18n.__('Display the featured image caption below the image.', 'featured-image-caption'),
                                checked: showCaption,
                                onChange: (value) => setAttributes({ showCaption: value })
                            })
                        )
                    )
                ]);
            };
        }
    );
    
    // Ensure our attribute is included in the block's save function
    wp.hooks.addFilter(
        'blocks.getSaveContent.extraProps',
        'featured-image-caption/add-save-props',
        function(props, blockType, attributes) {
            if (blockType.name === 'core/post-featured-image') {
                return {
                    ...props,
                    'data-show-caption': attributes.showCaption ? 'true' : 'false'
                };
            }
            return props;
        }
    );
    
    // Add a more reliable way to store the setting in the block content
    wp.hooks.addFilter(
        'blocks.getSaveContent',
        'featured-image-caption/add-save-content',
        function(content, blockType, attributes) {
            if (blockType.name === 'core/post-featured-image' && attributes.showCaption) {
                // Add a hidden comment to mark this block as having caption enabled
                content += '<!-- featured-image-caption-enabled -->';
            }
            return content;
        }
    );
}