<template>
    <div>
        <Modal
        :value="getDeleteModalObj.showDeleteModal"
        :mask-closable="false"
        :closable="false"
        >
            <div slot="header" class="flex items-center justify-center space-x-4 text-lg font-semibold text-red-500">
                <icon name="info" class="w-4 h-4 fill-current" />
                <span>Delete confirmation</span>
            </div>
            <div style="text-align:center">
                <p>Are You Sure Want To Delete This?</p>
            </div>
            <div slot="footer" class="flex">
                <button @click="closeModal" class="w-full py-2 transform border border-gray-800 rounded-md hover:scale-95 focus:outline-none">Cancel</button>
                <button @click="deleteModal" class="w-full py-2 text-white transform bg-red-500 rounded-md hover:scale-95 focus:outline-none">Delete</button>
            </div>
        </Modal>
    </div>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
    data() {
        return {
            isDeleting: false,
        }
    },

    methods: {
        async deleteModal() {

            const res = await this.callApi('post', this.getDeleteModalObj.deleteUrl, this.getDeleteModalObj.data)
            if (res.status === 200) {
                this.success('DATA HAS BEEN DELETED SUCCESSFULLY')
                this.$store.commit('setDeleteModal', true)
            }else{
                this.error()
                this.$store.commit('setDeleteModal', false)
            }
            this.showDeleteModal = false

        },

        closeModal() {
            this.$store.commit('setDeleteModal', false)
        }
    },

    computed : {
        ...mapGetters(['getDeleteModalObj'])
    }

}
</script>
