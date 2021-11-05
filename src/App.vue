<style src="./assets/css/style.bundle.css"></style>
<style src="./assets/plugins/global/plugins.bundle.css"></style>
<style
  src="./assets/plugins/custom/fullcalendar/fullcalendar.bundle.css"
></style>
<template>
  <body
    class="page-bg header-fixed header-tablet-and-mobile-fixed aside-enabled"
  >
    <MainLoader v-if="isLoading" />
    <router-view v-else :key="$route.fullPath" />
    <notifications
      :ignoreDuplicates="true"
      position="top right"
      class="my-2 ml-2"
    />
  </body>
</template>
<script>
import MainLoader from "@/components/Loaders/MainLoader.vue";
export default {
  components: {
    MainLoader,
  },
  data() {
    return {
      isLoading: false,
    };
  },
  created() {
    this.getUser();
  },
  methods: {
    getUser() {
      this.isLoading = true;
      this.$appAxios
        .get("user")
        .then((res) => {
          this.$store.state.User.user = res.data;
          this.$store.state.User.isAuth = true;
          localStorage.setItem("role", res.data.role);
        })
        .catch(() => {
          this.$router.push({ name: "Login" });
          localStorage.removeItem("token");
          localStorage.removeItem("role");
        })
        .finally(() => {
          setTimeout(() => {
            this.isLoading = false;
          }, 1000);
        });
    },
  },
};
</script>
