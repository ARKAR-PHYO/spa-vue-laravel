require('./bootstrap');
import Vue from 'vue'
import router from './router'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
import common from './common';
import VueToastify from "vue-toastify";

Vue.use(ViewUI);
Vue.mixin(common);
Vue.use(VueToastify);
Vue.component('mainapp', require('./admin/shared/mainapp.vue').default);

const app = new Vue({
    el: '#app',
    router
})
