import Vue from "vue";

export default {
    methods: {
        refreshToken(response, callback){
            console.log("FROM MIXIN");
            if(response.data.success === false && response.data.status === 'expired'){
                Vue.localStorage.token = response.data.token;
                Vue.localStorage.refreshed = true;
                callback();
            }
        }
    },
}
