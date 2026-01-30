import template from './blog-category-detail.html.twig';

Shopware.Component.register('blog-category-detail', {
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
            blogCategory: null,
        };
    },

    computed: {
        repository() {
            return this.repositoryFactory.create('blog_category');
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
            return this.repository.get(this.$route.params.id, Shopware.Context.api).then((entity) => {
                this.blogCategory = entity;
                this.isLoading = false;
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, 'Could not load blog category'),
                });
            });
        },

        onSave() {
            if (!this.blogCategory) {
                return Promise.resolve();
            }

            this.isLoading = true;
            this.isSaveSuccessful = false;

            return this.repository.save(this.blogCategory, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.isSaveSuccessful = true;

                this.createNotificationSuccess({
                    message: 'Blog category saved',
                });
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, 'Could not save blog category'),
                });
            });
        },

        onDelete() {
            if (!this.blogCategory) {
                return Promise.resolve();
            }

            this.isLoading = true;
            return this.repository.delete(this.blogCategory.id, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.createNotificationSuccess({
                    message: 'Blog category deleted',
                });

                return this.$router.push({ name: 'blog.category.list' });
            }).catch((error) => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.getErrorMessage(error, 'Could not delete blog category'),
                });
            });
        },
    },
});
