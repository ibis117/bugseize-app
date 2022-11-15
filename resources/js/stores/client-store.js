import {defineStore} from 'pinia'
import axios from "../api/axios";

const API_URL = '/api/clients';
export const useClientStore = defineStore('client', {
    state: () => ({
        client: {},
        clientList: [],
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
                this.clientList = result.data;
                this.perPage = result.perPage;
                this.total = result.totalCount;
                this.total = result.lastPage;
                return result;
            })
        },

        create() {
            return axios.post(`${API_URL}`, this.client)
        },

        update() {
            let id = this.client.id;
            return axios.put(`${API_URL}/${id}`, this.client)
        },

        show(id) {
            return axios.get(`${API_URL}/${id}`)
        },

        delete(id) {
            return axios.delete(`${API_URL}/${id}`)
        }
    }
})
