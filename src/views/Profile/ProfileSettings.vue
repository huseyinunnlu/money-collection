<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper">
        <section class="content">
          <div class="container-fluid">
            <div class="row py-4">
              <div class="col-md-3">
                <UserProfile :_User="this.$store.getters._User"/>
              </div>
              <div class="col-md-9">
                <div class="card">
                  <UserNavbar :slug="this.$store.getters._User.slug"/>
                  <UserSettings />
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <Footer />
    </div>
  </body>
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import Footer from "@/components/Header/Footer.vue";
import UserProfile from "@/components/Profile/UserProfile.vue";
import UserSettings from "@/components/Profile/UserSettings.vue";
import UserNavbar from "@/components/Profile/UserNavbar.vue";
export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserProfile,
    UserSettings,
    UserNavbar,
  },
};
</script>
