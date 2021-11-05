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
          <Sidebar />
          <!--begin::Post-->
          <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div
              class="row col-10 offset-1 gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15"
            >
            <ContentHeader :title="'Money Details'"/>
              <div class="card">
                <div class="card-body">
                  <h2 v-if="isLoading" class="text-center">Loading...</h2>
                  <Show :money="money" v-if="!isLoading" />
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
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import Footer from "@/components/Header/Footer.vue";
import Show from "@/components/Moneys/Show.vue";
import ContentHeader from "@/components/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    Show,
    ContentHeader,
  },
  data() {
    return {
      money: [],
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
        .get("/money/" + this.$route.params.id + "/get")
        .then((res) => {
          this.money = res.data.data;
          this.isLoading = false;
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Money not found",
          });
          this.$router.push({ name: "Money" });
        })
        .finally(() => {
          setTimeout(() => {
            this.isLoading = false;
          }, 2000);
        });
    },
  },
};
</script>
