<template>
  <tr v-if="!isDeleted">
    <td>{{ kuphur.id }}</td>
    <td>{{ kuphur.title }}</td>
    <td>
      <span class="badge badge-success" v-if="kuphur.status == '1'">Active</span>
      <span class="badge badge-danger" v-else>Inactive</span>
    </td>
    <td>
      <router-link
        :to="{ name: 'AdminEditKuphur', params: { id: kuphur.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <button
        class="btn btn-danger btn-sm"
        @click="del(kuphur.id)"
      >
        <i class="fas fa-trash"></i>
      </button>
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
  props: ["kuphur"],
  methods: {
    del(id) {
      this.$appAxios
        .delete("/kuphur/" + id)
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Kuphür successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Kuphür didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
