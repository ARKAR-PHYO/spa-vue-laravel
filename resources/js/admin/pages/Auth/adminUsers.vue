<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center space-x-4">
                <h1>Admin Users</h1>
                <button @click="addModal = true" v-if="isWritePermitted" class="flex flex-row items-center px-5 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <icon name="plus" class="w-4 h-4 fill-current" />
                    <p class="">Create Admin User</p>
                </button>
            </div>

            <!-- TABLE -->
            <div v-if="adminUsers.length" class="my-6 bg-white rounded shadow-md">
                <table class="w-full table-auto min-w-max">
                    <thead>
                        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">User Type</th>
                            <th class="px-6 py-3 text-center">Created At</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600">
                        <tr v-for="(adminUser,i) in adminUsers" :key="i" v-if="adminUsers.length" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ adminUser.id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <span>{{ adminUser.fullName }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <span>{{ adminUser.email }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <span>{{ adminUser.userType }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <p>{{ adminUser.CreatedDate }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center item-center">
                                    <!-- VIEW BUTTON -->
                                    <div @click="showViewModal(adminUser, i)" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <!-- EDIT BUTTON -->
                                    <div @click="showEditModal(adminUser, i)" v-if="isUpdatePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <!-- DELETE BUTTON -->
                                    <div @click="showDeletingModal(adminUser, i)" v-if="isDeletePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </div>
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

            <!-- ADMIN USER ADDING MODAL -->
            <Modal
                v-model="addModal"
                title="Add Admin User"
                :closable="false"
                :mask-closable="false"
                >
                <div class="space-y-3">
                    <input v-model="data.fullName" type="text" placeholder="Enter Full Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <input v-model="data.email" type="email" placeholder="Enter Email" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <input v-model="data.password" type="password" placeholder="Enter Password" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <select v-model="data.role_id" type="text" placeholder="Roles" name="roles" id="roles" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                        <option class="text-gray-400" :value="null" disabled selected>Select Role</option>
                        <option v-for="(role, i) in roles" :key="i" v-if="roles.length" :value="role.id">{{ role.roleName }}</option>
                    </select>
                </div>

                <div slot="footer" class="">
                    <button @click="addModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="addAdminUser" class="px-4 py-1 transform bg-green-300 rounded-md focus:outline-none hover:scale-105">Add Admin User</button>
                </div>
            </Modal>

            <!-- VIEWING ADMIN USER MODAL -->
            <Modal
                v-model="showModal"
                title="Show Admin User"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <table class="w-full table-auto min-w-max">
                        <tbody class="text-sm font-light text-gray-600">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-3 py-3 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <div class="flex items-center">
                                        <span>{{ showData.fullName }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-3 py-3 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>Email</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <div class="flex items-center">
                                        <span>{{ showData.email }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                                <td class="px-3 py-3 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>User Type</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <div class="flex items-center">
                                        <span>{{ showData.userType }}</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div slot="footer" class="flex items-center justify-between">
                    <div class="">
                        <p>Created Date: {{ showData.createdAt }}</p>
                    </div>
                    <button @click="showModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                </div>
            </Modal>

            <!-- ADMIN USER EDITING MODAL -->
            <Modal
                v-model="editModal"
                title="Edit Admin User"
                :closable="false"
                :mask-closable="false"
                >
                <div class="space-y-3">
                    <input v-model="editData.fullName" type="text" placeholder="Enter Full Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <input v-model="editData.email" type="email" placeholder="Enter Email" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <input v-model="editData.password" type="password" placeholder="Enter Password" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <select v-model="editData.role_id" type="text" placeholder="Roles" name="roles" id="roles" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                        <option class="text-gray-400" :value="null" disabled selected>Select Role</option>
                        <option v-for="(role, i) in roles" :key="i" v-if="roles.length" :value="role.id">{{ role.roleName }}</option>
                    </select>
                </div>

                <div slot="footer" class="">
                    <button @click="editModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="editAdminUser" class="px-4 py-1 transform bg-green-300 rounded-md focus:outline-none hover:scale-105">Update</button>
                </div>
            </Modal>
        </div>
    </div>
</template>

<script>

import Icon from './../../shared/Icon'
import deleteModal from '../../components/deleteModal'
import { mapGetters } from 'vuex'

export default {
    components: {
        Icon,
        deleteModal,
    },

    data() {
        return {
            data: {
                fullName: '',
                email: '',
                password: '',
                role_id: null,
            },
            editData: {
                fullName: '',
                email: '',
                userType: '',
                role_id: null,
            },
            showData: {
                fullName: '',
                email: '',
                password: '',
                userType: '',
                createdAt: '',
            },
            adminUsers: [],
            roles: [],
            addModal: false,
            editModal: false,
            showModal: false,
            isAdding: false,
        }
    },

    methods: {
        async addAdminUser() {
            // if (this.data.fullName.trim()=='') return this.error('Full Name Is Require')
            // if (this.data.email.trim()=='') return this.error('Email Is Require')
            // if (this.data.password.trim()=='') return this.error('Password Is Require')
            // if (this.data.userType.trim()=='') return this.error('User Type Is Require')
            const res = await this.callApi('post', 'app/create_adminUser', this.data)
            if (res.status === 201) {
                this.adminUsers.unshift(res.data)
                this.success('Admin User Has Been Added Successfully')
                this.addModal = false
                this.data.fullName = ''
                this.data.email = ''
                this.data.password = ''
                this.data.role_id = ''
            }else{
                if (res.status == 422) {
                    for(let i in res.data.errors){
                        this.error(res.data.errors[i][0])
                    }
                }else{
                    this.error()
                }
            }
        },

        // EDITING ADMIN USER MODAL
        async editAdminUser() {
            const res = await this.callApi('post', 'app/edit_adminUser', this.editData)
            if (res.status === 200) {
                this.adminUsers[this.index].fullName = this.editData.fullName
                this.adminUsers[this.index].email = this.editData.email
                this.adminUsers[this.index].role_id = this.editData.role_id
                this.success('Admin User Has Been EDITED Successfully')
                this.editModal = false
                this.data.fullName = ''
                this.data.email = ''
                this.data.password = ''
                this.data.role_id = ''
            }else{
                if (res.status == 422) {
                    for(let i in res.editData.errors){
                        this.error(res.editData.errors[i][0])
                    }
                }else{
                    this.error()
                }
            }
        },

        // SHOW EDIT MODAL
        showEditModal(adminUser, index) {
            let obj = {
                id: adminUser.id,
                fullName: adminUser.fullName,
                email: adminUser.email,
                role_id: adminUser.role_id,
            }
            this.editData = obj
            this.editModal = true
            this.index = index
        },

        // SHOW VIEW MODAL
        showViewModal(adminUser, index){
            let obj = {
                id: adminUser.id,
                fullName: adminUser.fullName,
                email: adminUser.email,
                userType: adminUser.userType,
                createdAt: adminUser.CreatedDate,
            }
            this.showData = obj
            this.showModal = true
            this.index = index
        },
    },

    async created() {
        const [res, resRole] = await Promise.all([
            this.callApi('get', 'app/get_adminUsers'),
            this.callApi('get', 'app/get_roles')
        ])
        if (res.status === 200) {
            this.adminUsers = res.data
        }else{
            this.error()
        }
        if (resRole.status === 200) {
            this.roles = resRole.data
        }else{
            this.error()
        }
    },
}
</script>
