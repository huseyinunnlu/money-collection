<template>
  <div>
    Index
  </div>
</template>
<script>
export default {
  created() {
    this.$appAxios.get("/user").then((res) => {
      console.log(res.data);
    });
  },
};
</script>
