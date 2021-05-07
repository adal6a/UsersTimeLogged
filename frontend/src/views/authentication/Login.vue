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

        <el-form :model="userForm" style="margin-top: 12px;">
          <el-form-item prop="email">
            <el-input
                v-model="userForm.email"
                placeholder="Email"
                name="email"
                type="text"
                tabindex="1"
                autocomplete="on"
            />
          </el-form-item>

          <el-form-item prop="password">
            <el-input
                v-model="userForm.password"
                type="password"
                placeholder="Password"
                name="password"
                tabindex="2"
                autocomplete="on"
                @keyup.enter.native="login"
            />
          </el-form-item>

          <el-button
              :loading="loading"
              type="primary"
              style="width:100%;"
              @click.native.prevent="login"
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
      userForm: {
        email: '',
        password: ''
      },
      loading: false,
      error: null
    }
  },

  methods: {
    async login() {
      this.error = null;

      try {
        this.loading = true;

        await this.$store.dispatch('login', this.userForm);
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