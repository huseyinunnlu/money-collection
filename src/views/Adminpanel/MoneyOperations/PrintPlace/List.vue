<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-10 offset-1">
            <ContentHeader :title="'Print Places'" />
            <div class="card">
              <div class="card-header">
                <MoneyNavbar />
              </div>
              <div class="card-body">
                <List />
              </div>
            </div>
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
import MoneyNavbar from "@/components/Adminpanel/MoneyOperations/Navbar.vue";
import List from "@/components/Adminpanel/MoneyOperations/PrintPlace/List.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    ContentHeader,
    MoneyNavbar,
    List
  },
};
</script>
