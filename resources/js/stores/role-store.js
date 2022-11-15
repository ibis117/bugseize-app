import {defineStore} from 'pinia'
import axios from "../api/axios";
import {usePermissionStore} from "./permission-store";

const API_URL = '/api/roles';
export const useRoleStore = defineStore('role', {
    state: () => ({
        role: {
        },
        roleList: [],
        loading: false,
        pagination: {
            currentPage: 1,
            perPage: 10,
            total: 0,
            lastPage: 0,
        },
        filters: {},
        selectedList:[],
        selectedPermissions: [],
    }),
    getters: {
        permissions() {
            return usePermissionStore().permissionList;
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
                this.roleList = result.data;
                this.perPage = result.perPage;
                this.total = result.totalCount;
                this.total = result.lastPage;
                return result;
            })
        },

        create() {
            return axios.post(`${API_URL}`, {
                ...this.role,
                permissions: this.selectedPermissions
            })
        },

        update() {
            let id = this.role.id;
            return axios.put(`${API_URL}/${id}`, {
                ...this.role,
                permissions: this.selectedPermissions
            })
        },

        show(id) {
            return axios.get(`${API_URL}/${id}`)
        },

        delete(id) {
            return axios.delete(`${API_URL}/${id}`)
        },

        setSelectedPermissions() {
            this.selectedPermissions = this.role?.permissions.map(permission => permission.id);
        }
    }
})
