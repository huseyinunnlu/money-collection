<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <div class="content-wrapper py-4">
        <div class="row">
          <div class="col-10 offset-1">
            <ContentHeader :title="title" />
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
import Footer from "@/components/Header/Footer.vue";
import ContentHeader from "@/components/ContentHeader.vue";
import MoneyNavbar from "@/components/Adminpanel/MoneyOperations/Navbar.vue";
import List from "@/components/Adminpanel/MoneyOperations/Emissions/List.vue";

export default {
  components: {
    Navbar,
    Footer,
    ContentHeader,
    MoneyNavbar,
    List
  },
  computed:{
    title(){
      return this.$t('ems.title')
    }
  },
};
</script>
