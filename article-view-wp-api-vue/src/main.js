import Vue from 'vue'
import VueResource from 'vue-resource'
import VueTouch from 'vue-touch'
import App from './App.vue'

// Swipping on touch-enabled devices
VueTouch.config.swipe = {
  direction: 'horizontal'
};
Vue.use(VueTouch)

Vue.use(VueResource);

new Vue({
    el: '#app',
    render: h => h(App)
})
