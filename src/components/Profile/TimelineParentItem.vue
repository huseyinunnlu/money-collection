<template>
  <div class="time-label my-4">
    <span class="bg-danger rounded p-2">
      {{ moment(item[0].created_at).format("MMM Do YY") }}
    </span>
  </div>
  <!-- timeline item -->
  <div class="timeline-label">
    <div class="timeline-item align-items-center" v-for="coll in item" :key="coll.id">
      <!--begin::Label-->
      <div class="timeline-label fw-bolder text-gray-800 fs-6">
        {{ moment(coll.created_at).format("h:mm") }}
      </div>
      <!--end::Label-->
      <!--begin::Badge-->
      <div class="timeline-badge">
        <i class="fa fa-dollar-sign text-primary fs-1"></i>
      </div>
      <!--end::Badge-->
      <!--begin::Text-->
      <div class="fw-mormal timeline-content text-muted ps-3 d-flex flex-nowrap align-items-center">
        <router-link :to="{name:'Profile',params:{slug:coll.user.slug}}">{{coll.user.fullName}}</router-link>
        <span class="mx-4">{{$t('profile.message',{ems:coll.money.emission_id.title,serie:coll.uniqueSerie,kuphur:coll.money.kuphur_id.title})}}</span>
        <router-link :to="{name:'MoneyShow',params:{id:coll.money.id}}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-80">{{$t('button.details')}}</router-link>
      </div>
      <!--end::Text-->
    </div>
  </div>
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
