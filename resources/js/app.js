require('./bootstrap');
import Vue from 'vue'
import store from  './store'
import router from './router'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import common from './common';
import VueToastify from "vue-toastify";
import clickaway from 'vue-clickaway';


Vue.use(ViewUI);
Vue.mixin(common);
Vue.use(VueToastify);
Vue.use(clickaway);
Vue.use(store);

Vue.component('mainapp', require('./admin/shared/mainapp.vue').default);

const app = new Vue({
    el: '#app',
    router,
    store,
})

