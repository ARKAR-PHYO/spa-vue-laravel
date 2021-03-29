import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import adminDashboard from './admin/pages/adminDashboard'
import tag from './admin/pages/tag'
import category from './admin/pages/category'
import adminusers from './admin/pages/adminUsers'

const routes = [
    {
        path: '/',
        component: adminDashboard,
    },
    {
        path: '/tag',
        component: tag,
    },
    {
        path: '/category',
        component: category,
    },

    {
        path: '/adminusers',
        component: adminusers,
    },
]

export default new Router({
    mode: 'history',
    routes
})
