<template>
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
      <!--begin::Wrapper-->
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <Navbar />
        <!--begin::Container-->
        <div
          id="kt_content_container"
          class="d-flex flex-column-fluid align-items-start container-xxl"
        >
          <!--begin::Post-->
          <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div
              class="
                row
                col-10
                offset-1
                gy-5
                g-xl-8
                d-flex
                align-items-center
                mt-lg-0
                mb-10 mb-lg-15
              "
            >
              <ContentHeader :title="title" />

              <div class="card">
                <div class="card-body">
                  <h2 v-if="isLoading" class="text-center">Loading...</h2>
                  <Edit :money="money" :datas="datas" v-if="!isLoading" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <Footer />
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Footer from "@/components/Header/Footer.vue";
import Edit from "@/components/Moneys/Edit.vue";
import ContentHeader from "@/components/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Footer,
    Edit,
    ContentHeader
  },
  data() {
    return {
      money: [],
      datas: {
        emission: [],
        scwpm: [],
        kuphur: [],
        serie: [],
        tertip: [],
        printPlace: [],
        signatures: [],
      },
      isLoading: false,
    };
  },
  created() {
    this.getData();
  },
  computed:{
    title(){
      return this.$t('button.edit')
    }
  },
  methods: {
    getData() {
      this.isLoading = true;
      this.$appAxios
        .get("getdata")
        .then((res) => {
          this.datas.emission = res.data.data.emission;
          this.datas.scwpm = res.data.data.scwpm;
          this.datas.kuphur = res.data.data.kuphur;
          this.datas.serie = res.data.data.serie;
          this.datas.tertip = res.data.data.tertip;
          this.datas.printPlace = res.data.data.printPlace;
          this.datas.signatures = res.data.data.signatures;
        })
        .catch(() => {
          this.datas.emission = [];
          this.datas.scwpm = [];
          this.datas.kuphur = [];
          this.datas.serie = [];
          this.datas.tertip = [];
          this.datas.printPlace = [];
          this.datas.signatures = [];
        })
        .finally(() => {
          this.get();
        });
    },
    get() {
      this.$appAxios
        .get("/money/" + this.$route.params.id + "/get")
        .then((res) => {
          this.money = res.data.data;
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Money not found",
          });
          this.$router.push({ name: "Money" });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
