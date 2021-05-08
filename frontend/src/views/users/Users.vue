<template>
  <div>
    <el-row :gutter="24" type="flex" justify="center">
      <el-col :span="6">
        <el-date-picker
            v-model="filter.date"
            type="date"
            style="width: 100%;"
            placeholder="Pick a date"
            value-format="yyyy-MM-dd"
            @change="filterUsers"
        >
        </el-date-picker>
      </el-col>
      <el-col :span="14">
        <el-input
            clearable
            placeholder="Search by name or email"
            prefix-icon="el-icon-search"
            v-model="filter.searchString"
            @input="filterUsers"
        >
        </el-input>
      </el-col>
    </el-row>

    <el-row :gutter="24" type="flex" justify="center" style="margin-top: 12px;">
      <el-col :span="20">
        <el-table
            empty-text="No data found"
            v-loading="loading"
            border
            :data="users"
            style="width: 100%"
            @sort-change="sortByDateOrTime"
        >
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
              sortable
              prop="logged_date"
              label="Date">
          </el-table-column>
          <el-table-column
              sortable
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
      filter: {
        page: 1,
        date: '',
        searchString: '',
        orderByDate: '',
        orderByTime: ''
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

      let { data } = await user.usersLoggedTime(this.filter);

      this.users = data.data.data;

      this.pagination.currentPage = data.data.current_page
      this.pagination.perPage = data.data.per_page
      this.pagination.totalItems = data.data.total
      this.loading = false;
    },
    handlePaginate(page) {
      this.pagination.currentPage = page;
      this.filter.page = page;
      this.getUsers();
    },
    filterUsers() {
      this.filter.page = 1;
      this.getUsers();
    },
    sortByDateOrTime(data) {
      this.filter.orderByDate = '';
      this.filter.orderByTime = '';

      const order = data.order === 'ascending' ? 'asc' : 'desc';

      if (data.prop === 'total_logged_time') {
        this.filter.orderByTime = order;
      } else {
        this.filter.orderByDate = order;
      }

      this.getUsers();
    }
  }
}
</script>

<style scoped>

</style>