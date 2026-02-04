import template from './sw-cms-el-preview-cms-enhancements-button.html.twig';
import './sw-cms-el-preview-cms-enhancements-button.scss';

const { Mixin } = Shopware;

/**
 * @private
 * @sw-package discovery
 */
export default {
    template,

    mixins: [
        Mixin.getByName('cms-element'),
    ],

    created() {
        this.initElementConfig('cms-enhancements-button');
    },
};
