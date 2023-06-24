<script setup>
import { onMounted } from "vue";
import APlayer from "aplayer";
import "aplayer/dist/APlayer.min.css";
onMounted(() => {
  thePlayer();
});

const thePlayer = () => {
  new APlayer({
    container: document.getElementById("aplayer"),
    audio: [
      {
        name: "First Song",
        artist: "artist",
        url: "../../../../public/music/battle-of-the-dragons-8037.mp3",
        cover: "cover.jpg",
      },
      {
        name: "Second Song",
        artist: "artist",
        url: "../../../../public/music/epic-hollywood-trailer-9489.mp3",
        cover: "cover.jpg",
      },
    ],
  });
};
</script>

<template>
  <div class="bg-green-500 rounded">
    <div id="aplayer"></div>
  </div>
</template>
