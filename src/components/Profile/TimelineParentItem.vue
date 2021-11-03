<template>
  <div class="time-label">
    <span class="bg-danger">
      {{ moment(item[0].created_at).format("D MMM YYYY") }}
    </span>
  </div>
  <!-- /.timeline-label -->
  <!-- timeline item -->
  <div v-for="coll in item" :key="coll.id">
    <i class="fas fa-envelope bg-primary"></i>
    <div class="timeline-item">
      <span class="time"><i class="far fa-clock"></i> {{ moment(coll.created_at).format("h:mm:ss") }}</span>
      <h3 class="timeline-header">
        <router-link :to="{name:'Profile',params:{slug:coll.user.slug}}">{{coll.user.fullName}}</router-link> Added money to his collection. <router-link :to="{name:'MoneyShow',params:{id:coll.money.id}}">(See Money)</router-link>
      </h3>
    </div>
  </div>
  <!-- END timeline item -->
</template>
<script>
import moment from "moment";
export default {
  props: ["item"],
  created() {
    this.moment = moment;
  },
};
</script>
