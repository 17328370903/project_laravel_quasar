import './bootstrap';
import '../css/app.css'

import {createApp} from "vue"
import App from "./pages/App.vue"

import {Quasar, Notify} from "quasar"
import router from "./route/index.js";

import {createPinia} from "pinia"
import {createI18n} from "vue-i18n"
import en from "@/language/en.js"
import zh_CN from "@/language/zh_CN.js"

// Import icon libraries
import '@quasar/extras/material-icons/material-icons.css'

// Import Quasar css
import 'quasar/src/css/index.sass'


const i18n = createI18n({
    legacy: false,
    messages: {
        en, zh_CN
    },
    locale: 'zh_CN', // 设置默认语言为中文
})
const pinia = createPinia();


const app = createApp(App)

app.use(pinia)
app.use(router)
app.use(i18n)
app.use(Quasar, {
    plugins: {
        Notify
    }
})
app.mount("#app")

