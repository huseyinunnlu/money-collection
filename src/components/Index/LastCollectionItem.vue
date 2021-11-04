<template>
  <tr>
    <td>
      <div class="symbol symbol-50px me-2">
        <span class="symbol-label">
          <img
            :src="item.user.profilePhoto"
            class="h-75 align-self-end rounded"
            :alt="item.user.slug"
          />
        </span>
      </div>
    </td>
    <td>
      <router-link
        :to="{ name: 'Profile', params: { slug: item.user.slug } }"
        class="text-dark fw-bolder text-hover-primary mb-1 fs-6"
        >{{ item.user.fullName }}</router-link
      >
    </td>
    <td>
      <span class="text-muted fw-bold d-block fs-7"
        >{{ item.money.emission_id.title }} - ({{
          item.money.serie_id.title
        }})</span
      >
      <span class="text-dark fw-bolder d-block fs-5">{{
        item.money.kuphur_id.title
      }}</span>
    </td>
    <td class="text-end">
      <span class="text-dark fs-7 fw-bolder">{{ moment(item.created_at).format("MMM Do YY - h:mm:ss") }}</span>
    </td>
    <td class="text-end">
      <router-link
        :to="{name:'MoneyShow',params:{id:item.money.id}}"
        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
      >
      See Money
      </router-link>
    </td>
  </tr>
</template>
<script>
import moment from "moment";
export default {
  props: ["item"],
  created() {
    this.moment = moment;
  },
};
</script>
