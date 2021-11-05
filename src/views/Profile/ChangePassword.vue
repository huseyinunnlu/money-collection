<template>
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
      <!--begin::Wrapper-->
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <Navbar />
        <div
          id="kt_content_container"
          class="d-flex flex-column-fluid align-items-start container-xxl"
        >
          <Sidebar />
          <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <UserNavbar :slug="_User.slug" class="my-3" />
            <UserProfile :_User="_User" />
            <ChangePassword />
          </div>
        </div>
        <Footer />
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import Footer from "@/components/Header/Footer.vue";
import UserProfile from "@/components/Profile/UserProfile.vue";
import UserNavbar from "@/components/Profile/UserNavbar.vue";
import ChangePassword from "@/components/Profile/ChangePassword.vue";
import {mapGetters} from "vuex"
export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserProfile,
    UserNavbar,
    ChangePassword,
  },
  computed:{
    ...mapGetters(['_User'])
  }
};
</script>
