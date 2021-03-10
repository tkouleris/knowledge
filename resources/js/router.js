import Vue from 'vue';
import VueRouter from "vue-router";
import LoginComponent from "./components/LoginComponent";
import DashboardComponent from "./components/DashboardComponent";
import KnowledgeFormComponent from "./components/KnowledgeFormComponent";

Vue.use(VueRouter);
var vue_url = "/"
export default new VueRouter({
    mode:'history',
    routes:[
        {
            path:vue_url,
            component: LoginComponent,
            beforeEnter:(to, from, next) =>{
                if(localStorage.token != null){
                    next(vue_url + 'dashboard');
                }else{
                    next();
                }
            }
        },
        {
            path: vue_url + 'dashboard',
            component: DashboardComponent,
            // beforeEnter:(to, from, next) =>{
            //     if(localStorage.token == null){
            //         next(vue_url);
            //     }else{
            //         next();
            //     }
            // }
        },
        {
            path: vue_url + 'knowledge/form/:id',
            component: KnowledgeFormComponent,
            // beforeEnter:(to, from, next) =>{
            //     if(localStorage.token == null){
            //         next(vue_url);
            //     }else{
            //         next();
            //     }
            // }
        },
    ]


})
