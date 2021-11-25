<template>
  <form class="form-horizontal" @submit.prevent="update()">
    <div class="form-group my-4 row">
      <label for="title" class="col-sm-2 col-form-label">{{$t('common.title')}}</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
          id="title"
          :placeholder="$t('common.status')"
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
      <label for="status" class="col-sm-2 col-form-label">{{$t('common.status')}}</label>
      <div class="col-sm-10">
        <select id="status" v-model="form.status" class="form-select form-select-solid">
          <option :value="'0'">{{$t('common.inactive')}}</option>
          <option :value="'1'">active</option>
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
          {{$t('button.update')}}
        </button>
        <button v-else disabled type="submit" class="btn btn-success btn-sm">
          {{$t('button.loading')}}
        </button>
      </div>
    </div>
  </form>
</template>
<script>
import {mapGetters} from 'vuex'
export default {
  props: ["printPlace"],
  data() {
    return {
      form: {
        title: null,
        status: "1",
      },
      isLoading: false,
      errors: [],
    };
  },
  computed: {
    ...mapGetters(["_printPlaces"]),
  },
  created() {
    this.form.title = this.printPlace.title;
    this.form.status = this.printPlace.status;
  },
  methods: {
    update() {
      this.isLoading = true;
      this.$appAxios
        .put("/printplace/" + this.printPlace.id, {
          title: this.form.title,
          status: this.form.status,
        })
        .then(() => {
          this.$notify({
            type: "success",
            title: "Print place successfully updated",
          });

          if (this._printPlaces.length > 0) {
            const editedData = this.printPlace;
            editedData.title = this.form.title;
            editedData.status = this.form.status;
            let foundIndex = this._printPlaces.findIndex(
              (element) => element.id === this.printPlace.id
            );
            this._printPlaces.splice(foundIndex, 1, editedData);
          }
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "Print place didn't updated",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
