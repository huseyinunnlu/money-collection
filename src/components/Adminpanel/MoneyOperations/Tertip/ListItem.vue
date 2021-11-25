<template>
  <tr v-if="!isDeleted">
    <td>{{ tertip.id }}</td>
    <td>{{ tertip.title }}</td>
    <td>
      <span class="badge badge-success" v-if="tertip.status == '1'">{{$t('common.active')}}</span>
      <span class="badge badge-danger" v-else>{{$t('common.inactive')}}</span>
    </td>
    <td>
      <router-link
        :to="{ name: 'AdminEditTertip', params: { id: tertip.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <button
        class="btn btn-danger btn-sm"
        @click="del(tertip.id)"
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
  props: ["tertip"],
  methods: {
    del(id) {
      this.$appAxios
        .delete("/tertip/" + id)
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Tertip successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Tertip didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
