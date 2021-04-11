<template>
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <navbar-component></navbar-component>
        <menu-component></menu-component>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Knowledge</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
<!--                                <li class="breadcrumb-item"><a href="#">Home</a></li>-->
<!--                                <li class="breadcrumb-item active">General Form</li>-->
                            </ol>
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
                                    <h3 class="card-title">General</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input v-model="title" type="text" class="form-control" id="title" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea v-model="description" class="form-control" rows="3" id="description" placeholder="Description ..."></textarea>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button @click="submit_form($event)" id='btn_submit' class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Form Element sizes -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">  Urls</h3>
                                </div>
                                <div class="card-body">
                                    <table width="100%">
                                        <template v-for="url in urls" >
                                            <tr :id="'url_data_' + url.id">
                                                <td colspan="2"><a :href="url.url" target="_blank">{{url.description}}</a></td>
                                                <td width="10%"><button @click="enable_edit_url(url.id)" class="btn btn-secondary">Edit</button></td>
                                                <td width="10%"><button @click="delete_url_confirmation(url.id)" class="btn btn-danger">Delete</button></td>
                                            </tr>
                                            <tr :id="'url_edit_' + url.id" class="d-none">
                                                <td><input :id="'edit_url_description_'+url.id" class="form-control" type="text" placeholder="Url description..."></td>
                                                <td><input :id="'edit_url_string_'+url.id" class="form-control" type="text" placeholder="Url description..."></td>
                                                <td width="10%"><button @click="save_url(url.id)" class="btn btn-success">Save</button></td>
                                                <td width="10%"><button @click="disable_edit_url(url.id)" class="btn btn-danger">Cancel</button></td>
                                            </tr>
                                        </template>
                                    </table>
                                    <hr>
                                    <div id="url_form">
                                        <input v-model="url_description" class="form-control" type="text" placeholder="Url description...">
                                        <br/>
                                        <input v-model="url_string" class="form-control form-control-sm" type="text" placeholder="url...">
                                    </div>
                                    <button @click="create_url($event)" class="btn btn-primary" style="margin-top: 10px;">Add</button>
<!--                                    <button class="btn btn-danger" style="margin-top: 10px;">Clear</button>-->
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                            <!-- /.card -->
                        <div class="col-md-12">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Videos</h3>
                                </div>
                                <div class="card-body">
                                    <table width="100%">
                                        <template v-for="video in videos" >
                                            <tr :id="'video_data_'+video.id">
                                                <td><a :href="video.url" target="_blank">{{video.title}}</a></td>
                                                <td colspan="2"><i>{{video.description}}</i></td>
                                                <td width="10%"><button @click="enable_edit_video(video.id)" class="btn btn-secondary">Edit</button></td>
                                                <td width="10%"><button @click="delete_video_confirmation(video.id)" class="btn btn-danger">Delete</button></td>
                                            </tr>
                                            <tr :id="'video_edit_' + video.id" class="d-none">
                                                <td><input :id="'edit_video_title_'+video.id" class="form-control" type="text" placeholder="Url description..."></td>
                                                <td><input :id="'edit_video_url_'+video.id" class="form-control" type="text" placeholder="Url description..."></td>
                                                <td><input :id="'edit_video_description_'+video.id" class="form-control" type="text" placeholder="Url description..."></td>
                                                <td width="10%"><button @click="save_video(video.id)" class="btn btn-success">Save</button></td>
                                                <td width="10%"><button @click="disable_edit_video(video.id)" class="btn btn-danger">Cancel</button></td>
                                            </tr>
                                        </template>
                                    </table>
                                    <hr>
                                    <div>
                                        <input v-model="video_title" class="form-control" type="text" placeholder="Video title...">
                                        <br/>
                                        <input v-model="video_url" class="form-control" type="text" placeholder="Video url...">
                                        <br/>
                                        <input v-model="video_description" class="form-control" type="text" placeholder="Video description...">
                                    </div>
                                    <button @click="create_video($event)" class="btn btn-primary" style="margin-top: 10px;">Add</button>
<!--                                    <button class="btn btn-danger" style="margin-top: 10px;">Clear</button>-->

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- general form elements disabled -->
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">Tags</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <span style="background:green;
                                                 color:white;
                                                 padding:5px;
                                                 margin:10px;"
                                          v-for="tag in tags" :key="tag.id"
                                    >{{ tag.tag}}&nbsp;<a style="background-color:green; margin-left:10px;margin-right: 5px;cursor: pointer;" @click="unrealateTag(tag.id)">X</a></span>
                                    <hr>
                                    <div>
                                        <input v-model="knowledge_tag" class="form-control" type="text" placeholder="Tag">
                                        <br/>
                                    </div>
                                    <button @click="tag_knowledge($event)" class="btn btn-primary" style="margin-top: 10px;">Add</button>
                                    <button class="btn btn-danger" style="margin-top: 10px;">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
import {bus} from "../app";
export default {
    name: "KnowledgeFormComponent",
    components: {MenuComponent, NavbarComponent, FooterComponent},
    data: function() {
        return {
            id: this.$route.params.id,
            title:null,
            description:null,
            urls:null,
            url_string:null,
            url_description:null,
            videos:null,
            video_title:null,
            video_url:null,
            video_description:null,
            knowledge_tag:null,
            tags:null,
            header:{
                headers: {
                    Authorization: "Bearer " + localStorage.token
                },
            }
        }
    },
    mounted() {
        this.load_knowledge();
        bus.$on('knowledge_created', () => {
            this.$router.go();
        })
    },
    methods:{
        setToken: function (token){
            this.header.headers.Authorization = "Bearer " + token
        },
        submit_form: function (event){
            event.preventDefault();
            this.save_knowledge();
        },
        load_knowledge: function (){
            let full_url = config.API_URL + "/api/knowledge/"+this.id;
            axios.get(full_url, this.header)
                .then(response =>{
                    if(response.data.success === false && response.data.status === 'expired'){
                        localStorage.token = response.data.token;
                        this.setToken(localStorage.token);
                        this.load_knowledge();
                    }

                    if(response.data.success === true){
                        this.title = response.data.data.title;
                        this.description = response.data.data.description;
                        this.urls = response.data.data.urls;
                        this.videos = response.data.data.videos;
                        this.tags = response.data.data.tags
                    }
                })
                .catch(
                    error=>{
                        alert(error.response.data.message);
                        this.$router.push('/dashboard');
                    }
                );
        },
        save_knowledge: function (reload_page = true){
            let data = {
                'title': this.title,
                'description': this.description
            }
            let full_url = config.API_URL + "/api/knowledge/" + this.id;
            axios.post(full_url, data, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.save_knowledge();
                        }

                        if(response.data.success === true
                            && reload_page === true
                        ){
                            this.$router.go();
                        }
                    }

                ).catch(
                error=>alert('Wrong Username or Password')
            );
        },
        create_url: function (){
            this.save_knowledge(false);
            let data = {
                'url': this.url_string,
                'description': this.url_description
            }
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/url';
            axios.post(full_url, data, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.create_url();
                        }

                        if(response.data.success === true){
                            this.$router.go();
                        }
                    }

                ).catch(
                error=>alert('Wrong Username or Password')
            );
        },
        delete_url_confirmation(url_id){
            if(confirm("Do you really want to delete this url ?")){
                this.save_knowledge(false);
                this.delete_url(url_id);
            }
        },
        delete_url(url_id){
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/url/' + url_id;
            axios.delete(full_url,this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.delete_url(url_id);
                        }

                        if(response.status === 204){
                            this.$router.go();
                        }
                    }
                ).catch(
                error=>alert('Wrong Username or Password')
            );
        },
        create_video(event){
            this.save_knowledge(false);
            let data = {
                'title': this.video_title,
                'url': this.video_url,
                'description': this.video_description
            }
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/video';
            axios.post(full_url, data, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.create_video(event);
                        }

                        if(response.data.success === true){
                            this.$router.go();
                        }
                    }

                ).catch(error=>alert('Wrong Username or Password'));
        },
        delete_video_confirmation(video_id){
            if(confirm("Do you really want to delete this video ?")){
                this.save_knowledge(false);
                this.delete_video(video_id);
            }
        },
        delete_video(video_id){
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/video/' + video_id;
            axios.delete(full_url,this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.delete_video(video_id);
                        }

                        if(response.status === 204){
                            this.$router.go();
                        }
                    }
                ).catch(
                error=>alert('Wrong Username or Password')
            );
        },
        tag_knowledge(){
            this.save_knowledge(false);
            let data = {
                'tag': this.knowledge_tag
            }
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/tag';
            axios.post(full_url, data, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.tag_knowledge();
                        }

                        if(response.data.success === true){
                            this.$router.go();
                        }
                    }

                ).catch(error=>alert('error'));
        },
        unrealateTag(tag_id){
            this.save_knowledge(false);
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/tag/' + tag_id;
            axios.delete(full_url, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.unrealateTag(tag_id);
                        }

                        if(response.data.success === true){
                            this.$router.go();
                        }
                    }

                ).catch(error=>alert('error'));
        },
        enable_edit_url(url_id){
            this.save_knowledge(false);
            $('#url_data_'+url_id).addClass('d-none');
            $('#url_edit_'+url_id).removeClass('d-none');
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/url/' + url_id;
            axios.get(full_url, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.enable_edit_url(url_id);
                        }

                        if(response.data.success === true){
                            $('#edit_url_string_'+url_id).val(response.data.data.url)
                            $('#edit_url_description_'+url_id).val(response.data.data.description)
                        }
                    }

                ).catch(error=>alert('error'));
        },
        disable_edit_url(url_id){
            $('#url_data_'+url_id).removeClass('d-none');
            $('#url_edit_'+url_id).addClass('d-none');
            $('#edit_url_string_'+url_id).val('')
            $('#edit_url_description_'+url_id).val('')
        },
        save_url(url_id){
            this.save_knowledge(false);
            let data = {
                'url': $('#edit_url_string_' + url_id).val(),
                'description': $('#edit_url_description_' + url_id).val()
            }
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/url/' + url_id;
            axios.put(full_url, data, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.save_url(url_id);
                        }

                        if(response.data.success === true){
                            this.$router.go();
                        }
                    }

                ).catch(error=>alert('Wrong Username or Password'));
        },
        enable_edit_video(video_id){
            this.save_knowledge(false);
            $('#video_data_'+video_id).addClass('d-none');
            $('#video_edit_'+video_id).removeClass('d-none');
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/video/' + video_id;
            axios.get(full_url, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.enable_edit_video(video_id);
                        }

                        if(response.data.success === true){
                            $('#edit_video_title_'+video_id).val(response.data.data.title)
                            $('#edit_video_url_'+video_id).val(response.data.data.url)
                            $('#edit_video_description_'+video_id).val(response.data.data.description)
                        }
                    }

                ).catch(error=>alert('error'));
        },
        disable_edit_video(video_id){
            $('#video_data_'+video_id).removeClass('d-none');
            $('#video_edit_'+video_id).addClass('d-none');
            $('#edit_video_title_'+video_id).val('')
            $('#edit_video_url_'+video_id).val('')
            $('#edit_video_description_'+video_id).val('')
        },
        save_video(video_id){
            this.save_knowledge(false);
            let data = {
                'title': $('#edit_video_title' + video_id).val(),
                'url': $('#edit_video_url_' + video_id).val(),
                'description': $('#edit_video_description_' + video_id).val()
            }
            let full_url = config.API_URL + "/api/knowledge/" + this.id +'/video/' + video_id;
            axios.put(full_url, data, this.header)
                .then(
                    response =>{
                        if(response.data.success === false && response.data.status === 'expired'){
                            localStorage.token = response.data.token;
                            this.setToken(localStorage.token);
                            this.save_video(video_id);
                        }

                        if(response.data.success === true){
                            this.$router.go();
                        }
                    }

                ).catch(error=>alert('Wrong Username or Password'));
        }
    }
}
</script>

<style scoped>

</style>
