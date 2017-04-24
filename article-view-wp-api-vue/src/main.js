import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'
import 'expose-loader?$!expose-loader?jQuery!jquery'
import App from './App.vue'
import Article from './assets/js/components/article.vue';

const router = new VueRouter({
    routes: [
        { name: 'article', path: '/article/:id', component: Article }
    ]
});

Vue.use(VueRouter);
Vue.use(VueResource);

new Vue({
    el: '#app',
    router,
    render: h => h(App)
})
