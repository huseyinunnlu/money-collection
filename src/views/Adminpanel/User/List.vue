<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper py-4">
          <div class="row">
              <div class="col-10 offset-1">
                  <ContentHeader :title="'Users'"/>
                  <UserList />
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
import UserList from "@/components/Adminpanel/User/UserList.vue";
import ContentHeader from "@/components/ContentHeader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserList,
    ContentHeader,
  },
};
</script>
