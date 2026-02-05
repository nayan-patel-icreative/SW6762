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
        this.createEntity();
    },

    methods: {
        createEntity() {
            this.blogCategory = this.repository.create(Shopware.Context.api);
            this.blogCategory.name = '';
        },

        onChangeLanguage({ languageId }) {
            this.createEntity();
        },

        onSave() {
            this.isLoading = true;
            this.isSaveSuccessful = false;

            return this.repository.save(this.blogCategory, Shopware.Context.api).then(() => {
                this.isLoading = false;
                this.isSaveSuccessful = true;

                this.createNotificationSuccess({
                    message: this.$tc('blog-system.category.notification.saved'),
                });

                return this.$router.push({
                    name: 'blog.category.detail',
                    params: { id: this.blogCategory.id },
                });
            }).catch(() => {
                this.isLoading = false;
                this.createNotificationError({
                    message: this.$tc('blog-system.category.notification.saveError'),
                });
            });
        },
    },
});
