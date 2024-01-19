<script setup>
import {ref} from "vue"
import MenuItem from "@/components/MenuItem.vue";
import {useUserStore} from "@/store/user.js";

const userStore = useUserStore()

let menu = ref(userStore.routes)

</script>

<template>
    <q-list class="rounded-borders">
        <MenuItem :menu="menu" :level="0"/>
    </q-list>
</template>

<style scoped>

</style>
