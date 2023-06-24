<script setup>
import RouterLinkButton from "../../global/RouterLinkButton.vue";
</script>

<template>
  <div>
    <div class="mx-auto py-4">
      <div class="flex flex-wrap font-bold text-gray-100">
        <div class="text-gray-900 text-xl">Posts</div>
        <div class="bg-green-500 w-full h-1"></div>
        <div class="w-full mt-4">
          <RouterLinkButton
            class="ml-2"
            btnText="Create Post"
            color="green"
            url="/account/create-post"
          />
        </div>
      </div>
    </div>
    <div class="flex flex-wrap mb-4">
      <div class="my-1 px-1 w-full md:w-1/2 lg:w-1/2">
        <div class="rounded-lg border">
          <a href="#">
            <img
              class="rounded-t-lg w-full"
              src="https://via.placeholder.com/500x300"
              alt=""
            />
          </a>
          <div class="p-2 md:p-4">
            <div class="text-lg">
              <RouterLink
                class="underline text-blue-500 hover:text-blue-600"
                to=""
              >
                Test Title
              </RouterLink>
            </div>
            <p class="py-2">Location: Test Location</p>
            <p class="text-gray-darker text-md">
              Lorem ipsum dolor sit amet, officia excepteur ex fugiat
              reprehenderit enim labore culpa sint ad nisi Lorem pariatur mollit
              ex esse exercitation amet. Nisi anim cupidatat excepteur officia.
              Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet
              voluptate voluptate dolor minim nulla est proident. Nostrud
              officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex
              occaecat reprehenderit commodo officia dolor Lorem duis laboris
              cupidatat officia voluptate. Culpa proident adipisicing id nulla
            </p>
            <div class="mt-2 flex items-center justify-end">
              <RouterLink
                class="mr-1 bg-blue-500 hover:bg-blue-700 text-white text-sm font-bold py-1 px-2 rounded-full"
                to=""
              >
                Edit Post
              </RouterLink>
              <button
                class="bg-red-500 hover:bg-red-700 text-white text-sm font-bold py-1 px-2 rounded-full"
                to=""
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
