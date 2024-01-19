import axios from "axios"
import notify from "@/plugin/notify.js";
import {ACCESS_TOKEN} from "@/config/index.js";
import router from "@/route/index.js";

const authWhiteRoutes = [
    '/backend/login',
];

const instance = axios.create({
    baseURL: '/',
    timeout: 1000,
    headers: {
        'X-Requested-With': "XMLHttpRequest"
    },
});


instance.interceptors.request.use(config => {

    if (!authWhiteRoutes.includes(config.url)) {
        let token = sessionStorage.getItem(ACCESS_TOKEN)
        if (!token) {
            router.push("/login")
            return;
        }

        config.headers.Authorization = token;
    }


    return config;
}, error => {

})

instance.interceptors.response.use(response => {
    let code = Number(response.data.code);
    if (code === 200) {
        return response.data;
    }
    // if (code === 422) {
    //     return Promise.reject(response.data)
    // }

    notify.warning(response.data.msg)

    throw new Error(response);

}, error => {
    throw new Error(error);
})

export default instance;
