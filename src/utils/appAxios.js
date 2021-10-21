import axios from "axios";

import CryptoJS from "crypto-js";
let decryptToken = null;
let bytes = null;
let decryptedToken = null;
if (localStorage.getItem("token")) {
  decryptToken = localStorage.getItem("token");
  bytes = CryptoJS.AES.decrypt(decryptToken, "vuexisawesomesecret");
  decryptedToken = bytes.toString(CryptoJS.enc.Utf8);
}
export const appAxios = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    Authorization: decryptedToken,
  },
});
