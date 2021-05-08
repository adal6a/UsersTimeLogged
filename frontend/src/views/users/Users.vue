<template>
  <div>
    <el-row :gutter="24" type="flex" justify="center">
      <el-col :span="20">
        <el-table
            v-loading="loading"
            border
            :data="users"
            style="width: 100%">
          <el-table-column
              prop="name"
              label="Name">
          </el-table-column>
          <el-table-column
              prop="email"
              label="Email">
          </el-table-column>
          <el-table-column
              prop="mobile"
              label="Mobile">
          </el-table-column>
          <el-table-column
              prop="logged_date"
              label="Date">
          </el-table-column>
          <el-table-column
              prop="total_logged_time"
              label="Logged time">
          </el-table-column>
        </el-table>

        <div class="block">
          <el-pagination
              style="margin-top: 12px;"
              align="right"
              layout="prev, pager, next"
              :current-page	="pagination.currentPage"
              :page-size="pagination.perPage"
              :total="pagination.totalItems"
              @current-change="handlePaginate"
          >
          </el-pagination>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>

import user from '@/api/user';

export default {
  name: "Users",
  data() {
    return {
      loading: false,
      pagination: {
        currentPage: 1,
        perPage: 0,
        totalItems: 0
      },
      users: []
    }
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    async getUsers() {
      this.loading = true;

      let { data } = await user.usersLoggedTime({
        page: this.pagination.currentPage
      });

      this.users = data.data.data;

      this.pagination.currentPage = data.data.current_page
      this.pagination.perPage = data.data.per_page
      this.pagination.totalItems = data.data.total
      this.loading = false;
    },
    handlePaginate(page) {
      this.pagination.currentPage = page;
      this.getUsers();
    }
  }
}
</script>

<style scoped>

</style>