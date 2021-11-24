<template>
  <Add v-if="_IsAuth && _User.role == 1" />
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
              data-target="#add"
              v-if="_User.role == 1 && _IsAuth"
            >
              <i class="fas fa-plus"></i>Add Money
            </button>
            <div class="dropdown dropright">
              <button
                type="button"
                class="btn btn-primary show menu-dropdown"
                id="dropdownMenuButton"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Filter
              </button>
              <form
                class="
                  dropdown-menu
                  menu menu-sub menu-sub-dropdown
                  w-300px w-md-325px
                "
                aria-labelledby="dropdownMenuButton"
                data-kt-menu="true"
                data-popper-placement="bottom-end"
                style="
                  z-index: 105;
                  position: absolute;
                  inset: 0px 0px auto auto;
                  margin: 0px 10px;
                  transform: translate(-469px, 128px);
                "
              >
                <!--begin::Header-->
                <div class="px-7 py-5">
                  <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                </div>
                <!--end::Header-->
                <!--begin::Separator-->
                <div class="separator border-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Content-->
                <div class="px-7 py-5" data-kt-user-table-filter="form">
                  <div class="form-group my-3 row">
                    <vue-select
                      class="form-control form-control-solid w-100"
                      v-model="filter.arrays.scwpm_id.data"
                      :options="datas.scwpm"
                      :multiple="true"
                      :taggable="true"
                      label-by="scwpm_id.title"
                      value-by="scwpm_id.id"
                      :disabled="datas.scwpm.length < 1"
                    ></vue-select>
                  </div>
                  <div class="form-group my-3 row">
                    <vue-select
                      class="form-control form-control-solid w-100"
                      v-model="filter.arrays.kuphur_id.data"
                      :options="datas.kuphur"
                      :disabled="datas.kuphur.length < 1"
                      label-by="kuphur_id.title"
                      value-by="kuphur_id.id"
                      :multiple="true"
                      :taggable="true"
                    ></vue-select>
                  </div>

                  <div class="form-group my-3 row">
                    <vue-select
                      class="form-control form-control-solid w-100"
                      v-model="filter.arrays.serie_id.data"
                      :options="datas.serie"
                      label-by="serie_id.title"
                      value-by="serie_id.id"
                      :multiple="true"
                      :taggable="true"
                      :disabled="datas.serie.length < 1"
                    ></vue-select>
                  </div>

                  <div class="form-group my-3 row">
                    <vue-select
                      class="form-control form-control-solid w-100"
                      v-model="filter.arrays.tertip_id.data"
                      :options="datas.tertip"
                      :disabled="datas.tertip.length < 1"
                      label-by="tertip_id.title"
                      value-by="tertip_id.id"
                      :multiple="true"
                      :taggable="true"
                      @blur="get()"
                    ></vue-select>
                  </div>
                  <div class="form-group my-3 row">
                    <select
                      class="form-select form-select-solid w-100"
                      v-model="filter.count"
                      style="width: 20px"
                      @change="get()"
                    >
                      <option :value="null">Select data count</option>
                      <option :value="'5'">5</option>
                      <option :value="'15'">15</option>
                    </select>
                  </div>
                  <div class="form-group my-3 row">
                    <select
                      class="form-select form-select-solid w-100"
                      v-model="filter.order"
                      @change="get()"
                    >
                      <option :value="'desc'">Creating Date DESC</option>
                      <option :value="'asc'">Creating Date ASC</option>
                    </select>
                  </div>
                  <div class="form-group my-3 row">
                    <select
                      class="form-control form-control-solid w-100"
                      v-model="filter.status"
                      v-if="_IsAuth && _User.role == 1"
                      @change="get()"
                    >
                      <option :value="'1'">Active</option>
                      <option :value="'0'">Inactive</option>
                    </select>
                  </div>

                  <!--begin::Separator-->
                  <div class="separator border-gray-200"></div>
                  <!--end::Separator-->
                  <!--begin::Footer-->
                  <div class="py-5">
                    <div
                      class="form-group-row d-flex justify-content-between my-4"
                    >
                      <button
                        @click="(page = 1), reset()"
                        type="button"
                        class="btn btn-primary"
                      >
                        Reset
                      </button>
                      <div
                        class="
                          form-check form-check-solid
                          d-flex
                          align-items-center
                        "
                      >
                        <input
                          id="show"
                          type="checkbox"
                          v-model="filter.isCollection"
                          @change="get()"
                        />
                        <label class="form-check-label" for="show">
                          MyCollection</label
                        >
                      </div>
                    </div>
                  </div>
                  <!--end::Footer-->
                </div>
                <!--end::Content-->
              </form>
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
            class="
              table
              align-middle
              table-row-dashed
              fs-6
              gy-5
              dataTable
              no-footer
            "
            style="height:190px;"
            id="kt_table_users"
          >
            <!--begin::Table head-->
            <thead>
              <!--begin::Table row-->
              <tr class="text-dark-600 fw-bold">
                <th>ID</th>
                <th>Emission</th>
                <th>SCWPM</th>
                <th>Kuphür</th>
                <th>Value</th>
                <th>Serie</th>
                <th>Çil</th>
                <th>Tertip</th>
                <th>PrintPlace</th>
                <th>Status</th>
                <th>Opr.</th>
              </tr>
              <!--end::Table row-->
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody class="text-gray-600 fw-bold" v-if="isLoading">
              <MoneyLoader />
            </tbody>
            <tbody
              v-if="!isLoading && _Moneys.length > 0"
              class="text-gray-600 fw-bold"
            >
              <Item v-for="money in _Moneys" :key="money.id" :money="money" />
            </tbody>
            <!--end::Table body-->
            <div class="text-center">
              <a
                v-if="_Moneys.length < dataCount && !isLoading"
                class="text-center text-primary my-3"
                style="cursor: pointer"
                @click="page++, get()"
                >Load more</a
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
import Item from "@/components/Moneys/ListItem.vue";
import Add from "@/components/Moneys/Add.vue";
import MoneyLoader from "@/components/Loaders/MoneyLoader.vue";
import VueSelect from "vue-next-select";
import "vue-next-select/dist/index.min.css";

import { mapGetters } from "vuex";
export default {
  components: {
    Item,
    Add,
    MoneyLoader,
    "vue-select": VueSelect,
  },
  data() {
    return {
      filter: {
        arrays: {
          scwpm_id: {
            column: "scwpm_id",
            data: [],
          },
          kuphur_id: {
            column: "kuphur_id",
            data: [],
          },
          serie_id: {
            column: "serie_id",
            data: [],
          },
          tertip_id: {
            column: "tertip_id",
            data: [],
          },
        },
        order: "desc",
        status: "1",
        count: 15,
        isCollection: false,
      },
      isLoading: true,
      page: 1,
      dataCount: 0,
      datas: {
        scwpm: [],
        kuphur: [],
        serie: [],
        tertip: [],
      },
    };
  },
  created() {
    this.filterItems({
      column: "scwpm_id",
      data: "scwpm",
      emission_id: this.$route.query.ems_id,
    });
  },
  watch: {
    "filter.arrays.scwpm_id.data"(val) {
      if (val.length > 0) {
        this.filterItems({
          column: "kuphur_id",
          data: "kuphur",
        });
      } else {
        this.datas.kuphur = [];
        this.datas.serie = [];
        this.datas.tertip = [];
        this.get();
      }
    },
    "filter.arrays.kuphur_id.data"(val) {
      if (val.length > 0) {
        this.filterItems({
          column: "serie_id",
          data: "serie",
        });
      } else {
        this.datas.serie = [];
        this.datas.tertip = [];
        this.get();
      }
    },
    "filter.arrays.serie_id.data"(val) {
      if (val.length > 0) {
        this.filterItems({
          column: "tertip_id",
          data: "tertip",
        });
      } else {
        this.datas.tertip = [];
        this.get();
      }
    },
    "filter.arrays.tertip_id.data"() {
      this.get();
    },
  },
  methods: {
    reset() {
      let filter = this.filter.arrays;
      let datas = this.datas;
      datas.kuphur = [];
      datas.serie = [];
      datas.tertip = [];
      filter.scwpm_id.data = [];
      filter.kuphur_id.data = [];
      filter.serie_id.data = [];
      filter.tertip_id.data = [];
      this.filter.count = "15";
      this.filter.order = "desc";
      this.filter.status = "1";
      this.filter.isCollection = false;
      this.get();
    },
    filterItems(data) {
      this.$appAxios
        .post("/moneyfilter", {
          column: data.column,
          data: data.data,
          emission_id: this.$route.query.ems_id,
          filter: this.filter,
        })
        .then((res) => {
          const data = res.data.data;
          const array = res.data.arrdata;
          if (array == "scwpm") {
            this.datas.scwpm = data;
            this.datas.kuphur = [];
            this.datas.serie = [];
            this.datas.tertip = [];
          } else if (array == "kuphur") {
            this.datas.kuphur = data;
            this.datas.serie = [];
            this.datas.tertip = [];
          } else if (array == "serie") {
            this.datas.serie = data;
            this.datas.tertip = [];
          } else if (array == "tertip") {
            this.datas.tertip = data;
          }
          this.get();
        });
    },
    get() {
      if (!this.$route.query.ems_id) {
        this.$router.push({ name: "Catalog" });
      }
      this.isLoading = true;
      this.$appAxios
        .post("moneys/get", {
          page: this.page,
          emission_id: this.$route.query.ems_id,
          filter: this.filter,
        })
        .then((res) => {
          if (res.data.data.data.length > 0) {
            if (this.page == 1) {
              this.$store.state.Money.moneys = [];
              this.$store.state.Money.moneys = res.data.data.data;
            } else {
              this.$store.state.Money.moneys =
                this.$store.state.Money.moneys.concat(res.data.data.data);
            }
            this.dataCount = res.data.data.total;
          } else {
            this.$notify({
              type: "error",
              title: "Money not found.",
            });
            this.$store.state.Money.moneys = [];
          }
        })
        .catch(() => {
          this.$store.state.Money.moneys = [];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
  computed: {
    ...mapGetters(["_Moneys", "_IsAuth", "_User"]),
  },
};
</script>
