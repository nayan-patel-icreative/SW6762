import template from './sw-cms-preview-text-teaser-section.html.twig';
import './sw-cms-preview-text-teaser-section.scss';

export default {
    template,

    computed: {
        assetFilter() {
            return Shopware.Filter.getByName('asset');
        },
    },
};
