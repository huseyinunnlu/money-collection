<template>
  <Add />
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
                  class="btn btn-primary btn-sm"
                  data-toggle="modal"
                  data-target="#add"
                >
                  <i class="fas fa-plus"></i>
                  Add Print Place
                </button>
              </h3>
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: auto;">
                  <input
                    type="text"
                    name="table_search"
                    class="form-control float-right"
                    placeholder="Search"
                    v-model="search"
                  />
                  <select class="form-control" v-model="status">
                    <option :value="null">Select Status</option>
                    <option :value="1">Active</option>
                    <option :value="0">Inactive</option>
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
                  <div class="input-group-append">
                    <button
                      @click="(page = 1), get()"
                      type="submit"
                      class="btn btn-default"
                    >
                      <i class="fas fa-search"></i>
                    </button>
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
                    <th>Title</th>
                    <th>Status</th>
                    <th>Opr.</th>
                  </tr>
                </thead>
                <tbody>
                  <UserLoader v-if="isLoading" />
                  <Item
                    v-else
                    v-for="printPlace in _printPlaces"
                    :key="printPlace.id"
                    :printPlace="printPlace"
                  />
                </tbody>
              </table>
              <div class="text-center">
                <a
                  v-if="_printPlaces.length < dataCount && !isLoading"
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
import Item from "@/components/Adminpanel/MoneyOperations/PrintPlace/ListItem.vue";
import Add from "@/components/Adminpanel/MoneyOperations/PrintPlace/Add.vue";
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
      search: "",
      status: 1,
      count: 15,
      sort: "desc",
      isLoading: false,
      page: 1,
      dataCount: 0,
    };
  },
  created() {
    if (this._printPlaces.length == 0) {
      this.get();
    }
  },
  methods: {
    get() {
      this.isLoading = true;
      this.$appAxios
        .get("printplace", {
          params: {
            page: this.page,
            search: this.search,
            status: this.status,
            count: this.count,
            sort: this.sort,
          },
        })
        .then((res) => {
          if (this.page == 1) {
            this.$store.state.Opr.printPlaces = [];
            this.$store.state.Opr.printPlaces = res.data.data;
          } else {
            this.$store.state.Opr.printPlaces = this.$store.state.Opr.printPlaces.concat(
              res.data.data
            );
          }
          this.dataCount = res.data.total;
        })
        .catch(() => {
          this.$store.state.Opr.printPlaces = [];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
  computed: {
    ...mapGetters(["_printPlaces"]),
  },
};
</script>
