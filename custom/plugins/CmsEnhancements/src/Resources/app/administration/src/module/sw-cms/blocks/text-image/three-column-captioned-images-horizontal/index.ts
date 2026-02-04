/**
 * @private
 * @sw-package discovery
 */

export {};

declare const Shopware: any;

Shopware.Component.register(
    'sw-cms-preview-three-column-captioned-images-horizontal',
    () => import('./preview'),
);

/**
 * @private
 * @sw-package discovery
 */
Shopware.Component.register(
    'sw-cms-block-three-column-captioned-images-horizontal',
    () => import('./component'),
);

/**
 * @private
 * @sw-package discovery
 */
Shopware.Service('cmsService').registerCmsBlock({
    name: 'three-column-captioned-images-horizontal',
    label: 'Three columns – captioned images (horizontal) + button',
    category: 'text-image',

    component: 'sw-cms-block-three-column-captioned-images-horizontal',
    previewComponent: 'sw-cms-preview-three-column-captioned-images-horizontal',

    defaultConfig: {
        marginBottom: '20px',
        marginTop: '20px',
        marginLeft: null,
        marginRight: null,
        sizingMode: 'boxed',
    },

    slots: {
        'left-image': {
            type: 'image',
            default: {
                config: {
                    displayMode: { source: 'static', value: 'cover' },
                },
                data: {
                    media: {
                        value: Shopware.Constants.CMS.MEDIA.previewCamera,
                        source: 'default',
                    },
                },
            },
        },
        'left-text': {
            type: 'text',
            default: {
                config: {
                    content: {
                        source: 'static',
                        value: `
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum dolor sit amet elitr.</p>
                        `.trim(),
                    },
                },
            },
        },
        'left-button': {
            type: 'cms-enhancements-button',
            default: {
                config: {
                    label: { source: 'static', value: 'Learn more' },
                    url: { source: 'static', value: '#' },
                    variant: { source: 'static', value: 'primary' },
                },
            },
        },

        'center-image': {
            type: 'image',
            default: {
                config: {
                    displayMode: { source: 'static', value: 'cover' },
                },
                data: {
                    media: {
                        value: Shopware.Constants.CMS.MEDIA.previewPlant,
                        source: 'default',
                    },
                },
            },
        },
        'center-text': {
            type: 'text',
            default: {
                config: {
                    content: {
                        source: 'static',
                        value: `
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum dolor sit amet elitr.</p>
                        `.trim(),
                    },
                },
            },
        },
        'center-button': {
            type: 'cms-enhancements-button',
            default: {
                config: {
                    label: { source: 'static', value: 'Learn more' },
                    url: { source: 'static', value: '#' },
                    variant: { source: 'static', value: 'primary' },
                },
            },
        },

        'right-image': {
            type: 'image',
            default: {
                config: {
                    displayMode: { source: 'static', value: 'cover' },
                },
                data: {
                    media: {
                        value: Shopware.Constants.CMS.MEDIA.previewGlasses,
                        source: 'default',
                    },
                },
            },
        },
        'right-text': {
            type: 'text',
            default: {
                config: {
                    content: {
                        source: 'static',
                        value: `
                        <h3>Lorem ipsum</h3>
                        <p>Lorem ipsum dolor sit amet elitr.</p>
                        `.trim(),
                    },
                },
            },
        },
        'right-button': {
            type: 'cms-enhancements-button',
            default: {
                config: {
                    label: { source: 'static', value: 'Learn more' },
                    url: { source: 'static', value: '#' },
                    variant: { source: 'static', value: 'primary' },
                },
            },
        },
    },
});
