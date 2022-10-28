import {defineStore} from 'pinia'

export const useSideBarStore = defineStore('sidebar', {
    state: () => ({
        isSideBarOpen: true,
        isSecondarySideBarOpen: false,
    }),

    getters: {},

    actions: {
        toggleSideBar() {
            this.isSideBarOpen = !this.isSideBarOpen;
            this.isSecondarySideBarOpen = false;
        },

        setSecondarySideBar(show) {
            this.isSecondarySideBarOpen = show;
        },

        onResize() {
            const sizes = {
                'sm': '640px',

                'md': '768px',

                'lg': '1024px',

                'xl': '1280px',

                '2xl': '1536px',
            }
            const screenSize = window.innerWidth;

            this.isSideBarOpen = screenSize >= 768;
        }
    }
})
