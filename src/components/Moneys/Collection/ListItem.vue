<template>
  <ImageSlider v-if="item.images.length > 0" :images="item.images" :id="item.id"/>
  <tr v-if="!isDeleted">
    <td>{{ item.id }}</td>
    <td>
      <a
        class="text-primary"
        role="button"
        data-toggle="modal"
        :data-target="'#exampleModal' + item.id"
        >See Photos({{ item.images.length }})</a
      >
    </td>
    <td>{{ item.uniqueSerie }}</td>
    <td>
      {{
        item.purchasedPerson != "null" || !item.purchasedPerson
          ? item.purchasedPerson
          : "Yok"
      }}
    </td>
    <td>{{ moment(item.date).format("MMM Do YY") }}</td>
    <!-- Button trigger modal -->
    <td class="float-left">
      <div class="dropdown">
        <button
          class="btn btn-light btn-active-light-primary btn-sm dropdown-toggle"
          type="button"
          id="dropdownMenuButton"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
        >
          Actions
        </button>
        <div
          class="
            dropdown-menu
            menu
            menu-sub
            menu-sub-dropdown
            menu-column
            menu-rounded
            menu-gray-600
            menu-state-bg-light-primary
            fw-bold
            fs-7
            w-125px
            py-4
          "
          aria-labelledby="dropdownMenuButton"
        >
          <!-- <div class="menu-item px-3">
            <router-link
              v-if="_IsAuth && _User.role == 1"
              :to="{ name: 'AdminMoneyEdit', params: { id: money.id } }"
              class="menu-link px-3"
              ><i class="fas fa-pen mx-2"></i> Edit</router-link
            >
          </div> -->
          <!-- <div class="menu-item px-3">
            <router-link
              :to="{ name: 'MoneyShow', params: { id: money.id } }"
              class="menu-link px-3"
              ><i class="fas fa-eye mx-2"></i> Details</router-link
            >
          </div> -->
          <div class="menu-item px-3">
            <a class="menu-link px-3" @click="del(item.id)">
              <i class="fas fa-trash mx-2"></i> Delete
            </a>
          </div>
          <!-- <div class="menu-item px-3">
            <a
              class="menu-link px-3"
              :disabled="buttonIsLoading"
              @click="addCollection()"
              v-if="!isCollected && money.status == 1"
            >Add Coll.
            </a>
            <a
              class="menu-link px-3"
              @click="deleteCollection()"
              :disabled="buttonIsLoading"
              v-if="isCollected && money.status == 1"
            >Del. Coll.
            </a>
          </div> -->
        </div>
      </div>
    </td>
  </tr>
</template>
<script>
import { mapGetters } from "vuex";
import moment from "moment";

import ImageSlider from "@/components/Moneys/Collection/ImageSlider.vue";
export default {
  computed: {
    ...mapGetters(["_User", "_IsAuth"]),
  },
  components: {
    ImageSlider,
  },
  created() {
    this.moment = moment;
  },
  data() {
    return {
      isDeleted: false,
      isLoading: false,
      buttonIsLoading: false,
      isCollected: false,
    };
  },
  props: ["item"],
  methods: {
    del(id) {
      this.buttonIsLoading = false;
      this.$appAxios
        .post("/collection/delete", {
          id: id,
        })
        .then(() => {
          this.isDeleted = true;
          this.$notify({
            type: "success",
            title: "Koleksiyondan kaldırıldı.",
          });
        })
        .catch(() => {
          this.$notify({
            type: "error",
            title: "Koleksiyondan kaldırılamadı.",
          });
        })
        .finally(() => {
          this.buttonIsLoading = false;
        });
    },
  },
};
</script>
