<template>
    <body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Knowledge</b> </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="login" >
                    <div class="input-group mb-3">
                        <input  v-model="email" @keypress="loginAtEnterPressed($event)" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input v-model="password" @keypress="loginAtEnterPressed($event)" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button @click="login_attempt($event)" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    <a :href="password_reset_url">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a :href="registration_url" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </body>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
import config from '../config'
import VueAxios from 'vue-axios'
Vue.use(VueAxios,axios)

export default {
    name: "LoginComponent",
    data(){
        return {
            email: null,
            password: null,
            registration_url: window.location.origin + '/register',
            password_reset_url: window.location.origin + '/password/reset'
        }
    },
    methods:{
        login_attempt: function (event){
            event.preventDefault();
            let credentials = {
                'email': this.email,
                'password': this.password
            }

            Vue.axios.post(config.API_URL + "/api/login", credentials)
                .then(
                    response =>{
                        localStorage.token = response.data.token;
                        localStorage.name = response.data.name;
                        localStorage.id = response.data.id;
                        this.$router.push('/dashboard');
                    }

                ).catch(
                error=>alert('Wrong Username or Password')
            );
        },
        loginAtEnterPressed(event){

            if(event.keyCode !== 13){
                return;
            }
            this.login_attempt(event);
        }
    }
}
</script>

<style scoped>
</style>
