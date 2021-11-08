<template>
  <div class="col-xl-12">
    <div class="d-flex my-5 flex-stack">
      <a class="btn btn-outline btn-nav ms-2 disabled">
        Osmanlı Devleti Kağıt Paralar
      </a>
      <a class="btn btn-outline btn-nav ms-2 disabled">
        Osmanlı Devleti Madeni Paralar
      </a>
      <a
        class="btn btn-outline btn-nav ms-2"
        @click="
          (trShow = !trShow),
            filterItems({
              column: 'emission_id',
              data: 'emission',
              emission_id: null,
              scwpm_id: null,
              kuphur_id: null,
              serie: null,
            })
        "
      >
        Türkiye Cumhuriyeti Kağıt Paralar
      </a>
      <a class="btn btn-outline btn-nav ms-2 disabled">
        Türkiye Cumhuriyeti Madeni Paralar
      </a>
      <a class="btn btn-outline btn-nav ms-2 disabled">
        Türkiye Cumhuriyeti Hatıra Paralar
      </a>
      <a class="btn btn-outline btn-nav ms-2 disabled">
        Türkiye Cumhuriyeti Hatıra Para Setleri
      </a>
    </div>
  </div>
  <div class="row gy-5 g-xl-8" v-if="trShow">
    <!--begin::Col-->
    <CatalogItemLoader v-if="isLoading" />
    <CatalogItem
      v-else
      v-for="item in datas.emission"
      :key="item.emission_id.id"
      :item="item"
    />
    <!--end::Col-->
  </div>
</template>
<script>
import CatalogItem from "@/components/Index/CatalogItem.vue";
import CatalogItemLoader from "@/components/Loaders/CatalogItemLoader.vue";
export default {
  data() {
    return {
      trShow: false,
      isLoading: false,
      emission_id: null,
      datas: {
        emission: [],
      },
    };
  },
  components: {
    CatalogItem,
    CatalogItemLoader,
  },
  created() {},
  methods: {
    filterItems(data) {
      if (this.datas.emission.length == 0) {
        this.isLoading = true;
        let iscollect = 0;
        this.$appAxios
          .get("/moneyfilter", {
            params: {
              column: data.column,
              data: data.data,
              status: 1,
              emission_id: data.emission_id,
              scwpm_id: null,
              kuphur_id: null,
              serie_id: null,
              isCollected: iscollect,
            },
          })
          .then((res) => {
            const data = res.data.data;
            const array = res.data.arrdata;
            if (array == "emission") {
              this.datas.emission = data;
            }
          })
          .finally(() => {
            this.isLoading = false;
          });
      }
    },
  },
};
</script>
