<template>
  <!-- <p>{{ $t("message") }}</p> -->
  <select @change="change" v-model="$i18n.locale" class=" form-select-solid form-select-sm menu-link px-2">
    <option
      v-for="(lang, i) in $store.getters._Langs"
      :key="`Lang${i}`"
      :value="lang.value"
    >
      {{ lang.text }}
    </option>
  </select>
</template>
<script>
export default {
    methods:{
        change(){
            localStorage.setItem('lang',this.$i18n.locale)
        }
    }
}
</script>