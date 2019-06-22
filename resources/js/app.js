
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
import Dashboard from './components/Dashboard.vue';
Vue.component('dashboard',Dashboard);

import Profile from './components/Profile.vue';
Vue.component('profile',Profile);


const routes = [
    { path: '/dasboard', component: Dashboard },
    { path: '/profile', component: Profile },
  ]

//creating the router instance
const router = new VueRouter({
mode: 'history',//to remove the # that appears in the link
routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router
});
