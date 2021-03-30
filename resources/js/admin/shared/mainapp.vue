<template>
    <div class="flex flex-row h-screen">
            <div v-if="$store.state.user" class="flex flex-col w-56 bg-gray-600">
                <a href="/" class="flex items-center justify-center py-2 bg-gray-50">
                    <logo />
                </a>
                <!-- <mainmenu :user="this.user" /> --> <!-- PASS USER PROP IF SMTH WRONG WITH MENU -->
                <mainmenu :user="this.user" />
            </div>
            <div class="flex flex-col w-full">
                <!-- TOP NAV BAR -->
                <div v-if="$store.state.user" class="flex flex-row items-center h-16 px-12 py-6 bg-gray-100 shadow-md">
                    <div class="flex-auto">Super Admin</div>
                    <div class="flex flex-row items-center space-x-4">
                        <icon name="bell" class="w-5 h-5" />
                        <dropdown>
                            <span>{{ user.fullName }}</span>
                            <div slot="dropdown" class="flex flex-col">
                                <router-link to="/" class="flex items-center px-4 py-2 space-x-3 text-gray-700 hover:bg-gray-200 hover:text-gray-700">
                                    <icon name="gear" class="w-6" />
                                    <span>Setting</span>
                                </router-link>
                                <a href="/logout" class="flex items-center px-4 py-2 space-x-3 text-gray-700 hover:bg-gray-200 hover:text-gray-700">
                                    <icon name="logout" class="w-6" />
                                    <span>Logout</span>
                                </a>
                            </div>
                        </dropdown>
                    </div>
                </div>
                <!-- TOP NAV BAR END -->

                <!-- MIDDLE CONTENT -->
                <div class="flex-auto overflow-y-auto">
                    <router-view class=" md:py-6 md:px-12" />
                </div>
                <!-- MIDDLE CONTENT END -->

                <!-- MAIN FOOTER -->
                <mainFooter v-if="$store.state.user" />
                <!-- MAIN FOOTER END -->
            </div>
        </div>
</template>
<script>

// import icon from './Icon'
import mainmenu from './mainMenu'
import dropdown from './Dropdown'
import Logo from './Logo';
import Icon from './Icon.vue';
import mainFooter from './mainFooter';

export default {
    props: [
        'user',
    ],
    components: {
        // icon,
        Icon,
        mainmenu,
        Logo,
        mainFooter,
        dropdown
    },

    data() {
        return {
            isLoggedIn: false,
        }
    },

    created() {
        this.$store.commit('updateUser', this.user)
    },
}
</script>
