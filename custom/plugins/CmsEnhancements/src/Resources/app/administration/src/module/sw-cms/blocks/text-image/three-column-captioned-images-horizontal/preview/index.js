import template from './sw-cms-preview-three-column-captioned-images-horizontal.html.twig';
import './sw-cms-preview-three-column-captioned-images-horizontal.scss';

/**
 * @private
 * @sw-package discovery
 */
export default {
    template,

    computed: {
        assetFilter() {
            return Shopware.Filter.getByName('asset');
        },
    },
};
