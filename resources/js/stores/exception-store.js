import {defineStore} from 'pinia'
import axios from "../api/axios";

export const useExceptionStore = defineStore('exception', {
    state: () => ({
        exception: {},
        exceptions: [],
        currentPage: 1,
        lastPage: 1,
        perPage: 10,
        total: 0,
        selected: []
    }),
    getters: {
        pagination() {
            return {
                page: this.currentPage,
                rowsPerPage: this.perPage,
            }
        },
    },

    actions: {
        create() {
            return axios.post('/api/bug-exceptions', this.exception)
        },

        list(filter = null) {
            return axios.get('/api/bug-exceptions',{
                params: {
                    page: this.currentPage,
                    ...filter
                }
            })
                .then(res => {
                    const data = res.data;
                    this.exceptions = data.data;
                    this.lastPage = data.lastPage;
                    this.perPage = data.perPage;
                    this.total = data.totalCount;
                });
        },

        show(id) {
            return axios.get(`/api/bug-exceptions/${id}`)
                .then(res => {
                    this.exception = res.data;
                    if (this.exception.status === 'unread') {
                        this.markAsRead(id);
                    }
                })
        },

        markAsRead(id) {
            return axios.get(`/api/bug-exceptions/${id}/mark-as-read`)
                .then(res => {
                    this.exception = res.data;
                })
        },

    }
})
