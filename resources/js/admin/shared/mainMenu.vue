<template>
    <div class="">
        <div class="flex items-center justify-center py-4 text-white bg-blue-900">
            <span>{{ new Date().toLocaleString() }}</span>
        </div>
        <div class="flex-auto overflow-y-auto">
            <router-link to="/" class="routerLink">
                <icon name="dashboard" class="icon" />
                <div class="">Dashboard</div>
            </router-link>
            <router-link to="/tag" class="routerLink">
                <icon name="tag" class="icon" />
                <div class="">Tag</div>
            </router-link>
        </div>
    </div>
</template>
<script>
import icon from './Icon'

export default {
    components: {icon}
}
</script>
