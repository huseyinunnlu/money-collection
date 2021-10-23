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
                <div class="sidebar-loader" v-if="isLoading">
                  <UserSidebarLoader />
                </div>
                <div class="user-sidebar" v-else>
                  <UserProfile :_User="user"/>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card" v-if="isLoading">
                  <div class="card-body">
                    <h1 class="text-center">Loading...</h1>
                  </div>
                </div>
                <div class="card" v-else>
                  <UserNavbar :slug="user.slug" />
                  <UserContent/>
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
import UserContent from "@/components/Profile/UserContent.vue";
import UserNavbar from "@/components/Profile/UserNavbar.vue";
import UserSidebarLoader from "@/components/Profile/UserSidebarLoader.vue";

export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserProfile,
    UserContent,
    UserNavbar,
    UserSidebarLoader
  },
  data() {
    return {
      user: [],
      isLoading: false,
    };
  },
  created() {
    if (this.$route.params.slug != this.$store.getters._User.slug) {
      this.getUser();
    } else {
      this.user = this.$store.getters._User;
    }
  },
  methods: {
    getUser() {
      this.isLoading = true;
      this.$appAxios
        .post("/getuser", {
          slug: this.$route.params.slug,
        })
        .then((res) => {
          this.user = res.data;
        })
        .catch(() => {
          this.$router.push({ name: "404" });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
