import template from './sw-cms-preview-four-column-image-text.html.twig';
import './sw-cms-preview-four-column-image-text.scss';

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
