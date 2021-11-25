<template>
  <Add />
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
            class="d-flex justify-content-between"
            data-kt-user-table-toolbar="base"
            data-select2-id="select2-data-81-jv68"
          >
            <button
              class="btn btn-primary me-4"
              data-toggle="modal"
              data-target="#addCollection"
            >
              <i class="fas fa-plus"></i>{{$t('collection.add')}}
            </button>
            <router-link
              :to="{name:'MoneyShow',params:{id:$route.params.id}}"
              class="btn btn-primary me-4"
            >
              <i class="fas fa-eye"></i>{{$t('button.moneyDetails')}}
            </router-link>
            
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
            class="
              table
              align-middle
              table-row-dashed
              fs-6
              gy-5
              dataTable
              no-footer
            "
            id="kt_table_users"
          >
            <!--begin::Table head-->
            <thead>
              <!--begin::Table row-->
              <tr class="text-dark-600 fw-bold">
                <th>ID</th>
                <th>{{$t('collection.images')}}</th>
                <th>{{$t('collection.table.column.uniqueSerie')}}</th>
                <th>{{$t('collection.table.column.purchasedPerson')}}</th>
                <th>{{$t('collection.table.column.date')}}</th>
                <th>{{$t('common.opr')}}</th>
              </tr>
              <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-bold" v-if="isLoading">
              <UserLoader />
            </tbody>
            <tbody
              v-if="!isLoading && _Collections.length > 0"
              class="text-gray-600 fw-bold"
            >
              <Item v-for="item in _Collections" :key="item.id" :item="item"/>
            </tbody>
            <!--end::Table body-->
            <div class="text-center">
              <a
                v-if="_Collections.length < dataCount && !isLoading"
                class="text-center text-primary my-3"
                style="cursor: pointer"
                @click="page++, get()"
                >{{$t('common.loadMore')}}</a
              >
            </div>
          </table>
        </div>
      </div>
      <!--end::Table-->
    </div>
    <!--end::Card body-->
  </div>
</template>
<script>
import Item from "@/components/Moneys/Collection/ListItem.vue";
import Add from "@/components/Moneys/Collection/Add.vue";
import UserLoader from "@/components/Loaders/UserLoader.vue";
// import VueSelect from "vue-next-select";
// import "vue-next-select/dist/index.min.css";

import { mapGetters } from "vuex";
export default {
  components: {
    Item,
    Add,
    UserLoader,
  },
  data() {
    return {
      filter: {},
      dataCount: 0,
      page: 1,
      isLoading: false,
    };
  },
  computed: {
    ...mapGetters(["_Collections", "_IsAuth", "_User"]),
  },
  created() {
    this.$store.state.Collection.collections = [];
    this.get();
  },
  methods: {
    get() {
      this.isLoading = true
      this.$appAxios
        .get("money/" + this.$route.params.id + "/mycollection")
        .then((res) => {
          this.$store.state.Collection.collections = res.data.data.data;
        })
        .finally(()=>{
          this.isLoading = false
        })
    },
  },
};
</script>
