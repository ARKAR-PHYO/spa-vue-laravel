<template>
    <div class="relative inline-block text-left text-gray-800" @clickaway="closeMenu">
    <div>
      <span class="">
        <button
          @click="isMenuOpen = !isMenuOpen"
          type="button"
          class="inline-flex items-center justify-between w-full h-10 px-4 py-4 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-800 btn-focus"
          id="options-menu"
          aria-haspopup="true"
          aria-expanded="true">

          <slot />
          <icon name="cheveron-down" class="w-5 ml-2 fill-current" />
        </button>
      </span>
    </div>
    <transition
      enter-active-class="transition duration-100 ease-out"
      enter-class="transform scale-95 opacity-0"
      enter-to-class="transform scale-100 opacity-100"
      leave-active-class="transition duration-75 ease-in"
      leave-class="transform scale-100 opacity-100"
      leave-to-class="transform scale-95 opacity-0"
    >
      <div v-if="isMenuOpen" class="absolute right-0 z-20 w-56 mt-2 overflow-hidden text-sm origin-top-right border rounded-md shadow-lg">
        <div class="flex flex-col bg-white rounded-md shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="options-menu" >
            <slot class="flex flex-col" name="dropdown" />
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
import Icon from './Icon';

export default {
    components: {
        Icon,
    },
    data() {
        return {
            isMenuOpen: false
        }
    },

    methods: {
        closeMenu() {
            this.isMenuOpen = false
        }
    },
}
</script>
