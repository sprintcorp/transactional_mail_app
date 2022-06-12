import Vue from 'vue';
import Vuex from 'vuex';
import mail from './modules/mail';
Vue.use(Vuex);

const modules = {
    mail
};

export default new Vuex.Store({
    modules
});
