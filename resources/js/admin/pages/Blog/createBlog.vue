<template>
    <!-- component -->
    <div class="flex items-center justify-center">
        <div class="w-full">
            <div class="flex items-center space-x-4">
                <button class="flex flex-row items-center px-5 py-2 space-x-1 text-white transform bg-blue-400 rounded-md shadow-md focus:outline-none hover:scale-105">
                    <p class="">Save</p>
                </button>
            </div>

            <!-- TABLE -->
            <div class="my-6 ">
                <h1 class="block max-w-4xl mx-auto text-4xl"><input type="text" placeholder="Title" class="w-full border-none focus:outline-none"></h1>
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

        };
    },
    methods: {

    }
};
</script>
<style>
</style>
