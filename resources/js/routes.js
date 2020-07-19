import VueRouter from 'vue-router';


let routes = [
    {
        path: '/dashboard',
        component: require('./views/dashboard').default
    },
    {
        path: '/users',
        component: require('./views/users').default
    },
    {
        path: '/movies',
        component: require('./views/movies/list').default
    },
    {
        path: '/movies/create',
        component: require('./views/movies/create').default
    },
    {
        path: '/movies/:id/edit',
        component: require('./views/movies/edit').default
    }
];


export default new VueRouter({
    base: '/admin/',
    mode: 'history',
    routes,
    linkActiveClass: 'active'
});
