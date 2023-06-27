<script setup>
import { onMounted } from "vue";
import APlayer from "aplayer";
import "aplayer/dist/APlayer.min.css";
import { useSongStore } from "../../../store/song";

const songStore = useSongStore();
let songsList = [];

onMounted(() => {
  mapSongs();
  thePlayer();
});

const mapSongs = () => {
  let newSongs = songStore.songs.map(function (song) {
    return {
      name: song.title,
      artist: songStore.artistName,
      url:
        process.env.VITE_APP_API_URL +
        "songs/" +
        songStore.artistId +
        "/" +
        song.song,
    };
  });

  for (let i = 0; i < newSongs.length; i++) {
    songsList.push(newSongs[i]);
  }
};

const thePlayer = () => {
  new APlayer({
    container: document.getElementById("aplayer"),
    audio: songsList,
  });
};
</script>

<template>
  <div class="bg-green-500 rounded">
    <div id="aplayer"></div>
  </div>
</template>
