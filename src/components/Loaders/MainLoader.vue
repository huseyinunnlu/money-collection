<template>
  <div class="d-flex justify-content-center align-items-center flex-column my-5">
    <div class="loader text-center mb-2"></div>
    <h3>Loading..</h3>
  </div>
</template>
<style scoped>
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
