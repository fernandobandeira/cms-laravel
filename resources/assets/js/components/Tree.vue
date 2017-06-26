<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">{{nome}}</span>
            <el-button size="small" type="primary" icon="plus" class="fr" @click="adicionar">Adicionar</el-button>
        </div>

        <div class="search-container">
            <el-input
                    placeholder="Pesquisar"
                    v-model="filterText">
            </el-input>
        </div>

        <el-tree
                v-loading.body="loading"
                class="filter-tree"
                :data="data"
                :props="defaultProps"
                default-expand-all
                :filter-node-method="filterNode"
                :expand-on-click-node="false"
                :render-content="renderContent"
                ref="tree">
        </el-tree>

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
        props: ['nome', 'defaultProps', 'url', 'customParams'],
        data() {
            return {
                filterText: ''                
            };
        },
        watch: {
            filterText(val) {
                this.$refs.tree.filter(val);
            }
        },
        methods: {
            filterNode(value, data) {
                if (!value) return true;
                return data.nome.indexOf(value) !== -1;
            },
            nodeClick(node) {
                this.editar(node.id);
            },
            renderContent(h, { node, data, store }) {
                return (
                    <span>
                        <span>
                            <span class="link" on-click={ () => this.editar(data.id) }>{node.label}</span>
                        </span>
                        <span style="float: right; margin-right: 20px">
                            <el-button size="mini" icon="delete" on-click={ () => this.dialog(data.id) }></el-button>
                        </span>
                    </span>);
            }
        }        
    };
</script>