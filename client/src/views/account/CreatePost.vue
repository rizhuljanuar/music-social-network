<script setup>
import { ref } from "vue";
import TextInput from "../../components/global/TextInput.vue";
import DisplayCropperButton from "../../components/global/DisplayCropperButton.vue";
import CropperModal from "../../components/global/CropperModal.vue";
import TextArea from "../../components/global/TextArea.vue";
import SubmitFormButton from "../../components/global/SubmitFormButton.vue";
import CroppedImage from "../../components/global/CroppedImage.vue";
import { useUserStore } from "../../store/user";
import { usePostStore } from "../../store/post";
import { useRouter } from "vue-router";
import Swal from "sweetalert2";
import axios from "axios";

const userStore = useUserStore();
const postStore = usePostStore();
const router = useRouter();

let showModal = ref(false);
let title = ref(null);
let location = ref(null);
let description = ref(null);
let imageData = null;
let image = ref(null);
let errors = ref([]);

const setCroppedImageData = (data) => {
  imageData = data;
  image.value = data.imageUrl;
};

const createPost = async () => {
  errors.value = [];

  if (imageData === null) {
    Swal.fire(
      "No cropped image found?",
      "Please crop an image of your choice and complete all other inputs",
      "warning"
    );

    return null;
  }

  let data = new FormData();

  data.append("user_id", userStore.id || "");
  data.append("title", title.value || "");
  data.append("location", location.value || "");
  data.append("description", description.value || "");

  if (imageData) {
    data.append("image", imageData.file || "");
    data.append("height", imageData.height || "");
    data.append("width", imageData.width || "");
    data.append("left", imageData.left || "");
    data.append("top", imageData.top || "");
  }

  try {
    console.log(data);
    await axios.post("api/posts/", data);

    Swal.fire(
      "New post created!",
      'The post you created was called "' + title.value + '"',
      "success"
    );

    await postStore.fetchPostByUserId(userStore.id);

    setTimeout(() => {
      router.push("/account/profile/" + userStore.id);
    }, 200);
  } catch (error) {
    errors.value = error.response.data.errors;
  }
};
</script>

<template>
  <div id="createPost" class="container max-w-4xl mx-auto pt-20 pb-20 px-6">
    <div class="text-gray-900 text-xl">Create Post</div>
    <div class="bg-green-500 w-full h-1"></div>

    <CropperModal
      v-if="showModal"
      :minAspectRatioProp="{ width: 16, height: 9 }"
      :maxAspectRatioProp="{ width: 16, height: 9 }"
      @croppedImageData="setCroppedImageData"
      @showModal="showModal = false"
    />

    <div class="flex flex-wrap mt-4 mb-6">
      <div class="w-full md:w-1/2 px-3">
        <TextInput
          label="Title"
          placeholder="Awesome Concert"
          v-model:input="title"
          inputType="text"
          :error="errors.title ? errors.title[0] : ''"
        />
      </div>
      <div class="w-full md:w-1/2 px-3">
        <TextInput
          label="Location"
          placeholder="Jakarta"
          v-model:input="location"
          inputType="text"
          :error="errors.location ? errors.location[0] : ''"
        />
      </div>
    </div>
    <div class="flex flex-wrap mt-4 mb-6">
      <div class="w-full md:w-1/2 px-3">
        <DisplayCropperButton
          label="Post Image"
          btnText="Add Post Image"
          @showModal="showModal = true"
        />
      </div>
    </div>
    <div class="flex flex-wrap mt-4 mb-6">
      <div class="w-full px-3">
        <CroppedImage label="Cropped Image" :image="image" />
      </div>
    </div>
    <div class="flex flex-wrap mt-4 mb-6">
      <div class="w-full md:w-1/2 px-3">
        <TextArea
          label="Description"
          placeholder="Please enter some information user"
          v-model:description="description"
          :error="errors.description ? errors.description[0] : ''"
        />
      </div>
    </div>
    <div class="flex flex-wrap mt-4 mb-6">
      <div class="w-full px-3">
        <SubmitFormButton @submit="createPost" btnText="Create Post" />
      </div>
    </div>
  </div>
</template>
