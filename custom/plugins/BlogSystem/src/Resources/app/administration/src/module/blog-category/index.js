import './page/blog-category-list';
import './page/blog-category-detail';
import './page/blog-category-create';

Shopware.Module.register('blog-category', {
    type: 'plugin',

    name: 'Blog Category',
    title: 'Blog Category',
    description: 'Blog Category module',

    routePrefixName: 'blog.category',
    routePrefixPath: 'blog-category',

    color: '#57D9A3',
    icon: 'default-documentation-file',

    routes: {
        list: {
            component: 'blog-category-list',
            path: 'list',
            meta: {}
        },

        detail: {
            component: 'blog-category-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'blog.category.list'
            }
        },

        create: {
            component: 'blog-category-create',
            path: 'create',
            meta: {
                parentPath: 'blog.category.list'
            }
        }
    },

    navigation: [{
        id: 'blog-category',
        label: 'Blog Categories',
        color: '#57D9A3',
        path: 'blog.category.list',
        icon: 'default-documentation-file',
        parent: 'sw-content',
        position: 110
    }]
});
