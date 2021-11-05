<template>
  <form class="form-horizontal" @submit.prevent="update()">
    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Emission</label>
      <div class="col-sm-10">
        <select class="form-select form-select-solid" v-model="form.emissionId">
          <option
            v-for="ems in datas.emission"
            :key="ems.id"
            :value="ems.id"
            v-text="ems.title"
          ></option>
        </select>
        <small
          class="text-danger"
          v-if="errors.emissionId"
          v-text="errors.emissionId[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">SCWPM</label>
      <div class="col-sm-10">
        <select class="form-select form-select-solid" v-model="form.scwpmId">
          <option
            v-for="scwpm in datas.scwpm"
            :key="scwpm.id"
            :value="scwpm.id"
            v-text="scwpm.title"
          ></option>
        </select>
        <small
          class="text-danger"
          v-if="errors.scwpmId"
          v-text="errors.scwpmId[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Kuphür</label>
      <div class="col-sm-10">
        <select class="form-select form-select-solid" v-model="form.kuphurId">
          <option
            v-for="kuphur in datas.kuphur"
            :key="kuphur.id"
            :value="kuphur.id"
            v-text="kuphur.title"
          ></option>
        </select>
        <small
          class="text-danger"
          v-if="errors.kuphurId"
          v-text="errors.kuphurId[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Nominal Value</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
          placeholder="Value"
          v-model="form.value"
        />
        <small
          class="text-danger"
          v-if="errors.value"
          v-text="errors.value[0]"
        ></small>
      </div>
    </div>
    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Serie</label>
      <div class="col-sm-10">
        <select class="form-select form-select-solid" v-model="form.serieId">
          <option
            v-for="serie in datas.serie"
            :key="serie.id"
            :value="serie.id"
            v-text="serie.title"
          ></option>
        </select>
        <small
          class="text-danger"
          v-if="errors.serieId"
          v-text="errors.serieId[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Çil Value</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
          placeholder="Value"
          v-model="form.cilValue"
        />
        <small
          class="text-danger"
          v-if="errors.cilValue"
          v-text="errors.cilValue[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">ÇT (XF) Value</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
          placeholder="Value"
          v-model="form.ctValue"
        />
        <small
          class="text-danger"
          v-if="errors.ctValue"
          v-text="errors.ctValue[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">T(F) Value</label>
      <div class="col-sm-10">
        <input
          type="text"
          class="form-control form-control-solid"
          placeholder="Value"
          v-model="form.tValue"
        />
        <small
          class="text-danger"
          v-if="errors.tValue"
          v-text="errors.tValue[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Tertip</label>
      <div class="col-sm-10">
        <select class="form-select form-select-solid" v-model="form.tertipId">
          <option
            v-for="tertip in datas.tertip"
            :key="tertip.id"
            :value="tertip.id"
            v-text="tertip.title"
          ></option>
        </select>
        <small
          class="text-danger"
          v-if="errors.tertipId"
          v-text="errors.tertipId[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Size</label>
      <div class="col-sm-10">
        <input class="form-control form-control-solid" type="text" v-model="form.size" />
        <small
          class="text-danger"
          v-if="errors.size"
          v-text="errors.size[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Print Place</label>
      <div class="col-sm-10">
        <select class="form-select form-select-solid" v-model="form.printPlace">
          <option
            v-for="place in datas.printPlace"
            :value="place.id"
            :key="place.id"
            v-text="place.title"
          ></option>
        </select>
        <small
          class="text-danger"
          v-if="errors.printPlace"
          v-text="errors.printPlace[0]"
        ></small>
      </div>
    </div>
    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Signatures</label>
      <div class="col-sm-10">
        <select class="form-select form-select-solid" v-model="form.signatures" multiple>
          <option
            v-for="sign in datas.signatures"
            :key="sign.id"
            :value="sign.id"
            v-text="sign.title"
          ></option>
        </select>
        <small
          class="text-danger"
          v-if="errors.signatures"
          v-text="errors.signatures[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Tedavul date</label>
      <div class="col-sm-10">
        <input type="date" class="form-control form-control-solid" v-model="form.tedavulDate" />
        <small
          class="text-danger"
          v-if="errors.tedavulDate"
          v-text="errors.tedavulDate[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Tedavulden Çıkma Tarihi</label>
      <div class="col-sm-10">
        <input type="date" class="form-control form-control-solid" v-model="form.lastDate" />
        <small
          class="text-danger"
          v-if="errors.lastDate"
          v-text="errors.lastDate[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label"
        >Zorunlu Tedavulden Süresi Sonu</label
      >
      <div class="col-sm-10">
        <input type="date" class="form-control form-control-solid" v-model="form.zortedDate" />
        <small
          class="text-danger"
          v-if="errors.zortedDate"
          v-text="errors.zortedDate[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Timeout</label>
      <div class="col-sm-10">
        <input type="date" class="form-control form-control-solid" v-model="form.timeoutDate" />
        <small
          class="text-danger"
          v-if="errors.timeoutDate"
          v-text="errors.timeoutDate[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Expiry Date</label>
      <div class="col-sm-10">
        <input type="date" class="form-control form-control-solid" v-model="form.expiryDate" />
        <small
          class="text-danger"
          v-if="errors.expiryDate"
          v-text="errors.expiryDate[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Front Color</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-solid" v-model="form.frontColor" />
        <small
          class="text-danger"
          v-if="errors.frontColor"
          v-text="errors.frontColor[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Back Color</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-solid" v-model="form.backColor" />
        <small
          class="text-danger"
          v-if="errors.backColor"
          v-text="errors.backColor[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Front Image</label>
      <div class="col-sm-10">
        <img :src="money.frontImage" v-if="!image.fpPreview" style="width:50px; height:50px;">
        <img :src="image.fpPreview" v-else @click="image.fpPreview = null,image.frontImage = null" style="width:50px; height:50px; cursor:poniter;">
        <input type="file" class="form-control-file form-control-file-solid" @change="onUpdatefp" />
        <small
          class="text-danger"
          v-if="errors.frontImage"
          v-text="errors.frontImage[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Back Image</label>
      <div class="col-sm-10">
        <img :src="money.backImage" v-if="!image.bpPreview" style="width:50px; height:50px;">
        <img :src="image.bpPreview" @click="image.bpPreview = null,image.backImage = null" v-else style="width:50px; height:50px; cursor:pointer;">

        <input type="file" class="form-control-file form-control-file-solid" @change="onUpdatebp" />
        <small
          class="text-danger"
          v-if="errors.backImage"
          v-text="errors.backImage[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Link</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-solid" v-model="form.link" />
        <small
          class="text-danger"
          v-if="errors.link"
          v-text="errors.link[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label">Back Color</label>
      <div class="col-sm-10">
        <textarea class="form-control form-control-solid" v-model="form.desc"></textarea>
        <small
          class="text-danger"
          v-if="errors.desc"
          v-text="errors.desc[0]"
        ></small>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Status</label>
      <div class="col-sm-10">
        <select v-model="form.status" class="form-select form-select-solid">
          <option :value="'0'">Inactive</option>
          <option :value="'1'">Active</option>
        </select>
        <small
          class="text-danger"
          v-if="errors.status"
          v-text="errors.status[0]"
        ></small>
      </div>
    </div>

    <div class="form-group my-4 row">
      <label class="col-sm-2 col-form-label"></label>
      <div class="col-sm-10">
        <button
          type="submit"
          class="btn btn-primary btn-sm"
          v-if="!isLoading"
        >
          Update Money
        </button>
        <button disabled class="btn btn-primary btn-sm" v-if="isLoading">
          Updating...
        </button>
      </div>
    </div>
  </form>
</template>
<script>
export default {
  props: ["money", "datas"],
  data() {
    return {
      form: {
        emissionId: null,
        scwpmId: null,
        kuphurId: null,
        value: null,
        serieId: null,
        cilValue: null,
        ctValue: null,
        tValue: null,
        tertipId: null,
        size: null,
        printPlace: null,
        signatures: [],
        tedavulDate: null,
        lastDate: null,
        zortedDate: null,
        timeoutDate: null,
        expiryDate: null,
        frontColor: null,
        backColor: null,
        link: null,
        desc: null,
        status: null,
      },
      image: {
        frontImage: null,
        backImage: null,
        fpPreview: null,
        bpPreview: null,
      },
      isLoading: false,
      errors: [],
    };
  },
  created() {
    this.form.emissionId = this.money.emission_id.id;
    this.form.scwpmId = this.money.scwpm_id.id;
    this.form.kuphurId = this.money.kuphur_id.id;
    this.form.value = this.money.value;
    this.form.serieId = this.money.serie_id.id;
    this.form.cilValue = this.money.cilValue;
    this.form.ctValue = this.money.ctValue;
    this.form.tValue = this.money.tValue;
    this.form.tertipId = this.money.tertip_id.id;
    this.form.size = this.money.size;
    this.form.printPlace = this.money.print_place_id.id;
    this.form.signatures == this.money.selectedSign;
    this.form.tedavulDate = this.money.tedavulDate;
    this.form.lastDate = this.money.lastDate;
    this.form.zortedDate = this.money.zortedDate;
    this.form.timeoutDate = this.money.timeoutDate;
    this.form.expiryDate = this.money.expiryDate;
    this.form.frontColor = this.money.frontColor;
    this.form.backColor = this.money.backColor;
    this.form.link = this.money.link;
    this.form.desc = this.money.desc;
    this.form.status = this.money.status;
  },
  methods: {
    onUpdatefp(e) {
      let image = e.target.files[0];
      this.image.fpPreview = URL.createObjectURL(image);
      this.image.frontImage = image;
    },
    onUpdatebp(e) {
      let image = e.target.files[0];
      this.image.bpPreview = URL.createObjectURL(image);
      this.image.backImage = image;
    },
    update() {
      this.isLoading = true;
      let formData = new FormData();
      if (this.image.frontImage) {
        formData.append("frontImage", this.image.frontImage);
      }
      if (this.image.backImage) {
        formData.append("backImage", this.image.backImage);
      }

      formData.append("emissionId", this.form.emissionId);
      formData.append("scwpmId", this.form.scwpmId);
      formData.append("kuphurId", this.form.kuphurId);
      formData.append("value", this.form.value);
      formData.append("serieId", this.form.serieId);
      formData.append("cilValue", this.form.cilValue);
      formData.append("ctValue", this.form.ctValue);
      formData.append("tValue", this.form.tValue);
      formData.append("tertipId", this.form.tertipId);
      formData.append("size", this.form.size);
      formData.append("printPlace", this.form.printPlace);
      formData.append("signatures", this.form.signatures);
      formData.append("tedavulDate", this.form.tedavulDate);
      formData.append("lastDate", this.form.lastDate);
      formData.append("zortedDate", this.form.zortedDate);
      formData.append("timeoutDate", this.form.timeoutDate);
      formData.append("expiryDate", this.form.expiryDate);
      formData.append("frontColor", this.form.frontColor);
      formData.append("backColor", this.form.backColor);
      formData.append("link", this.form.link);
      formData.append("desc", this.form.desc);
      formData.append("status", this.form.status);

      this.$appAxios
        .post("/money/"+this.money.id+"/update", formData)
        .then(() => {
          this.$notify({
            type: "success",
            title: "Money updated successfuly.",
          });
        })
        .catch((err) => {
            this.$notify({
            type: "error",
            title: "Money did't updated.",
          });
          this.errors = err.respose.data.errors;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>
