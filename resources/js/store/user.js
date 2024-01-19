import {defineStore} from "pinia"
import {getTreeMenu} from "@/api/common.js";

export const useUserStore = defineStore('route', {
    state: () => {
        return {
            isLogin: false,
            routes: []
        }
    },
    actions: {
        getRoutes() {
            return getTreeMenu().then(({data}) => {
                return data;
            })
        }
    }
})
