<template>
    <div class="login flex justify-center items-center" style="height: 100vh;width: 100%;">

        <div class="q-pa-md" style="width: 330px">
            <h5 align="center">后台管理系统</h5>
            <q-form
                @submit="onSubmit"
                class="q-gutter-sm"
            >
                <q-input
                    clearable
                    dense
                    outlined
                    v-model="formData.email"
                    :label="$t('账号')"
                    lazy-rules
                    autocomplete
                    :rules="[ val => val && val.length > 0 || $t('请输入账号')]"
                />

                <q-input
                    clearable
                    dense
                    outlined
                    type="password"
                    v-model="formData.password"
                    :label="$t('密码')"
                    autocomplete
                    lazy-rules
                    :rules="[ val => val !== null && val !== '' || $t('请输入密码'),]"
                />

                <q-input
                    clearable
                    dense
                    outlined
                    v-model="formData.code"
                    type="text"
                    :label="$t('验证码')"
                    lazy-rules
                    :rules="[ val => val !== null && val !== '' || $t('请输入验证码'),]"
                >
                    <template v-slot:append>
                        <q-img spinner-color="red" v-if="captchaUrl" :src="captchaUrl" style="width: 100px;"
                               @click="refreshCaptcha">
                        </q-img>
                    </template>
                </q-input>

                <div>
                    <q-btn :loading="loading" style="width: 100%;" :label="$t('登录')" type="submit" color="primary">
                        <template v-slot:loading>
                            <q-spinner-hourglass class="on-left"/>
                            Loading...
                        </template>
                    </q-btn>
                </div>
            </q-form>

        </div>
    </div>
</template>

<script setup>
import {useQuasar} from 'quasar'
import {reactive, onMounted, ref} from 'vue'
import {getCaptcha, login} from "@/api/login.js";
import notify from "@/plugin/notify.js";
import router from "@/route/index.js";
import {ACCESS_TOKEN} from "@/config/index.js";

const $q = useQuasar()
const loading = ref(false)


const formData = reactive({
    email: "",
    password: "",
    code: "",
    key: ""
})
const captchaUrl = ref('')

function onSubmit() {
    loading.value = true;
    login(formData).then(({msg, data}) => {
        notify.success(msg)
        sessionStorage.setItem(ACCESS_TOKEN, data.token)
        router.push("/")
    }).finally(() => {
        loading.value = false
        refreshCaptcha()
    })
}


function refreshCaptcha() {
    getCaptcha().then(({data}) => {
        captchaUrl.value = data.img;
        formData.key = data.key;
    })
}


onMounted(() => {
    refreshCaptcha();
})

</script>

<style scoped>
.login {
    flex-direction: column;
}
</style>
