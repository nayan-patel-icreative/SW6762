import './page/blog-list';
import './page/blog-detail';
import './page/blog-create';

Shopware.Module.register('blog-system', {
    type: 'plugin',

    name: 'Blog',
    title: 'Blog',
    description: 'Blog module',

    routePrefixName: 'blog',
    routePrefixPath: 'blog',

    color: '#57D9A3',
    icon: 'default-documentation-file',

    routes: {
        list: {
            component: 'blog-list',
            path: 'list',
            meta: {}
        },

        detail: {
            component: 'blog-detail',
            path: 'detail/:id',
            meta: {
                parentPath: 'blog.list'
            }
        },

        create: {
            component: 'blog-create',
            path: 'create',
            meta: {
                parentPath: 'blog.list'
            }
        }
    },

    navigation: [{
        id: 'blog-system',
        label: 'Blog',
        color: '#57D9A3',
        path: 'blog.list',
        icon: 'default-documentation-file',
        parent: 'sw-content',
        position: 100
    }]
});
