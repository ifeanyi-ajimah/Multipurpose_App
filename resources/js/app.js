
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

//import moment after installation
import moment from 'moment';



//import vform package that we installed for vue-laravel form validation INSTALLED THUS: npm i axios vform
import { Form, HasError, AlertError } from 'vform'

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
//vform

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//import and use  progress bar.

import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
  });

// remember to place this: <vue-progress-bar></vue-progress-bar> under the router view in your master.blade.php file.

//using sweet alert
import Swal from 'sweetalert2'
window.swal = Swal;
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

window.toast = toast;

import Dashboard from './components/Dashboard.vue';
Vue.component('dashboard',Dashboard);

import Profile from './components/Profile.vue';
Vue.component('profile',Profile);

import Users from './components/Users.vue';
Vue.component('users',Users);

let routes = [
    { path: '/dasboard', component: Dashboard },
    { path: '/profile', component: Profile },
    { path: '/users', component: Users },
  ]

//creating the router instance
const router = new VueRouter({
mode: 'history',//to remove the # that appears in the link
routes // short for `routes: routes`
});

//global filters created
Vue.filter('to-uppercase',function(value)
{
 return value.charAt(0).toUpperCase() + value.slice(1)
});

Vue.filter('my-date', function(created){
  return moment(created).format('MMMM Do YYYY, h:mm:ss a');
});

let Fire = new Vue();

window.Fire = Fire;

const app = new Vue({
    el: '#app',
    router
});

