<template>
  <div>
    <el-row :gutter="24" type="flex" justify="center">
      <el-col :span="12">
        <el-alert
            v-if="error !== null"
            :title="error"
            type="error"
            show-icon>
        </el-alert>

        <el-form ref="loginForm" :model="loginForm" :rules="loginFormRules" style="margin-top: 12px;">
          <el-form-item prop="email">
            <el-input
                v-model="loginForm.email"
                placeholder="Email"
                name="email"
                type="text"
                tabindex="1"
                autocomplete="on"
            />
          </el-form-item>

          <el-form-item prop="password">
            <el-input
                v-model="loginForm.password"
                type="password"
                placeholder="Password"
                name="password"
                tabindex="2"
                autocomplete="on"
                @keyup.enter.native="validateForm"
                show-password
            />
          </el-form-item>

          <el-button
              :loading="loading"
              type="primary"
              style="width:100%;"
              @click.native.prevent="validateForm"
          >
            Login
          </el-button>
        </el-form>
      </el-col>
    </el-row>
  </div>
</template>

<script>

export default {
  name: 'Login',

  data() {
    return {
      loginForm: {
        email: '',
        password: ''
      },
      loginFormRules: {
        email: [
          { required: true, message: 'Email is required', trigger: 'blur' },
        ],
        password: [
          { required: true, message: 'Password is required', trigger: 'blur' }
        ],
      },
      loading: false,
      error: null
    }
  },

  methods: {
    validateForm() {
      this.$refs['loginForm'].validate((valid) => {
        if (valid) {
          this.login();
        } else {
          return false
        }
      })
    },
    async login() {
      this.error = null;

      try {
        this.loading = true;

        await this.$store.dispatch('login', this.loginForm);
        this.loading = false;
        this.error = null;

        await this.$router.push({ name: 'users' });
      } catch (error) {
        this.error = error.response.data.message;
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>