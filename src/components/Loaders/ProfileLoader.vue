<template>
  <div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
      <!--begin::Details-->
      <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        <!--begin: Pic-->
        <div class="me-7 mb-4">
          <div
            class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative"
          >
            <img
              :src="
                'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'
              "
              :alt="'profilephoto'"
            />
            <div
              class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"
            ></div>
          </div>
        </div>
        <!--end::Pic-->
        <!--begin::Info-->
        <div class="flex-grow-1">
          <!--begin::Title-->
          <div
            class="d-flex justify-content-between align-items-start flex-wrap mb-2"
          >
            <!--begin::User-->
            <div class="d-flex flex-column">
              <!--begin::Name-->
              <div class="d-flex align-items-center mb-2">
                <a
                  class="text-gray-900 full-name-text text-hover-primary fs-2 fw-bolder me-2"
                  ></a
                >
                <span class="badge badge-light-success full-name-text">
                  
                </span>
              </div>
              <!--end::Name-->
              <!--begin::Info-->

              <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                <a
                  href="#"
                  class="full-name-text d-flex align-items-center text-gray-400 text-hover-primary mb-2"
                ></a>
              </div>

              <!--end::Info-->
            </div>
            <!--end::User-->
          </div>
          <!--end::Title-->
          <!--begin::Stats-->
          <div class="d-flex flex-wrap flex-stack">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-grow-1 pe-8">
              <!--begin::Stats-->
              <div class="d-flex flex-wrap">
                <!--begin::Stat-->
                <div
                  class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3"
                >
                  <!--begin::Number-->
                  <div class="d-flex align-items-center">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                    <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                      >
                        <rect
                          opacity="0.5"
                          x="13"
                          y="6"
                          width="13"
                          height="2"
                          rx="1"
                          transform="rotate(90 13 6)"
                          fill="black"
                        ></rect>
                        <path
                          d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                          fill="black"
                        ></path>
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div
                      class="fs-2 fw-bolder counted"
                      data-kt-countup="true"
                      data-kt-countup-value="4500"
                      data-kt-countup-prefix="$"
                    >
                      $4,500
                    </div>
                  </div>
                  <!--end::Number-->
                  <!--begin::Label-->
                  <div class="fw-bold fs-6 text-gray-400">Earnings</div>
                  <!--end::Label-->
                </div>
                <!--end::Stat-->
              </div>
              <!--end::Stats-->
            </div>
            <!--end::Wrapper-->
          </div>
          <!--end::Stats-->
        </div>
        <!--end::Info-->
      </div>
      <!--end::Details-->
    </div>
  </div>
</template>
<style scoped>
.full-name-text {
  background-color: #999;
  padding: 8px 0px;
  text-align: center;
  margin: 10px 0;
  border-radius: 2px;
  animation-name: loading;
  animation-duration: 2s;
  animation-iteration-count: infinite;
}

@keyframes loading {
  0% {
    background-color: #e6e6e6;
  }
  100% {
    background-color: #bbb;
  }
}
</style>
