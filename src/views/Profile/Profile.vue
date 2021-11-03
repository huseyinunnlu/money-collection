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
                <ProfileLoader v-if="isLoading" />
                <UserProfile :_User="_Profile" v-else />
              </div>
              <div class="col-md-9">
                <div class="card">
                  <UserNavbar :slug="_Profile.slug" />
                  <UserContentLoader v-if="isLoading" />
                  <UserContent :moneyStatics="_Collection" v-else />
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
import ProfileLoader from "@/components/Loaders/ProfileLoader.vue";
import UserContentLoader from "@/components/Loaders/UserContentLoader.vue";
import {mapGetters} from "vuex"
export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    UserProfile,
    UserContent,
    UserNavbar,
    ProfileLoader,
    UserContentLoader,
  },
  computed:{
    ...mapGetters(['_Profile','_User','_Collection'])
  },
  data() {
    return {
      isLoading: false,
    };
  },
  created() {
    if (this.$route.params.slug != this._User.slug) {
      if(this._Profile.length == 0 || this.$route.params.slug != this._Profile.slug) {
        this.getUser();
      }
    } else {
      this.$store.state.Profile.profile = this._User;
      this.getCollectionStatics(this._User.id)
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
          this.$store.state.Profile.profile = res.data;
          this.getCollectionStatics(res.data.id)
        })
        .catch(() => {
          this.$router.push({ name: "Index" });
        })
        .finally(() => {
          setTimeout(() => {
            this.isLoading = false;
          }, 2000);
        });
    },
    getCollectionStatics(id) {
      this.isLoading = true;
      this.$appAxios
        .get("/getstatics", {
          params: {
            id: id,
          },
        })
        .then((res) => {
            this.$store.state.Profile.collection = res.data.result;
        })
        .finally(()=>{
            this.isLoading = false;
        })
    },
  },
};
</script>
