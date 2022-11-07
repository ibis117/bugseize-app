import {defineStore} from 'pinia'
import axios from "../api/axios";

export const useIssueStore = defineStore('issue', {
    state: () => ({
        issue: {},
        issues: [],
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
            return axios.post('/api/issues', this.issue)
        },

        list(filter = null) {
            return axios.get('/api/issues',{
                params: {
                    page: this.currentPage,
                    ...filter
                }
            })
                .then(res => {
                    const data = res.data;
                    this.issues = data.data;
                    this.lastPage = data.lastPage;
                    this.perPage = data.perPage;
                    this.total = data.totalCount;
                });
        },

        show(id) {
            return axios.get(`/api/issues/${id}`)
                .then(res => {
                    this.issue = res.data;
                    if (this.issue.status === 'unread') {
                        this.markAsRead(id);
                    }
                })
        },

        markAsRead(id) {
            return axios.get(`/api/issues/${id}/mark-as-read`)
                .then(res => {
                    this.issue = res.data;
                })
        },

    }
})
