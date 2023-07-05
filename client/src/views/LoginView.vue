<script setup>
import { ref } from "vue";
import axios from "axios";
import { RouterLink } from "vue-router";
import { useUserStore } from "../store/user";
import { useVideoStore } from "../store/video";
import { useSongStore } from "../store/song";
import { usePostStore } from "../store/post";
import { useProfileStore } from "../store/profile";
import { useRouter } from "vue-router";
import TextInput from "../components/global/TextInput.vue";

const userStore = useUserStore();
const videoStore = useVideoStore();
const songStore = useSongStore();
const postStore = usePostStore();
const profileStore = useProfileStore();
const router = useRouter();

let errors = ref([]);
let email = ref(null);
let password = ref(null);

const login = async () => {
  try {
    let res = await axios.post("api/login", {
      email: email.value,
      password: password.value,
    });

    axios.defaults.headers.common["Authorization"] = "Bearer " + res.data.token;
    userStore.setUserDetails(res);

    await profileStore.fetchProfileById(userStore.id);
    await songStore.fetchSongsByUserId(userStore.id);
    await postStore.fetchPostByUserId(userStore.id);
    await videoStore.fetchVideoByUserId(userStore.id);

    router.push("/account/profile/" + userStore.id);
  } catch (error) {
    errors.value = error.response.data.errors;
  }
};
</script>

<template>
  <div id="register">
    <div class="w-full p-6 flex justify-center items-center">
      <div class="w-full max-w-xs">
        <div class="bg-black p-8 shadow rounded mb-6">
          <h1 class="mb-6 text-lg text-gray-100 font-thin">
            Let's get rocking
          </h1>
          <div class="mb-4">
            <TextInput
              label="Email"
              :labelColor="false"
              placeholder="email"
              v-model:input="email"
              inputType="text"
              :error="errors.email ? errors.email[0] : ''"
            />
          </div>
          <div class="mb-4">
            <TextInput
              label="Password"
              :labelColor="false"
              placeholder="password"
              v-model:input="password"
              inputType="password"
              :error="errors.password ? errors.password[0] : ''"
            />
          </div>
          <button
            class="block w-full bg-green-500 text-white rounded-sm py-3 text-sm tracking-wide"
            type="submit"
            @click="login"
          >
            Login
          </button>
        </div>
        <p class="text-center text-md text-gray-900">
          Don't have an account yet ?
          <RouterLink
            class="text-blue-500 no-underline hover:underline"
            to="register"
          >
            Register
          </RouterLink>
        </p>
      </div>
    </div>
  </div>
</template>
