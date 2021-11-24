<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="addUser"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ $t('user.add')}}</h5>
          <i data-dismiss="modal" aria-label="Close" class="close fas fa-times" style="cursor:pointer"></i>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group my-4 row">
              <label for="fullName" class="col-sm-2 col-form-label"
                >{{ $t('user.table.column.nameSurname')}}</label
              >
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid"
                  id="fullName"
                  :placeholder="$t('user.table.column.nameSurname')"
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
              <label for="email" class="col-sm-2 col-form-label">{{ $t('user.table.column.email')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid"
                  id="email"
                  :placeholder="$t('user.table.column.email')"
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
              <label for="password" class="col-sm-2 col-form-label"
                >{{ $t('user.table.column.password')}}</label
              >
              <div class="col-sm-10">
                <input
                  type="password"
                  class="form-control form-control-solid"
                  id="password"
                  :placeholder="$t('user.table.column.nameSurname')"
                  v-model="form.password"
                />
              </div>
            </div>
            <small
              class="text-danger"
              v-if="errors.password"
              v-text="errors.password[0]"
            ></small>

            <div class="form-group my-4 row">
              <label for="accType" class="col-sm-2 col-form-label"
                >{{ $t('user.table.column.role')}}</label
              >
              <div class="col-sm-10">
                <select
                  id="accType"
                  v-model="form.role"
                  class="form-select form-select-solid"
                >
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
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            {{ $t('button.close')}}
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="!form.fullName || !form.email"
            v-if="!isLoading"
            @click="addUser"
          >
            {{ $t('button.add')}}
          </button>
          <button disabled class="btn btn-primary" v-if="isLoading">
            {{ $t('button.loading')}}
          </button>
        </div>
      </div>
    </div>
  </div>
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
        role: 0,
      },
      isLoading: false,
      errors: [],
    };
  },
  methods: {
    addUser() {
      this.isLoading = true;
      this.$appAxios
        .post("/user/add", {
          fullName: this.form.fullName,
          email: this.form.email,
          password: CryptoJs.SHA256(this.form.password).toString(),
          password_confirmation: CryptoJs.SHA256(this.form.password).toString(),
          role: this.form.role,
        })
        .then((res) => {
          this.form.fullName = null;
          this.form.email = null;
          this.form.password = null;
          this.form.role = 0;
          this.$store.state.Users.users.unshift(res.data.user);
          this.$notify({
            type: "success",
            title: res.data.message,
          });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "User didn't added",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
