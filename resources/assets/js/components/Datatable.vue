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
                    :data="data"
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
    import BaseIndex from "./mixins/Index";

    export default {
        mixins: [BaseIndex],
        props: ['nome', 'url', 'customParams'],
        data() {
            return {
                currentPage: 1,
                pageSize: 15
            }
        },
        methods: {
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
            }
        }
    }
</script>