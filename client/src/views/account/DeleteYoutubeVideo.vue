<script setup>
import SubmitFormButton from "../../components/global/SubmitFormButton.vue";
import TextInput from "../../components/global/TextInput.vue";
</script>

<template>
  <div id="deleteYoutubeVideo" class="container mx-auto max-w-4xl pt-20 px-6">
    <div class="text-gray-900 text-xl">Delete Youtube Video</div>
    <div class="bg-red-500 w-full h-1 mb-4"></div>

    <div class="bg-white rounded px-8 pt-6 pb-8">
      <div class="flex flex-wrap">
        <div class="w-1/4 mr-auto mt-2 text-lg p-1 text-gray-900">
          1. This is a youtube video
          <iframe
            class="w-full h-20"
            src="https://www.youtube.com/embed/LaQj636PJh0?autoplay=0"
          ></iframe>
        </div>
        <div class="w-1/4 ml-auto p-1">
          <button
            class="float-right bg-transparent hover:bg-red-500 text-gray-900 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
