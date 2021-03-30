<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center space-x-4">
                <h1>Tags</h1>
                <button @click="addModal = true" v-if="isWritePermitted" class="flex flex-row items-center px-5 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <icon name="plus" class="w-4 h-4 fill-current" />
                    <p class="">Create Tag</p>
                </button>
            </div>

            <!-- TABLE -->
            <div v-if="tags.length" class="my-6 bg-white rounded shadow-md">
                <table class="w-full table-auto min-w-max">
                    <thead>
                        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Tag Name</th>
                            <th class="px-6 py-3 text-center">Created At</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600">
                        <tr v-for="(tag,i) in tags" :key="i" v-if="tags.length" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ tag.id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <span>{{ tag.tagName }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <p>{{ tag.CreatedDate }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center item-center">
                                    <!-- VIEW BUTTON -->
                                    <div @click="showViewModal(tag, i)" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <!-- EDIT BUTTON -->
                                    <div @click="showEditModal(tag, i)" v-if="isUpdatePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <!-- DELETE BUTTON -->
                                    <div @click="showDeletingModal(tag, i)" v-if="isDeletePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
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

            <!-- TAG ADDING MODAL -->
            <Modal
                v-model="addModal"
                title="Add Tag"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <input v-model="data.tagName" name="tagName" type="text" placeholder="Enter Tag Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                </div>

                <div slot="footer" class="">
                    <button @click="addModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="addTag" class="px-4 py-1 transform bg-green-300 rounded-md focus:outline-none hover:scale-105">Add Tag</button>
                </div>
            </Modal>

            <!-- TAG EDITING MODAL -->
            <Modal
                v-model="editModal"
                title="Edit Tag"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <input v-model="editData.tagName" type="text" placeholder="Edit Tag Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                </div>

                <div slot="footer" class="">
                    <button @click="editModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="editTag" class="px-4 py-1 transform bg-green-300 rounded-md hover:scale-105 focus:outline-none">Update</button>
                </div>
            </Modal>

            <!-- TAG VIEWING MODAL -->
            <Modal
                v-model="showModal"
                title="Show Tag"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <table class="w-full table-auto min-w-max">
                        <tbody class="text-sm font-light text-gray-600">
                            <tr class="hover:bg-gray-100">
                                <td class="px-3 py-3 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>Tag Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <div class="flex items-center">
                                        <span>{{ showData.tagName }}</span>
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

            <!-- TAG DELETING MODAL -->
            <deleteModal />
        </div>
    </div>
</template>

<script>

import Icon from './../shared/Icon'
import deleteModal from '../components/deleteModal'
import { mapGetters } from 'vuex'

export default {
    components: {
        Icon,
        deleteModal,
    },

    data() {
        return {
            data: {
                tagName: '',
            },
            editData: {
                tagName: '',
            },
            showData: {
                tagName: '',
                createdAt: '',
            },
            addModal: false,
            editModal: false,
            showModal: false,
            isAdding: false,
            tags: [],
            index: -1,
            showDeleteModal: false,
            deleteItem: {},
            deletingIndex: -1,
        }
    },

    methods: {
        async addTag() {
            // if (this.data.tagName.trim()=='') return this.error('Tag Name Is Require')
            const res = await this.callApi('post', 'app/create_tag', this.data)
            if (res.status === 201) {
                this.tags.unshift(res.data)
                this.success('Tag Has Been Added Successfully')
                this.addModal = false
                this.data.tagName = ''
            }else{
                if (res.status == 422) {
                    if (res.data.errors.tagName) {
                        this.error(res.data.errors.tagName[0])
                    }
                }else{
                    this.error()
                }
            }
        },

        // TAG EDITING MODAL
        async editTag() {
            // if (this.editData.tagName.trim()=='') return this.error('Tag Name Is Require')
            const res = await this.callApi('post', 'app/edit_tag', this.editData)
            if (res.status === 200) {
                this.tags[this.index].tagName = this.editData.tagName
                this.success('Tag Has Been EDITED Successfully')
                this.editModal = false
                this.editData.tagName = ''
            }else{
                if (res.status == 422) {
                    if (res.data.errors.tagName) {
                        this.error(res.data.errors.tagName[0])
                    }
                }else{
                    this.error()
                }
            }
        },

        // SHOW EDIT MODAL
        showEditModal(tag, index) {
            let obj = {
                id: tag.id,
                tagName: tag.tagName
            }
            this.editData = obj
            this.editModal = true
            this.index = index
        },

        // SHOW VIEW MODAL
        showViewModal(tag, index){
            let obj = {
                id: tag.id,
                tagName: tag.tagName,
                createdAt: tag.CreatedDate,
            }
            this.showData = obj
            this.showModal = true
            this.index = index
        },

        // DELETE TAG
        showDeletingModal(tag, i) {
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'app/delete_tag',
                data: tag,
                deletingIndex: i,
                isDeleted: false,
            }
            this.$store.commit('setDeletingModalObj', deleteModalObj)
        },
    },

    async created() {
        const res = await this.callApi('get', 'app/get_tags')
        if (res.status === 200) {
            this.tags = res.data
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
                this.tags.splice(obj.deletingIndex,1)
            }
        }
    },
}
</script>
