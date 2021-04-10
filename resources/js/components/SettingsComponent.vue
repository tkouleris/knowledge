<template>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <navbar-component></navbar-component>
            <menu-component></menu-component>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Settings</h1>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Profile</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" v-model="name" class="form-control" id="name" placeholder="Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input v-model="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                            </div>
<!--                                            <div class="form-group">-->
<!--                                                <label for="exampleInputFile">File input</label>-->
<!--                                                <div class="input-group">-->
<!--                                                    <div class="custom-file">-->
<!--                                                        <input type="file" class="custom-file-input" id="exampleInputFile">-->
<!--                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>-->
<!--                                                    </div>-->
<!--                                                    <div class="input-group-append">-->
<!--                                                        <span class="input-group-text">Upload</span>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button @click="update_user($event)" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>

            <footer-component></footer-component>
        </div>
    </body>
</template>

<script>
import FooterComponent from "./FooterComponent";
import NavbarComponent from "./NavbarComponent";
import MenuComponent from "./MenuComponent";
import config from "../config";
export default {
    name: "SettingsComponent",
    components: {MenuComponent, NavbarComponent, FooterComponent},
    data: function() {
        return {
            id: localStorage.id,
            name:null,
            password:'',
            header:{
                headers: {
                    Authorization: "Bearer " + localStorage.token
                },
            }
        }
    },
    mounted() {
        this.name = localStorage.name;
    },
    methods: {
        update_user: function (event) {
            event.preventDefault();
            let data = {
                'id': this.id,
                'name': this.name
            }
            if(this.password.length > 0){
                data['password'] = this.password;
            }
            let full_url = config.API_URL + "/api/user/update";
            axios.post(full_url, data, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.update_user(event);
                        }

                        if(response.data.success === true){
                            localStorage.name = response.data.data.name;
                            this.$router.go();
                        }
                    }

                ).catch(
                error=>{
                    alert(error.response.data.message);
                }
            );
        },
    }
}
</script>

<style scoped>

</style>
