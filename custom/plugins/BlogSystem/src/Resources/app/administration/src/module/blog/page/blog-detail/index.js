import template from './blog-detail.html.twig';

Shopware.Component.register('blog-detail', {
    template,

    inject: [
        'repositoryFactory',
    ],

    mixins: [
        Shopware.Mixin.getByName('notification'),
    ],

    data() {
        return {
            isLoading: false,
            isSaveSuccessful: false,
            blog: null,
            productIds: [],
        };
    },

    computed: {
        repository() {
            return this.repositoryFactory.create('blog');
        },

        languageContext() {
            return Shopware.Context.api;
        },

        productRepository() {
            return this.repositoryFactory.create('product');
        },

        productCriteria() {
            const criteria = new Shopware.Data.Criteria(1, 25);
            criteria.addSorting(Shopware.Data.Criteria.sort('createdAt', 'DESC', false));
            return criteria;
        },
    },

    watch: {
        '$route.params.id'() {
            this.loadEntity();
        },
    },

    created() {
        this.loadEntity();
    },

    methods: {
        getErrorMessage(error, fallbackMessage) {
            const apiErrors = error?.response?.data?.errors;
            if (Array.isArray(apiErrors) && apiErrors.length > 0) {
                const first = apiErrors[0];
                return first.detail || first.title || fallbackMessage;
            }

            return error?.message || fallbackMessage;
        },

        loadEntity() {
            if (!this.$route.params.id) {
                return Promise.resolve();
            }

            this.isLoading = true;
            const criteria = new Shopware.Data.Criteria();
            criteria.addAssociation('products');

            return this.repository.get(this.$route.params.id, Shopware.Context.api, criteria).then((entity) => {
                this.blog = entity;
                this.productIds = (entity.products || []).map((product) => product.id);
                this.isLoading = false;
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, this.$tc('blog-system.blog.notification.loadError')),
                });
            });
        },

        onChangeLanguage({ languageId }) {
            return this.loadEntity();
        },

        onSave() {
            if (!this.blog) {
                return Promise.resolve();
            }

            this.blog.products = this.productIds.map((id) => ({
                id,
                versionId: Shopware.Context.api.liveVersionId,
            }));

            this.isLoading = true;
            this.isSaveSuccessful = false;

            return this.repository.save(this.blog, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.isSaveSuccessful = true;

                this.createNotificationSuccess({
                    message: this.$tc('blog-system.blog.notification.saved'),
                });
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, this.$tc('blog-system.blog.notification.saveError')),
                });
            });
        },

        onDelete() {
            if (!this.blog) {
                return Promise.resolve();
            }

            this.isLoading = true;
            return this.repository.delete(this.blog.id, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.createNotificationSuccess({
                    message: this.$tc('blog-system.blog.notification.deleted'),
                });

                return this.$router.push({ name: 'blog.list' });
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, this.$tc('blog-system.blog.notification.deleteError')),
                });
            });
        },
    },
});
