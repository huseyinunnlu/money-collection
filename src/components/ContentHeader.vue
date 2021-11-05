<template>
  <div class="row mb-4 mx-5">
    <div class="col-sm-12">
      <h1>{{ title }}</h1>
    </div>
  </div>
  <!-- /.container-fluid -->
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      default: "Index",
    },
  },
};
</script>
