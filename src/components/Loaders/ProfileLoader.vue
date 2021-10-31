<template>
  <div class="card card-primary card-outline">
    <div class="card-body box-profile d-flex justfy-content-center flex-column">
      <img
        class="profile-user-img img-fluid img-circle"
        alt="User profile picture"
        :src="
          'https://i.pinimg.com/736x/8b/16/7a/8b167af653c2399dd93b952a48740620.jpg'
        "
      />
      <p class="full-name-text text-center"></p>
    </div>
    <!-- /.card-body -->
  </div>
</template>
<style scoped>
.full-name-text {
  background-color: #bbb;
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
