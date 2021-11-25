<template>
  <div class="form-group my-4 row">
    <label class="col-sm-2 col-form-label">
      Profile Photo<br />
      <a class="text-muted" @click="isUploaded"
        ><small>({{$t('button.deletePhoto')}})</small></a
      >
    </label>

    <div class="col-sm-10 d-flex align-items-center">
      <small
        class="text-muted"
        style="position: absolute; top:0px;"
        v-if="isLoading"
        >uploading...</small
      >
      <img
        v-if="!photoPreview"
        :src="_User.profilePhoto"
        class="rounded-circle mr-4"
        style="width:60px; height:60px;"
      />
      <div class="preview" v-else>
        <img
          :src="photoPreview"
          class="rounded-circle mr-4"
          style="width:60px; height:60px;"
        />
      </div>
      <input type="file" class="me-3 form-control-file form-control-file-solid" @change="isUploaded" />

      <small
        v-if="errors.image"
        v-text="errors.image[0]"
        class="text-danger"
      ></small>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      photoPreview: null,
      isLoading: false,
      errors: [],
    };
  },
  computed: {
    ...mapGetters(["_User"]),
  },
  methods: {
    isUploaded(e) {
      this.isLoading = true;
      let image = null;
      if (e.target.files) {
        image = e.target.files[0];
        this.photoPreview = URL.createObjectURL(image);
      } else {
        this.photoPreview = null;
      }
      let formData = new FormData();
      formData.append("image", image);
      this.$appAxios
        .post("updatepp", formData)
        .then((res) => {
          this.$store.state.User.user.profilePhoto = res.data.url;
          this.photo = res.data.url;
          this.photoPreview = null;
          this.$notify({
            type: "success",
            title: "Photo successfully uploaded",
          });
          window.location.reload();
        })
        .catch((err) => {
          this.$notify({
            type: "error",
            title: "Photo didn't uploaded",
          });
          this.errors = err.response.data.errors;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
<style>
.close-icon {
  cursor: pointer;
  position: relative;
  border-radius: 50%;
  background-color: #999;
  color: #000;
  padding: 0px 5px;
  top: 10px;
  left: -10px;
  float: right;
  font-size: 13px;
  text-align: center;
}
</style>
