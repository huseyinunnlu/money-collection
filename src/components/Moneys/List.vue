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
            data-kt-user-table-toolbar="base"
            data-select2-id="select2-data-81-jv68"
          >
            <button
              class="btn btn-primary mb-3"
              data-toggle="modal"
              data-target="#add"
              v-if="_User.role == 1 && IsAuth"
            >
              <i class="fas fa-plus"></i>Add Money
            </button>
            <div class="input-group input-group-sm" style="width: 100%;">
              <select
                @change="
                  filterItems({
                    column: 'kuphur_id',
                    data: 'kuphur',
                    scwpm_id: scwpm,
                    kuphur_id: null,
                    serie_id: null,
                  })
                "
                :disabled="datas.scwpm.length < 1"
                class="form-control"
                v-model="scwpm"
              >
                <option :value="null">Select Scwpm</option>

                <option
                  v-for="scwpm in datas.scwpm"
                  :key="scwpm.scwpm_id.id"
                  :value="scwpm.scwpm_id.id"
                  >{{ scwpm.scwpm_id.title }}</option
                >
              </select>
              <select
                @change="
                  filterItems({
                    column: 'serie_id',
                    data: 'serie',
                    scwpm_id: scwpm,
                    kuphur_id: kuphur,
                    serie_id: null,
                  })
                "
                :disabled="datas.kuphur.length < 1"
                class="form-control"
                v-model="kuphur"
              >
                <option :value="null">Select Kuphür</option>

                <option
                  v-for="kuphur in datas.kuphur"
                  :key="kuphur.kuphur_id.id"
                  :value="kuphur.kuphur_id.id"
                  >{{ kuphur.kuphur_id.title }}</option
                >
              </select>
              <select
                @change="
                  filterItems({
                    column: 'tertip_id',
                    data: 'tertip',
                    scwpm_id: scwpm,
                    kuphur_id: kuphur,
                    serie_id: serie,
                  })
                "
                class="form-control"
                :disabled="datas.serie.length < 1"
                v-model="serie"
              >
                <option :value="null">Select Serie</option>

                <option
                  v-for="serie in datas.serie"
                  :key="serie.serie_id.id"
                  :value="serie.serie_id.id"
                  >{{ serie.serie_id.title }}</option
                >
              </select>
              <select
                class="form-control"
                :disabled="datas.tertip.length < 1"
                v-model="tertip"
                @change="get()"
              >
                <option :value="null">Select Tertip</option>

                <option
                  v-for="tertip in datas.tertip"
                  :key="tertip.tertip_id.id"
                  :value="tertip.tertip_id.id"
                  >{{ tertip.tertip_id.title }}</option
                >
              </select>
              <select class="form-control" v-model="count" style="width:20px;" @change="get()">
                <option :value="null">Select data count</option>
                <option :value="'5'">5</option>
                <option :value="'15'">15</option>
              </select>
              <select class="form-control" v-model="sort" @change="get()">
                <option :value="'desc'">Creating Date DESC</option>
                <option :value="'asc'">Creating Date ASC</option>
              </select>
              <select
                class="form-control"
                v-model="status"
                v-if="_IsAuth && _User.role == 1"
                @change="get()"
              >
                <option :value="'1'">Active</option>
                <option :value="'0'">Inactive</option>
              </select>
              <div class="input-group-append">
                <button
                  @click="(page = 1), reset(), get()"
                  type="submit"
                  class="btn btn-default"
                >
                  Reset
                </button>
              </div>
              <div class="form-check d-flex align-items-center">
                <input id="show" type="checkbox" v-model="isCollection" @change="get()"/>
                <label class="form-check-label" for="show">MyCollection</label>
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
                style="cursor:pointer;"
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
import { mapGetters } from "vuex";
export default {
  components: {
    Item,
    Add,
    MoneyLoader,
  },
  data() {
    return {
      scwpm: null,
      kuphur: null,
      serie: null,
      tertip: null,
      status: 1,
      count: 15,
      sort: "desc",
      isLoading: true,
      page: 1,
      dataCount: 0,
      isCollection: false,
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
      scwpm_id: null,
      kuphur_id: null,
      serie: null,
    });
  },
  methods: {
    reset() {
      this.scwpm = null;
      this.kuphur = null;
      this.serie = null;
      this.tertip = null;
      this.status = 1;
      this.count = 15;
      this.sort = "desc";
      this.isLoading = true;
      this.page = 1;
      this.datas.scwpm = [];
      this.datas.kuphur = [];
      this.datas.serie = [];
      this.datas.tertip = [];
      this.filterItems({
        column: "scwpm_id",
        data: "scwpm",
        emission_id: this.$route.query.ems_id,
        scwpm_id: null,
        kuphur_id: null,
        serie: null,
      });
    },
    get() {
      this.isLoading = true;
      let iscollect = null;
      if (this.isCollection) {
        iscollect = 1;
      } else {
        iscollect = 0;
      }
      this.$appAxios
        .get("moneys/get", {
          params: {
            page: this.page,
            emission_id: this.$route.query.ems_id,
            scwpm_id: this.scwpm,
            kuphur_id: this.kuphur,
            serie_id: this.serie,
            tertip_id: this.tertip,
            status: this.status,
            count: this.count,
            sort: this.sort,
            isCollected: iscollect,
          },
        })
        .then((res) => {
          if (res.data.data.data.length > 0) {
            if (this.page == 1) {
              this.$store.state.Money.moneys = [];
              this.$store.state.Money.moneys = res.data.data.data;
            } else {
              this.$store.state.Money.moneys = this.$store.state.Money.moneys.concat(
                res.data.data.data
              );
            }
            this.dataCount = res.data.data.total;
          } else {
            this.$notify({
              type: "error",
              title: "Money not found.",
            });
            this.$store.state.Money.moneys = []
          }
        })
        .catch(() => {
          this.$store.state.Money.moneys = [];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    filterItems(data) {
      let iscollect = null;
      if (this.isCollection) {
        iscollect = 1;
      } else {
        iscollect = 0;
      }
      this.$appAxios
        .get("/moneyfilter", {
          params: {
            column: data.column,
            data: data.data,
            status: this.status,
            emission_id: this.$route.query.ems_id,
            scwpm_id: data.scwpm_id,
            kuphur_id: data.kuphur_id,
            serie_id: data.serie_id,
            isCollected: iscollect,
          },
        })
        .then((res) => {
          const data = res.data.data;
          const array = res.data.arrdata;
          if (array == "scwpm") {
            this.datas.scwpm = data;
            this.kuphur = null;
            this.serie = null;
            this.tertip = null;
            this.datas.kuphur = []
            this.datas.serie = []
            this.datas.tertip = []
          } else if (array == "kuphur") {
            this.datas.kuphur = data;   
            this.kuphur = null
            this.serie = null;
            this.tertip = null;
            this.datas.serie = []
            this.datas.tertip = []
          } else if (array == "serie") {
            this.datas.serie = data;
            this.tertip = null;
            this.datas.tertip = []
          } else if (array == "tertip") {
            this.datas.tertip = data;
          }
          this.get()
        });
    },
  },
  computed: {
    ...mapGetters(["_Moneys", "_IsAuth", "_User"]),
  },
};
</script>
