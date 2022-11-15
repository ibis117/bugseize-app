import {defineStore} from 'pinia'
import axios from "../api/axios";

const API_URL = '/api/permissions';
export const usePermissionStore = defineStore('permission', {
    state: () => ({
        permission: {},
        permissionList: [],
        loading: false,
        pagination: {
            currentPage: 1,
            perPage: 10,
            total: 0,
            lastPage: 0,
        },
        filters: {},
        selectedList:[]
    }),
    getters: {

    },

    actions: {
        list() {
            return axios.get(`${API_URL}`, {
                params: {
                    ...this.filter
                }
            }).then(res => {
                const result = res.data;
                this.permissionList = result;
                // this.perPage = result.perPage;
                // this.total = result.totalCount;
                // this.total = result.lastPage;
                return result;
            })
        },

        create() {
            return axios.post(`${API_URL}`, this.permission)
        },

        update() {
            let id = this.permission.id;
            return axios.put(`${API_URL}/${id}`, this.permission)
        },

        show(id) {
            return axios.get(`${API_URL}/${id}`)
        },

        delete(id) {
            return axios.delete(`${API_URL}/${id}`)
        },

        sync() {
            return axios.post('/api/sync-permission');
        }
    }
})
