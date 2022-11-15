import {defineStore} from 'pinia'
import axios from "../api/axios";

const API_URL = '/api/example';
export const useExampleStore = defineStore('example', {
    state: () => ({
        example: {},
        exampleList: [],
        loading: false,
        pagination: {
            currentPage: 1,
            perPage: 10,
            total: 0,
            lastPage: 0,
        },
        filters: {

        },
        selectedList:[]
    }),
    getters: {

    },

    actions: {
        list(filter) {
            return axios.get(`${API_URL}`, {
                params: filter
            }).then(res => {
                const result = res.data;
                this.exampleList = result.data;
                this.perPage = result.perPage;
                this.total = result.totalCount;
                this.total = result.lastPage;
                return result;
            })
        },

        create() {
            return axios.post(`${API_URL}`)
        },

        update(id) {
            return axios.put(`${API_URL}/id`)
        },

        show(id) {
            return axios.get(`${API_URL}/id`)
        },

        delete(id) {
            return axios.delete(`${API_URL}/id`)
        }
    }
})
