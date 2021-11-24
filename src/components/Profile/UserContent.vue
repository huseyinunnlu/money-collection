<template>
  <div class="card card-xl-stretch mb-xl-10">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
      <h3 class="card-title align-items-start flex-column">
        <span class="fw-bolder mb-2 text-dark">{{ $t("profile.collectionHistory") }}</span>
      </h3>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
      <!--begin::Timeline-->
      
        <!--begin::Item-->
        <TimelineParentItem
          v-for="(item, index) in moneyStatics.timeline"
          :key="index"
          :item="item"
        />
        <!--end::Item-->
      <!--end::Timeline-->
    </div>
    <!--end: Card Body-->
  </div>
</template>
<script>
import TimelineParentItem from "@/components/Profile/TimelineParentItem.vue";
export default {
  props: ["moneyStatics"],
  components: {
    TimelineParentItem,
  },
};
</script>
