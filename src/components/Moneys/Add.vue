<script>
import VueSelect from "vue-next-select";
import "vue-next-select/dist/index.min.css";

export default {
  components:{
    'vue-select' : VueSelect,
  },
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
        status: "1",
      },
      image: {
        frontImage: null,
        backImage: null,
        fpPreview: null,
        bpPreview: null,
      },
      datas: {
        emission: [],
        scwpm: [],
        kuphur: [],
        serie: [],
        tertip: [],
        printPlace: [],
        signatures: [],
      },
      isLoading: false,
      errors: [],
    };
  },
  created() {
    this.getData();
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
    getData() {
      this.$appAxios
        .get("getdata")
        .then((res) => {
          this.datas.scwpm = res.data.data.scwpm;
          this.datas.kuphur = res.data.data.kuphur;
          this.datas.serie = res.data.data.serie;
          this.datas.tertip = res.data.data.tertip;
          this.datas.printPlace = res.data.data.printPlace;
          this.datas.signatures = res.data.data.signatures;
        })
        .catch(() => {
          this.datas.scwpm = [];
          this.datas.kuphur = [];
          this.datas.serie = [];
          this.datas.tertip = [];
          this.datas.printPlace = [];
          this.datas.signatures = [];
        });
    },
    add() {
      this.isLoading = true;
      let formData = new FormData();
      if (this.image.frontImage) {
        formData.append("frontImage", this.image.frontImage);
      }
      if (this.image.backImage) {
        formData.append("backImage", this.image.backImage);
      }

      formData.append("emissionId", this.$route.query.ems_id);
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
        .post("/money/add", formData)
        .then((res) => {
          this.$store.state.Money.moneys.unshift(res.data.data);
          this.$notify({
            type: "success",
            message: "Money added successfuly.",
          });
          this.form.scwpmId = null;
          this.form.kuphurId = null;
          this.form.value = null;
          this.form.serieId = null;
          this.form.cilValue = null;
          this.form.ctValue = null;
          this.form.tValue = null;
          this.form.tertipId = null;
          this.form.size = null;
          this.form.printPlace = null;
          this.form.signatures = [];
          this.form.tedavulDate = null;
          this.form.lastDate = null;
          this.form.zortedDate = null;
          this.form.timeoutDate = null;
          this.form.expiryDate = null;
          this.form.frontColor = null;
          this.form.backColor = null;
          this.image.frontImage = null;
          this.image.backImage = null;
          this.form.link = null;
          this.form.desc = null;
          this.form.status = "1";
          this.image.fpPreview = null;
          this.image.bpPreview = null;
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
          this.$notify({
            type: "error",
            title: "Money didn't added.",
          });
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>

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
          <h5 class="modal-title" id="exampleModalLabel">{{$t('money.add')}}</h5>
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
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.scwpm')}}</label>
              <div class="col-sm-10">
                <vue-select
                  class="form-control form-control-solid w-100"
                  style="background-color:white;"
                  v-model="form.scwpmId"
                  :options="datas.scwpm"
                  :disabled="datas.scwpm.length < 1"
                  close-on-select
                  label-by="title"
                  value-by="id"
                  :collapse-tags="true"	
                  :searchable="true"
                ></vue-select>
                <small
                  class="text-danger"
                  v-if="errors.scwpmId"
                  v-text="errors.scwpmId[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.kuphur')}}</label>
              <div class="col-sm-10">
                <vue-select
                  class="form-control form-control-solid w-100"
                  style="background-color:white;"
                  v-model="form.kuphurId"
                  :options="datas.kuphur"
                  :disabled="datas.kuphur.length < 1"
                  close-on-select
                  label-by="title"
                  value-by="id"
                  :collapse-tags="true"	
                  :searchable="true"
                ></vue-select>
                <small
                  class="text-danger"
                  v-if="errors.kuphurId"
                  v-text="errors.kuphurId[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.value')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid mb-lg-0"
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
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.serie')}}</label>
              <div class="col-sm-10">
                <vue-select
                  class="form-control form-control-solid w-100"
                  style="background-color:white;"
                  v-model="form.serieId"
                  :options="datas.serie"
                  :disabled="datas.serie.length < 1"
                  close-on-select
                  label-by="title"
                  value-by="id"
                  :collapse-tags="true"	
                  :searchable="true"
                ></vue-select>
                <small
                  class="text-danger"
                  v-if="errors.serieId"
                  v-text="errors.serieId[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.cil')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid mb-lg-0"
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
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.ct')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid mb-lg-0"
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
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.t')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid mb-lg-0"
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
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.tertip')}}</label>
              <div class="col-sm-10">
                <vue-select
                  class="form-control form-control-solid w-100"
                  style="background-color:white;"
                  v-model="form.tertipId"
                  :options="datas.tertip"
                  :disabled="datas.tertip.length < 1"
                  close-on-select
                  label-by="title"
                  :clear-on-select="true"
                  value-by="id"
                  :collapse-tags="true"	
                  :searchable="true"
                ></vue-select>
                <small
                  class="text-danger"
                  v-if="errors.tertipId"
                  v-text="errors.tertipId[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.size')}}</label>
              <div class="col-sm-10">
                <input
                  class="form-control form-control-solid mb-lg-0"
                  type="text"
                  v-model="form.size"
                />
                <small
                  class="text-danger"
                  v-if="errors.size"
                  v-text="errors.size[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.printPlace')}}</label>
              <div class="col-sm-10">
                <vue-select
                  class="form-control form-control-solid w-100"
                  style="background-color:white;"
                  v-model="form.printPlace"
                  :options="datas.printPlace"
                  :disabled="datas.printPlace.length < 1"
                  close-on-select
                  label-by="title"
                  :clear-on-select="true"
                  value-by="id"
                  :collapse-tags="true"	
                  :searchable="true"
                ></vue-select>
                <small
                  class="text-danger"
                  v-if="errors.printPlace"
                  v-text="errors.printPlace[0]"
                ></small>
              </div>
            </div>
            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.signatures')}}</label>
              <div class="col-sm-10">
                <vue-select
                  class="form-control form-control-solid w-100"
                  style="background-color:white;"
                  v-model="form.signatures"
                  :options="datas.signatures"
                  :disabled="datas.signatures.length < 1"
                  close-on-select
                  label-by="title"
                  :clear-on-select="true"
                  value-by="id"
                  :collapse-tags="true"	
                  :searchable="true"
                  :taggable="true"
                  :multiple="true"
                ></vue-select>
                <small
                  class="text-danger"
                  v-if="errors.signatures"
                  v-text="errors.signatures[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.date1')}}</label>
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.tedavulDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.tedavulDate"
                  v-text="errors.tedavulDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label"
                >{{$t('money.table.column.date2')}}</label
              >
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.lastDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.lastDate"
                  v-text="errors.lastDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label"
                >{{$t('money.table.column.date3')}}</label
              >
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.zortedDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.zortedDate"
                  v-text="errors.zortedDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.date3')}}</label>
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.timeoutDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.timeoutDate"
                  v-text="errors.timeoutDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.date4')}}</label>
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.expiryDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.expiryDate"
                  v-text="errors.expiryDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.frontColor')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.frontColor"
                />
                <small
                  class="text-danger"
                  v-if="errors.frontColor"
                  v-text="errors.frontColor[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.backColor')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.backColor"
                />
                <small
                  class="text-danger"
                  v-if="errors.backColor"
                  v-text="errors.backColor[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.backImage')}}</label>
              <div class="col-sm-10">
                <input
                  type="file"
                  class="form-control-file form-control-file-solid mb-lg-0"
                  @change="onUpdatefp"
                />
                <small
                  class="text-danger"
                  v-if="errors.frontImage"
                  v-text="errors.frontImage[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.backImage')}}</label>
              <div class="col-sm-10">
                <input
                  type="file"
                  class="form-control-file form-control-file-solid mb-lg-0"
                  @change="onUpdatebp"
                />
                <small
                  class="text-danger"
                  v-if="errors.backImage"
                  v-text="errors.backImage[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.link')}}</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.link"
                />
                <small
                  class="text-danger"
                  v-if="errors.link"
                  v-text="errors.link[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('money.table.column.desc')}}</label>
              <div class="col-sm-10">
                <textarea
                  class="form-control form-control-solid mb-lg-0"
                  v-model="form.desc"
                ></textarea>
                <small
                  class="text-danger"
                  v-if="errors.desc"
                  v-text="errors.desc[0]"
                ></small>
              </div>
            </div>

            <div class="form-group my-4 row">
              <label class="col-sm-2 col-form-label">{{$t('common.status')}}</label>
              <div class="col-sm-10">
                <select
                  v-model="form.status"
                  class="form-select form-select-solid mb-lg-0"
                >
                  <option :value="null">{{$t('common.status')}}</option>
                  <option :value="'0'">{{$t('common.inactive')}}</option>
                  <option :value="'1'">{{$t('common.active')}}</option>
                </select>
                <small
                  class="text-danger"
                  v-if="errors.status"
                  v-text="errors.status[0]"
                ></small>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button
            type="submit"
            class="btn btn-primary"
            @click="add()"
            v-if="!isLoading"
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