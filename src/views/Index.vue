<template>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <Navbar />
      <Sidebar />
      <div class="content-wrapper"></div>
      <Footer />
    </div>
  </body>
</template>
<script>
import Navbar from "@/components/Header/Navbar.vue";
import Sidebar from "@/components/Sidebar/Sidebar.vue";
import Footer from "@/components/Header/Footer.vue";
export default {
  components: {
    Navbar,
    Sidebar,
    Footer,
  },
};
</script>
