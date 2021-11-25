<template>
  <tr v-if="!isDeleted">
    <td>{{ printPlace.id }}</td>
    <td>{{ printPlace.title }}</td>
    <td>
      <span class="badge badge-success" v-if="printPlace.status == '1'">{{$t('common.active')}}</span>
      <span class="badge badge-danger" v-else>{{$t('common.inactive')}}</span>
    </td>
    <td>
      <router-link
        :to="{ name: 'AdminEditPrintPlace', params: { id: printPlace.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <button
        class="btn btn-danger btn-sm"
        @click="del(printPlace.id)"
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
  props: ["printPlace"],
  methods: {
    del(id) {
      this.$appAxios
        .delete("/printplace/" + id)
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Print place successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Print place didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
