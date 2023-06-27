<script setup>
import { useUserStore } from "../../../store/user";

const userStore = useUserStore();
</script>

<template>
  <div class="py-2">
    <p class="text-gray-900 text-lg">
      <b>About me</b>
    </p>
    <p class="text-md md:text-lg text-gray-600 leading-normal">
      {{ userStore.description }}
    </p>
  </div>
</template>
