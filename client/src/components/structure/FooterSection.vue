<script setup>
import { RouterLink } from "vue-router";
</script>

<template>
  <div class="w-full bg-black text-gray-100">
    <div
      class="container mx-auto max-w-4xl h-full flex flex-wrap justify-between items-start text-sm p-6 pt-8 pb-4"
    >
      <div>
        <div class="mb-2 text-lg underline">Quick links</div>
        <RouterLink to="/" class="block mb-2">Home</RouterLink>
      </div>
      <div>
        <div class="mb-2 text-lg underline">Our company</div>
        <p class="mb-4 leading-normal">
          123 Main Street <br />
          London <br />
          SW1 SW1
        </p>
        <p class="text-sm">07775 444 999</p>
      </div>
    </div>
    <div
      class="container mx-auto max-w-4xl h-full flex flex-wrap justify-between items-start text-sm py-6 pl-6 pr-4"
    >
      &copy;2023 MSN Company. All rights reserved.
      <div class="pt-4 md:p-0 text-left text-xs">
        <div class="no-underline hover:underline ml-4">Privacy Policy</div>
        <div class="no-underline hover:underline ml-4">Terms & Conditions</div>
        <div class="no-underline hover:underline ml-4">Contact Us</div>
      </div>
    </div>
  </div>
</template>
