<template>
  <!--begin::Header-->
  <div
    id="kt_header"
    class="header align-items-stretch"
    data-kt-sticky="true"
    data-kt-sticky-name="header"
    data-kt-sticky-offset="{default: '200px', lg: '300px'}"
  >
    <!--begin::Container-->
    <div class="header-container container-xxl d-flex align-items-center">
      <!--begin::Heaeder menu toggle-->
      <div
        class="d-flex topbar align-items-center d-lg-none ms-n2 me-3"
        title="Show aside menu"
      >
        <div
          class="btn btn-icon btn-color-gray-900 w-30px h-30px"
          id="kt_header_menu_mobile_toggle"
        >
          <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
          <span class="svg-icon svg-icon-2">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
            >
              <path
                d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                fill="black"
              />
              <path
                opacity="0.3"
                d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                fill="black"
              />
            </svg>
          </span>
          <!--end::Svg Icon-->
        </div>
      </div>
      <!--end::Heaeder menu toggle-->
      <!--begin::Header Logo-->
      <div class="header-logo me-5 me-md-10 flex-grow-1 flex-lg-grow-0">
        <router-link :to="{ name: 'Index' }">
          <img
            alt="'Logo'"
            :src="
              'https://preview.keenthemes.com/metronic8/demo12/assets/media/logos/logo-1.svg'
            "
            class="d-none d-lg-block h-30px"
          />
        </router-link>
      </div>
      <!--end::Header Logo-->
      <!--begin::Wrapper-->
      <div
        class="d-flex align-items-stretch justify-content-end flex-lg-grow-1"
      >
        <!--begin::Navbar-->
        <div class="d-flex align-items-stretch" id="kt_header_nav">
          <!--begin::Menu wrapper-->
          <div
            class="header-menu align-items-stretch h-lg-75px"
            data-kt-drawer="true"
            data-kt-drawer-name="header-menu"
            data-kt-drawer-activate="{default: true, lg: false}"
            data-kt-drawer-overlay="true"
            data-kt-drawer-width="{default:'200px', '300px': '250px'}"
            data-kt-drawer-direction="start"
            data-kt-drawer-toggle="#kt_header_menu_mobile_toggle"
            data-kt-swapper="true"
            data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}"
          >
            <!--begin::Menu-->
            <div
              class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch"
              id="#kt_header_menu"
              data-kt-menu="true"
            >
              <div class="menu-item me-lg-1">
                <router-link
                  class="menu-link active py-3"
                  :to="{ name: 'Index' }"
                >
                  <span class="menu-title">{{$t('header.navbar.index')}}</span>
                </router-link>
              </div>

              <div class="menu-item me-lg-1">
                <router-link
                  v-if="_User.role == 1"
                  class="menu-link active py-3"
                  :to="{ name: 'AdminMoneyOperations' }"
                >
                  <span class="menu-title">{{$t('header.navbar.moneyOpr')}}</span>
                </router-link>
              </div>
              <div class="menu-item me-lg-1">
                <router-link
                  v-if="_User.role == 1"
                  class="menu-link active py-3"
                  :to="{ name: 'AdminpanelUsers' }"
                >
                  <span class="menu-title">{{$t('header.navbar.users')}}</span>
                </router-link>
              </div>
            </div>
            <!--end::Menu-->
          </div>
          <!--end::Menu wrapper-->
        </div>
        <!--end::Navbar-->
        <!--begin::Topbar-->
        <div class="d-flex align-items-stretch flex-shrink-0">
          <!--begin::Toolbar wrapper-->
          <div class="topbar d-flex align-items-stretch flex-shrink-0">
            <!--begin::User-->
            <NavbarUser />
            <!--end::User -->

            <!--begin::Aside mobile toggle-->
            <div
              class="d-flex align-items-center d-lg-none ms-4"
              title="Show header menu"
            >
              <div
                class="btn btn-icon btn-color-gray-900 w-30px h-30px w-30px h-30px w-md-40px h-md-40px"
                id="kt_aside_toggle"
              >
                <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                <span class="svg-icon svg-icon-2">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                  >
                    <path
                      d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                      fill="black"
                    />
                    <path
                      opacity="0.3"
                      d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                      fill="black"
                    />
                  </svg>
                </span>
                <!--end::Svg Icon-->
              </div>
            </div>
            <!--end::Aside mobile toggle-->
          </div>
          <!--end::Toolbar wrapper-->
        </div>
        <!--end::Topbar-->
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Container-->
  </div>
  <!--end::Header-->
</template>
<script>
import NavbarUser from "@/components/Header/NavbarUser.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    NavbarUser,
  },
  computed: {
    ...mapGetters(["_User"]),
  },
};
</script>
