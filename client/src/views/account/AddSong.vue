<script setup>
import { ref } from "vue";
import { useUserStore } from "../../store/user";
import { useSongStore } from "../../store/song";
import { useRouter } from "vue-router";
import SubmitFormButton from "../../components/global/SubmitFormButton.vue";
import TextInput from "../../components/global/TextInput.vue";
import Swal from "../../sweetalert";
import axios from "axios";

const userStore = useUserStore();
const songStore = useSongStore();
const router = useRouter();

let title = ref(null);
let song = ref(null);
let file = ref(null);
let errors = ref([]);

const handleFileUpload = () => {
  song.value = file.value.files[0];
};

const addSong = async () => {
  if (!song.value) {
    Swal.fire(
      "Oops, something went wrong",
      "You forgot to upload the mp3 file!",
      "warning"
    );

    return null;
  }

  try {
    let form = new FormData();

    form.append("user_id", userStore.id);
    form.append("title", title.value || "");
    form.append("file", song.value);

    await axios.post("api/songs", form);
    songStore.fetchSongsByUserId(userStore.id);

    setTimeout(() => {
      router.push("/account/profile/" + userStore.id);
    }, 200);
  } catch (error) {
    errors.value = error.response.data.errors;
  }
};
</script>

<template>
  <div id="addSong" class="container mx-auto max-w-4xl pt-20 px-6">
    <div class="text-gray-900 text-xl">Add Song</div>
    <div class="bg-green-500 w-full h-1 mb-4"></div>

    <TextInput
      class="mb-6"
      label="Title"
      placeholder="Cool New Song"
      v-model:input="title"
      inputType="text"
      :error="errors.title ? errors.title[0] : ''"
    />

    <div class="w-full">
      <label
        class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
      >
        Select Image
      </label>
      <input
        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-400 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
        type="file"
        id="image"
        ref="file"
        @change="handleFileUpload"
      />
    </div>
    <SubmitFormButton btnText="Add Song" @click="addSong" />
  </div>
</template>
