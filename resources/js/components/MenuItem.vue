<script setup>
import {defineProps} from "vue"

const props = defineProps({
    menu: {
        type: Array,
        default: () => []
    },
    level: {
        type: Number,
        default: 0

    }
})

function isChildren(item) {
    if (item.children && Array.isArray(item.children) && item.children.length > 0) {
        return true;
    }
    return false;
}
</script>

<template>
    <template v-for="item in props.menu">
        <q-expansion-item
            v-if="!item.meta.hidden"
            :to="!isChildren(item)?item.path:''"
            :icon="item.meta.icon"
            :label="item.meta.title"
            :hide-expand-icon="!isChildren(item)"
            :header-inset-level="props.level"
            group="menu"
        >
            <template v-if="isChildren(item)">
                <MenuItem :menu="item.children" :level="props.level + 1"/>
            </template>
        </q-expansion-item>
    </template>


</template>

<style scoped>

</style>
