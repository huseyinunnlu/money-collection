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
          <!--begin::Post-->
          <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <UserNavbar :slug="_Profile.slug" class="my-3" />
            <ProfileLoader v-if="isLoading" />
            <UserProfile :_User="_Profile" v-else />
            <div class="row">
              <UserContentLoader class="col-md-5" v-if="isLoading" />
              <UserContent
                class="col-md-5"
                :moneyStatics="_Collection"
                v-else
              />
            </div>
          </div>
        </div>
        <Footer />
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Footer from "@/components/Header/Footer.vue";
import UserProfile from "@/components/Profile/UserProfile.vue";
import UserNavbar from "@/components/Profile/UserNavbar.vue";
import UserContent from "@/components/Profile/UserContent.vue";
import ProfileLoader from "@/components/Loaders/ProfileLoader.vue";
import UserContentLoader from "@/components/Loaders/UserContentLoader.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    Navbar,
    Footer,
    UserProfile,
    UserContent,
    UserNavbar,
    ProfileLoader,
    UserContentLoader,
  },
  computed: {
    ...mapGetters(["_Profile", "_User", "_Collection"]),
  },
  data() {
    return {
      isLoading: false,
    };
  },
  created() {
    if (this.$route.params.slug != this._User.slug) {
      if (
        this._Profile.length == 0 ||
        this.$route.params.slug != this._Profile.slug
      ) {
        this.getUser();
      }
    } else {
      this.$store.state.Profile.profile = this._User;
      this.getCollectionStatics(this._User.id);
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
          this.getCollectionStatics(res.data.id);
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
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
