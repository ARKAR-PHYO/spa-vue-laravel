<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center space-x-4">
                <h1>Role Management</h1>
                <button @click="addModal = true" v-if="isWritePermitted" class="flex flex-row items-center px-5 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <icon name="plus" class="w-4 h-4 fill-current" />
                    <p class="">Add Role</p>
                </button>
            </div>

            <!-- TABLE -->
            <div v-if="roles.length" class="my-6 bg-white rounded shadow-md">
                <table class="w-full table-auto min-w-max">
                    <thead>
                        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Role Type</th>
                            <th class="px-6 py-3 text-center">Created At</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600">
                        <tr v-for="(role,i) in roles" :key="i" v-if="roles.length" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ role.id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <span>{{ role.roleName }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <span>{{ role.CreatedDate }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center item-center">
                                    <!-- VIEW BUTTON -->
                                    <div @click="showViewModal(role, i)" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <!-- EDIT BUTTON -->
                                    <div @click="showEditModal(role, i)" v-if="isUpdatePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <!-- DELETE BUTTON -->
                                    <div @click="showDeletingModal(role, i)" v-if="isDeletePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
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

            <!-- Role ADDING MODAL -->
            <Modal
                v-model="addModal"
                title="Add Role"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <input v-model="data.roleName" name="roleName" type="text" placeholder="Enter Role Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                </div>

                <div slot="footer" class="">
                    <button @click="addModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="addRole" class="px-4 py-1 transform bg-green-300 rounded-md focus:outline-none hover:scale-105">Add Role</button>
                </div>
            </Modal>

            <!-- ROLE EDITING MODAL -->
            <Modal
                v-model="editModal"
                title="Edit Role"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <input v-model="editData.roleName" type="text" placeholder="Edit Role Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                </div>

                <div slot="footer" class="">
                    <button @click="editModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="editRole" class="px-4 py-1 transform bg-green-300 rounded-md hover:scale-105 focus:outline-none">Update</button>
                </div>
            </Modal>

            <!-- ROLE VIEWING MODAL -->
            <Modal
                v-model="showModal"
                title="Show Role"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <table class="w-full table-auto min-w-max">
                        <tbody class="text-sm font-light text-gray-600">
                            <tr class="hover:bg-gray-100">
                                <td class="px-3 py-3 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>Role Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <div class="flex items-center">
                                        <span>{{ showData.roleName }}</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div slot="footer" class="flex items-center justify-between">
                    <div class="">
                        <p>Created Date: {{ showData.createdAt }}</p>
                        <p>Created Date: {{ showData.createdAt }}</p>
                    </div>
                    <button @click="showModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                </div>
            </Modal>

            <!-- ROLE DELETING MODAL -->
            <deleteModal />
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
                roleName: '',
                // permission: '',
            },
            editData: {
                roleName: '',
            },
            showData: {
                roleName: '',
                createdAt: '',
            },
            roles: [],
            addModal: false,
            editModal: false,
            showModal: false,
            isAdding: false,
            index: -1,
            showDeleteModal: false,
            deleteItem: {},
            deletingIndex: -1,
        }
    },

    methods: {
        async addRole() {
            const res = await this.callApi('post', 'app/create_role', this.data)
            if (res.status === 201) {
                this.roles.unshift(res.data)
                this.success('Role Has Been Added Successfully')
                this.addModal = false
                this.data.roleName = ''
            }else{
                if (res.status == 422) {
                    if (res.data.errors.roleName) {
                        this.error(res.data.errors.roleName[0])
                    }
                }else{
                    this.error()
                }
            }
        },

        // Role EDITING MODAL
        async editRole() {
            const res = await this.callApi('post', 'app/edit_role', this.editData)
            if (res.status === 200) {
                this.roles[this.index].roleName = this.editData.roleName
                this.success('Role Has Been EDITED Successfully')
                this.editModal = false
                this.editData.roleName = ''
            }else{
                if (res.status == 422) {
                    if (res.data.errors.roleName) {
                        this.error(res.data.errors.roleName[0])
                    }
                }else{
                    this.error()
                }
            }
        },

        // SHOW EDIT MODAL
        showEditModal(role, index) {
            let obj = {
                id: role.id,
                roleName: role.roleName
            }
            this.editData = obj
            this.editModal = true
            this.index = index
        },

        // SHOW VIEW MODAL
        showViewModal(role, index){
            let obj = {
                id: role.id,
                roleName: role.roleName,
                createdAt: role.CreatedDate,
            }
            this.showData = obj
            this.showModal = true
            this.index = index
        },

        // DELETE ROLE
        showDeletingModal(role, i) {
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'app/delete_role',
                data: role,
                deletingIndex: i,
                isDeleted: false,
            }
            this.$store.commit('setDeletingModalObj', deleteModalObj)
        },
    },

    async created() {
        const res = await this.callApi('get', 'app/get_roles')
        if (res.status === 200) {
            this.roles = res.data
        }else{
            this.error()
        }
    },

    computed : {
		...mapGetters(['getDeleteModalObj'])
	},

    watch: {
        getDeleteModalObj(obj){
            if (obj.isDeleted) {
                this.roles.splice(obj.deletingIndex,1)
            }
        }
    },
}
</script>
