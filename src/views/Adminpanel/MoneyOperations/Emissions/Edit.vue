<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-10 offset-1">
            <ContentHeader :title="'Edit Emission'" />
            <h2 v-if="isLoading" class="text-center">Loading...</h2>
            <EmissionEdit v-else :ems="emission" />
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
import EmissionEdit from "@/components/Adminpanel/MoneyOperations/Emissions/EmissionEdit.vue";
import ContentHeader from "@/components/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    EmissionEdit,
    ContentHeader,
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
          this.emission = []
          this.$notify({
            type: "error",
            title: "Emission not found",
          });
          this.$router.push({ name: "AdminEmissions" });
        })
        .finally(() => {
          setTimeout(() => {
            this.isLoading = false
          }, 2000);
        });
    },
  },
};
</script>
