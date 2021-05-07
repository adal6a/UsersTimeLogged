import Login from '../views/authentication/Login';
import Users from '../views/users/Users';

import middleware from './middleware';

export default [
    {
        path :'*',
        redirect: '/login'
    },
    {
        path: '',
        redirect: '/login',
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        beforeEnter: middleware.guest,
    },
    {
        path: '/users',
        name: 'users',
        component: Users,
        beforeEnter: middleware.user,
    },
];