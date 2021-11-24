<template>
  <div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
      <div>
        <form class="form-horizontal" @submit.prevent="updateProfile()">
          <UserProfilePhoto />
          <div class="form-group my-4 row">
            <label for="fullName" class="col-sm-2 col-form-label"
              >{{ $t("profile.fullName") }}</label
            >
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control form-control-solid"
                id="fullName"
                placeholder="Full Name"
                v-model="form.fullName"
              />
              <small
                v-if="errors.fullName"
                v-text="errors.fullName[0]"
                class="text-danger"
              ></small>
            </div>
          </div>

          <div class="form-group my-4 row">
            <label for="email" class="col-sm-2 col-form-label">{{ $t("profile.email") }}</label>
            <div class="col-sm-10">
              <input
                type="text"
                class="form-control form-control-solid"
                id="email"
                placeholder="Email"
                v-model="form.email"
              />
              <small
                v-if="errors.email"
                v-text="errors.email[0]"
                class="text-danger"
              ></small>
            </div>
          </div>

          <div class="form-group my-4 row">
            <div class="offset-sm-2 col-sm-10">
              <button
                type="submit"
                class="btn btn-primary btn-sm"
                :disabled="!form.fullName || !form.email"
                v-if="!isLoading"
              >
                {{ $t("button.update") }}
              </button>
              <button type="submit" class="btn btn-primary btn-sm" v-if="isLoading">
                {{ $t("button.loading") }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import UserProfilePhoto from "@/components/Profile/UserProfilePhoto.vue";
export default {
  components: {
    UserProfilePhoto,
  },
  data() {
    return {
      form: {
        fullName: null,
        email: null,
      },
      errors: [],
      isLoading: false,
    };
  },
  computed: {
    ...mapGetters(["_User"]),
  },
  mounted() {
    this.form.fullName = this._User.fullName;
    this.form.email = this._User.email;
  },
  methods: {
    updateProfile() {
      this.isLoading = true;
      this.errors = [];
      this.$appAxios
        .post("updateprofile", {
          fullName: this.form.fullName,
          email: this.form.email,
        })
        .then(() => {
          this.$store.state.User.user.fullName = this.form.fullName;
          this.$store.state.User.user.email = this.form.email;
          this.$notify({
            type: "success",
            title: "Profile successfully updated.",
          });
          window.location.reload();
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "success",
            title: "Profile successfully updated.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
