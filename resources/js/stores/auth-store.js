import {defineStore} from 'pinia'
import axios from "../api/axios";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        isLoggedIn: false,
        token: '',
        credentials: {
            username: '',
            password: ''
        },
        user: null
    }),
    persist: {
        paths: ['isLoggedIn', 'token']
    },
    getters: {
        isAuth(){
            return this.isLoggedIn;
        },
        getToken() {
            return this.token;
        }
    },

    actions: {
        setAuth(isLoggedIn, path){
            this.isLoggedIn = isLoggedIn;
            this.router.push(path);
        },

        setToken(token) {
            this.token = token;
        },

        login() {
            // axios.get('/sanctum/csrf-cookie').then(response => {
            //
            // });
            axios.post('/api/login', this.credentials).then(res => {
                this.credentials.username = '';
                this.credentials.password = '';
                this.setToken(res.data.token);
                this.setAuth(true, '/');
            });
        },

        getUser() {
            return axios.get('/api/user').then(res => {
                this.user = res.data
                return res.data;
            });
        },

        logout() {
            axios.post('/api/logout').then(res => this.setAuth(false, '/login'));
        }
    }
})
