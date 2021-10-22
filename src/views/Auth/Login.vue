<template>
  <body class="hold-transition login-page">
    <div class="login-box my-3">
      <div class="login-logo">
        <a href="../../index2.html"><b>Mod</b>Hub</a>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

            <LoginForm />
          
          <!-- /.social-auth-links -->

          <p class="mb-1">
            <a href="forgot-password.html">I forgot my password</a>
          </p>
          <p class="mb-0">
            <router-link :to="{ name: 'Register' }" class="text-center"
              >Register a new membership</router-link
            >
          </p>
        </div>
      </div>
    </div>
  </body>
</template>
<script> 
import LoginForm from '@/components/Auth/LoginForm.vue'
export default {
    components: {
        LoginForm,
    }
}
</script>
