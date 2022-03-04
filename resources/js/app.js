require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import Router from 'vue-router'

import task from './components/task.vue'
import loading from './components/loading.vue'

Vue.component('task', task);
Vue.component('Loading', loading);

const routes = [
    {
      path: "/",
      name: "Home",
      component: task,
    }
];

const VueRouter = new Router({
    mode: 'history',
    routes
})
export default VueRouter

Vue.use( Router )
Vue.use( VueRouter )

const app = new Vue({
    el: '#app',
});
