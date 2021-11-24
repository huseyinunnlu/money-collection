<template>
  <tr v-if="!isDeleted">
    <td>{{ user.id }}</td>
    <td>{{ user.fullName }}</td>
    <td>{{ user.email }}</td>
    <td>
      <span class="badge badge-primary" v-if="user.role == 0">User</span>
      <span class="badge badge-success" v-else>Admin</span>
    </td>
    <td>{{ moment(user.created_at).format("MMM Do YY") }}</td>
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
          {{$t('button.actions')}}
        </button>
        <div
          class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
          aria-labelledby="dropdownMenuButton"
        >
          <div class="menu-item px-3">
            <router-link
              :to="{ name: 'AdminpanelEditUser', params: { id: user.id } }"
              class="menu-link px-3"
              ><i class="fas fa-pen mx-2"></i> {{$t('button.edit')}}</router-link
            >
          </div>
          <div class="menu-item px-3">
            <router-link
              :to="{ name: 'Profile', params: { slug: user.slug } }"
              class="menu-link px-3"
              ><i class="fas fa-eye mx-2"></i> {{$t('button.details')}}</router-link
            >
          </div>
          <div class="menu-item px-3">
            <a
              v-if="$store.getters._User.id != user.id"
              class="menu-link px-3"
              @click="deleteUser()"
            >
              <i class="fas fa-trash mx-2"></i> {{$t('button.delete')}}
            </a>
          </div>
        </div>
      </div>
    </td>
  </tr>
</template>
<script>
import moment from "moment";
export default {
  data() {
    return {
      isDeleted: false,
      isLoading: false,
    };
  },
  created() {
    this.moment = moment;
  },
  methods: {
    deleteUser() {
      this.isLoading = true;
      if (this.user.id == this.$store.getters._User.id) {
        this.$notify({
          type: "error",
          title: "You cannot delete own account.",
        });
      } else {
        this.$appAxios
          .delete("/user/" + this.user.id + "/delete")
          .then(() => {
            this.isDeleted = true;
            this.$notify({
              type: "success",
              title: "User successfuly deleted.",
            });
          })
          .catch(() => {
            this.$notify({
              type: "error",
              title: "User didn't deleted.",
            });
          })
          .finally(() => {
            this.isLoading = false;
          });
      }
    },
  },
  props: ["user"],
};
</script>
