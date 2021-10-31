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
            <Show v-else :money="money"/>
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
