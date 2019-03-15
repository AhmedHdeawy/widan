// import Home from './components/Home.vue';
import Dashboard from './components/dashboard/index.vue';
import DashboardHome from './components/dashboard/dashboard/index.vue';
import Categories from './components/dashboard/categories/index.vue';
import Clients from './components/dashboard/clients/index.vue';
import Service from './components/dashboard/clients/service.vue';
import Users from './components/dashboard/users/index.vue';
import NotFound from './components/NotFound.vue';

export const routes = [
    {
        path: '/dashboard',
        component: Dashboard,
        children: [
            {
                path: '',
                component: DashboardHome
            },
            {
                path: 'categories',
                component: Categories
            },
            {
                path: 'clients',
                component: Clients
            },
            {
                path: 'service/:id',
                component: Service
            },
            {
                path: 'users',
                component: Users
            },
        ]
    },
    // {
    //     path: '/dashboard/clients',
    //     component: Clients
    // },
    // {
    //     path: '/dashboard/users',
    //     component: Users
    // },
    {
        path: '/not-found',
        component: NotFound
    },
    {
        path: '*',
        component: NotFound
    }
];
