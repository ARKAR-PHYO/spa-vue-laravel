<template>
    <div class="flex flex-row h-screen">
            <div class="flex flex-col w-56 bg-gray-600">
                <router-link to="/" class="flex items-center justify-center py-2 bg-gray-50">
                    <logo />
                </router-link>
                <mainmenu />
            </div>
            <div class="flex flex-col w-full">
                <!-- TOP NAV BAR -->
                <div class="flex flex-row items-center h-16 px-12 py-6 bg-gray-100 shadow-md">

                    <div class="flex-auto">Super Admin</div>
                    <div class="flex flex-row items-center space-x-4">
                        <icon name="bell" class="w-5 h-5" />
                        <dropdown>
                            <span>First Last</span>
                            <div slot="dropdown" class="flex flex-col">
                                <router-link to="/" class="flex items-center px-4 py-2 space-x-3 text-gray-700 hover:bg-gray-200 hover:text-gray-700">
                                    <icon name="gear" class="w-6" />
                                    <span>Setting</span>
                                </router-link>
                                <router-link to="/" class="flex items-center px-4 py-2 space-x-3 text-gray-700 hover:bg-gray-200 hover:text-gray-700">
                                    <icon name="logout" class="w-6" />
                                    <span>Logout</span>
                                </router-link>
                            </div>
                        </dropdown>
                    </div>
                </div>
                <!-- TOP NAV BAR END -->

                <!-- MIDDLE CONTENT -->
                <div class="flex-auto overflow-y-auto md:py-6 md:px-12">
                    <router-view />
                </div>
                <!-- MIDDLE CONTENT END -->

                <!-- MAIN FOOTER -->
                <mainFooter />
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
    components: {
        // icon,
        Icon,
        mainmenu,
        Logo,
        mainFooter,
        dropdown
    },
}
</script>
