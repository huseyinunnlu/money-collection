<template>
  <div class="card-header p-2">
    <ul class="nav nav-pills">
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminMoneyOperations',
        }"
        data-toggle="tab"
        >Index</router-link
      >
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminEmissions',
        }"
        data-toggle="tab"
        >Emissions</router-link
      >
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminSCWPM',
        }"
        data-toggle="tab"
        >SCWPM  </router-link
      >
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminKuphur',
        }"
        data-toggle="tab"
        >Kuphür  </router-link
      >
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminPrintPlace',
        }"
        data-toggle="tab"
        >Print Place  </router-link
      >
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminTertip',
        }"
        data-toggle="tab"
        >Tertip  </router-link
      >
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminSerie',
        }"
        data-toggle="tab"
        >Serie  </router-link
      >
      <router-link
        class="router-link py-0 px-2"
        :to="{
          name: 'AdminSignature',
        }"
        data-toggle="tab"
        >Signature  </router-link
      >
    </ul>
  </div>
</template>
<script>
export default {
};
</script>
<style>
.router-link-active {
  color: black;
}
</style>
