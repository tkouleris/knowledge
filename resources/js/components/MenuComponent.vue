<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="" class="brand-link">
            <img src="" alt="Logo" class="brand-image img-circle elevation-3" :src="logo" style="opacity: .8">
            <span class="brand-text font-weight-light">Knowledge</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="user_image" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a :href="url_dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
<!--                        <router-link class="nav-link" :to="url_dashboard"><i class="nav-icon fas fa-tachometer-alt"></i>Dashboard</router-link>-->
                    </li>
                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Settings
                                <span class="right badge badge-danger">todo</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
export default {
    name: "MenuComponent",
    data: function() {
        return {
            name:'',
            logo: window.location.origin + '/img/logo.jpg',
            user_image: window.location.origin + '/img/user.jpg',
            url_dashboard: window.location.origin + '/dashboard'
        }
    },
    mounted() {
        this.name = localStorage.name;
    }
}
</script>

<style scoped>

</style>
