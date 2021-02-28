/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import StarRating from 'vue-star-rating';


Vue.component('app-rating', require('./components/AppRating.vue').default);
Vue.component('star-rating', StarRating);

const app = new Vue({
    el: '#app',
});
