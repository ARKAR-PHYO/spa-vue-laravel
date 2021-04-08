<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center space-x-4">
                <h1 class="flex-auto text-4xl bg-gray-500"><input type="text" placeholder="Title" class="w-full border-none focus:outline-none"></h1>
                <button @click="save" class="flex flex-row items-center px-5 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <p class="">Save</p>
                </button>
            </div>
            <div class="flex flex-row my-6">
                <div class="w-3/4 editor">
                    <editor
                        ref="editor"
                        autofocus
                        holder-id="codex-editor"
                        save-button-id="save-button"
                        :initialized="onInitialized"
                        @save="onSave"
                        :config="config"
                    />
                </div>

                <div class="flex flex-col w-1/4 px-6 space-y-8 ">
                    <div class="px-3 py-2 space-y-4 bg-gray-200 shadow-lg">
                        <p class="text-lg font-medium text-center ">Category</p>
                        <select type="text" placeholder="Categories" name="categories" id="categories" class="w-full p-2 overflow-hidden border border-gray-700 rounded-md focus:outline-none">
                            <option class="text-gray-400" :value="null" disabled selected>Select Category</option>
                            <option value="Category 1">Category 1</option>
                            <option value="Category 2">Category 2</option>
                            <option value="Category 3">Category 3</option>
                        </select>
                    </div>
                    <div class="px-3 py-2 space-y-4 bg-gray-200 shadow-lg">
                        <p class="text-lg font-medium text-center">Tag</p>
                        <select type="text" placeholder="Tags" name="tags" id="tags" class="w-full p-2 overflow-hidden border border-gray-700 rounded-md focus:outline-none">
                            <option class="text-gray-400" :value="null" disabled selected>Select Tag</option>
                            <option value="Tag 1">Tag 1</option>
                            <option value="Tag 2">Tag 2</option>
                            <option value="Tag 3">Tag 3</option>
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Icon from './../../shared/Icon'
import ImageTool from '@editorjs/image'

export default {

    components: {
        Icon,
    },
    data() {
        return {
            config: {
                tools: {
                    image: {
                        class: ImageTool,
                        config: {
                            endpoints: {
                                // byFile: 'http://localhost:8008/uploadFile', // Your backend file uploader endpoint
                                // byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by Url
                            }
                        }
                    }
                }
			},
        };
    },
    watch:{

    },

    methods: {
        async onInitialized(response){
            console.log('mentod', response)
        },
        async onSave(response){
            console.log('mentod on save', response)
        },
        async save(){
            this.$refs.editor._data.state.editor.save()
        },
    }
};
</script>

