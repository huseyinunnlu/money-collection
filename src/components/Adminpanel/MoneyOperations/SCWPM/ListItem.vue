<template>
  <tr v-if="!isDeleted">
    <td>{{ scwpm.id }}</td>
    <td>{{ scwpm.title }}</td>
    <td>
      <span class="badge badge-success" v-if="scwpm.status == '1'">{{$t('common.active')}}</span>
      <span class="badge badge-danger" v-else>{{$t('common.inactive')}}</span>
    </td>
    <td>
      <router-link
        :to="{ name: 'AdminEditSCWPM', params: { id: scwpm.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <button
        class="btn btn-danger btn-sm"
        @click="del(scwpm.id)"
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
  props: ["scwpm"],
  methods: {
    del(id) {
      this.$appAxios
        .delete("/scwpm/" + id)
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "SCWPM successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "SCWPM didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
