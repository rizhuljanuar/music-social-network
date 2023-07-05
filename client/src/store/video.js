import axios from "axios";
import { defineStore } from "pinia";

export const useVideoStore = defineStore("video", {
  state: () => ({
    videos: null,
  }),
  actions: {
    async fetchVideoByUserId(userId) {
      let res = await axios.get("api/youtube/" + userId);
      this.$state.videos = res.data.videos_by_user;
    },

    clearVideos() {
      this.$state.videos = null;
    },
  },
  persist: true,
});
