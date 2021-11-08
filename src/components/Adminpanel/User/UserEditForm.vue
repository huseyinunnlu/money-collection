<template>
  <form class="form-horizontal" @submit.prevent="updateUser()">
    <div class="form-group my-2 row">
      <label for="fullName" class="col-sm-2 col-form-label">Full Name</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
          id="fullName"
          placeholder="Full Name"
          v-model="form.fullName"
        />
      </div>
    </div>
    <small
      class="text-danger"
      v-if="errors.fullName"
      v-text="errors.fullname[0]"
    ></small>
    

    <div class="form-group my-4 row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
          id="email"
          placeholder="Email"
          v-model="form.email"
        />
      </div>
    </div>
    <small
      class="text-danger"
      v-if="errors.email"
      v-text="errors.email[0]"
    ></small>

    <div class="form-group my-4 row">
      <label for="accType" class="col-sm-2 col-form-label">Account Role</label>
      <div class="col-sm-10">
        <select id="accType" v-model="form.role" class="form-select form-select-solid">
          <option :value="'0'">User</option>
          <option :value="'1'">Admin</option>
        </select>
      </div>
    </div>

    <small
      class="text-danger"
      v-if="errors.role"
      v-text="errors.role[0]"
    ></small>

    <div class="change-password my-5">
        <h3 class="my-5">Change Password</h3>


      <div class="form-group my-4 row">
        <label for="password" class="col-sm-2 col-form-label"
          >Change Password</label
        >
        <div class="col-sm-10">
          <input
            type="password"
            class="form-control"
            id="password"
            placeholder="Password"
            v-model="form.password"
          />
        </div>
      </div>
      <small
        class="text-danger"
        v-if="errors.password"
        v-text="errors.password[0]"
      ></small>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <button v-if="!isLoading" type="submit" class="btn btn-success btn-sm">Update</button>
        <button v-else disabled type="submit" class="btn btn-success btn-sm">Updating...</button>
      </div>
    </div>
  </form>
</template>
<script>
import CryptoJs from "crypto-js";
export default {
  props:['user'],
  data() {
    return {
      form: {
        fullName: null,
        email: null,
        password: null,
        role: 0,
      },
      isLoading: false,
      errors: [],
    };
  },
  mounted() {
    this.form.fullName = this.user.fullName;
    this.form.email = this.user.email;
    this.form.role = this.user.role;
  },
  methods: {
    updateUser() {
      this.isLoading = true;
      let password = null;
      if (this.form.password) {
        password = CryptoJs.SHA256(this.form.password).toString();
      }
      this.$appAxios
        .post("/user/"+this.user.id+"/update", {
          fullName: this.form.fullName,
          email: this.form.email,
          role: this.form.role,
          password: password,
        })
        .then(() => {
          this.$notify({
            type: "success",
            title: "User successfully updated",
          });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "User didn't updated",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
