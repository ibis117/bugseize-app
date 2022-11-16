import {defineStore} from 'pinia'
import axios from "../api/axios";
import {useClientStore} from "../stores/client-store";
import {useRoleStore} from "../stores/role-store";

const API_URL = '/api/users';
export const useUserStore = defineStore('user', {
    state: () => ({
        user: {},
        userList: [],
        loading: false,
        pagination: {
            currentPage: 1,
            perPage: 10,
            total: 0,
            lastPage: 0,
        },
        filters: {},
        selectedList:[],
        selectedRole: null,
        selectedClient: null,
    }),
    getters: {
        clients() {
            return useClientStore().clientList;
        },
        roles() {
            return useRoleStore().roleList;
        }
    },

    actions: {
        list() {
            return axios.get(`${API_URL}`, {
                params: {
                    ...this.filter
                }
            }).then(res => {
                const result = res.data;
                this.userList = result.data;
                this.perPage = result.perPage;
                this.total = result.totalCount;
                this.total = result.lastPage;
                return result;
            })
        },

        create() {
            return axios.post(`${API_URL}`, {
                ...this.user,
                role_id: this.selectedRole,
                client_id: this.selectedClient
            })
        },

        update() {
            let id = this.user.id;
            return axios.put(`${API_URL}/${id}`, {
                ...this.user,
                role_id: this.selectedRole,
                client_id: this.selectedClient
            })
        },

        show(id) {
            return axios.get(`${API_URL}/${id}`)
        },

        delete(id) {
            return axios.delete(`${API_URL}/${id}`)
        },

        setSelectedRole() {
            this.selectedRole = this.user?.roles[0]?.pivot?.role_id;
        },

        setSelectedClient() {
            this.selectedClient = this.user?.clients[0]?.pivot?.client_id;
        }
    }
})
