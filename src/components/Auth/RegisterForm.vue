<template>
  <form method="post" @submit.prevent="register()">
    <div class="input-group">
      <input
        type="text"
        class="form-control"
        placeholder="Full name"
        v-model="form.fullName"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-user"></span>
        </div>
      </div>
    </div>

    <div class="input-group mt-3">
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

    <div class="input-group mt-3">
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

    <div class="input-group mt-3">
      <input
        type="password"
        class="form-control"
        placeholder="Retype password"
        v-model="form.password_confirmation"
      />
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>

    <div class="row mt-3 my-3">
      <div class="col-6 offset-3">
        <button
          v-if="!isLoading"
          type="submit"
          class="btn btn-primary btn-block"
          :disabled="
            !form.fullName ||
              !form.email ||
              !form.password ||
              !form.password_confirmation
          "
        >
          Register
        </button>
        <button class="btn btn-primary btn-block" v-else disabled>
          Registering...
        </button>
      </div>
      <!-- /.col -->
    </div>
  </form>
</template>
<script>
import CryptoJs from "crypto-js";

export default {
  data() {
    return {
      form: {
        fullName: null,
        email: null,
        password: null,
        password_confirmation: null,
      },
      isLoading: false,
      isRegisterable: true,
    };
  },
  methods: {
    register() {
      this.isLoading = true;
      this.isRegisterable = true;
      const valPass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/;
      if (this.form.password.length < 8 || this.form.password.length > 25) {
        this.$notify({
          type: "error",
          title: "Password must be between 8 and 25 characters",
        });
        this.isRegisterable = false;
      }

      if (!valPass.test(this.form.password)) {
        this.$notify({
          type: "error",
          title: "Please enter valid password",
        });
        this.isRegisterable = false;
      }

      if (this.form.password != this.form.password_confirmation) {
        this.$notify({
          type: "error",
          title: "Password confirmation didn't mistmatch.",
        });
        this.isRegisterable = false;
      }

      if (this.isRegisterable) {
        this.$appAxios
          .post("register", {
            fullName: this.form.fullName,
            email: this.form.email,
            password: CryptoJs.SHA256(this.form.password).toString(),
            password_confirmation: CryptoJs.SHA256(
              this.form.password
            ).toString(),
          })
          .then(() => {
            this.$notify({
              type: "success",
              title: "Successfully registered.",
            });
            this.$router.push({ name: "Login" });
          })
          .catch((err) => {
            if (err.response.data.errors.fullName) {
              this.$notify({
                type: "error",
                title: err.response.data.errors.fullName[0],
              });
            }
            if (err.response.data.errors.email) {
              this.$notify({
                type: "error",
                title: err.response.data.errors.email[0],
              });
            }
            if (err.response.data.errors.password) {
              this.$notify({
                type: "error",
                title: err.response.data.errors.password[0],
              });
            }
          });
      }
      this.isLoading = false;
      this.isRegisterable = true;
    },
  },
};
</script>
