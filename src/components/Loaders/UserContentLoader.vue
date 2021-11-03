<template>
  <div class="card-body">
    <div class="tab-content">
      <div class="active tab-pane" id="content">
        <div class="row">
          <div class="collections-statics d-flex flex-wrap">
            <div class="info-box col-4" v-for="i in 3" :key="i">
              <span class="info-box-icon bg-info elevation-1"></span>
              <div class="info-box-content">
                <span class="info-box-text"></span>
                <span class="info-box-number">
                  <small></small>
                  <span class="float-right"></span>
                </span>
              </div>
            </div>

            <!-- Timeline Loader -->
            <div>
              <div class="header">
                <h3 class="text-center my-4">Timeline</h3>
              </div>
              <div class="content">
                <div class="card-body">
                  <div class="tab-content">
                    <div class="tab-pane active">
                      <div class="timeline timeline-inverse">
                        <!-- Timeline Item Loader -->
                        <div class="time-label">
                          <span class="bg-danger py-3 px-5"></span>
                        </div>
                        <!-- /.timeline-label -->
                        <!-- timeline item -->
                        <div v-for="i in 4" :key="i" style="width:120%;">
                          <i class="fas fa-envelope bg-primary"></i>
                          <div class="timeline-item">
                            <span class="time">
                              <i class="far fa-clock"></i>
                            </span>
                            <h3 class="timeline-header px-5">Loading ...</h3>
                          </div>
                        </div>
                        <!-- END timeline item -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>
.info-box-text {
  background-color: #bbb;
  padding: 8px 0px;
  text-align: center;
  margin: 10px 0;
  border-radius: 2px;
  width: 110px;
  height: 7px;
  animation-name: loading;
  animation-duration: 2s;
  animation-delay: 2s;
  animation-iteration-count: infinite;
}
.info-box-number span,
.info-box-number small {
  background-color: #bbb;
  padding: 8px 0px;
  text-align: center;
  margin: 7px 0;
  border-radius: 2px;
  width: 110px;
  height: 7px;
  animation-name: loading;
  animation-duration: 2s;
  animation-delay: 2s;
  animation-iteration-count: infinite;
}

.timeline-item {
  width:110%;
}


@keyframes loading {
  0% {
    background-color: #e6e6e6;
  }
  25% {
    background-color: #bbb;
  }
  75% {
    background-color: #e6e6e6;
  }
  100% {
    background-color: #bbb;
  }
}
</style>
