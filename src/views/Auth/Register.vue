<template>
  <div class="hold-transition register-page">
    <div class="pt-2">
      <div class="register-box py-2">
        <div class="register-logo">
          <router-link :to="{ name: 'Index' }"><b>LOGO</b></router-link>
        </div>

        <div class="card">
          <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>
            <RegisterForm />
            <router-link :to="{ name: 'Login' }" class="text-center"
              >I already have a membership</router-link
            >
          </div>
          
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import RegisterForm from "@/components/Auth/RegisterForm.vue";
export default {
  components: {
    RegisterForm,
  },
};
</script>
