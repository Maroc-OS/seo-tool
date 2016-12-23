
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import store from './store/index';
import CrawledUrl from './store/CrawledUrl';
import VueRouter from 'vue-router'

import CrawledList from './components/CrawledList.vue';
import Dashboard from './components/Dashboard.vue';
import Header from './components/Dashboard.vue';

Vue.component('CrawledList', CrawledList);
Vue.component('Dashboard', Dashboard);
Vue.component('Header', Header);

Vue.use(VueRouter)
const routes = [
    { path: '/', component: Dashboard },
    { path: '/crawled/all', component: CrawledList }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    router,
    store,
    el: '#app',

    created() {

        window.Echo.channel('crawler').listen('UrlHasBeenCrawled', (event) => {
            this.$store.commit('addCrawledUrl', new CrawledUrl(event.data));
        });

        window.Echo.channel('crawler').listen('CrawlHasEnded', (event) => {
            this.$store.commit('crawlHasEnded');
        });

    },
});
