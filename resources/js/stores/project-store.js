import {defineStore} from 'pinia'
import axios from "../api/axios";

export const useProjectStore = defineStore('project', {
    state: () => ({
        project: {},
        projects: [],
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
        }
    },

    actions: {
        create() {
            return axios.post('/api/projects', this.project)
        },

        list() {
            return axios.get('/api/projects',{
                params: {
                    page: this.currentPage,
                }
            })
                .then(res => {
                    const data = res.data;
                    this.projects = data.data;
                    this.lastPage = data.lastPage;
                    this.perPage = data.perPage;
                    this.total = data.totalCount;
                });
        },

        show(id) {
            return axios.get(`/api/projects/${id}`)
                .then(res => {
                    this.project = res.data;
                })
        }
    }
})
