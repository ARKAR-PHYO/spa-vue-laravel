import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import adminDashboard from './admin/pages/adminDashboard'
import tag from './admin/pages/tag'

const routes = [
    {
        path: '/',
        component: adminDashboard,
    },
    {
        path: '/tag',
        component: tag,
    },
]

export default new Router({
    mode: 'history',
    routes
})
