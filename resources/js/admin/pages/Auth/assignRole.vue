<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center">
                <div class="flex items-center flex-auto space-x-4">
                    <h1>Assign Role</h1>
                    <select v-model="data.id" @change="changeAdmin" type="text" placeholder="Roles" name="roles" id="roles" class="w-1/5 p-2 border border-gray-700 rounded-md focus:outline-none">
                        <option class="text-gray-400" :value="null" disabled selected>Select Role</option>
                        <option v-for="(role, i) in roles" :key="i" v-if="roles.length" :value="role.id">{{ role.roleName }}</option>
                    </select>
                </div>
                <button @click="assignRoles" class="flex items-center px-6 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <icon name="plus" class="w-4 h-4 fill-current" />
                    <p class="">Assign</p>
                </button>
            </div>

            <!-- TABLE -->
            <div v-if="roles.length" class="my-6 bg-white rounded shadow-md">
                <table class="w-full table-auto min-w-max">
                    <thead>
                        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                            <th class="px-6 py-3 text-left">Resource Name</th>
                            <th class="px-6 py-3 text-left">Read</th>
                            <th class="px-6 py-3 text-left">Write</th>
                            <th class="px-6 py-3 text-left">Update</th>
                            <th class="px-6 py-3 text-left">Delete</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600">
                        <tr v-for="(resource,i) in resources" :key="i" v-if="resources.length" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ resource.resourceName }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <span><input v-model="resource.read" type="checkbox" class=""></span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center ">
                                    <span><input v-model="resource.write" type="checkbox" class=""></span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex item-center">
                                   <span><input v-model="resource.update" type="checkbox" class=""></span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex item-center">
                                   <span><input v-model="resource.delete" type="checkbox" class=""></span>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!-- TABLE END -->
            <div v-else class="flex items-center px-4 py-2 mt-6 space-x-4 text-lg font-semibold bg-yellow-200 border-l-4 border-yellow-500 rounded-md">
                <icon name="info" class="w-6 text-yellow-500 fill-current" />
                <div class="">
                    <p>You don't have any records.</p>
                    <p><span @click="addModal = true" class="underline cursor-pointer hover:no-underline">Go add some record</span></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import Icon from './../../shared/Icon'

export default {
    components: {
        Icon,
    },

    data() {
        return {
            data: {
                id: null,
            },
            roles: [],
            resources: [
                {resourceName: 'Tags', read: false, write: false, update: false, delete: false, name: 'tags'},
                {resourceName: 'Category', read: false, write: false, update: false, delete: false, name: 'categories'},
                {resourceName: 'Admin users', read: false, write: false, update: false, delete: false, name: 'adminusers'},
                {resourceName: 'Role', read: false, write: false, update: false, delete: false, name: 'roles'},
                {resourceName: 'Assign Role', read: false, write: false, update: false, delete: false, name: 'assignRoles'},
                {resourceName: 'Home', read: false, write: false, update: false, delete: false, name: '/'},
            ],
            defaultResourcesPermission: [
                {resourceName: 'Tags', read: false, write: false, update: false, delete: false, name: 'tags'},
                {resourceName: 'Category', read: false, write: false, update: false, delete: false, name: 'categories'},
                {resourceName: 'Admin users', read: false, write: false, update: false, delete: false, name: 'adminusers'},
                {resourceName: 'Role', read: false, write: false, update: false, delete: false, name: 'roles'},
                {resourceName: 'Assign Role', read: false, write: false, update: false, delete: false, name: 'assignRoles'},
                {resourceName: 'Home', read: false, write: false, update: false, delete: false, name: '/'},
            ],
        }
    },

    methods: {
        async assignRoles() {
            let data = JSON.stringify(this.resources)
            const res = await this.callApi('post', 'app/assignRoles', {'permission': data, id: this.data.id})
            if (res.status === 200) {
                this.success('Role Has Been Assign Sueccessfully')
                let index = this.roles.findIndex(role => role.id == this.data.id)
                this.roles[index].permission = data
            }else{
                this.error()
            }
        },

        changeAdmin() {
            let index = this.roles.findIndex(role => role.id == this.data.id)
            let permission = this.roles[index].permission
            if (!permission) {
                this.resources = this.defaultResourcesPermission
            }else{
                this.resources = JSON.parse(permission)
            }
        },
    },

    async created() {
        const res = await this.callApi('get', 'app/get_roles')
        if (res.status === 200) {
            this.roles = res.data
            if (res.data.length) {
                this.data.id = res.data[0].id
                if (res.data[0].permission) {
                    this.resources = JSON.parse(res.data[0].permission)
                }
            }
        }else{
            this.error()
        }
    },
}
</script>
