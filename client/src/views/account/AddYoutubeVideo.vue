<script setup>
import SubmitFormButton from "../../components/global/SubmitFormButton.vue";
import TextInput from "../../components/global/TextInput.vue";
import { useRouter } from "vue-router";
import { useUserStore } from "../../store/user";
import { ref } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

const router = useRouter();
const userStore = useUserStore();

let title = ref(null);
let videoCode = ref(null);
let errors = ref([]);

const addYoutubeVideoLink = async () => {
  errors.value = [];

  try {
    await axios.post("api/youtube", {
      user_id: userStore.id,
      title: title.value,
      url: videoCode.value,
    });

    Swal.fire(
      "New video added",
      `You added a video with the name ${title.value}`,
      "succes"
    );

    router.push("/account/profile");
  } catch (error) {
    errors.value = error.response.data.errors;
  }
};
</script>

<template>
  <div id="addYoutubeVideo" class="container mx-auto max-w-4xl pt-20 px-6">
    <div class="text-gray-900 text-xl">Add Youtube Video</div>
    <div class="bg-green-500 w-full h-1 mb-4"></div>

    <TextInput
      class="mb-6"
      label="Title"
      placeholder="Cool New Video"
      v-model:input="title"
      inputType="text"
      :error="errors.title ? errors.title[0] : ''"
    />
    <TextInput
      class="mb-2"
      label="Video URL"
      placeholder="2VnYXKwneUQ"
      v-model:input="videoCode"
      inputType="text"
      :error="errors.url ? errors.url[0] : ''"
    />

    <SubmitFormButton btnText="Add Song" @click="addYoutubeVideoLink" />
  </div>
</template>
