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
          <!-- <Sidebar /> -->
          <!--begin::Post-->
          <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div
              class="
                row
                gy-5
                g-xl-8
                d-flex
                align-items-center
                mt-lg-0
                mb-10 mb-lg-15
              "
            >
              <div class="row gy-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-4">
                  <!--begin::Card-->
                  <router-link
                    :to="{ name: 'Catalog' }"
                    class="card card-xl-stretch mb-5 mb-xl-8"
                  >
                    <!--begin::Card body-->
                    <div
                      class="card-body d-flex flex-column flex-stack pb-0 px-0"
                    >
                      <!--begin::Title-->
                      <div
                        class="text-dark fs-2 text-left mb-10 fw-bolder card-px"
                      >
                        {{ $t("index.catalog") }}
                      </div>
                      <!--end::Title-->
                      <!--begin::Illustration-->
                      <div class="position-relative align-self-center">
                        <img
                          src="assets/media/illustrations/custom/1.png"
                          style="margin-bottom: -5px"
                          class="mw-100 mx-auto h-100px card-rounded"
                        />
                      </div>
                      <!--begin::Illustration-->
                    </div>
                    <!--end::Card body-->
                  </router-link>
                  <!--end::Card-->
                </div>
                <div class="col-xl-4">
                  <!--begin::Card-->
                  <router-link
                    :to="{ name: 'Index' }"
                    class="card card-xl-stretch mb-5 mb-xl-8"
                  >
                    <!--begin::Card body-->
                    <div
                      class="card-body d-flex flex-column flex-stack pb-0 px-0"
                    >
                      <!--begin::Title-->
                      <div
                        class="text-dark fs-2 text-left mb-10 fw-bolder card-px"
                      >
                        {{ $t("index.priceAnalysis") }}
                      </div>
                      <!--end::Title-->
                      <!--begin::Illustration-->
                      <div class="position-relative align-self-center">
                        <img
                          src="assets/media/illustrations/custom/1.png"
                          style="margin-bottom: -5px"
                          class="mw-100 mx-auto h-100px card-rounded"
                        />
                      </div>
                      <!--begin::Illustration-->
                    </div>
                    <!--end::Card body-->
                  </router-link>
                  <!--end::Card-->
                </div>
                <div class="col-xl-4">
                  <!--begin::Card-->
                  <router-link
                    :to="{ name: 'Index' }"
                    class="card card-xl-stretch mb-5 mb-xl-8"
                  >
                    <!--begin::Card body-->
                    <div
                      class="card-body d-flex flex-column flex-stack pb-0 px-0"
                    >
                      <!--begin::Title-->
                      <div
                        class="text-dark fs-2 text-left mb-10 fw-bolder card-px"
                      >
                        {{ $t("index.marketplace") }}
                      </div>
                      <!--end::Title-->
                      <!--begin::Illustration-->
                      <div class="position-relative align-self-center">
                        <img
                          src="assets/media/illustrations/custom/1.png"
                          style="margin-bottom: -5px"
                          class="mw-100 mx-auto h-100px card-rounded"
                        />
                      </div>
                      <!--begin::Illustration-->
                    </div>
                    <!--end::Card body-->
                  </router-link>
                  <!--end::Card-->
                </div>
                <!--end::Col-->
              </div>
            </div>
            <!--end::Row-->
            <CatalogBody />
            <!--begin::Row-->
            <div class="row gy-5 my-4 g-xl-8">
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
// import Sidebar from "@/components/Sidebar/Sidebar.vue";
import Footer from "@/components/Header/Footer.vue";

import LastCollections from "@/components/Index/LastCollectionList.vue";
import CatalogBody from "@/components/Index/CatalogBody.vue";
export default {
  components: {
    Navbar,
    // Sidebar,
    Footer,
    LastCollections,
    CatalogBody,
  },
};
</script>
