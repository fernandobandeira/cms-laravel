<template>
    <datatable nome="Listagem de Produtos">
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
                    <a @click="parent.editar(scope.row.id)">{{scope.row.nome}}</a>
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
