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
                <ContentHeader :title="'Collection Details'" />
                <div class="col-md-12">
                  <List />
                </div>
              </div>
            </div>
            <Footer />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Footer from "@/components/Header/Footer.vue";
import ContentHeader from "@/components/ContentHeader.vue";
import List from "@/components/Moneys/Collection/List.vue";

export default {
  components: {
    Navbar,
    Footer,
    ContentHeader,
    List,
  },
};
</script>
