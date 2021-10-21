<template>
  <MainLoader v-if="isLoading"/>
  <router-view v-else/>
  <notifications :ignoreDuplicates="true" position="top right"/>
</template>
<script>
import MainLoader from "@/components/Loaders/MainLoader.vue"
export default {
  components:{
    MainLoader,
  },
  data(){
    return {
      isLoading:false
    }
  }
}
</script>

