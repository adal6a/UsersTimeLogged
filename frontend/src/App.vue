<template>
  <div id="app">
    <el-container>
      <el-header>
        <el-menu :router="true" :default-active="activeIndex" mode="horizontal">
          <el-menu-item v-if="!tokenAuthentication" index="login" :route="{ name: 'login' }">
            <template slot="title">
              <i class="el-icon-user"></i>
              <span>Login</span>
            </template>
          </el-menu-item>
          <el-menu-item v-if="tokenAuthentication" index="users" :route="{ name: 'users' }">
            <template slot="title">
              <i class="el-icon-tickets"></i>
              <span>Users list</span>
            </template>
          </el-menu-item>
          <el-menu-item v-if="tokenAuthentication" index="logout" @click="logout">
            <template slot="title">
              <i class="el-icon-switch-button"></i>
              <span>Logout</span>
            </template>
          </el-menu-item>
        </el-menu>
      </el-header>
      <el-main><router-view/></el-main>
    </el-container>
  </div>
</template>

<script>

import { mapGetters } from 'vuex'

export default {
  data() {
    return {
      activeIndex: 'login'
    }
  },
  computed: {
    ...mapGetters({
      tokenAuthentication: 'tokenAuthentication'
    })
  },
  watch: {
    $route (to) {
      this.activeIndex = to.name;
    }
  },
  methods: {
    async logout() {
      try {
        await this.$store.dispatch('logout');
        await this.$router.push({ name: 'login' })
      } catch (error) {
        this.error = error.response.data.message;
      }
    }
  }

}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
</style>
