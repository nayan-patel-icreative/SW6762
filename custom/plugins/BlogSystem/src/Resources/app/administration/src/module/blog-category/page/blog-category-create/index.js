import template from './blog-category-create.html.twig';

Shopware.Component.register('blog-category-create', {
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

    created() {
        this.blogCategory = this.repository.create(Shopware.Context.api);
        this.blogCategory.name = '';
    },

    methods: {
        onSave() {
            this.isLoading = true;
            this.isSaveSuccessful = false;

            return this.repository.save(this.blogCategory, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.isSaveSuccessful = true;

                this.createNotificationSuccess({
                    message: 'Blog category saved',
                });

                return this.$router.push({
                    name: 'blog.category.detail',
                    params: { id: this.blogCategory.id },
                });
            }).catch(() => {
                this.isLoading = false;
                this.createNotificationError({
                    message: 'Could not save blog category',
                });
            });
        },
    },
});
