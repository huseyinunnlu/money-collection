<template>
  <Add v-if="_IsAuth && _User.role == 1" />
  <!--begin::Col-->

  <div class="col-xl-4 d-flex align-items-center">
    <select class="form-control form-control-lg">
      <option :value="'tr'">Türkiye</option>
    </select>
  </div>

  <!--end::Col-->

  <!--begin::Col-->
  <div class="col-xl-8">
    <div class="d-flex ps-lg-20" v-if="datas.emission.length > 0">
      <a
        v-for="ems in datas.emission"
        :key="ems.emission_id.id"
        class="btn btn-icon btn-outline btn-nav h-50px w-50px h-lg-70px w-lg-70px ms-2"
        @click="
          (emission = ems.emission_id.id),
            filterItems({
              column: 'scwpm_id',
              data: 'scwpm',
              emission_id: emission,
              scwpm_id: null,
              kuphur_id: null,
              serie_id: null,
            }),
            get()
        "
      >
        <!--begin::Svg Icon | path: icons/duotune/abstract/abs038.svg-->
        <span class="text-white" style="font-size:110%;">{{
          ems.emission_id.title
        }}</span>
        <!--end::Svg Icon-->
      </a>
    </div>
  </div>
  <!--end::Col-->
  
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
          >
            <i class="fas fa-plus"></i>Add Money
          </button>
          <div class="input-group input-group-sm" style="width: 100%;">
            <select
              @change="
                filterItems({
                  column: 'kuphur_id',
                  data: 'kuphur',
                  emission_id: emission,
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
                  emission_id: emission,
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
                  emission_id: emission,
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
            >
              <option :value="null">Select Tertip</option>

              <option
                v-for="tertip in datas.tertip"
                :key="tertip.tertip_id.id"
                :value="tertip.tertip_id.id"
                >{{ tertip.tertip_id.title }}</option
              >
            </select>
            <select class="form-control" v-model="count" style="width:20px;">
              <option :value="null">Select data count</option>
              <option :value="'5'">5</option>
              <option :value="'15'">15</option>
            </select>
            <select class="form-control" v-model="sort">
              <option :value="'desc'">Creating Date DESC</option>
              <option :value="'asc'">Creating Date ASC</option>
            </select>
            <select
              class="form-control"
              v-model="status"
              v-if="_IsAuth && _User.role == 1"
            >
              <option :value="'1'">Active</option>
              <option :value="'0'">Inactive</option>
            </select>
            <div class="input-group-append">
              <button
                @click="(page = 1), get()"
                type="submit"
                class="btn btn-default"
              >
                <i class="fas fa-search"></i>
              </button>
              <button
                @click="(page = 1), reset(), get()"
                type="submit"
                class="btn btn-default"
              >
                Reset
              </button>
            </div>
            <div class="form-check d-flex align-items-center">
              <input id="show" type="checkbox" v-model="isCollection" />
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
      emission: null,
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
        emission: [],
        scwpm: [],
        kuphur: [],
        serie: [],
        tertip: [],
      },
    };
  },
  created() {
    this.get();
    this.filterItems({
      column: "emission_id",
      data: "emission",
      emission_id: null,
      scwpm_id: null,
      kuphur_id: null,
      serie: null,
    });
  },
  methods: {
    reset() {
      this.emission = null;
      this.scwpm = null;
      this.kuphur = null;
      this.serie = null;
      this.tertip = null;
      this.status = 1;
      this.count = 15;
      this.sort = "desc";
      this.isLoading = true;
      this.page = 1;
      this.datas.emission = [];
      this.datas.scwpm = [];
      this.datas.kuphur = [];
      this.datas.serie = [];
      this.datas.tertip = [];
      this.filterItems({
        column: "emission_id",
        data: "emission",
        emission_id: null,
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
            emission_id: this.emission,
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
          if (this.page == 1) {
            this.$store.state.Money.moneys = [];
            this.$store.state.Money.moneys = res.data.data.data;
          } else {
            this.$store.state.Money.moneys = this.$store.state.Money.moneys.concat(
              res.data.data.data
            );
          }
          this.dataCount = res.data.data.total;
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
            emission_id: data.emission_id,
            scwpm_id: data.scwpm_id,
            kuphur_id: data.kuphur_id,
            serie_id: data.serie_id,
            isCollected: iscollect,
          },
        })
        .then((res) => {
          const data = res.data.data;
          const array = res.data.arrdata;
          if (array == "emission") {
            this.datas.emission = data;
          } else if (array == "scwpm") {
            this.datas.scwpm = data;
          } else if (array == "kuphur") {
            this.datas.kuphur = data;
          } else if (array == "serie") {
            this.datas.serie = data;
          } else if (array == "tertip") {
            this.datas.tertip = data;
          }
        });
    },
  },
  computed: {
    ...mapGetters(["_Moneys", "_IsAuth", "_User"]),
  },
};
</script>
