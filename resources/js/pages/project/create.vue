<script setup>
import {onMounted, reactive, ref} from "vue"
import {createProject} from "@/api/project.js";
import notify from "@/plugin/notify.js";
import router from "@/route/index.js";


const loading = ref(false)

const initData = {
    name: "",
    description: "",
    person_in_charge: "",
    project_members: ""
}

const form = reactive({})


function save() {
    createProject(form).then(() => {
        notify.success("创建成功")
        router.push("/project")
    })
}

function reset() {
    Object.keys(initData).forEach(key => {
        form[key] = initData[key]
    })
}

onMounted(() => {
    reset()
})

</script>

<template>
    <div>
        <div class="q-mb-lg">
            <q-btn @click="$router.back()" flat color="primary" label="返回" icon="arrow_back"/>
        </div>
        
        <q-form class="q-gutter-xs" @submit.prevent.stop="save" @reset="reset">
            <q-input
                outlined
                v-model="form.name"
                label="项目名称"
                lazy-rules
                dense
                :rules="[val => !!val || '项目名称不能为空']"
            />

            <q-input
                outlined
                v-model="form.person_in_charge"
                label="项目负责人"
                lazy-rules
                dense
                :error="false"

            />

            <q-input
                outlined
                v-model="form.project_members"
                label="项目成员"
                lazy-rules
                dense
                :error="false"
            />

            <q-input
                v-model="form.description"
                label="项目描述"
                type="textarea"
                dense
                outlined
                :error="false"
            />

            <div>
                <q-btn label="保存" type="submit" color="primary"/>
                <q-btn label="重置" type="reset" color="primary" flat class="q-ml-sm"/>
            </div>
        </q-form>
    </div>
</template>

<style scoped>

</style>
