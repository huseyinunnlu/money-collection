<template>
  <form @submit.prevent="login()">
    <div class="input-group">
      <input
        type="text"
        class="form-control"
        placeholder="Email"
        v-model="form.email"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
    </div>
    <small
      class="text-danger"
      v-if="errors.email"
      v-text="errors.email[0]"
    ></small>
    <div class="input-group my-3">
      <input
        type="password"
        class="form-control"
        placeholder="Password"
        v-model="form.password"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>

    <div class="row d-flex justify-content-center">
      <div class="col-6">
        <button
          v-if="!isLoading"
          :disabled="isLoading || !form.email || !form.password"
          type="submit"
          class="btn btn-primary btn-block"
        >
          Sign In
        </button>
        <button v-else disabled type="button" class="btn btn-primary btn-block">
          Siging In...
        </button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</template>
<script>
import CryptoJS from "crypto-js";
export default {
  data() {
    return {
      form: {
        email: null,
        password: null,
      },
      errors: [],
      isLoading: false,
    };
  },
  methods: {
    login() {
      this.isLoading = true;
      let cryptedPass = CryptoJS.SHA256(this.form.password).toString();
      this.$appAxios
        .post("/login", {
          email: this.form.email,
          password: cryptedPass,
        })
        .then((res) => {
          this.$notify({
            type: "success",
            title: "Successfully Signed In redirecting",
          });
          this.form.email = null;
          this.form.password = null;
          this.$store.state.User.user = res.data.user;
          this.$store.state.User.isAuth = true;
          var encryptedToken = CryptoJS.AES.encrypt(
            res.data.token.token,
            "vuexisawesomesecret"
          ).toString();
          localStorage.setItem("token", encryptedToken);
          localStorage.setItem("role", res.data.user.role);
          this.$router.push({ name: "Index" });
          window.location.reload()
        })
        .catch((err) => {
          this.$notify({
            type: "error",
            title: "Didn't Signed In.",
          });
          this.errors = err.response.data.errors;
          localStorage.removeItem("role");
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
