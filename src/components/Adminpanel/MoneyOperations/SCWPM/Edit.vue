<template>
  <form class="form-horizontal" @submit.prevent="update()">
    <div class="form-group my-4 row">
      <label for="title" class="col-sm-2 col-form-label">Title</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
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

    <div class="form-group my-4 row">
      <label for="status" class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <select id="status" v-model="form.status" class="form-select form-select-solid">
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
    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <button v-if="!isLoading" type="submit" class="btn btn-success btn-sm">
          Update
        </button>
        <button v-else disabled type="submit" class="btn btn-success btn-sm">
          Updating...
        </button>
      </div>
    </div>
  </form>
</template>
<script>
import {mapGetters} from "vuex"
export default {
  props: ['scwpm'],
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
  computed:{
    ...mapGetters(['_scwpms'])
  },
  created() {
    this.form.title = this.scwpm.title;
    this.form.status = this.scwpm.status;
  },
  methods: {
    update() {
      this.isLoading = true;
      this.$appAxios
        .put("/scwpm/" + this.scwpm.id, {
          title: this.form.title,
          status: this.form.status,
        })
        .then(() => {
          this.$notify({
            type: "success",
            title: "SCWPM successfully updated",
          });
          if (this._scwpms.length > 0) {
            const editedData = this.scwpm;
            editedData.title = this.form.title;
            editedData.status = this.form.status;
            let foundIndex = this._scwpms.findIndex(
              (element) => element.id === this.scwpm.id
            );
            this._scwpms.splice(foundIndex, 1, editedData);
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "SCWPM didn't updated",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
