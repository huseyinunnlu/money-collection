<template>
  <div class="card">
    <div class="card-body p-0">
      <ul
        class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 mx-5 fw-bolder"
      >
        <!--begin::Nav item-->
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminMoneyOperations'}"
            >{{$t('header.navbar.index')}}</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminEmissions' }"
            >{{$t('ems.title')}}</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminSCWPM' }"
            >{{$t('scwpm.title')}}</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminKuphur' }"
            >{{$t('kuphur.title')}}</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminPrintPlace' }"
            >{{$t('printPlace.title')}}</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminTertip' }"
            >{{$t('tertip.title')}}</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminSerie' }"
            >{{$t('serie.title')}}</router-link
          >
        </li>
        <li class="nav-item mt-2">
          <router-link
            class="nav-link text-active-primary ms-0 me-10 py-5"
            :to="{ name: 'AdminSignature' }"
            >{{$t('signature.title')}}</router-link
          >
        </li>
        <!--end::Nav item-->
      </ul>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style>
.router-link-active {
  color: black;
}
</style>
