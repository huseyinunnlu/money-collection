<template>
  <tr v-for="i in 8" :key="i">
    <td><span></span></td>
    <td><span></span></td>
    <td><span></span></td>
    <td><span></span></td>
    <td><span></span></td>
    <td><span></span></td>
    <td>
      <button disabled class="btn btn-primary btn-sm">
        <i class="fas fa-eye"></i>
      </button>
    </td>
  </tr>

</template>
<style scoped>
td span{
  padding: 8px 50px;
  float: left;
  background-color: rgb(230, 230, 230,0.8);
  border-radius: 2px;
  margin: 3px 0px;
}
</style>
