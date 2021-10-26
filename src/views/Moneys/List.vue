<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-12">
            <ContentHeader :title="'Moneys'" />
            <List />
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
import ContentHeader from "@/components/ContentHeader.vue";
import List from "@/components/Moneys/List.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    ContentHeader,
    List,
  },
};
</script>
