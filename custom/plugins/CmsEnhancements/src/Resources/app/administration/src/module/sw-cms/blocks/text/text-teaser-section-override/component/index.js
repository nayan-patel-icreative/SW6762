import template from './sw-cms-block-text-teaser-section.html.twig';
import './sw-cms-block-text-teaser-section.scss';

export default {
    template,

    computed: {
        assetFilter() {
            return Shopware.Filter.getByName('asset');
        },

        backgroundMediaUrl() {
            const directUrl = this.block?.backgroundMedia?.url;
            if (directUrl) {
                return directUrl;
            }

            const value = this.block?.config?.backgroundMedia?.value;

            if (!value) {
                return null;
            }

            if (typeof value === 'string') {
                return value;
            }

            if (typeof value === 'object') {
                if (value.url) {
                    return value.url;
                }

                if (value.media && value.media.url) {
                    return value.media.url;
                }
            }

            return null;
        },

        imageUrl() {
            return (
                this.backgroundMediaUrl ||
                this.assetFilter('/administration/administration/static/img/cms/preview_camera_small.webp')
            );
        },
    },
};
