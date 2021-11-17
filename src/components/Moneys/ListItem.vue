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
    <td class="text-end">
      <div class="dropdown">
        <button
          class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle"
          type="button"
          id="dropdownMenuButton"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          Actions
        </button>
        <div
          class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
          aria-labelledby="dropdownMenuButton"
        >
          <div class="menu-item px-3">
            <router-link
              v-if="_IsAuth && _User.role == 1"
              :to="{ name: 'AdminMoneyEdit', params: { id: money.id } }"
              class="menu-link px-3"
              ><i class="fas fa-pen mx-2"></i> Edit</router-link
            >
          </div>
          <div class="menu-item px-3">
            <router-link
              :to="{ name: 'MoneyShow', params: { id: money.id } }"
              class="menu-link px-3"
              ><i class="fas fa-eye mx-2"></i> Details</router-link
            >
          </div>
          <div class="menu-item px-3">
            <a
              v-if="_IsAuth && _User.role == 1"
              class="menu-link px-3"
              @click="del(money.id)"
            >
              <i class="fas fa-trash mx-2"></i> Delete
            </a>
          </div>
          <div class="menu-item px-3">
            <router-link
              :to="{name:'MyCollection',params:{id:money.id}}"
              class="menu-link px-3"
            >Collection Details
            </router-link>
          </div>
        </div>
      </div>
    </td>
  </tr>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  computed: {
    ...mapGetters(["_User", "_IsAuth"]),
  },
  created() {
    this.isCollected = this.money.isCollected;
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
    deleteCollection() {
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
    },
  },
};
</script>
