import {createRouter, createWebHashHistory} from "vue-router"

import routes from "./routes.js";
import {ACCESS_TOKEN} from "@/config/index.js";
import {useUserStore} from "@/store/user.js";
import Redirect from "@/components/Redirect.vue";


const router = createRouter({
    routes,
    history: createWebHashHistory()
})

const componentModules = import.meta.glob('../pages/**/**.vue')
componentModules['redirect'] = () => import('@/components/Redirect.vue')
//处理后端路由
let dealRoute = (menu, name) => {
    return menu.map(item => {
        let tempRoute = {
            path: item.path,
            name: item.name,
            meta: {
                title: item.title,
                icon: item.icon,
                hidden: Number(item.is_hidden) !== 0,
                active: item.active_path
            },
            component: componentModules[`../pages/${item.component}`] || Redirect
        }

        if (item.redirect !== '') {
            tempRoute.redirect = item.redirect;
        }
        if (item.path !== '') {
            router.addRoute(name, tempRoute)
        }

        if (item.children && Array.isArray(item.children) && item.children.length > 0) {
            tempRoute.children = dealRoute(item.children, item.name)
        }

        return tempRoute;
    })
}

//路由前置守卫
router.beforeEach(async (to, from, next) => {
    if (to.fullPath !== '/login') {
        let token = sessionStorage.getItem(ACCESS_TOKEN)
        if (!token) {
            next("/login")
        } else {
            let userStore = useUserStore()
            if (userStore.isLogin !== true) {
                let menus = await userStore.getRoutes()
                userStore.routes = dealRoute(menus, 'home')
                userStore.isLogin = true;
                await router.replace(to.fullPath)
            }
            next();
        }
    } else {
        next();
    }
})

export default router;
