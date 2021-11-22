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
        @click="(trShow = !trShow), getEmissions()"
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
      :key="item.id"
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
    getEmissions() {
      if (this.datas.emission.length == 0) {
        this.isLoading = true;
        this.$appAxios
          .post("/getcatalog")
          .then((res) => {
            this.datas.emission = res.data.data
          })
          .finally(() => {
            this.isLoading = false;
          });
      }
    },
  },
};
</script>
