<template>
  <div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
      <div>
        <form class="form-horizontal" @submit.prevent="update()">
          <div class="form-group my-4 row">
            <label for="cpassword" class="col-sm-2 col-form-label"
              >Current Password</label
            >
            <div class="col-sm-10">
              <input
                type="password"
                class="form-control form-control-solid"
                id="cpassword"
                placeholder="Current Password"
                v-model="form.cpassword"
              />
              <small
                v-if="errors.cpassword"
                v-text="errors.cpassword[0]"
                class="text-danger"
              ></small>
            </div>
          </div>

          <div class="form-group my-4 row">
            <label for="password" class="col-sm-2 col-form-label"
              >New Password</label
            >
            <div class="col-sm-10">
              <input
                type="password"
                class="form-control form-control-solid"
                id="password"
                placeholder="New Password"
                v-model="form.password"
              />
              <small
                v-if="errors.password"
                v-text="errors.password[0]"
                class="text-danger"
              ></small>
            </div>
          </div>

          <div class="form-group my-4 row">
            <label for="password_confirmation" class="col-sm-2 col-form-label"
              >Re-Enter New Password</label
            >
            <div class="col-sm-10">
              <input
                type="password"
                class="form-control form-control-solid"
                id="password_confirmation"
                placeholder="Re-enter new password"
                v-model="form.password_confirmation"
              />
              <small
                v-if="errors.password_confirmation"
                v-text="errors.password_confirmation[0]"
                class="text-danger"
              ></small>
            </div>
          </div>

          <div class="form-group my-4 row">
            <div class="offset-sm-2 col-sm-10">
              <button
                type="submit"
                class="btn btn-primary btn-sm"
                :disabled="
                  !form.password ||
                    !form.password_confirmation ||
                    !form.cpassword
                "
                v-if="!isLoading"
              >
                Update
              </button>
              <button type="submit" class="btn btn-primary" v-if="isLoading">
                Updating
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import CryptoJS from "crypto-js";
export default {
  data() {
    return {
      form: {
        cpassword: null,
        password: null,
        password_confirmation: null,
      },
      isRegister: false,
      errors: [],
      isLoading: false,
    };
  },
  methods: {
    update() {
      this.errors = [];
      this.isLoading = true;
      this.isRegister = true;
      const valPass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]/;
      if (this.form.password.length < 8 || this.form.password.length > 25) {
        this.$notify({
          type: "error",
          title: "Password must be between 8 and 25 characters",
        });
        this.isRegister = false;
      }

      if (!valPass.test(this.form.password)) {
        this.$notify({
          type: "error",
          title: "Please enter valid password",
        });
        this.isRegister = false;
      }

      if (this.form.password != this.form.password_confirmation) {
        this.$notify({
          type: "error",
          title: "Password confirmation didn't mistmatch.",
        });
        this.isRegister = false;
      }
      if (this.isRegister) {
        this.$appAxios
          .post("changepassword", {
            cpassword: CryptoJS.SHA256(this.form.cpassword).toString(),
            password: CryptoJS.SHA256(this.form.password).toString(),
            password_confirmation: CryptoJS.SHA256(
              this.form.password_confirmation
            ).toString(),
          })
          .then(() => {
            this.$notify({
              type: "success",
              title: "Password changed successfully.",
            });
            this.form.cpassword = null;
            this.form.password = null;
            this.form.password_confirmation = null;
          })
          .catch((err) => {
            this.$notify({
              type: "error",
              title: "Password didn't changed.",
            });
            this.errors = err.response.data.errors;
          })
          .finally(() => {
            this.isLoading = false;
          });
      }
      this.isLoading = false;
    },
  },
};
</script>
