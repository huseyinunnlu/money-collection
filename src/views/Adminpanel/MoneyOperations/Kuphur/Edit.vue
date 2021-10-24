<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-10 offset-1">
            <ContentHeader :title="'Edit Kuphür'" />
            <h2 v-if="isLoading" class="text-center">Loading...</h2>
            <Edit :kuphur="kuphur" v-if="!isLoading" />
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
import Edit from "@/components/Adminpanel/MoneyOperations/Kuphur/Edit.vue";
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
      kuphur: [],
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
        .get("/kuphur/" + this.$route.params.id)
        .then((res) => {
          this.kuphur = res.data.data;
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Kuphür not found",
          });
          this.$router.push({ name: "AdminKuphur" });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
