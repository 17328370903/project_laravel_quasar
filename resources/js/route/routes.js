const routes = [
    {
        path: "/",
        name: "home",
        redirect: "/index",
        component: () => import("@/components/Layout.vue"),
        children: []
    },
    {
        path: "/login",
        name: "login",
        component: () => import("@/pages/login/index.vue")
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'NotFound',
        component: () => import("@/pages/errors/404.vue")
    }
];


export default routes;
