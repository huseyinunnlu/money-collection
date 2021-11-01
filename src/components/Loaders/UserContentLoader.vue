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
  animation-delay:2s;
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
  animation-delay:2s;
  animation-iteration-count: infinite;
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
