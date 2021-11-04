<template>
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
      <!--begin::Wrapper-->
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <Navbar />
        <!--begin::Container-->
        <div
          id="kt_content_container"
          class="d-flex flex-column-fluid align-items-start container-xxl"
        >
          <Sidebar />
          <!--begin::Post-->
          <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div
              class="row gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15"
            >
              <List />
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row gy-5 g-xl-8">
              <!--begin::Col-->
              <LastCollections />
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Post-->
        </div>
        <!--end::Container-->

        <Footer />
      </div>
      <!--end::Wrapper-->
    </div>
    <!--end::Page-->
  </div>
  <!--end::Root-->
  <!--end::Main-->
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import Footer from "@/components/Header/Footer.vue";

import List from "@/components/Moneys/List.vue";
import LastCollections from "@/components/Index/LastCollectionList.vue";
export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
    List,
    LastCollections,
  },
};
</script>
