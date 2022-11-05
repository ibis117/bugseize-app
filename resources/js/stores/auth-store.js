import {defineStore} from 'pinia'
import axios from "../api/axios";

export const useAuthStore = defineStore('auth', {
    state: () => ({
        isLoggedIn: false,
        credentials: {
            username: '',
            password: ''
        },
        user: null
    }),
    persist: {
        paths: ['isLoggedIn']
    },
    getters: {
        isAuth(){
            return this.isLoggedIn;
        }
    },

    actions: {
        setAuth(isLoggedIn, path){
            this.isLoggedIn = isLoggedIn;
            this.router.push(path);
        },

        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/login', this.credentials).then(res => {
                    this.credentials.username = '';
                    this.credentials.password = '';
                    this.setAuth(true, '/');
                });
            });
        },

        getUser() {
            axios.get('/api/user').then(res => this.user = res.data);
        },

        logout() {
            axios.post('/api/logout').then(res => this.setAuth(false, '/login'));
        }
    }
})
