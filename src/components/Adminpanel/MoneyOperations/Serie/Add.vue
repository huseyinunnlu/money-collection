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
          <h5 class="modal-title" id="exampleModalLabel">Add New Serie</h5>
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
            <div class="form-group row">
              <label for="title" class="col-sm-2 col-form-label">Title</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
                  id="title"
                  placeholder="Title"
                  v-model="form.title"
                />
              </div>
            </div>
            <small
              class="text-danger"
              v-if="errors.title"
              v-text="errors.title[0]"
            ></small>

            <div class="form-group row">
              <label for="status" class="col-sm-2 col-form-label"
                >Status</label
              >
              <div class="col-sm-10">
                <select id="status" v-model="form.status" class="form-control">
                  <option :value="'0'">Inactive</option>
                  <option :value="'1'">Active</option>
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
            Close
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            :disabled="!form.status || !form.title"
            v-if="!isLoading"
            @click="add"
          >
            Add Tertip
          </button>
          <button disabled class="btn btn-primary" v-if="isLoading">
            Adding...
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
        .post("/serie", {
          title: this.form.title,
          status: this.form.status,
        })
        .then((res) => {
          this.form.title = null;
          this.form.status = 1;
          this.$store.state.Opr.series.unshift(res.data.data);
          this.$notify({
            type: "success",
            title: "Serie successfully added.",
          });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "Serie didn't added.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
