<template>
    <div class="flex flex-col items-center justify-center min-h-screen space-y-6 bg-gray-400">
        <logo class="h-20" />
        <div class="flex flex-col w-1/4 overflow-hidden bg-white rounded-lg shadow-lg">
            <h1 class="flex items-center justify-center py-4">Welcome Back!</h1>
            <div class="px-4 space-y-4">
                <div class="">
                    <label class="block mb-2 text-lg font-medium" for="email">Email:</label>
                    <input v-model="data.email" type="email" placeholder="Enter Email" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                </div>
                <div class="">
                    <label class="block mb-2 text-lg font-medium" for="email">Password:</label>
                    <input v-model="data.password" type="password" placeholder="Enter Password" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                </div>
            </div>
            <div class="flex justify-end p-4 mt-4 bg-gray-200">
                <button @click="login" class="px-4 py-1 text-lg font-medium text-white transform bg-gray-400 rounded-md focus:outline-none hover:scale-105">Login</button>
            </div>
        </div>
    </div>
</template>

<script>
import Logo from '../../shared/Logo'

export default {
    components: {
        Logo
    },

    data() {
        return {
            data: {
                email: 'admin@admin.com',
                password: 'password',
            },
            isLogging: false,
        }
    },

    methods: {
        async login() {
            // if (this.data.email.trim()=='') return this.error('Email Is Require')
            // if (this.data.password.trim()=='') return this.error('Password Is Require')
            // if (this.data.password.length < 6) return this.error('Incorrect Login Detail')
            this.isLogging = true

            const res = await this.callApi('post', 'app/adminUserLogin', this.data)

            if (res.status === 200) {
                this.success(res.data.msg)
                window.location = '/'
            }else if(res.status == 422){
                for(let i in res.data.errors){
                    this.error(res.data.errors[i][0])
                }
            }else {
                if (res.status === 401) {
                    this.error(res.data.msg)
                }else {
                    this.error()
                }
            }
            this.isLogging = false
        },
    },
}
</script>
