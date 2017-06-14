<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">{{ nome }}</span>
            <el-button size="small" type="primary" icon="plus" class="fr" @click="adicionar">Adicionar</el-button>
        </div>
        <div class="listagem">
            <div class="search-container">
                <el-input
                        placeholder="Pesquisar"
                        icon="search"
                        class="search"
                        @change="getData"
                        v-model="search">
                </el-input>
            </div>

            <el-table
                    :data="tableData"
                    stripe
                    v-loading.body="loading"
                    @sort-change="handleSortChange"
                    row-key="id"
                    style="width: 100%">
                <slot name="colunas" :update="update" :editar="editar" :dialog="dialog"></slot>
            </el-table>

            <div class="pagination-container">
                <el-pagination
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        class="fr"
                        :current-page.sync="currentPage"
                        :page-sizes="[15, 30, 100, 150, 300]"
                        :page-size="pageSize"
                        layout="total, sizes, prev, pager, next, jumper"
                        :total="total">
                </el-pagination>
            </div>
        </div>
        <el-dialog
                title="Aviso"
                :visible.sync="dialogVisible"
                size="tiny">
                <span>Tem certeza que deseja excluir este item?</span>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="closeDialog">Cancelar</el-button>
                    <el-button type="primary" @click="destroy" :loading="loadingDelete">Excluir</el-button>
                </span>
        </el-dialog>
    </el-card>
</template>

<script>
    export default {
        props: ['nome'],
        data() {
            return {
                tableData: [],
                loading: false,
                currentPage: 1,
                total: 0,
                pageSize: 15,
                order: '',
                search: '',
                dialogVisible: false,
                loadingDelete: false
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
            },
            editar(id) {
                window.location.href = window.location.href + '/' + id + '/editar';
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
            dialog(deletingItem) {
                this.deletingItem = deletingItem;
                this.dialogVisible = true;
            },
            closeDialog() {
                this.deletingItem = '';
                this.dialogVisible = false;
            },
            destroy() {
                let self = this;
                this.loadingDelete = true;

                window.axios.delete(window.location.href + '/' + this.deletingItem)
                    .then(function(response) {
                        self.deletingItem = '';
                        self.dialogVisible = false;
                        self.loadingDelete = false;
                        self.getData();
                    });
            }
        },
        created: function() {
            this.getData();
        }
    }
</script>