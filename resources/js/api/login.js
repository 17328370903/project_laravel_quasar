import axios from 'axios'
import instance from "@/plugin/request.js";


/**
 * 获取验证码
 */
export function getCaptcha() {
    return axios.get("/captcha/api/default")
}

/**
 * 登录
 * @param data
 * @returns {Promise<axios.AxiosResponse<any>>}
 */
export function login(data) {
    return instance.post("/backend/login", data);
}
