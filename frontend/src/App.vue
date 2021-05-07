<template>
  <div id="app">
    <el-container>
      <el-header>
        <el-menu :router="true" :default-active="activeIndex" mode="horizontal">
          <el-menu-item index="login" :route="{ name: 'login' }">
            <template slot="title">
              <i class="el-icon-user"></i>
              <span>Login</span>
            </template>
          </el-menu-item>
          <el-menu-item index="users" :route="{ name: 'users' }">
            <template slot="title">
              <i class="el-icon-tickets"></i>
              <span>Users list</span>
            </template>
          </el-menu-item>
          <el-menu-item index="logout">
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
export default {
  data() {
    return {
      activeIndex: 'login'
    }
  },
  watch: {
    $route (to) {
      this.activeIndex = to.name;
    }
  },
  methods: {

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
