<template>
  <form
    class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework"
    novalidate="novalidate"
    id="kt_sign_up_form"
    @submit.prevent="register()"
  >
    <!--begin::Heading-->
    <div class="mb-10 text-center">
      <!--begin::Title-->
      <h1 class="text-dark mb-3">Create an Account</h1>
      <!--end::Title-->
      <!--begin::Link-->
      <div class="text-gray-400 fw-bold fs-4">
        Already have an account?
        <router-link :to="{ name: 'Login' }" class="link-primary fw-bolder"
          >Sign in here</router-link
        >
      </div>
      <!--end::Link-->
    </div>
    <!--end::Heading-->
    <!--begin::Input group-->
    <div class="row fv-row mb-7 fv-plugins-icon-container">
      <!--begin::Col-->
      <label class="form-label fw-bolder text-dark fs-6">Full Name</label>
      <input
        class="form-control form-control-lg form-control-solid"
        type="text"
        placeholder=""
        name="first-name"
        autocomplete="off"
        v-model="form.fullName"
      />
      <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-7 fv-plugins-icon-container">
      <label class="form-label fw-bolder text-dark fs-6">Email</label>
      <input
        class="form-control form-control-lg form-control-solid"
        type="email"
        placeholder=""
        name="email"
        autocomplete="off"
        v-model="form.email"
      />
      <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div
      class="mb-10 fv-row fv-plugins-icon-container"
      data-kt-password-meter="true"
    >
      <!--begin::Wrapper-->
      <div class="mb-1">
        <!--begin::Label-->
        <label class="form-label fw-bolder text-dark fs-6">Password</label>
        <!--end::Label-->
        <!--begin::Input wrapper-->
        <div class="position-relative mb-3">
          <input
            class="form-control form-control-lg form-control-solid"
            type="password"
            placeholder=""
            name="password"
            autocomplete="off"
            v-model="form.password"
          />
          <span
            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
            data-kt-password-meter-control="visibility"
          >
            <i class="bi bi-eye-slash fs-2"></i>
            <i class="bi bi-eye fs-2 d-none"></i>
          </span>
        </div>
        <!--end::Input wrapper-->
      </div>
      <!--end::Wrapper-->
      <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <!--end::Input group=-->
    <!--begin::Input group-->
    <div class="fv-row mb-5 fv-plugins-icon-container">
      <label class="form-label fw-bolder text-dark fs-6"
        >Confirm Password</label
      >
      <input
        class="form-control form-control-lg form-control-solid"
        type="password"
        placeholder=""
        name="confirm-password"
        autocomplete="off"
        v-model="form.password_confirmation"
      />
      <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10 fv-plugins-icon-container">
      <label
        class="form-check form-check-custom form-check-solid form-check-inline"
      >
        <input class="form-check-input" type="checkbox" name="toc" value="1" />
        <span class="form-check-label fw-bold text-gray-700 fs-6"
          >I Agree
          <a href="#" class="ms-1 link-primary">Terms and conditions</a>.</span
        >
      </label>
      <div class="fv-plugins-message-container invalid-feedback"></div>
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="text-center">
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
      <button class="btn btn-primary btn-block disabled" v-else>
        Registering...
      </button>
    </div>
    <!--end::Actions-->
    <div></div>
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
      setTimeout(() => {
        this.isLoading = false;
        this.isRegisterable = true;
      }, 1000);
    },
  },
};
</script>
