import {defineStore} from 'pinia'
import axios from "../api/axios";

export const useCentrifugeStore = defineStore('centrifuge', {
    state: () => ({
        userToken: null,
        channelToken: null
    }),

    getters: {

    },

    actions: {
        getUserToken(ctx=null) {
            return axios.get('/api/centrifuge/token')
                .then(res => {
                    this.userToken = res.data.token;
                    return res;
                });
        },

        getChannelToken() {

        }
    }
})
