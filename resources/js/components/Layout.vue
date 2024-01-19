<script setup>
import {onMounted, ref, watch} from 'vue'
import Menu from "@/components/Menu.vue";
import router from "@/route/index.js";

const leftDrawerOpen = ref(false)
const toggleLeftDrawer = () => {
    leftDrawerOpen.value = !leftDrawerOpen.value
}


const breadcrumbs = ref([])

function initBreadcrumbs() {
    breadcrumbs.value = []
    if (router.currentRoute.value.path.path === "/" || router.currentRoute.value.path.path === "/index") {
        breadcrumbs.value = [{title: router.currentRoute.value.meta.title, to: "/"}]
    } else {

        router.currentRoute.value.matched.forEach(route => {
            breadcrumbs.value.push({title: route.meta.title, to: route.path})
        })
    }
}


onMounted(() => {
    initBreadcrumbs()
})

watch(() => router.currentRoute.value, (newVal, oldVal) => {
    initBreadcrumbs()
})


</script>
<template>
    <q-layout view="lHh lpR lfr">
        <q-header elevated class="bg-primary text-white">
            <q-toolbar>
                <q-btn dense flat round icon="menu" @click="toggleLeftDrawer"/>
                <q-breadcrumbs active-color="#fff">
                    <q-breadcrumbs-el v-for="item in breadcrumbs" :label="item.title" :to="item.path"/>
                </q-breadcrumbs>
                <!--                <q-toolbar-title>{{ $router.currentRoute.value.meta.title }}</q-toolbar-title>-->
            </q-toolbar>
        </q-header>

        <q-drawer show-if-above v-model="leftDrawerOpen" side="left" bordered>
            <Menu/>
        </q-drawer>

        <q-page-container>
            <div style="padding: 10px;">
                <router-view/>
            </div>
        </q-page-container>

    </q-layout>
</template>

