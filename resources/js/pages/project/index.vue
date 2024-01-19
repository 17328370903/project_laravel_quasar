<script setup>
import {onMounted, reactive, ref} from "vue"
import {getProjectList} from "@/api/project.js";
import Pagination from "@/components/Pagination.vue";

const tableData = ref([])
const loading = ref(false)
const pagination = reactive({
    page: 1,
    page_size: 10,
    lastPage: 0,
    total: 0
})

function getList() {
    loading.value = true;
    let formData = {page: pagination.page, page_size: pagination.page_size}
    getProjectList(formData).then(({data}) => {
        tableData.value = data.data
        pagination.total = data.total
        pagination.lastPage = data.last_page
    }).finally(() => loading.value = false)
}

const columns = [
    {
        name: 'name',
        required: true,
        label: '项目名称',
        align: 'left',
        field: row => row.name,
        format: val => `${val}`,

    },
    {name: 'person_in_charge', align: 'center', label: '负责人', field: 'person_in_charge'},
    {name: 'creator', align: 'center', label: '创建人', field: row => row.creator?.name || ''},
    {name: 'created_at', align: 'center', label: '创建时间', field: 'created_at'},
    {name: 'updated_at', align: 'center', label: '更新时间', field: 'updated_at'},
    {name: 'options', align: 'center', label: '操作', field: "options"},


]


onMounted(() => getList())


</script>

<template>
    <div>
        <q-table
            :loading="loading"
            class="my-sticky-virtscroll-table"
            virtual-scroll
            :virtual-scroll-sticky-size-start="48"
            row-key="index"
            :rows="tableData"
            :columns="columns"
            hide-pagination
        >
            <template v-slot:top>
                <div style="width: 100%" class="flex justify-between">
                    <q-btn color="primary" icon="post_add" @click="$router.push('/project/create')"/>
                    <q-form class="q-gutter-md flex">
                        <q-input outlined dense></q-input>
                        <q-btn icon="search" dense>搜索</q-btn>
                    </q-form>
                </div>

            </template>
            <template v-slot:body-cell-options="props">
                <q-td>
                    <q-btn dense icon="edit" color="amber"></q-btn>
                    &nbsp;
                    <q-btn dense icon="delete" color="red"></q-btn>
                </q-td>
            </template>

        </q-table>
        <Pagination
            @getList="getList"
            v-model:page="pagination.page"
            v-model:pageSize="pagination.page_size"
            :total="pagination.total"
            :lastPage="pagination.lastPage"
        />
    </div>
</template>

<style scoped>

</style>
