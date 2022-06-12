import Vue from 'vue';
import App from './App.vue';
import router from './router/index';
import store from './store';
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap/dist/js/bootstrap.js"
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret,faEye,faPaperPlane,faPlus } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

require('./bootstrap');
library.add(faUserSecret,faEye,faPaperPlane,faPlus)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false

new Vue({
    router,store,
    render: h => h(App),
}).$mount('#app')

