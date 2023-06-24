<script setup>
import { ref } from "vue";
import { RouterLink } from "vue-router";
import TextInput from "../components/global/TextInput.vue";

let email = ref(null);
let password = ref(null);
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
              error="This is a text error"
            />
          </div>
          <div class="mb-4">
            <TextInput
              label="Password"
              :labelColor="false"
              placeholder="password"
              v-model:input="password"
              inputType="password"
              error="This is a text error"
            />
          </div>
          <button
            class="block w-full bg-green-500 text-white rounded-sm py-3 text-sm tracking-wide"
            type="submit"
          >
            Register
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
