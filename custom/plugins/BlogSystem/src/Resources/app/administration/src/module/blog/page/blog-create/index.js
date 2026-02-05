import template from './blog-create.html.twig';

Shopware.Component.register('blog-create', {
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

    created() {
        this.createEntity();
    },

    methods: {
        createEntity() {
            this.blog = this.repository.create(Shopware.Context.api);
            this.blog.active = false;
            this.blog.author = '';
            this.blog.name = '';
            this.blog.description = '';
            this.blog.blogCategoryId = null;
            this.blog.releaseDate = null;
            this.productIds = [];
        },

        onChangeLanguage({ languageId }) {
            this.createEntity();
        },

        getErrorMessage(error, fallbackMessage) {
            const apiErrors = error?.response?.data?.errors;
            if (Array.isArray(apiErrors) && apiErrors.length > 0) {
                const first = apiErrors[0];
                return first.detail || first.title || fallbackMessage;
            }

            return error?.message || fallbackMessage;
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

                return this.$router.push({
                    name: 'blog.detail',
                    params: { id: this.blog.id },
                });
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, this.$tc('blog-system.blog.notification.saveError')),
                });
            });
        },
    },
});
