import template from './sw-cms-el-config-cms-enhancements-button.html.twig';

const { Mixin } = Shopware;

/**
 * @private
 * @sw-package discovery
 */
export default {
    template,

    emits: ['element-update'],

    mixins: [
        Mixin.getByName('cms-element'),
    ],

    created() {
        this.initElementConfig('cms-enhancements-button');
    },

    computed: {
        variantOptions() {
            return [
                { value: 'primary', label: 'Primary' },
                { value: 'secondary', label: 'Secondary' },
                { value: 'success', label: 'Success' },
                { value: 'danger', label: 'Danger' },
                { value: 'warning', label: 'Warning' },
                { value: 'info', label: 'Info' },
                { value: 'light', label: 'Light' },
                { value: 'dark', label: 'Dark' },
                { value: 'link', label: 'Link' },
            ];
        },
    },

    methods: {
        emitUpdate() {
            this.$emit('element-update', this.element);
        },
    },
};
