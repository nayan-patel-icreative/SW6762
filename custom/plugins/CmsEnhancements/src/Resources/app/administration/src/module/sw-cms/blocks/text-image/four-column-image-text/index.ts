/**
 * @private
 * @sw-package discovery
 */

declare const Shopware: any;

Shopware.Component.register('sw-cms-preview-four-column-image-text', () => import('./preview'));

/**
 * @private
 * @sw-package discovery
 */
Shopware.Component.register('sw-cms-block-four-column-image-text', () => import('./component'));

/**
 * @private
 * @sw-package discovery
 */
Shopware.Service('cmsService').registerCmsBlock({
    name: 'four-column-image-text',
    label: 'Four columns – image/text cards',
    category: 'text-image',

    component: 'sw-cms-block-four-column-image-text',
    previewComponent: 'sw-cms-preview-four-column-image-text',

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
                        <h2>Lorem</h2>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                        sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                        sed diam voluptua.</p>
                        `.trim(),
                    },
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
                        <h2>Ipsum</h2>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                        sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                        sed diam voluptua.</p>
                        `.trim(),
                    },
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
                        <h2>Dolor</h2>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                        sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,
                        sed diam voluptua.</p>
                        `.trim(),
                    },
                },
            },
        },

        'fourth-image': {
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

        'fourth-text': {
            type: 'text',
            default: {
                config: {
                    content: {
                        source: 'static',
                        value: `
                        <h2>Elitr</h2>
                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,
                        sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat.</p>
                        `.trim(),
                    },
                },
            },
        },
    },
});
