import axios from "axios";
import { defineStore } from "pinia";

export const usePostStore = defineStore("post", {
  state: () => ({
    posts: null,
  }),
  actions: {
    async fetchPostByUserId(userId) {
      let res = await axios.get("api/posts/user/" + userId);
      this.$state.posts = res.data;
    },

    postImage(image) {
      return process.env.VITE_APP_API_URL + "images/posts/" + image;
    },

    clearPosts() {
      this.$state.posts = null;
    },
  },
  persist: true,
});
