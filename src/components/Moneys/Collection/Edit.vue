<template>
  <div class="modal-body">
    <form class="form-horizontal" @submit.prevent="update">
      <div class="form-group my-4 row">
        <div class="images">
          <div class="images-header d-flex justify-content-between">
            <h2 class="text-center">{{$t('collection.images')}}</h2>
            <input type="file" multiple @change="onUpload" />
          </div>
          <div class="images-body">
            <div
              class="images-container d-flex flex-wrap justify-content-center"
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
                    <img :src="image.image" class="w-100 h-100" />
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
        <label class="col-sm-2 col-form-label">{{$t('collection.table.column.uniqueSerie')}}</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control form-control-solid"
            v-model="form.uniqueSerie"
          />
        </div>
      </div>
      <div class="form-group my-4 row">
        <label class="col-sm-2 col-form-label">{{$t('collection.table.column.purchasedPerson')}}</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control form-control-solid"
            v-model="form.purchasedPerson"
          />
        </div>
      </div>
      <div class="form-group my-4 row">
        <label class="col-sm-2 col-form-label">{{$t('collection.table.column.price')}}</label>
        <div class="col-sm-10">
          <input
            type="number"
            class="form-control form-control-solid"
            v-model="form.price"
          />
        </div>
      </div>
      <div class="form-group my-4 row">
        <label class="col-sm-2 col-form-label">{{$t('collection.table.column.date')}}</label>
        <div class="col-sm-10">
          <input
            type="date"
            class="form-control form-control-solid"
            v-model="form.date"
          />
        </div>
      </div>
      <div class="form-group my-4 row">
        <label class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button v-if="!isLoading" type="submit" class="btn btn-primary">
            {{$t('button.update')}}
          </button>
          <button v-else type="submit" class="btn btn-primary disabled">
            {{$t('button.loading')}}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  props: ["collection"],
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
      buttonIsLoading: false,
    };
  },
  created() {
    let col = this.collection;
    let form = this.form;
    this.previews = col.images;
    form.uniqueSerie = col.uniqueSerie;
    form.purchasedPerson = col.purchasedPerson;
    form.price = col.price;
    form.date = col.date;
  },
  methods: {
    onUpload(e) {
      let image = e.target.files;
      for (let i = 0; i < image.length; i++) {
        this.previews.unshift({
          image: URL.createObjectURL(image[i]),
        });
        this.form.images.unshift({
          image: image[i],
        });
      }
    },
    deleteImage(image) {
      this.buttonIsLoading = true;
      if (image.id) {
        this.$appAxios
          .post("deletecollectionimage", {
            id: image.id,
          })
          .finally(() => {
            this.buttonIsLoading = false;
          });
      }
      console.log(image)
      let index = this.previews.indexOf(image);
      if (index > -1) {
        this.previews.splice(index, 1);
        this.form.images.splice(index, 1);
      }
    },
    update() {
      this.isLoading = true;
      const formData = new FormData();
      for (let i = 0; i < this.form.images.length; i++) {
        formData.append("images[]", this.form.images[i].image);
      }
      formData.append("id", this.$route.params.id);
      formData.append("moneyId", this.collection.moneyId);
      formData.append("uniqueSerie", this.form.uniqueSerie);
      formData.append("purchasedPerson", this.form.purchasedPerson);
      formData.append("price", this.form.price);
      formData.append("date", this.form.date);
      this.$appAxios
        .post("/updatecollection", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(() => {
          this.$notify({
            type: "success",
            title: "Kolleksiyon Başarıyla Güncellendi",
          });
          this.form.images = [];
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "Kolleksiyon Güncellenemedi",
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
