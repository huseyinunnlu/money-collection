<template>
  <div class="col-xl-6">
    <!--begin::Table Widget 6-->
    <div class="card card-xl-stretch mb-xl-8">
      <!--begin::Header-->
      <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bolder fs-3 mb-1"
            >{{$t('index.lastcollectedmoneys')}}</span
          >
        </h3>
      </div>
      <!--end::Header-->
      <!--begin::Body-->
      <div class="card-body py-3">
        <div class="tab-content">
          <!--begin::Tap pane-->
          <div class="tab-pane fade show active" id="kt_table_widget_6_tab_1">
            <!--begin::Table container-->
            <div class="table-stripted">
              <!--begin::Table-->
              <table class="table align-middle gs-0 gy-3">
                <!--begin::Table head-->
                <thead>
                  <tr>
                    <th class="p-0 w-50px"></th>
                    <th class="p-0 min-w-150px"></th>
                    <th class="p-0 min-w-140px"></th>
                    <th class="p-0 min-w-120px"></th>
                  </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody v-if="_LastCollected.length > 0">
                  <LastCollectionItem v-for="lcollect in _LastCollected" :key="lcollect.id" :item="lcollect"/>
                </tbody>
                <!--end::Table body-->
              </table>
            </div>
            <!--end::Table-->
          </div>
          <!--end::Tap pane-->
        </div>
      </div>
      <!--end::Body-->
    </div>
    <!--end::Tables Widget 6-->
  </div>
</template>
<script>
import LastCollectionItem from "@/components/Index/LastCollectionItem.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    LastCollectionItem,
  },
  computed: {
    ...mapGetters(["_LastCollected"]),
  },
  created() {
    this.get();
  },
  methods: {
    get() {
      this.$appAxios.post("/getlastcollected")
      .then((res) => {
        this.$store.state.Index.lastCollected = res.data.data;
      })
      .catch(()=>{
          this.$store.state.Index.lastCollected = []
      });
    },
  },
};
</script>
