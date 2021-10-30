<template>
  <tr v-if="!isDeleted">
    <td>{{ money.id }}</td>
    <td>{{ money.emission_id.title }}</td>
    <td>{{ money.scwpm_id.title }}</td>
    <td>{{ money.kuphur_id.title }}</td>
    <td>{{ money.value }}</td>
    <td>{{ money.serie_id.title }}</td>
    <td>{{ money.cilValue }}</td>
    <td>{{ money.tertip_id.title }}</td>
    <td>{{ money.print_place_id.title }}</td>
    <td>
      <span class="badge badge-success" v-if="money.status == '1'">Active</span>
      <span class="badge badge-danger" v-else>Inactive</span>
    </td>
    <td>
      <router-link
        v-if="_IsAuth && _User.role == 1"
        :to="{ name: 'AdminMoneyEdit', params: { id: money.id } }"
        class="btn btn-success btn-sm"
        ><i class="fas fa-pen"></i
      ></router-link>
      <router-link
        :to="{ name: 'AdminMoneyShow', params: { id: money.id } }"
        class="btn btn-info btn-sm"
        ><i class="fas fa-eye"></i
      ></router-link>
      <button
        v-if="_IsAuth && _User.role == 1"
        class="btn btn-danger btn-sm"
        @click="del(money.id)"
      >
        <i class="fas fa-trash"></i>
      </button>
      <button
        class="btn btn-primary btn-sm"
        :disabled="buttonIsLoading"
        @click="addCollection()"
        v-if="!isCollected && money.status == 1"
      >
        <i class="fas fa-plus"></i>
      </button>
      <button class="btn btn-info btn-sm" @click="deleteCollection()" :disabled="buttonIsLoading" v-if="isCollected && money.status == 1">
        <i class="fas fa-times"></i>
      </button>
    </td>
  </tr>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["_User", "_IsAuth"]),
  },
  created(){
    this.isCollected = this.money.isCollected
  },
  data() {
    return {
      isDeleted: false,
      isLoading: false,
      buttonIsLoading: false,
      isCollected: false,
    };
  },
  props: ["money"],
  methods: {
    del(id) {
      this.$appAxios
        .delete("/money/" + id + "/delete")
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Money successfuly deleted.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Successfully added to your money collection.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    addCollection() {
      this.buttonIsLoading = true;
      this.$appAxios
        .post("collection/add", {
          userId: this._User.id,
          moneyId: this.money.id,
        })
        .then(() => {
          this.isCollected = true;
          this.$notify({
            type: "success",
            title: "Money successfully added to your money collection",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Money didn't added your collection.",
          });
        })
        .finally(() => {
          this.buttonIsLoading = false;
        });
    },
    deleteCollection(){
      this.buttonIsLoading = true;
      this.$appAxios
        .post("collection/delete", {
          userId: this._User.id,
          moneyId: this.money.id,
        })
        .then(() => {
          this.isCollected = false;
          this.$notify({
            type: "success",
            title: "Money successfully deleted to your money collection",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Money didn't deleted your collection.",
          });
        })
        .finally(() => {
          this.buttonIsLoading = false;
        });
    }
  },
};
</script>
