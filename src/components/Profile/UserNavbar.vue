<template>
  <div class="card">
    <div class="card-body p-0">
      <ul
        class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 mx-5 fw-bolder"
      >
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'Profile', params: { slug: slug } }"
            >Index</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            v-if="_User.slug == slug"
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'ProfileSettings' }"
            >Settings</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            v-if="_User.slug == slug"
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'ChangePassword' }"
            >ChangePassword</router-link
          >
        </li>
        <!--end::Nav item-->
      </ul>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  props: {
    slug: {
      type: String,
      default: "test",
    },
  },
  computed: {
    ...mapGetters(["_User"]),
  },
};
</script>
<style>
.router-link-active {
  color: black;
}
</style>
