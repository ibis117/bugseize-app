import axios from 'axios';
import {useAuthStore} from "../stores/auth-store";


axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.interceptors.response.use(function (response) {
    return response;
}, function (error) {
    if (error.response.status === 401) {
        useAuthStore().setAuth(false, '/login');
    }
    return Promise.reject(error);
});


export default axios;
