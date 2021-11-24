<template>
  <div v-if="_IsAuth" class="d-flex align-items-center ms-3 ms-lg-5 dropleft">
    <!--begin::Menu wrapper-->
    <div
      role="button"
      id="dropdownMenuButton"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="false"
      class="
        btn btn-icon btn-active-light-primary
        w-30px
        h-30px
        w-md-40px
        h-md-40px
      "
    >
      <img
        class="h-100 w-100 rounded"
        :src="_User.profilePhoto"
        :alt="_User.slug"
      />
    </div>
    <!--begin::Menu-->
    <div
      class="
        dropdown-menu
        menu
        menu-sub
        menu-sub-dropdown
        menu-column
        menu-rounded
        menu-gray-800
        menu-state-bg
        menu-state-primary
        fw-bold
        py-4
        fs-6
        w-275px
      "
      aria-labelledby="dropdownMenuButton"
      data-kt-menu="true"
    >
      <!--begin::Menu item-->
      <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
          <!--begin::Avatar-->
          <div class="symbol symbol-50px me-5">
            <img :alt="_User.slug" :src="_User.profilePhoto" />
          </div>
          <!--end::Avatar-->
          <!--begin::Username-->
          <div class="d-flex flex-column">
            <div class="fw-bolder d-flex align-items-center fs-5">
              {{ _User.fullName }}
              <span
                v-if="_User.role == 1"
                class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2"
                >{{$t('header.user.user')}}</span
              >
              <span
                v-else
                class="badge badge-light-primary fw-bolder fs-8 px-2 py-1 ms-2"
                >{{$t('header.user.admin')}}</span
              >
            </div>
          </div>
          <!--end::Username-->
        </div>
      </div>
      <!--end::Menu item-->
      <!--begin::Menu separator-->
      <div class="separator my-2"></div>
      <!--end::Menu separator-->
      <!--begin::Menu item-->
      <div class="menu-item px-5">
        <router-link
          :to="{ name: 'Profile', params: { slug: _User.slug } }"
          class="menu-link px-5"
          >{{$t('header.user.myProfile')}}</router-link
        >
      </div>
      <!--end::Menu item-->
      <!--begin::Menu item-->
      <!--end::Menu item-->
      <!--begin::Menu separator-->
      <div class="separator my-2"></div>
      <!--end::Menu separator-->
      <!--begin::Menu item-->
      <div class="menu-item px-5 my-1">
        <router-link :to="{ name: 'ProfileSettings' }" class="menu-link px-5"
          >{{$t('header.user.accountSettings')}}</router-link
        >
      </div>
      <div class="menu-item px-5 my-1">
        <router-link :to="{ name: 'ChangePassword' }" class="menu-link px-5"
          >{{$t('header.user.changePassword')}}</router-link
        >
      </div>
      <!--end::Menu item-->
      <div class="separator my-2"></div>
      <Logout />
    </div>
    <!--end::Menu-->
    <!--end::Menu wrapper-->
  </div>
</template>
<script>
import Logout from "@/components/Auth/Logout.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    Logout,
  },
  computed: {
    ...mapGetters(["_User", "_IsAuth"]),
  },
};
</script>
