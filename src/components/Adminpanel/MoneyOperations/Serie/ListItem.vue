<template>
  <tr v-if="!isDeleted">
    <td>{{ serie.id }}</td>
    <td>{{ serie.title }}</td>
    <td>
      <span class="badge badge-success" v-if="serie.status == '1'">{{$t('common.active')}}</span>
      <span class="badge badge-danger" v-else>{{$t('common.active')}}</span>
    </td>
    <td>
      <router-link
        :to="{ name: 'AdminEditSerie', params: { id: serie.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <button
        class="btn btn-danger btn-sm"
        @click="del(serie.id)"
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
  props: ["serie"],
  methods: {
    del(id) {
      this.$appAxios
        .delete("/serie/" + id)
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Serie successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Serie didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
