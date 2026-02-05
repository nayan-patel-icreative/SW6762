import template from './blog-list.html.twig';

Shopware.Component.register('blog-list', {
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
            blogs: null,
            total: 0,
            page: 1,
            limit: 25,
            sortBy: 'createdAt',
            sortDirection: 'DESC',
        };
    },

    computed: {
        repository() {
            return this.repositoryFactory.create('blog');
        },

        columns() {
            return [
                {
                    property: 'name',
                    dataIndex: 'name',
                    label: this.$tc('blog-system.blog.list.column.name'),
                    primary: true,
                    inlineEdit: 'string',
                    routerLink: 'blog.detail',
                    allowResize: true,
                },
                {
                    property: 'active',
                    dataIndex: 'active',
                    label: this.$tc('blog-system.blog.list.column.active'),
                    sortable: true,
                    allowResize: true,
                },
                {
                    property: 'author',
                    dataIndex: 'author',
                    label: this.$tc('blog-system.blog.list.column.author'),
                    sortable: true,
                    allowResize: true,
                },
                {
                    property: 'createdAt',
                    dataIndex: 'createdAt',
                    label: this.$tc('blog-system.blog.list.column.createdAt'),
                    sortable: true,
                    allowResize: true,
                },
            ];
        },

        criteria() {
            const criteria = new Shopware.Data.Criteria(this.page, this.limit);
            criteria.addSorting(Shopware.Data.Criteria.sort(this.sortBy, this.sortDirection, false));
            criteria.addAssociation('category');

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
                this.blogs = result;
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
                    message: this.$tc('blog-system.blog.notification.deleted'),
                });

                return this.getList();
            }).catch(() => {
                this.createNotificationError({
                    message: this.$tc('blog-system.blog.notification.deleteError'),
                });

                return this.getList();
            });
        },

        onInlineEditSave(promise) {
            return promise.then(() => {
                this.createNotificationSuccess({
                    message: this.$tc('blog-system.blog.notification.saved'),
                });
            }).catch(() => {
                this.createNotificationError({
                    message: this.$tc('blog-system.blog.notification.saveError'),
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
