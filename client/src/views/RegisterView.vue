<script setup>
import axios from "axios";
import { RouterLink, useRouter } from "vue-router";
import { ref } from "vue";
import { useUserStore } from "../store/user";
import { useProfileStore } from "../store/profile";
import { usePostStore } from "../store/post";
import { useSongStore } from "../store/song";
import { useVideoStore } from "../store/video";
import TextInput from "../components/global/TextInput.vue";

const router = useRouter();
const userStore = useUserStore();
const profileStore = useProfileStore();
const songStore = useSongStore();
const postStore = usePostStore();
const videoStore = useVideoStore();

let errors = ref([]);
let firstName = ref(null);
let lastName = ref(null);
let email = ref(null);
let password = ref(null);
let confirmPassword = ref(null);

const register = async () => {
  errors.value = [];

  try {
    let res = await axios.post("api/register", {
      first_name: firstName.value,
      last_name: lastName.value,
      email: email.value,
      password: password.value,
      password_confirmation: confirmPassword.value,
    });

    axios.defaults.headers.common["Authorization"] = "Bearer " + res.data.token;
    userStore.setUserDetails(res);

    await profileStore.fetchProfileById(userStore.id);
    await songStore.fetchSongsByUserId(userStore.id);
    await postStore.fetchPostByUserId(userStore.id);
    await videoStore.fetchVideoByUserId(userStore.id);

    router.push("/account/profile/" + userStore.id);
  } catch (error) {
    console.log(error);
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
              label="First Name"
              :labelColor="false"
              placeholder="Rizhul"
              v-model:input="firstName"
              inputType="text"
              :error="errors.first_name ? errors.first_name[0] : ''"
            />
          </div>
          <div class="mb-4">
            <TextInput
              label="Last Name"
              :labelColor="false"
              placeholder="Januar"
              v-model:input="lastName"
              inputType="text"
              :error="errors.last_name ? errors.last_name[0] : ''"
            />
          </div>
          <div class="mb-4">
            <TextInput
              label="Email"
              :labelColor="false"
              placeholder="zhul@email.com"
              v-model:input="email"
              inputType="text"
              :error="errors.email ? errors.email[0] : ''"
            />
          </div>
          <div class="mb-4">
            <TextInput
              label="Password"
              :labelColor="false"
              placeholder="password123?"
              v-model:input="password"
              inputType="password"
              :error="errors.password ? errors.password[0] : ''"
            />
          </div>
          <div class="mb-4">
            <TextInput
              label="Confirm Password"
              :labelColor="false"
              placeholder="password123?"
              v-model:input="confirmPassword"
              inputType="password"
            />
          </div>
          <button
            class="block w-full bg-green-500 text-white rounded-sm py-3 text-sm tracking-wide"
            type="submit"
            @click="register"
          >
            Register
          </button>
        </div>
        <p class="text-center text-md text-gray-900">
          Already have an account ?
          <RouterLink
            class="text-blue-500 no-underline hover:underline"
            to="login"
          >
            Login
          </RouterLink>
        </p>
      </div>
    </div>
  </div>
</template>

<style lang="scss"></style>
