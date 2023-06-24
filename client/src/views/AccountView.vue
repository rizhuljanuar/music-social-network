<script setup>
import { RouterView } from "vue-router";
import FooterSection from "../components/structure/FooterSection.vue";
import TopNavigation from "../components/structure/TopNavigation.vue";
</script>

<template>
  <TopNavigation />
  <div id="accountView" class="max-w-4xl mx-auto">
    <RouterView />
  </div>
  <FooterSection />
</template>

<style lang="scss">
#accountView {
  min-height: 70vh;
}
</style>
