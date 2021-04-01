import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import adminDashboard from './admin/pages/adminDashboard'
import tags from './admin/pages/tag'
import categories from './admin/pages/category'
import adminusers from './admin/pages/Auth/adminUsers'
import login from './admin/pages/Auth/login'
import roles from './admin/pages/Auth/role'
import assignRoles from './admin/pages/Auth/assignRole'
import createBlog from './admin/pages/Blog/createBlog'

const routes = [
    {
        path: '/',
        component: adminDashboard,
        name: '/',
    },
    {
        path: '/tags',
        component: tags,
        name: 'tags',
    },
    {
        path: '/categories',
        component: categories,
        name: 'categories',
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
        path: '/roles',
        component: roles,
        name: 'roles',
    },

    {
        path: '/assignRoles',
        component: assignRoles,
        name: 'assignRoles',
    },

    {
        path: '/createBlog',
        component: createBlog,
        name: 'createBlog',
    },
]

export default new Router({
    mode: 'history',
    routes
})
