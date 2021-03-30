<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center space-x-4">
                <h1>Category</h1>
                <button @click="addModal = true" v-if="isWritePermitted" class="flex flex-row items-center px-5 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <icon name="plus" class="w-4 h-4 fill-current" />
                    <p class="">Create Category</p>
                </button>
            </div>

            <!-- TABLE -->
            <div v-if="categories.length" class="my-6 bg-white rounded shadow-md">
                <table class="w-full table-auto min-w-max">
                    <thead>
                        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Category Name</th>
                            <th class="px-6 py-3 text-left">Icon Image</th>
                            <th class="px-6 py-3 text-center">Created At</th>
                            <th class="px-6 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-light text-gray-600">
                        <tr v-for="(category,i) in categories" :key="i" v-if="categories.length" class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-6 py-3 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ category.id }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <span>{{ category.categoryName }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-left">
                                <div class="flex items-center">
                                    <!-- <span>{{ category.iconImage }}</span> -->
                                    <img class="w-20 " :src="category.iconImage" alt="">
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex items-center justify-center">
                                    <p>{{ category.CreatedDate }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center item-center">
                                    <!-- VIEW BUTTON -->
                                    <div @click="showViewModal(category, i)" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <!-- EDIT BUTTON -->
                                    <div @click="showEditModal(category, i)" v-if="isUpdatePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <!-- DELETE BUTTON -->
                                    <div @click="showDeletingModal(category, i)" v-if="isDeletePermitted" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
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

            <!-- ADDING CATEGORY MODAL -->
            <Modal
                v-model="addModal"
                title="Add Category"
                :closable="false"
                :mask-closable="false"
                >
                <div class="space-y-3">
                    <input v-model="data.categoryName" type="text" placeholder="Enter Category Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <Upload
                        ref="uploads"
                        multiple
                        type="drag"
                        :headers="{ 'x-csrf-token': token, 'X-Requested-With': 'XMLHttpRequest' }"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png']"
                        :on-format-error="handleFormatError"
                        :max-size="2048"
                        :on-exceeded-size="handleMaxSize"
                        action="app/upload">
                        <div style="padding: 20px 0">
                            <icon name="cloud-upload" class="w-20 mx-auto mb-3" />
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>
                    <div v-if="data.iconImage" class="relative w-1/2 overflow-hidden demo-upload-list">
                        <img class="w-full" :src="`${data.iconImage}`">
                        <div class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center mx-auto space-x-3 bg-gray-600 bg-opacity-60 demo-upload-list-cover">
                            <!-- <svg @click="deleteImage" class="w-3 text-white cursor-pointer fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z" /></svg> -->
                            <div @click="deleteImage">
                                <icon name="trash" @click="deleteImage" class="w-3 text-white cursor-pointer fill-current" />
                            </div>
                        </div>
                    </div>
                </div>

                <div slot="footer" class="">
                    <button @click="addModal=false" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="addCategory" class="px-4 py-1 transform bg-green-300 rounded-md focus:outline-none hover:scale-105">Add Category</button>
                </div>
            </Modal>

            <!-- EDITING CATEGORY MODAL -->
            <Modal
                v-model="editModal"
                title="Edit Category"
                :closable="false"
                :mask-closable="false"
                >
                <div class="space-y-3">
                    <input v-model="editData.categoryName" type="text" placeholder="Enter Category Name" class="w-full p-2 border border-gray-700 rounded-md focus:outline-none">
                    <Upload
                        v-show="isIconImageNew"
                        ref="editDataUploads"
                        multiple
                        type="drag"
                        :headers="{ 'x-csrf-token': token, 'X-Requested-With': 'XMLHttpRequest' }"
                        :on-success="handleSuccess"
                        :on-error="handleError"
                        :format="['jpg','jpeg','png']"
                        :on-format-error="handleFormatError"
                        :max-size="2048"
                        :on-exceeded-size="handleMaxSize"
                        action="app/upload">
                        <div style="padding: 20px 0">
                            <icon name="cloud-upload" class="w-20 mx-auto mb-3" />
                            <p>Click or drag files here to upload</p>
                        </div>
                    </Upload>
                    <div v-if="editData.iconImage" class="relative w-40 overflow-hidden demo-upload-list">
                        <img class="" :src="`${editData.iconImage}`">
                        <div class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center mx-auto space-x-3 bg-gray-600 bg-opacity-60 demo-upload-list-cover">
                            <div @click="deleteImage(false)">
                                <icon name="trash" class="w-4 text-white cursor-pointer fill-current" />
                            </div>
                        </div>
                    </div>
                </div>

                <div slot="footer" class="">
                    <button @click="closeEditModal" class="px-4 py-1 transform border border-gray-700 rounded-md hover:scale-105 focus:outline-none">Close</button>
                    <button @click="editCategory" class="px-4 py-1 transform bg-green-300 rounded-md hover:scale-105 focus:outline-none">Update</button>
                </div>
            </Modal>

            <!-- VIEWING CATEGORY MODAL -->
            <Modal
                v-model="showModal"
                title="Show Category"
                :closable="false"
                :mask-closable="false"
                >
                <div class="">
                    <table class="w-full table-auto min-w-max">
                        <tbody class="text-sm font-light text-gray-600">
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="px-3 py-3 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>Category Name</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <div class="flex items-center">
                                        <span>{{ showData.categoryName }}</span>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                                <td class="px-3 py-3 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span>Icon Image</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-left">
                                    <div class="flex items-center">
                                        <img class="w-40" :src="showData.iconImage" alt="">
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

            <!-- DELETING CATEGORY MODAL -->
            <deleteModal />

        </div>
    </div>
</template>

<script>

import deleteModal from '../components/deleteModal'
import Icon from './../shared/Icon'
import { mapGetters } from 'vuex'

export default {
    components: {
        Icon,
        deleteModal,
    },

    data() {
        return {
            data: {
                iconImage: '',
                categoryName: '',
            },
            editData: {
                iconImage: '',
                categoryName: '',
            },
            showData: {
                iconImage: '',
                categoryName: '',
                createdAt: '',
            },
            addModal: false,
            editModal: false,
            showModal: false,
            isAdding: false,
            categories: [],
            index: -1,
            showDeleteModal: false,
            deleteItem: {},
            deletingIndex: -1,
            token: '',
            isIconImageNew: false,
            isEditingItem: false,
        }
    },

    methods: {
        async addCategory() {
            // if (this.data.categoryName.trim()=='') return this.error('Category Name Is Require')
            // if (this.data.iconImage.trim()=='') return this.error('Icon Image Is Require')
            this.data.iconImage = `${this.data.iconImage}`
            const res = await this.callApi('post', 'app/create_category', this.data)
            if (res.status === 201) {
                this.categories.unshift(res.data)
                this.success('Category Has Been Added Successfully')
                this.addModal = false
                this.data.categoryName = ''
                this.data.iconImage = ''
            }else{
                if (res.status == 422) {
                    if (res.data.errors.categoryName) {
                        this.error(res.data.errors.categoryName[0])
                    }
                    if (res.data.errors.iconImage) {
                        this.error(res.data.errors.iconImage[0])
                    }
                }else{
                    this.error()
                }
            }
        },
        // TAG EDITING MODAL
        async editCategory() {
            // if (this.editData.categoryName.trim()=='') return this.error('Category Name Is Require')
            // if (this.editData.iconImage.trim()=='') return this.error('Icon Image Is Require')
            const res = await this.callApi('post', 'app/edit_category', this.editData)
            if (res.status === 200) {
                this.categories[this.index].categoryName = this.editData.categoryName
                this.categories[this.index].iconImage = this.editData.iconImage
                this.success('Category Has Been EDITED Successfully')
                this.editModal = false
                this.editData.categoryName = ''
                this.editData.iconImage = ''
            }else{
                if (res.status == 422) {
                    if (res.editData.errors.categoryName) {
                        this.error(res.editData.errors.categoryName[0])
                    }
                    if (res.editData.errors.iconImage) {
                        this.error(res.editData.errors.iconImage[0])
                    }
                }else{
                    this.error()
                }
            }
        },
        // SHOW EDIT MODAL
        showEditModal(category, index) {
            let obj = {
                id: category.id,
                categoryName: category.categoryName,
                iconImage: category.iconImage
            }
            this.editData = obj
            this.editModal = true
            this.index = index
            this.isEditingItem = true
        },
        // SHOW VIEW MODAL
        showViewModal(category, index){
            let obj = {
                id: category.id,
                categoryName: category.categoryName,
                iconImage: category.iconImage,
                createdAt: category.CreatedDate,
            }
            this.showData = obj
            this.showModal = true
            this.index = index
        },
        // DELETE TAG
        showDeletingModal(category, i) {
            const deleteModalObj = {
                showDeleteModal: true,
                deleteUrl: 'app/delete_category',
                data: category,
                deletingIndex: i,
                isDeleted: false,
            }
            this.$store.commit('setDeletingModalObj', deleteModalObj)
        },

        // DELETE IMAGE
        async deleteImage(isNew=true){
            let image
            if (!isNew) { // FOR EDITING
                this.isIconImageNew = true
                image = this.editData.iconImage
                this.editData.iconImage = ''
                this.$refs.editDataUploads.clearFiles()
            }else {
                image = this.data.iconImage
                this.data.iconImage = ''
                this.$refs.uploads.clearFiles()
            }
            const res = await this.callApi('post', 'app/delete_image', {imageName: image})
            if (res.status != 200) {
                this.data.iconImage = image
                this.error()
            }
        },
        handleSuccess (res, file) {
            res =  `/uploads/${res}`
            if (this.isEditingItem) {
                return this.editData.iconImage = res
            }
            this.data.iconImage = res
        },
        handleError (res, file) {
            this.warning(
                 'The file format is incorrect',
                 `${file.errors.file.length ? file.errors.file[0] : 'Something Went Wrong!'}`,
            );
        },
        handleFormatError (file) {
            this.warning(
                 'The file format is incorrect',
                 'File format of ' + file.name + ' is incorrect, please select jpg or png.',
            );
        },
        handleMaxSize (file) {
            this.warning(
                'Exceeding file size limit',
                'File  ' + file.name + ' is too large, no more than 2M.'
            );
        },
        closeEditModal() {
            this.isEditingItem = false
            this.editModal = false
        }
    },

    async created() {
        this.token = document.querySelector('meta[name="csrf-token"]').content;
        const res = await this.callApi('get', 'app/get_categories')
        if (res.status === 200) {
            this.categories = res.data
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
                this.categories.splice(obj.deletingIndex,1)
            }
        }
    },
}
</script>
