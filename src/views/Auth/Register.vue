<template>
  <div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
      <!--begin::Wrapper-->
      <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        <!--begin::Container-->
        <div
          id="kt_content_container"
          class="d-flex flex-column-fluid align-items-start container-xxl"
        >
          <!--begin::Post-->
          <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            <div
              class="row gy-5 g-xl-8 d-flex align-items-center mt-lg-0 mb-10 mb-lg-15"
            ></div>
            <!--end::Row-->
            <!--begin::Row-->
            <div
              class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20"
            >
              <!--begin::Logo-->
              <a href="/metronic8/demo12/../demo12/index.html" class="mb-12">
                <img
                  alt="Logo"
                  :src="
                    'https://preview.keenthemes.com/metronic8/demo12/assets/media/logos/logo-1.svg'
                  "
                  class="h-40px"
                />
              </a>
              <!--end::Logo-->
              <!--begin::Wrapper-->
              <div
                class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto"
              >
                <!--begin::Form-->
                <RegisterForm />
                <!--end::Row-->
              </div>
            </div>
            <!--end::Post-->
          <Footer />
          </div>
          <!--end::Container-->

        </div>
        <!--end::Wrapper-->
      </div>
      <!--end::Page-->
    </div>
  </div>
</template>

<script>
import RegisterForm from "@/components/Auth/RegisterForm.vue";
import Footer from "@/components/Header/Footer.vue";
export default {
  components: {
    RegisterForm,
    Footer,
  },
};
</script>
