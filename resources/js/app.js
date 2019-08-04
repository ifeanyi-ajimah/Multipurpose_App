
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// passport components



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

//importing pagination
Vue.component('pagination', require('laravel-vue-pagination'));

//importing our gate folder for ACL
import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);
Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);
Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

import Dashboard from './components/Dashboard.vue';
Vue.component('dashboard',Dashboard);

import Profile from './components/Profile.vue';
Vue.component('profile',Profile);

import NotFound from './components/NotFound.vue';
Vue.component('not-found',NotFound);

import Users from './components/Users.vue';
Vue.component('users',Users);


import Developer from './components/Developer.vue';
Vue.component('developer',Developer);

let routes = [
    { path: '/dasboard', component: Dashboard },
    { path: '/profile', component: Profile },
    { path: '/users', component: Users },
    {path: '/developer',component: Developer},
    {path: '*', component: NotFound}, //this is the notFoundComponent and it should be the last among the route list
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

//thiis very important to initialize fire in order to use globally to fire events assign an instance of vue to the windows object
let Fire = new Vue();
window.Fire = Fire;

const app = new Vue({
    el: '#app',
    router,
    data:{
        search: ''
    },
    methods:{
        searchIt: _.debounce( () => {
            Fire.$emit('searching');
        }, 1000),

        printme(){
            window.print();//check app.scss for a custome code that will remove print of heading laravel page
        }
    }
});

