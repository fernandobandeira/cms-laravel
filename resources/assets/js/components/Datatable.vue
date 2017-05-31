<template>
    <div class="datatable">
        <h3>Listagem de Produtos</h3>

        <el-input
                placeholder="Pesquisar"
                icon="search"
                class="search"
                @change="getData"
                v-model="search">
        </el-input>

        <el-button size="small" type="primary" icon="plus" class="new" @click="adicionar">Adicionar</el-button>

        <el-table
                :data="tableData"
                stripe
                v-loading.body="loading"
                @sort-change="handleSortChange"
                row-key="id"
                style="width: 100%"
                @update="update">
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
                pageSize: 15,
                order: '',
                search: ''
            }
        },
        methods: {
            getData() {
                let self = this;
                let query = '';

                this.loading = true;

                query += '?_limit=' + this.pageSize;
                query += '&_offset=' + ((this.currentPage - 1) * this.pageSize);
                if(this.order != '') {
                    query += '&_sort=' + this.order;
                }
                if(this.search != '') {
                    query += '&_q=' + this.search;
                }

                window.axios.get(window.location.href + query)
                    .then(function(response) {
                        self.total = parseInt(response.headers["meta-filter-count"]);
                        self.loading = false;
                        self.tableData = response.data;
                    });
            },
            update(data, column) {
                let self = this;
                let dados = {};
                dados[column] = data[column];

                window.axios.put(window.location.href + '/' + data.id, dados)
                    .then(function(response) {
                        self.getData();
                    });
            },
            handleSizeChange(val) {
                this.pageSize = val;
                this.getData();
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.getData();
            },
            handleSortChange(sort) {
                this.order = '';
                if (sort.prop != null) {
                    if (sort.order === 'descending') {
                        this.order = '-';
                    }
                    this.order += sort.prop;
                }
                this.getData();
            },
            adicionar() {
                window.location.href = window.location.href + '/novo';
            }
        },
        created: function() {
            this.getData();
        }
    }
</script>