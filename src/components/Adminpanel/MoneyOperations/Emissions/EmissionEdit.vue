<template>
  <form class="form-horizontal" @submit.prevent="updateEmission()">
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
  props: ['ems'],
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
  computed: {
    ...mapGetters(["_Emissions"]),
  },
  created() {
    this.form.title = this.ems.title;
    this.form.status = this.ems.status;
  },
  methods: {
    updateEmission() {
      this.isLoading = true;
      this.$appAxios
        .put("/emission/" + this.ems.id, {
          title: this.form.title,
          status: this.form.status,
        })
        .then(() => {
          this.$notify({
            type: "success",
            title: "Emisson successfully updated",
          });
          if (this._Emissions.length > 0) {
            const editedData = this.ems;
            editedData.title = this.form.title;
            editedData.status = this.form.status;
            let foundIndex = this._Emissions.findIndex(
              (element) => element.id === this.ems.id
            );
            this._Emissions.splice(foundIndex, 1, editedData);
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "Emission didn't updated",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
