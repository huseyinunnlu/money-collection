<template>
  <tr v-if="!isDeleted">
    <td>{{ signature.id }}</td>
    <td>{{ signature.title }}</td>
    <td>
      <span class="badge badge-success" v-if="signature.status == '1'">{{$t('common.active')}}</span>
      <span class="badge badge-danger" v-else>{{$t('common.inactive')}}</span>
    </td>
    <td>
      <router-link
        :to="{ name: 'AdminEditSignature', params: { id: signature.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <button
        class="btn btn-danger btn-sm"
        @click="del(signature.id)"
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
  props: ["signature"],
  methods: {
    del(id) {
      this.$appAxios
        .delete("/signature/" + id)
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Signature successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Signature didn't deleted.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
