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
                  {{$t('button.add')}}
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
                    <option :value="null">{{$t('common.status')}}</option>
                    <option :value="1">{{$t('common.active')}}</option>
                    <option :value="0">{{$t('common.inactive')}}</option>
                  </select>
                  <select
                    class="form-control"
                    v-model="count"
                    style="width:20px;"
                  >
                    <option :value="null">{{$t('common.count')}}</option>
                    <option :value="'5'">5</option>
                    <option :value="'15'">15</option>
                  </select>
                  <select class="form-control" v-model="sort">
                    <option :value="'desc'">{{$t('common.desc')}}</option>
                    <option :value="'asc'">{{$t('common.asc')}}</option>
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
                    <th>{{$t('common.title')}}</th>
                    <th>{{$t('common.status')}}</th>
                    <th>{{$t('common.opr')}}</th>
                  </tr>
                </thead>
                <tbody>
                  <UserLoader v-if="isLoading" />
                  <Item
                    v-else
                    v-for="signature in _signatures"
                    :key="signature.id"
                    :signature="signature"
                  />
                </tbody>
              </table>
              <div class="text-center">
                <a
                  v-if="_signatures.length < dataCount && !isLoading"
                  class="text-center text-primary my-3"
                  style="cursor:pointer;"
                  @click="page++, get()"
                  >{{$t('common.loadMore')}}</a
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
import Item from "@/components/Adminpanel/MoneyOperations/Signature/ListItem.vue";
import Add from "@/components/Adminpanel/MoneyOperations/Signature/Add.vue";
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
    if (this._signatures.length == 0) {
      this.get();
    }
  },
  methods: {
    get() {
      this.isLoading = true;
      this.$appAxios
        .get("signature", {
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
            this.$store.state.Opr.signatures = [];
            this.$store.state.Opr.signatures = res.data.data;
          } else {
            this.$store.state.Opr.signatures = this.$store.state.Opr.signatures.concat(
              res.data.data
            );
          }
          this.dataCount = res.data.total;
        })
        .catch(() => {
          this.$store.state.Opr.signatures = [];
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
  computed: {
    ...mapGetters(["_signatures"]),
  },
};
</script>
