<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="add"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$t('scwpm.add')}}</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group my-4 row">
              <label for="title" class="col-sm-2 col-form-label">{{$t('common.title')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid"
                  id="title"
                  :placeholder="$t('common.title')"
                  v-model="form.title"
                />
              </div>
            </div>
            <small
              class="text-danger"
              v-if="errors.title"
              v-text="errors.title[0]"
            ></small>

            <div class="form-group my-4 row">
              <label for="status" class="col-sm-2 col-form-label"
                >{{$t('common.status')}}</label
              >
              <div class="col-sm-10">
                <select id="status" v-model="form.status" class="form-select form-select-solid">
                  <option :value="'0'">{{$t('common.inactive')}}</option>
                  <option :value="'1'">{{$t('common.active')}}</option>
                </select>
              </div>
            </div>
            <small
              class="text-danger"
              v-if="errors.status"
              v-text="errors.status[0]"
            ></small>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            {{$t('button.close')}}
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="!form.status || !form.title"
            v-if="!isLoading"
            @click="add"
          >
            {{$t('button.add')}}
          </button>
          <button disabled class="btn btn-primary" v-if="isLoading">
            {{$t('button.loading')}}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      form: {
        title: null,
        status: '1',
      },
      isLoading: false,
      errors: [],
    };
  },
  methods: {
    add() {
      this.isLoading = true;
      this.$appAxios
        .post("/scwpm", {
          title: this.form.title,
          status: this.form.status,
        })
        .then((res) => {
          this.form.title = null;
          this.form.status = '1';
          this.$store.state.Opr.scwpms.unshift(res.data.data);
          this.$notify({
            type: "success",
            title: "SCWPM successfully added.",
          });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "SCWPM didn't added.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
