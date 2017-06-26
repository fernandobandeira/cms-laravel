<template>
    <datatable nome="Listagem de Produtos" url="/api/produtos" :customParams="customParams">
        <template slot="colunas" scope="parent">
            <el-table-column
                    sortable="custom"
                    prop="ordem"
                    label="Ordem"
                    width="110">
                <template scope="scope">
                    <el-input @blur="parent.update(scope.row, 'ordem')" size="mini" v-model="scope.row.ordem" class="ordem"></el-input>
                </template>
            </el-table-column>
            <el-table-column
                    sortable="custom"
                    prop="referencia"
                    label="Referência"
                    width="300">
            </el-table-column>
            <el-table-column
                    sortable="custom"
                    prop="nome"
                    label="Nome">
                <template scope="scope">
                    <span class="link" @click="parent.editar(scope.row.id)">{{scope.row.nome}}</span>
                </template>
            </el-table-column>
            <el-table-column
                prop="categorias"
                label="Categorias"
                width="140"
                :filters="[{ text: 'Home', value: 'Home' }, { text: 'Office', value: 'Office' }]"
                :filter-method="filterTag"
                filter-placement="bottom-end">
                <template scope="scope">
                    <el-tag
                    v-for="categoria in scope.row.categorias"
                    :key="categoria.id"
                    type="primary"
                    close-transition>
                        {{categoria.nome}}
                    </el-tag>
                </template>
            </el-table-column>
            <el-table-column
                    sortable="custom"
                    prop="ativo"
                    label="Ativo"
                    width="120">
                <template scope="scope">
                    <el-switch
                            @change.native="parent.update(scope.row, 'ativo')"
                            v-model="scope.row.ativo"
                            on-text=""
                            off-text="">
                    </el-switch>
                </template>
            </el-table-column>
            <el-table-column
                    sortable="custom"
                    prop="disponivel"
                    label="Disponível"
                    width="130">
                <template scope="scope">
                    <el-switch
                            @change.native="parent.update(scope.row, 'disponivel')"
                            v-model="scope.row.disponivel"
                            on-text=""
                            off-text="">
                    </el-switch>
                </template>
            </el-table-column>
            <el-table-column
                    sortable="custom"
                    prop="destaque"
                    label="Destaque"
                    width="120">
                <template scope="scope">
                    <el-switch
                            @change.native="parent.update(scope.row, 'destaque')"
                            v-model="scope.row.destaque"
                            on-text=""
                            off-text="">
                    </el-switch>
                </template>
            </el-table-column>
            <el-table-column prop="id" label="Ações" width="100">
                <template scope="scope">
                    <el-button size="small" icon="delete" @click="parent.dialog(scope.row.id)"></el-button>
                </template>
            </el-table-column>
        </template>
    </datatable>
</template>

<script>
    export default {
        data() {
            return {
                customParams: {
                    _with: 'categorias'
                }
            }
        }
    }
</script>