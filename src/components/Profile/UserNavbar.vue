<template>
  <div class="card-header p-2">
    <ul class="nav nav-pills">
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'Profile',
          params: { slug: slug },
        }"
        data-toggle="tab"
        >Index</router-link
      >
      
      <router-link
        v-if="slug == $store.getters._User.slug"
        class="router-link py-0 px-2"
        :to="{ name: 'ProfileSettings' }"
        data-toggle="tab"
        >Settings</router-link
      >
      <router-link
        v-if="slug == $store.getters._User.slug"
        class="router-link py-0 px-2"
        :to="{ name: 'ChangePassword' }"
        data-toggle="tab"
        >Change Password</router-link
      >
    </ul>
  </div>
</template>
<script>
export default {
  props: {
    slug: {
      type: String,
      default:'test'
    },
  },
};
</script>
<style>
.router-link-active {
  color: black;
}
</style>
