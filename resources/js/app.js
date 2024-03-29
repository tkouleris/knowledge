

// require('./bootstrap');
import config from './config.js'
import Vue from 'vue';
import router from './router.js'
import App from "./components/App";

require('./bootstrap');
export const bus = new Vue();
const app = new Vue({
    el: '#app',
    components:{
        App
    },
    router,
    config
});
