<template>
  <tr v-if="!isDeleted">
    <td>{{ ems.id }}</td>
    <td>{{ ems.title }}</td>
    <td>
      <span class="badge badge-success" v-if="ems.status == '1'">Active</span>
      <span class="badge badge-danger" v-else>Inactive</span>
    </td>
    <td>
      <router-link
        :to="{ name: 'AdminEditEmission', params: { id: ems.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <button class="btn btn-danger btn-sm" @click="del()"><i class="fas fa-trash"></i></button>
    </td>
  </tr>
</template>
<script>
export default {
  data() {
    return {
      isDeleted: false,
      isLoading: false,
    };
  },
  props: ["ems"],
  methods: {
    del() {
      this.$appAxios
        .delete("/emission/" + this.ems.id + "/delete")
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Emission successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Emission didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
