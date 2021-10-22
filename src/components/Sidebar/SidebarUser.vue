<template>
  <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
    <div class="image">
      <img
        :src="_User.profilePhoto"
        class="img-circle elevation-2"
        alt="User Image"
      />
    </div>
    <div class="info d-flex flex-column">
      <router-link :to="{name:'Index'}" class="d-block">{{_User.fullName}}</router-link>
      <Logout />
    </div>
  </div>
</template>
<script>
import Logout from "@/components/Auth/Logout.vue"
import { mapGetters } from "vuex"; 
export default {
  components:{
    Logout
  },
  computed: {
    ...mapGetters(["_User"]),
  },
};
</script>
