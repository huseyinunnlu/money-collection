<template>
  <div class="card-body">
    <div class="tab-content">
      <div class="active tab-pane" id="content">
        <div class="row">
          <div class="collections-statics d-flex flex-wrap">
            <div class="col-md-12">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"
                  ><i class="fas fa-dollar-sign"></i
                ></span>

                <div class="info-box-content">
                  <span class="info-box-text">Collected Moneys</span>
                  <span class="info-box-number">
                    {{moneyStatics.collectedMoney}} /
                    <small>{{moneyStatics.moneyCount}}</small>
                    <span class="float-right">{{moneyStatics.percent}}</span>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props:['moneyStatics']
}
</script>
