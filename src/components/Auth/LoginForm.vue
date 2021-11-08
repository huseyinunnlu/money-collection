<template>
  <form
    class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
    novalidate="novalidate"
    id="kt_sign_in_form"
    @submit.prevent="login()"
  >
    <!--begin::Heading-->
    <div class="text-center mb-10">
      <!--begin::Title-->
      <h1 class="text-dark mb-3">Sign In to Metronic</h1>
      <!--end::Title-->
      <!--begin::Link-->
      <div class="text-gray-400 fw-bold fs-4">
        New Here?
        <router-link :to="{ name: 'Register' }" class="link-primary fw-bolder"
          >Create an Account</router-link
        >
      </div>
      <!--end::Link-->
    </div>
    <!--begin::Heading-->
    <!--begin::Input group-->
    <div class="fv-row mb-10 fv-plugins-icon-container">
      <!--begin::Label-->
      <label class="form-label fs-6 fw-bolder text-dark">Email</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input
        class="form-control form-control-lg form-control-solid"
        type="text"
        name="email"
        autocomplete="off"
        v-model="form.email"
      />
      <!--end::Input-->
      <div
        class="fv-plugins-message-container invalid-feedback"
        v-if="errors.email"
        v-text="errors.email[0]"
      ></div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10 fv-plugins-icon-container">
      <!--begin::Wrapper-->
      <div class="d-flex flex-stack mb-2">
        <!--begin::Label-->
        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
        <!--end::Label-->
        <!--begin::Link
        <a
          href="/metronic8/demo12/../demo12/authentication/flows/basic/password-reset.html"
          class="link-primary fs-6 fw-bolder"
          >Forgot Password ?</a
        >
        end::Link-->
      </div>
      <!--end::Wrapper-->
      <!--begin::Input-->
      <input
        class="form-control form-control-lg form-control-solid"
        type="password"
        name="password"
        autocomplete="off"
        v-model="form.password"
      />
      <!--end::Input-->
      <div
        class="fv-plugins-message-container invalid-feedback"
        v-if="errors.password"
        v-text="errors.password[0]"
      ></div>
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center">
      <!--begin::Submit button-->
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
      <!--end::Submit button-->
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
          window.location.reload();
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
