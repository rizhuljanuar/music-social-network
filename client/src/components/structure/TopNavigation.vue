<script setup>
import { RouterLink } from "vue-router";
import FullScreenModal from "../structure/FullScreenModal.vue";
</script>

<template>
  <nav class="w-full px-4 bg-black relative z-20 text-white-200">
    <div
      class="container mx-auto max-w-4xl h-16 flex justify-between text-xs md:text-sm"
    >
      <div class="h-full flex items-center">
        <RouterLink to="" class="flex justify-center items-center">
          <div class="text-white text-2xl">MSN</div>
        </RouterLink>
      </div>
      <div class="h-full flex items-center">
        <FullScreenModal />
      </div>
    </div>
  </nav>
</template>
