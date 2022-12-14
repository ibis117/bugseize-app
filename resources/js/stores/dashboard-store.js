import {defineStore} from 'pinia'
import axios from "../api/axios";

export const useDashboardStore = defineStore('dashboard', {
    state: () => ({
        exceptions: [],
        projects: []
    }),
    getters: {

    },

    actions: {
        recentExceptions() {
            axios.get('/api/recent-bug-exceptions')
                .then(res => this.exceptions = res.data)
        },

        listProject() {
            axios.get('/api/projects')
                .then(res => this.projects = res.data.data)
        },

        pushToExceptions(exception) {
            this.exceptions.unshift(exception);
            this.exceptions.pop();
        }
    }
})
