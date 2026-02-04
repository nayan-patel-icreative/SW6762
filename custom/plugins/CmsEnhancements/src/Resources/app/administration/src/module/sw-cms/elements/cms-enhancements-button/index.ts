/**
 * @private
 * @sw-package discovery
 */

export {};

declare const Shopware: any;

Shopware.Component.register('sw-cms-el-cms-enhancements-button', () => import('./component'));
Shopware.Component.register('sw-cms-el-preview-cms-enhancements-button', () => import('./preview'));
Shopware.Component.register('sw-cms-el-config-cms-enhancements-button', () => import('./config'));

Shopware.Service('cmsService').registerCmsElement({
    name: 'cms-enhancements-button',
    label: 'Button',
    component: 'sw-cms-el-cms-enhancements-button',
    configComponent: 'sw-cms-el-config-cms-enhancements-button',
    previewComponent: 'sw-cms-el-preview-cms-enhancements-button',
    defaultConfig: {
        label: {
            source: 'static',
            value: 'Learn more',
        },
        url: {
            source: 'static',
            value: '#',
        },
        variant: {
            source: 'static',
            value: 'primary',
        },
    },
});
