<template>
    <div class="">
        <div class="flex items-center justify-center py-4 text-white bg-blue-900">
            <span>{{ new Date().toLocaleString() }}</span>
        </div>
        <div class="flex-auto overflow-y-auto">
            <div v-for="(menuItem, i) in permission" :key="i" v-if="permission.length && menuItem.read" class="">
                <router-link :to="menuItem.name" class="routerLink">
                    <icon name="dashboard" class="icon" />
                    <div class="">{{ menuItem.resourceName }}</div>
                </router-link>
            </div>
            <!-- <div class="">
                <router-link to="/tags" class="routerLink">
                    <icon name="tag" class="icon" />
                    <div class="">Tag</div>
                </router-link>
            </div>
            <div class="">
                <router-link to="/categories" class="routerLink">
                    <icon name="tag" class="icon" />
                    <div class="">Categories</div>
                </router-link>
            </div>
            <div class="">
                <router-link to="/adminusers" class="routerLink">
                    <icon name="tag" class="icon" />
                    <div class="">Admin Users</div>
                </router-link>
            </div>
            <div class="">
                <router-link to="/roles" class="routerLink">
                    <icon name="tag" class="icon" />
                    <div class="">Role</div>
                </router-link>
            </div>
            <div class="">
                <router-link to="/assignRoles" class="routerLink">
                    <icon name="tag" class="icon" />
                    <div class="">Assign Role</div>
                </router-link>
            </div> -->

        </div>
    </div>
</template>
<script>
import icon from './Icon'

export default {
    props: [
        'user',
        'permission',
    ],
    components: {
        icon,
    },

    // created() {
    //     this.$store.commit('updateUser', this.user)
    // },
}
</script>
