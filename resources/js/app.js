import Vue from 'vue';
import App from './App.vue';
import router from './router/index';
import store from './store';
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap/dist/js/bootstrap.js"
import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserSecret,faEye,faPaperPlane,faPlus,faArrowLeft } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';


require('./bootstrap');
library.add(faUserSecret,faEye,faPaperPlane,faPlus,faArrowLeft)
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.config.productionTip = false
Vue.use(VueSweetalert2);

new Vue({
    router,store,
    render: h => h(App),
}).$mount('#app')

