<template>
  <div>
    <div class="header">
      <h3 class="text-center my-4">Timeline</h3>
    </div>
    <div class="content">
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active">
            <div class="timeline timeline-inverse">
              <TimelineParentItem v-for="(item,index) in timeline" :key="index" :item="item"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import TimelineParentItem from '@/components/Profile/TimelineParentItem.vue'
export default {
    components:{
        TimelineParentItem,
    },
    props:['timeline']
}
</script>
