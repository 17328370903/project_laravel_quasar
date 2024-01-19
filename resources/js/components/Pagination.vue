<script setup>
import {defineEmits, defineProps} from "vue";

const props = defineProps({
    lastPage: {
        type: Number,
        default: 0
    },
    page: {
        type: Number,
        default: 1
    },
    pageSize: {
        type: Number,
        default: 10
    },
    total: {
        type: Number,
        default: 0
    },
    pageSizes: {
        type: Array,
        default: [10, 20, 30, 40, 50]
    }
})

const emits = defineEmits(["update:page", 'update:pageSize', 'getList'])

function changePageSize(pageSize) {
    emits('update:pageSize', pageSize)
    emits('getList')
}


function changePage(page) {
    emits('update:page', page)
    emits('getList')
}


</script>

<template>
    <div class="q-pa-lg flex justify-end">

        <div class="flex justify-center items-center">
            共:{{ props.total }}条
        </div>

        <q-pagination
            v-model="props.page"
            :min="1"
            :max="props.lastPage"
            :max-pages="props.pageSize"
            boundary-numbers
            direction-links
            @update:model-value="changePage"
        />
        <q-select
            @update:model-value="changePageSize"
            v-model="props.pageSize"
            outlined
            dense
            options-dense
            :options="props.pageSizes"
        />
    </div>
</template>

<style scoped>

</style>
