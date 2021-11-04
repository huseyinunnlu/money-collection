<script>
/*

  <div
    class="modal fade"
    id="kt_modal_add_user"
    tabindex="-1"
    aria-hidden="true"
  >
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
      <!--begin::Modal content-->
      <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header" id="kt_modal_add_user_header">
          <!--begin::Modal title-->
          <h2 class="fw-bolder">Add User</h2>
          <!--end::Modal title-->
          <!--begin::Close-->
          <div
            class="btn btn-icon btn-sm btn-active-icon-primary"
            data-kt-users-modal-action="close"
          >
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
            <span class="svg-icon svg-icon-1">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
              >
                <rect
                  opacity="0.5"
                  x="6"
                  y="17.3137"
                  width="16"
                  height="2"
                  rx="1"
                  transform="rotate(-45 6 17.3137)"
                  fill="black"
                ></rect>
                <rect
                  x="7.41422"
                  y="6"
                  width="16"
                  height="2"
                  rx="1"
                  transform="rotate(45 7.41422 6)"
                  fill="black"
                ></rect>
              </svg>
            </span>
            <!--end::Svg Icon-->
          </div>
          <!--end::Close-->
        </div>
        <!--end::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
          <!--begin::Form-->
          <form
            id="kt_modal_add_user_form"
            class="form fv-plugins-bootstrap5 fv-plugins-framework"
            action="#"
          >
            <!--begin::Scroll-->
            <div
              class="d-flex flex-column scroll-y me-n7 pe-7"
              id="kt_modal_add_user_scroll"
              data-kt-scroll="true"
              data-kt-scroll-activate="{default: false, lg: true}"
              data-kt-scroll-max-height="auto"
              data-kt-scroll-dependencies="#kt_modal_add_user_header"
              data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
              data-kt-scroll-offset="300px"
              style=""
            >
              <!--begin::Input group-->
              <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="d-block fw-bold fs-6 mb-5">Avatar</label>
                <!--end::Label-->
                <!--begin::Image input-->
                <div
                  class="image-input image-input-outline"
                  data-kt-image-input="true"
                  style="background-image: url(assets/media/avatars/blank.png)"
                >
                  <!--begin::Preview existing avatar-->
                  <div
                    class="image-input-wrapper w-125px h-125px"
                    style="background-image: url(assets/media/avatars/150-1.jpg);"
                  ></div>
                  <!--end::Preview existing avatar-->
                  <!--begin::Label-->
                  <label
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change"
                    data-bs-toggle="tooltip"
                    title=""
                    data-bs-original-title="Change avatar"
                  >
                    <i class="bi bi-pencil-fill fs-7"></i>
                    <!--begin::Inputs-->
                    <input
                      type="file"
                      name="avatar"
                      accept=".png, .jpg, .jpeg"
                    />
                    <input type="hidden" name="avatar_remove" />
                    <!--end::Inputs-->
                  </label>
                  <!--end::Label-->
                  <!--begin::Cancel-->
                  <span
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel"
                    data-bs-toggle="tooltip"
                    title=""
                    data-bs-original-title="Cancel avatar"
                  >
                    <i class="bi bi-x fs-2"></i>
                  </span>
                  <!--end::Cancel-->
                  <!--begin::Remove-->
                  <span
                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove"
                    data-bs-toggle="tooltip"
                    title=""
                    data-bs-original-title="Remove avatar"
                  >
                    <i class="bi bi-x fs-2"></i>
                  </span>
                  <!--end::Remove-->
                </div>
                <!--end::Image input-->
                <!--begin::Hint-->
                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                <!--end::Hint-->
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="fv-row mb-7 fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required fw-bold fs-6 mb-2">Full Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input
                  type="text"
                  name="user_name"
                  class="form-control form-control-solid mb-3 mb-lg-0"
                  placeholder="Full name"
                  value="Emma Smith"
                />
                <!--end::Input-->
                <div
                  class="fv-plugins-message-container invalid-feedback"
                ></div>
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="fv-row mb-7 fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="required fw-bold fs-6 mb-2">Email</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input
                  type="email"
                  name="user_email"
                  class="form-control form-control-solid mb-3 mb-lg-0"
                  placeholder="example@domain.com"
                  value="e.smith@kpmg.com.au"
                />
                <!--end::Input-->
                <div
                  class="fv-plugins-message-container invalid-feedback"
                ></div>
              </div>
              <!--end::Input group-->
              <!--begin::Input group-->
              <div class="mb-7">
                <!--begin::Label-->
                <label class="required fw-bold fs-6 mb-5">Role</label>
                <!--end::Label-->
                <!--begin::Roles-->
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                  <!--begin::Radio-->
                  <div class="form-check form-check-custom form-check-solid">
                    <!--begin::Input-->
                    <input
                      class="form-check-input me-3"
                      name="user_role"
                      type="radio"
                      value="0"
                      id="kt_modal_update_role_option_0"
                      checked="checked"
                    />
                    <!--end::Input-->
                    <!--begin::Label-->
                    <label
                      class="form-check-label"
                      for="kt_modal_update_role_option_0"
                    >
                      <div class="fw-bolder text-gray-800">Administrator</div>
                      <div class="text-gray-600">
                        Best for business owners and company administrators
                      </div>
                    </label>
                    <!--end::Label-->
                  </div>
                  <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                  <!--begin::Radio-->
                  <div class="form-check form-check-custom form-check-solid">
                    <!--begin::Input-->
                    <input
                      class="form-check-input me-3"
                      name="user_role"
                      type="radio"
                      value="1"
                      id="kt_modal_update_role_option_1"
                    />
                    <!--end::Input-->
                    <!--begin::Label-->
                    <label
                      class="form-check-label"
                      for="kt_modal_update_role_option_1"
                    >
                      <div class="fw-bolder text-gray-800">Developer</div>
                      <div class="text-gray-600">
                        Best for developers or people primarily using the API
                      </div>
                    </label>
                    <!--end::Label-->
                  </div>
                  <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                  <!--begin::Radio-->
                  <div class="form-check form-check-custom form-check-solid">
                    <!--begin::Input-->
                    <input
                      class="form-check-input me-3"
                      name="user_role"
                      type="radio"
                      value="2"
                      id="kt_modal_update_role_option_2"
                    />
                    <!--end::Input-->
                    <!--begin::Label-->
                    <label
                      class="form-check-label"
                      for="kt_modal_update_role_option_2"
                    >
                      <div class="fw-bolder text-gray-800">Analyst</div>
                      <div class="text-gray-600">
                        Best for people who need full access to analytics data,
                        but don't need to update business settings
                      </div>
                    </label>
                    <!--end::Label-->
                  </div>
                  <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                  <!--begin::Radio-->
                  <div class="form-check form-check-custom form-check-solid">
                    <!--begin::Input-->
                    <input
                      class="form-check-input me-3"
                      name="user_role"
                      type="radio"
                      value="3"
                      id="kt_modal_update_role_option_3"
                    />
                    <!--end::Input-->
                    <!--begin::Label-->
                    <label
                      class="form-check-label"
                      for="kt_modal_update_role_option_3"
                    >
                      <div class="fw-bolder text-gray-800">Support</div>
                      <div class="text-gray-600">
                        Best for employees who regularly refund payments and
                        respond to disputes
                      </div>
                    </label>
                    <!--end::Label-->
                  </div>
                  <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                  <!--begin::Radio-->
                  <div class="form-check form-check-custom form-check-solid">
                    <!--begin::Input-->
                    <input
                      class="form-check-input me-3"
                      name="user_role"
                      type="radio"
                      value="4"
                      id="kt_modal_update_role_option_4"
                    />
                    <!--end::Input-->
                    <!--begin::Label-->
                    <label
                      class="form-check-label"
                      for="kt_modal_update_role_option_4"
                    >
                      <div class="fw-bolder text-gray-800">Trial</div>
                      <div class="text-gray-600">
                        Best for people who need to preview content data, but
                        don't need to make any updates
                      </div>
                    </label>
                    <!--end::Label-->
                  </div>
                  <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <!--end::Roles-->
              </div>
              <!--end::Input group-->
            </div>
            <!--end::Scroll-->
            <!--begin::Actions-->
            <div class="text-center pt-15">
              <button
                type="reset"
                class="btn btn-light me-3"
                data-kt-users-modal-action="cancel"
              >
                Discard
              </button>
              <button
                type="submit"
                class="btn btn-primary"
                data-kt-users-modal-action="submit"
              >
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress"
                  >Please wait...
                  <span
                    class="spinner-border spinner-border-sm align-middle ms-2"
                  ></span
                ></span>
              </button>
            </div>
            <!--end::Actions-->
            <div></div>
          </form>
          <!--end::Form-->
        </div>
        <!--end::Modal body-->
      </div>
      <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
  </div>
 */

export default {
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
          this.datas.emission = res.data.data.emission;
          this.datas.scwpm = res.data.data.scwpm;
          this.datas.kuphur = res.data.data.kuphur;
          this.datas.serie = res.data.data.serie;
          this.datas.tertip = res.data.data.tertip;
          this.datas.printPlace = res.data.data.printPlace;
          this.datas.signatures = res.data.data.signatures;
        })
        .catch(() => {
          this.datas.emission = [];
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
        .post("/money/add", formData)
        .then((res) => {
          this.$store.state.Money.moneys.unshift(res.data.data);
          this.$notify({
            type: "success",
            message: "Money added successfuly.",
          });
          this.form.emissionId = null;
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
          <h5 class="modal-title" id="exampleModalLabel">Add New Money</h5>
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
              <label class="col-sm-2 col-form-label">Emission</label>
              <div class="col-sm-10">
                <select class="form-control" v-model="form.emissionId">
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">SCWPM</label>
              <div class="col-sm-10">
                <select class="form-control" v-model="form.scwpmId">
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Kuphür</label>
              <div class="col-sm-10">
                <select class="form-control" v-model="form.kuphurId">
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nominal Value</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
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
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Serie</label>
              <div class="col-sm-10">
                <select class="form-control" v-model="form.serieId">
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Çil Value</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">ÇT (XF) Value</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">T(F) Value</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tertip</label>
              <div class="col-sm-10">
                <select class="form-control" v-model="form.tertipId">
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Size</label>
              <div class="col-sm-10">
                <input class="form-control" type="text" v-model="form.size" />
                <small
                  class="text-danger"
                  v-if="errors.size"
                  v-text="errors.size[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Print Place</label>
              <div class="col-sm-10">
                <select class="form-control" v-model="form.printPlace">
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
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Signatures</label>
              <div class="col-sm-10">
                <select class="form-control" v-model="form.signatures" multiple>
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

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tedavul date</label>
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control"
                  v-model="form.tedavulDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.tedavulDate"
                  v-text="errors.tedavulDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label"
                >Tedavulden Çıkma Tarihi</label
              >
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control"
                  v-model="form.lastDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.lastDate"
                  v-text="errors.lastDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label"
                >Zorunlu Tedavulden Süresi Sonu</label
              >
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control"
                  v-model="form.zortedDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.zortedDate"
                  v-text="errors.zortedDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Timeout</label>
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control"
                  v-model="form.timeoutDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.timeoutDate"
                  v-text="errors.timeoutDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Expiry Date</label>
              <div class="col-sm-10">
                <input
                  type="date"
                  class="form-control"
                  v-model="form.expiryDate"
                />
                <small
                  class="text-danger"
                  v-if="errors.expiryDate"
                  v-text="errors.expiryDate[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Front Color</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
                  v-model="form.frontColor"
                />
                <small
                  class="text-danger"
                  v-if="errors.frontColor"
                  v-text="errors.frontColor[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Back Color</label>
              <div class="col-sm-10">
                <input
                  type="text"
                  class="form-control"
                  v-model="form.backColor"
                />
                <small
                  class="text-danger"
                  v-if="errors.backColor"
                  v-text="errors.backColor[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Front Image</label>
              <div class="col-sm-10">
                <input
                  type="file"
                  class="form-control-file"
                  @change="onUpdatefp"
                />
                <small
                  class="text-danger"
                  v-if="errors.frontImage"
                  v-text="errors.frontImage[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Back Image</label>
              <div class="col-sm-10">
                <input
                  type="file"
                  class="form-control-file"
                  @change="onUpdatebp"
                />
                <small
                  class="text-danger"
                  v-if="errors.backImage"
                  v-text="errors.backImage[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Link</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" v-model="form.link" />
                <small
                  class="text-danger"
                  v-if="errors.link"
                  v-text="errors.link[0]"
                ></small>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Back Color</label>
              <div class="col-sm-10">
                <textarea class="form-control" v-model="form.desc"></textarea>
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
                <select v-model="form.status" class="form-control">
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
<style src="@vueform/multiselect/themes/default.css"></style>
