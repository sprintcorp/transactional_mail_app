import Vue from 'vue'
import Router from 'vue-router'
import HomeComponent from "../pages/home/Home.vue";
import LayoutComponent from "../layout/Layout.vue";

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
            {path: '/', name: 'home', component: HomeComponent,}
        ]
    }]
});

export default router;
