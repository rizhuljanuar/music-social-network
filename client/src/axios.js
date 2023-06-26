import axios from "axios";

const user = JSON.parse(window.localStorage.getItem("user"));

axios.defaults.baseURL = process.env.VITE_APP_API_URL;

if (user) {
  axios.defaults.headers.common["Authorization"] = "Bearer " + user.token;
}
