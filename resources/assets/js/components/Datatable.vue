<template>
    <div>
        <el-table
                :data="tableData"
                stripe
                v-loading.body="loading"
                style="width: 100%">
            <slot></slot>
        </el-table>
        <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page.sync="currentPage"
                :page-sizes="[15, 30, 100, 150, 300]"
                :page-size="pageSize"
                layout="total, sizes, prev, pager, next, jumper"
                :total="total">
        </el-pagination>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tableData: [],
                loading: false,
                currentPage: 1,
                total: 0,
                pageSize: 15
            }
        },
        methods: {
            getData: function() {
                let self = this;
                let query = '';

                this.loading = true;

                query += '?_limit=' + this.pageSize;
                query += '&_offset=' + ((this.currentPage - 1) * this.pageSize);

                window.axios.get(window.location.href + query)
                    .then(function(response) {
                        self.total = parseInt(response.headers["meta-filter-count"]);
                        self.loading = false;
                        self.tableData = response.data;
                    });
            },
            handleSizeChange(val) {
                this.pageSize = val;
                this.getData();
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.getData();
            }
        },
        created: function() {
            this.getData();
        }
    }
</script>