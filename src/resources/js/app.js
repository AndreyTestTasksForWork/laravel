require('./bootstrap');

window.Vue = require('vue');

Vue.component('weather', require('./components/Weather.vue').default);

const app = new Vue({
    el: '#app'
});