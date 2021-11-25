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
              class="row col-10 offset-1 gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15"
            >
            <ContentHeader :title="title" />
              <div class="card">
                <div class="card-body">
                  <h2 v-if="isLoading" class="text-center">Loading...</h2>
                  <EmissionEdit :ems="emission" v-if="!isLoading" />
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
import EmissionEdit from "@/components/Adminpanel/MoneyOperations/Emissions/EmissionEdit.vue";
import ContentHeader from "@/components/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Footer,
    EmissionEdit,
    ContentHeader,
  },
  computed:{
    title(){
      return this.$t('button.edit')
    }
  },
  data() {
    return {
      emission: [],
      isLoading: false,
    };
  },
  created() {
    this.get();
  },
  methods: {
    get() {
      this.isLoading = true;
      this.$appAxios
        .get("/emission/" + this.$route.params.id)
        .then((res) => {
          this.emission = res.data.data;
        })
        .catch(() => {
          this.emission = [];
          this.$notify({
            type: "error",
            title: "Emission not found",
          });
          this.$router.push({ name: "AdminEmissions" });
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
