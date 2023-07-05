<script setup>
import RouterLinkButton from "../../global/RouterLinkButton.vue";
import { useVideoStore } from "../../../store/video";
import { useUserStore } from "../../../store/user";
import { useRoute } from "vue-router";
import { onMounted } from "vue";

const route = useRoute();
const videoStore = useVideoStore();
const userStore = useUserStore();

onMounted(async () => {
  await videoStore.fetchVideoByUserId(route.params.id);
});
</script>

<template>
  <div>
    <div class="mx-auto py-4">
      <div class="flex flex-wrap font-bold text-gray-100">
        <div class="text-gray-900 text-xl">Youtube Videos</div>
        <div class="bg-green-500 w-full h-1">Songs</div>
        <div
          class="w-full mt-4"
          v-if="userStore.id === parseInt(route.params.id)"
        >
          <RouterLinkButton
            class="ml-2"
            btnText="Delete Youtube Video"
            color="red"
            url="/account/delete-youtube-video"
          />
          <RouterLinkButton
            btnText="Add Youtube Video"
            color="green"
            url="/account/add-youtube-video"
          />
        </div>
      </div>
    </div>
    <div class="flex flex-wrap mb-4">
      <div
        v-for="video in videoStore.videos"
        :key="video"
        class="my-1 px-1 w-full md:w-1/2 lg:w-1/2"
      >
        <div class="text-xl text-gray-900">{{ video.title }}</div>
        <iframe class="w-full h-60" :src="video.url"></iframe>
      </div>
    </div>
  </div>
</template>
