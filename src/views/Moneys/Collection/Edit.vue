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
              <div class="card">
                <div class="card-body">
                  <h2 v-if="isLoading" class="text-center">Loading...</h2>
                  <Edit :collection="collection" v-if="!isLoading" />
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
import Edit from "@/components/Moneys/Collection/Edit.vue";

export default {
  components: {
    Navbar,
    Footer,
    Edit,
  },
  data() {
    return {
      collection: [],
      isLoading: false,
    };
  },
  created() {
    this.get();
  },
  methods: {
    get() {
      this.isLoading = true
      this.$appAxios
        .get("/mycollection/" + this.$route.params.id + "/get")
        .then((res) => {
          this.collection = res.data.data;
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Collection not found",
          });
          this.$router.push({ name: "Index" });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
