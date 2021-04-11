<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
<!--            <li class="nav-item d-none d-sm-inline-block">-->
<!--                <a href="index3.html" class="nav-link">Home</a>-->
<!--            </li>-->
<!--            <li class="nav-item d-none d-sm-inline-block">-->
<!--                <a href="#" class="nav-link">Contact</a>-->
<!--            </li>-->
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" @click="create_knowledge($event)" data-toggle="dropdown" href="#">
                    <i class="far fa-plus-square"></i> New
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" @click="logout($event)" data-toggle="dropdown" href="#">
                    <<i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">

            </li>
        </ul>
    </nav>
</template>

<script>
import config from "../config";
import {bus} from "../app";

export default {
    name: "NavbarComponent",
    data: function () {
        return {
            header:{
                headers: {
                    Authorization: "Bearer " + localStorage.token
                },
            }
        }
    },
    methods:{
        create_knowledge: function (event){
            let full_url = config.API_URL + "/api/knowledge/create";
            let data = null;
            axios.post(full_url, data, this.header)
                .then(response =>{
                    this.$router.push('/knowledge/form/'+response.data.data.id);
                    bus.$emit('knowledge_created');
                })
                .catch(
                    error=>alert('there was an error')
                );
        },
        logout: function (event){
            localStorage.clear();
            this.$router.push('/');
        }
    }
}
</script>

<style scoped>

</style>
