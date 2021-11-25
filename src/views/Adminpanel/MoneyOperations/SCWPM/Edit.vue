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
              <ContentHeader :title="scwpm" />

              <div class="card">
                <div class="card-body">
                  <h2 v-if="isLoading" class="text-center">Loading...</h2>
                  <Edit :scwpm="scwpm" v-if="!isLoading" />
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
import Edit from "@/components/Adminpanel/MoneyOperations/SCWPM/Edit.vue";
import ContentHeader from "@/components/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Footer,
    Edit,
    ContentHeader,
  },
  data() {
    return {
      scwpm: [],
      isLoading: false,
    };
  },
  computed:{
    title(){
      return this.$t('button.edit')
    }
  },
  created() {
    this.get();
  },
  methods: {
    get() {
      this.isLoading = true;
      this.$appAxios
        .get("/scwpm/" + this.$route.params.id)
        .then((res) => {
          this.scwpm = res.data.data;
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "SCWPM not found",
          });
          this.$router.push({ name: "AdminSCWPM" });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
