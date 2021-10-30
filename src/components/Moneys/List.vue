<template>
  <Add v-if="_IsAuth && _User.role == 1" />
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div
              class="card-header d-flex align-items-center justify-content-between flex-wrap"
            >
              <h3 class="card-title">
                <button
                  v-if="_IsAuth && _User.role == 1"
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#add"
                >
                  <i class="fas fa-plus"></i>
                  Add Money
                </button>
              </h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: auto;">
                  <select
                    @change="
                      filterItems({
                        column: 'scwpm_id',
                        data: 'scwpm',
                        emission_id: emission,
                        scwpm_id: null,
                        kuphur_id: null,
                        serie_id: null,
                      })
                    "
                    class="form-control"
                    v-model="emission"
                  >
                    <option :value="null">Select Emission</option>
                    <option
                      v-for="ems in datas.emission"
                      :key="ems.emission_id.id"
                      :value="ems.emission_id.id"
                      >{{ ems.emission_id.title }}</option
                    >
                  </select>
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
                  <select
                    class="form-control"
                    v-model="count"
                    style="width:20px;"
                  >
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
                  <div class="d-flex align-items-center">
                    <input id="show" type="checkbox" v-model="isCollection" />
                    <label for="show">Show My Collection</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
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
                </thead>
                <tbody v-if="isLoading">
                  <UserLoader />
                </tbody>
                <tbody v-if="!isLoading && _Moneys.length > 0">
                  <Item
                    v-for="money in _Moneys"
                    :key="money.id"
                    :money="money"
                  />
                </tbody>
              </table>
              <div class="text-center">
                <a
                  v-if="_Moneys.length < dataCount && !isLoading"
                  class="text-center text-primary my-3"
                  style="cursor:pointer;"
                  @click="page++, get()"
                  >Load more</a
                >
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import Item from "@/components/Moneys/ListItem.vue";
import Add from "@/components/Moneys/Add.vue";
import UserLoader from "@/components/Loaders/UserLoader.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    Item,
    Add,
    UserLoader,
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
            emission: this.emission,
            scwpm: this.scwpm,
            kuphur: this.kuphur,
            serie: this.serie,
            tertip: this.tertip,
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
      this.$appAxios
        .get("/moneyfilter", {
          params: {
            column: data.column,
            data: data.data,
            emission_id: data.emission_id,
            scwpm_id: data.scwpm_id,
            kuphur_id: data.kuphur_id,
            serie_id: data.serie_id,
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
