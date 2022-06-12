import Vue from 'vue'
import Router from 'vue-router'
import HomeComponent from "../pages/home/Home.vue";
import LayoutComponent from "../layout/Layout.vue";
import ViewEmailPage from "../pages/mail/Mail.vue"
import RecipientEmailPage from "../pages/recipient/Recipient.vue"


Vue.use(Router);
let router = new Router({
    mode: 'history',
    routes: [{
        path: '/',
        component: LayoutComponent,
        redirect: {
            name: 'home'
        },
        children: [
            {path: '/', name: 'home', component: HomeComponent,},
            {path: '/email/:id', name: 'ViewEmailPage', component: ViewEmailPage},
            {path: '/recipient/:mail', name: 'RecipientEmailPage', component: RecipientEmailPage},
        ]
    }]
});

export default router;
