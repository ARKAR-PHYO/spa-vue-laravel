import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import adminDashboard from './admin/pages/adminDashboard'
import tag from './admin/pages/tag'
import category from './admin/pages/category'
import adminusers from './admin/pages/Auth/adminUsers'
import login from './admin/pages/Auth/login'
import role from './admin/pages/Auth/role'
import assignRole from './admin/pages/Auth/assignRole'

const routes = [
    {
        path: '/',
        component: adminDashboard,
        name: '/',
    },
    {
        path: '/tag',
        component: tag,
        name: 'tags',
    },
    {
        path: '/category',
        component: category,
        name: 'category',
    },

    {
        path: '/adminusers',
        component: adminusers,
        name: 'adminusers',
    },

    {
        path: '/login',
        component: login,
        name: 'login',
    },

    {
        path: '/role',
        component: role,
        name: 'role',
    },

    {
        path: '/assignRole',
        component: assignRole,
        name: 'assignRole',
    },
]

export default new Router({
    mode: 'history',
    routes
})
