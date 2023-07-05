import axios from "axios";
import { defineStore } from "pinia";

export const useSongStore = defineStore("song", {
  state: () => ({
    artistId: null,
    artistName: null,
    songs: null,
  }),
  actions: {
    async fetchSongsByUserId(userId) {
      let res = await axios.get("api/songs/user/" + userId);
      console.log(res);

      this.$state.artistId = res.data.artist_id;
      this.$state.artistName = res.data.artist_name;
      this.$state.songs = res.data.songs;
    },

    clearSongs() {
      this.$state.artistId = null;
      this.$state.artistName = null;
      this.$state.songs = [];
    },
  },
  persist: true,
});
