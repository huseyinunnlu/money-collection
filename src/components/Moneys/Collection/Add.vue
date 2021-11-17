<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="addCollection"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Collection</h5>
          <i
            class="fas fa-times close"
            data-dismiss="modal"
            aria-label="Close"
            style="cursor: pointer"
          >
          </i>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="form-group my-4 row">
              <div class="images">
                <div class="images-header d-flex justify-content-between">
                  <h2 class="text-center">Images</h2>
                  <input type="file" multiple @change="onUpload" />
                </div>
                <div class="images-body">
                  <div
                    class="
                      images-container
                      d-flex
                      flex-wrap
                      justify-content-center
                    "
                  >
                    <div
                      class="image m-4"
                      v-for="(image, index) in previews"
                      :key="index"
                    >
                      <div
                        class="image-input image-input-outline"
                        data-kt-image-input="true"
                      >
                        <div class="image-input-wrapper w-125px h-125px">
                          <img :src="image" :alt="image" class="w-100 h-100" />
                        </div>
                        <span
                          class="
                            btn btn-icon btn-circle btn-active-color-primary
                            w-25px
                            h-25px
                            bg-body
                            shadow
                          "
                          data-kt-image-input-action="remove"
                          data-bs-toggle="tooltip"
                          title=""
                          @click="deleteImage(image)"
                          data-bs-original-title="Remove avatar"
                        >
                          <i class="bi bi-x fs-2"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">Unique Serie</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid"
                  v-model="form.uniqueSerie"
                />
              </div>
            </div>
            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">Purchased Person</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid"
                  v-model="form.purchasedPerson"
                />
              </div>
            </div>
            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">Purchase Price(Tl)</label>
              <div class="col-sm-10">
                <input
                  type="number"
                  class="form-control form-control-solid"
                  v-model="form.price"
                />
              </div>
            </div>
            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">Collected Date</label>
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control form-control-solid"
                  v-model="form.date"
                />
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button class="btn btn-primary" @click="add()" v-if="!isLoading">
            Add Money
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
        images: [],
        uniqueSerie: null,
        purchasedPerson: null,
        price: null,
        date: null,
      },
      errors: [],
      previews: [],
      isLoading: false,
    };
  },
  methods: {
    onUpload(e) {
      let image = e.target.files;
      for (let i = 0; i < image.length; i++) {
        this.form.images.unshift(image[i]);
        this.previews.unshift(URL.createObjectURL(image[i]));
      }
    },
    deleteImage(image) {
      let index = this.previews.indexOf(image);
      if (index > -1) {
        this.previews.splice(index, 1);
        this.form.images.splice(index, 1);
      }
    },
    add() {
      this.isLoading = true;
      const formData = new FormData();
      for (let i = 0; i < this.form.images.length; i++) {
        formData.append("images[]", this.form.images[i]);
      }
      formData.append("moneyId", this.$route.params.id);
      formData.append("uniqueSerie", this.form.uniqueSerie);
      formData.append("purchasedPerson", this.form.purchasedPerson);
      formData.append("price", this.form.price);
      formData.append("date", this.form.date);
      this.$appAxios
        .post("/collection/add", formData, {
          headers: {
            "x-device-id": "stuff",
            "Content-Type": "multipart/form-data",
          },
        })
        .then((res) => {
          let form = this.form;
          console.log(res.data);
          this.$notify({
            type: "success",
            title: "Kolleksiyon Başarıyla Eklendi",
          });
          form.images = [];
          this.previews = [];
          form.uniqueSerie = null;
          form.purchasedPerson = null;
          form.price = null;
          form.date = null;

          this.$store.state.Collection.collections.unshift(res.data.data);
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "Kolleksiyona eklenemedi",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
<style scoped>
.images-body {
  width: 100%;
  min-height: 300px;
  border-radius: 6px;
  height: auto;
  display: flex;
  flex-wrap: wrap;
  background-color: #f1f1f1;
  margin: 20px 0;
}
.images-container {
  margin: 10px;
}
</style>
