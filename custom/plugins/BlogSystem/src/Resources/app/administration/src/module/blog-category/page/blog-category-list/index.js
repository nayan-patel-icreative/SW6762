import template from './blog-category-list.html.twig';

Shopware.Component.register('blog-category-list', {
    template,

    inject: [
        'repositoryFactory',
    ],

    mixins: [
        Shopware.Mixin.getByName('listing'),
        Shopware.Mixin.getByName('notification'),
    ],

    data() {
        return {
            isLoading: false,
            blogCategories: null,
            total: 0,
            page: 1,
            limit: 25,
            sortBy: 'createdAt',
            sortDirection: 'DESC',
        };
    },

    computed: {
        repository() {
            return this.repositoryFactory.create('blog_category');
        },

        columns() {
            return [
                {
                    property: 'name',
                    dataIndex: 'name',
                    label: this.$tc('blog-system.category.list.column.name'),
                    primary: true,
                    inlineEdit: 'string',
                    routerLink: 'blog.category.detail',
                    allowResize: true,
                },
                {
                    property: 'createdAt',
                    dataIndex: 'createdAt',
                    label: this.$tc('blog-system.category.list.column.createdAt'),
                    sortable: true,
                    allowResize: true,
                },
            ];
        },

        criteria() {
            const criteria = new Shopware.Data.Criteria(this.page, this.limit);

            criteria.addSorting(Shopware.Data.Criteria.sort(this.sortBy, this.sortDirection, false));

            return criteria;
        },
    },

    created() {
        this.getList();
    },

    methods: {
        getList() {
            this.isLoading = true;

            return this.repository.search(this.criteria, Shopware.Context.api).then((result) => {
                this.blogCategories = result;
                this.total = result.total;
                this.isLoading = false;
            }).catch(() => {
                this.isLoading = false;
            });
        },

        onChangeLanguage({ languageId }) {
            return this.getList();
        },

        onDelete(item) {
            this.isLoading = true;

            return this.repository.delete(item.id, Shopware.Context.api).then(() => {
                this.createNotificationSuccess({
                    message: this.$tc('blog-system.category.notification.deleted'),
                });

                return this.getList();
            }).catch(() => {
                this.createNotificationError({
                    message: this.$tc('blog-system.category.notification.deleteError'),
                });

                return this.getList();
            });
        },

        onInlineEditSave(promise) {
            return promise.then(() => {
                this.createNotificationSuccess({
                    message: this.$tc('blog-system.category.notification.saved'),
                });
            }).catch(() => {
                this.createNotificationError({
                    message: this.$tc('blog-system.category.notification.saveError'),
                });
            });
        },

        onInlineEditCancel() {
            this.getList();
        },

        onPageChange(page) {
            this.page = page;
            this.getList();
        },

        onSortColumn(column) {
            this.sortBy = column.dataIndex;
            this.sortDirection = column.direction;
            this.getList();
        },
    },
});
