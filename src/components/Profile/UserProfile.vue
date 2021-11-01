<template>
  <div class="card card-primary card-outline">
    <div class="card-body box-profile">
      <div class="text-center">
        <img
          class="profile-user-img img-fluid img-circle"
          :src="_User.profilePhoto"
          alt="User profile picture"
          style="width:100px; height:100px;"
        />
      </div>
      <p class="text-muted text-center">{{ _User.fullName }}</p>
    </div>
    <!-- /.card-body -->
  </div>
</template>
<script>
import {mapGetters} from "vuex"
export default {
  props:["_User"],
  computed:{
    ...mapGetters(['_User'])
  }
};
</script>
