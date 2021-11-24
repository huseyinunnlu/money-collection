<template>
  <AddUser />

  <div class="card">
    <!--begin::Card header-->
    <div
      class="card-header border-0 pt-6"
      data-select2-id="select2-data-83-t4vv"
    >
      <div class="card-toolbar" data-select2-id="select2-data-82-5tlq">
        <!--begin::Toolbar-->
        <div class="card-title">
          <div
            data-kt-user-table-toolbar="base"
            data-select2-id="select2-data-81-jv68"
          >
            <button
              class="btn btn-primary mb-3"
              data-toggle="modal"
              data-target="#addUser"
            >
              <i class="fas fa-plus"></i>{{$t('button.add')}}
            </button>
            <div class="input-group input-group-sm" style="width: auto;">
              <input
                type="text"
                name="table_search"
                class="form-control float-right"
                placeholder="Search"
                v-model="search"
              />
              <select class="form-control" v-model="column">
                <option :value="null">{{$t('table.filter.column')}}</option>
                <option :value="'fullName'">{{$t('profile.fullName')}}</option>
                <option :value="'email'">{{$t('profile.email')}}</option>
              </select>
              <select class="form-control" v-model="role">
                <option :value="null">{{$t('table.filter.role')}}</option>
                <option :value="'0'">User</option>
                <option :value="'1'">Admin</option>
              </select>
              <select class="form-control" v-model="count" style="width:20px;">
                <option :value="null">{{$t('table.filter.count')}}</option>
                <option :value="'5'">5</option>
                <option :value="'15'">15</option>
                <option :value="'25'">25</option>
                <option :value="'50'">50</option>
                <option :value="'100'">100</option>
              </select>
              <select class="form-control" v-model="sort">
                <option :value="'desc'">{{$t('user.createdAt')}} ({{$t('table.filter.desc')}})</option>
                <option :value="'asc'">{{$t('user.createdAt')}} ({{$t('table.filter.asc')}})</option>
              </select>
              <div class="input-group-append">
                <button
                  @click="(page = 1), getUsers()"
                  type="submit"
                  class="btn btn-default"
                >
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--end::Toolbar-->
      </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
      <!--begin::Table-->
      <div
        id="kt_table_users_wrapper"
        class="dataTables_wrapper dt-bootstrap4 no-footer"
      >
        <div class="table-responsive">
          <table
            class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
            id="kt_table_users"
          >
            <!--begin::Table head-->
            <thead>
              <!--begin::Table row-->
              <tr class="text-dark-600 fw-bold">
                <th>ID</th>
                <th>{{$t('profile.fullName')}}</th>
                <th>{{$t('profile.email')}}</th>
                <th>{{$t('user.role')}}</th>
                <th>{{$t('user.createdAt')}}</th>
                <th>{{$t('user.opr')}}</th>
              </tr>
              <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-bold" v-if="isLoading">
              <UserLoader v-if="isLoading" />
            </tbody>
            <tbody
              v-if="!isLoading && _Users.length > 0"
              class="text-gray-600 fw-bold"
            >
              <UserItem
                v-for="user in _Users"
                :key="user.id"
                :user="user"
              />
            </tbody>
            <div class="text-center">
              <a
                v-if="_Users.length < dataCount && !isLoading"
                class="text-center text-primary my-3"
                style="cursor:pointer;"
                @click="page++, getUsers()"
                >{{$t('table.loadMore')}}</a
              >
            </div>
            <!--end::Table body-->
          </table>
        </div>
      </div>
      <!--end::Table-->
    </div>
    <!--end::Card body-->
  </div>
</template>
<script>
import UserItem from "@/components/Adminpanel/User/UserItem.vue";
import AddUser from "@/components/Adminpanel/User/AddUser.vue";
import UserLoader from "@/components/Loaders/UserLoader.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    UserItem,
    AddUser,
    UserLoader,
  },
  data() {
    return {
      search: "",
      column: "fullName",
      role: 0,
      count: 15,
      sort: "desc",
      isLoading: false,
      page: 1,
      dataCount: 0,
    };
  },
  created() {
    this.getUsers();
  },
  methods: {
    getUsers() {
      this.isLoading = true;
      this.$appAxios
        .get("user/get", {
          params: {
            page: this.page,
            search: this.search,
            column: this.column,
            role: this.role,
            count: this.count,
            sort: this.sort,
          },
        })
        .then((res) => {
          if (this.page == 1) {
            this.$store.state.Users.users = [];
            this.$store.state.Users.users = res.data.data;
          } else {
            this.$store.state.Users.users = this.$store.state.Users.users.concat(
              res.data.data
            );
          }
          this.dataCount = res.data.total;
        })
        .catch(() => {
          this.$store.state.Users.users = [];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
  computed: {
    ...mapGetters(["_Users"]),
  },
};
</script>
