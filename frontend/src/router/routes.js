import Login from '../views/authentication/Login';
import Users from '../views/users/Users';

export default [
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/users',
        name: 'users',
        component: Users
    },
];