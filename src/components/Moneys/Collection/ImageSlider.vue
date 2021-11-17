<template>
  <div
    class="modal fade"
    :id="'exampleModal' + id"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body p-0 m-0">
          <carousel :items-to-show="1" :wrapAround="true" :itemsToScroll="1">
            <slide v-for="item in images" :key="item.id">
              <div class="carousel__item">
                <img :src="item.image" style="width: 100%; height: 100;" />
              </div>
            </slide>
            <template #addons="{slidesCount}">
              <navigation v-if="slidesCount > 1"/>
            </template>
          </carousel>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Slide, Navigation } from "vue3-carousel";

export default {
  props: ["images", "id"],
  components: {
    Carousel,
    Slide,

    Navigation,
  },
};
</script>
