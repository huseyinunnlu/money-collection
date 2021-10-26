<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-10 offset-1">
            <ContentHeader :title="'Edit Money'" />
            <h2 v-if="isLoading" class="text-center">Loading...</h2>
            <Edit :money="money" :datas="datas" v-if="!isLoading" />
          </div>
        </div>
      </div>
      <Footer />
    </div>
  </body>
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import Footer from "@/components/Header/Footer.vue";
import Edit from "@/components/Moneys/Edit.vue";
import ContentHeader from "@/components/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    Edit,
    ContentHeader,
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
        .finally(()=>{
          this.get()
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
