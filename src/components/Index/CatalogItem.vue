<template>
    <div
      class="col-xl-4"
    >
      <!--begin::Card-->
      <router-link
        :to="{ name: 'Money', query: { ems_id: item.emission_id.id } }"
        class="card card-xl-stretch mb-5 mb-xl-8"
      >
        <!--begin::Card body-->
        <div class="card-body d-flex flex-column flex-stack pb-0 px-0">
          <!--begin::Title-->
          <div class="text-dark fs-2 text-left mb-10 fw-bolder card-px">
            {{ item.emission_id.title }}
          </div>
          <!--end::Title-->
          <!--begin::Illustration-->
          <div class="position-relative align-self-center">
            <img
              src="assets/media/illustrations/custom/1.png"
              style="margin-bottom: -5px"
              class="mw-100 mx-auto h-200px card-rounded"
            />
          </div>
          <!--begin::Illustration-->
        </div>
        <!--end::Card body-->
      </router-link>
      <!--end::Card-->
    </div>
</template>
<script>
export default {
    props:['item']
}
</script>