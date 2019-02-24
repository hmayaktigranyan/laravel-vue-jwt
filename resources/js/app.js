/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import './bootstrap';

import VueRouter from 'vue-router'
import Notifications from 'vue-notification'
import Navbar from './components/Navbar'

window.Vue = require('vue');
window.Vue.use(VueRouter);
window.Vue.use(Notifications);

Vue.component('Navbar', Navbar);

import router from './router';
import store from './store';

new Vue({
    el: '#app',
    router,
    store
})