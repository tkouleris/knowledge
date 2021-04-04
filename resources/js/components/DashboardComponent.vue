<template>
    <body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <navbar-component></navbar-component>
        <menu-component></menu-component>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">My Knowledge Collection</h3>

                                    <div class="card-tools">

                                    </div>
                                </div>
                                <div class="input-group input-group-sm" >
                                    <input type="text" @keypress="search_by_tag($event)" v-model="tag_search" class="form-control float-right"
                                           style="margin-left:10px;"
                                           placeholder="Search by tags, seperated with commas..."
                                    >

                                    <div class="input-group-append">
                                        <button @click="getKnowledgeList()" class="btn btn-default"
                                                style="margin-right:10px;"
                                        >
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Created</th>
                                            <th>Updated</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="knowledge in knowledge_list" :key="knowledge.id">
                                            <td>{{ knowledge.title}}</td>
                                            <td>{{ knowledge.description }}</td>
                                            <td>{{ knowledge.created_at }}</td>
                                            <td>{{ knowledge.updated_at }}</td>
                                            <td><a :href="knowledge_form_url + knowledge.id">edit</a></td>
                                            <td><a href="" @click="delete_knowledge_confirmation(knowledge.id)">delete</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer-component></footer-component>
    </div>
    </body>
</template>

<script>
import FooterComponent from "./FooterComponent";
import MenuComponent from "./MenuComponent";
import NavbarComponent from "./NavbarComponent";
import config from "../config";
import refreshToken from '../mixins/refreshToken'

export default {
    name: "DashboardComponent",
    components: {MenuComponent, FooterComponent, NavbarComponent},
    data: function() {
        return {
            knowledge_form_url: window.location.origin + '/knowledge/form/',
            knowledge_list:null,
            tag_search:null,
            header:{
                headers: {
                    Authorization: "Bearer " + localStorage.token
                },
            }
        }
    },
    mounted() {
        this.getKnowledgeList();
    },
    methods:{
        setToken: function (token){
            this.header.headers.Authorization = "Bearer " + token
        },
        getKnowledgeList: function (){
            let full_url = config.API_URL + "/api/knowledge/all";
            if(this.tag_search !== null){
                full_url = full_url + '?tag_search=' + this.tag_search;
            }
            axios.get(full_url, this.header)
                .then(response =>{
                    // Learn about mixins or interceptors in VUE
                    if(response.data.success === false && response.data.status === 'expired'){
                        localStorage.token = response.data.token;
                        this.setToken(localStorage.token);
                        this.getKnowledgeList();
                    }

                    if(response.data.success === true){
                        this.knowledge_list = response.data.data
                    }
                })
                .catch(
                    error => {
                        if (error.response.status === 401) {
                            localStorage.clear();
                            this.$router.push('/');
                            return;
                        }
                    }
                );
        },
        delete_knowledge_confirmation: function (knowledge_id){
            if(confirm("Do you really want to delete this knowledge ?")){
                this.delete_knowledge(knowledge_id);
            }
        },
        delete_knowledge: function (knowledge_id){
            let full_url = config.API_URL + "/api/knowledge/" + knowledge_id;
            axios.delete(full_url, this.header)
                .then(response =>{
                    if(response.data.success === false && response.data.status === 'expired'){
                        localStorage.token = response.data.token;
                        this.setToken(localStorage.token);
                        this.delete_knowledge(knowledge_id);
                    }

                    if(response.data.success === true){
                        this.$router.go();
                    }

                })
                .catch(
                    error=>alert(error)
                );
        },
        search_by_tag(event){
            if(event.keyCode !== 13){
                return;
            }
            this.getKnowledgeList();
        }
    },
    mixins:[
        refreshToken
    ]
}
</script>

<style scoped>

</style>
