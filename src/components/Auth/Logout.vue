<template>
    <a style="cursor:pointer;" v-if="_IsAuth" @click="logout" class="d-block">
      Logout
    </a>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["_User",'_IsAuth']),
  },
  created() {},
  methods: {
    logout() {
      this.$appAxios
        .post("/logout")
        .then(() => {
          this.$store.state.User.user = [];
          this.$store.state.User.isAuth = false;
          localStorage.removeItem("token");
          localStorage.removeItem("role");
          this.$router.push({ name: "Login" });
          this.$notify({
            type: "success",
            title: "Successfully logged out.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Didn't logged out.",
          });
        });
    },
  },
};
</script>
