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
            releaseDateInput: '',
            productIds: [],
        };
    },

    computed: {
        repository() {
            return this.repositoryFactory.create('blog');
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
                this.releaseDateInput = entity.releaseDate || '';
                this.productIds = (entity.products || []).map((product) => product.id);
                this.isLoading = false;
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, 'Could not load blog'),
                });
            });
        },

        onSave() {
            if (!this.blog) {
                return Promise.resolve();
            }

            this.blog.products = this.productIds.map((id) => ({
                id,
                versionId: Shopware.Context.api.liveVersionId,
            }));

            if (this.releaseDateInput) {
                this.blog.releaseDate = this.releaseDateInput;
            } else {
                this.blog.releaseDate = null;
            }

            this.isLoading = true;
            this.isSaveSuccessful = false;

            return this.repository.save(this.blog, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.isSaveSuccessful = true;

                this.createNotificationSuccess({
                    message: 'Blog saved',
                });
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, 'Could not save blog'),
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
                    message: 'Blog deleted',
                });

                return this.$router.push({ name: 'blog.list' });
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, 'Could not delete blog'),
                });
            });
        },
    },
});
