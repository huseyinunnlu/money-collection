<template>
  <MainLoader v-if="isLoading" />
  <router-view v-else :key="$route.fullPath"/>
  <notifications :ignoreDuplicates="true" position="top right" class="my-2 ml-2" />
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
          this.isLoading = false;
        });
    },
  },
};
</script>
