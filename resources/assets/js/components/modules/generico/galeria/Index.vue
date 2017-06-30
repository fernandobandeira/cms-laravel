<template>
    <datatable nome="Listagem de Galerias" url="/api/galerias">
        <template slot="colunas" scope="parent">
            <el-table-column
                    sortable="custom"
                    prop="nome"
                    label="Nome">
                <template scope="scope">
                    <span class="link" @click="parent.editar(scope.row.id)">{{scope.row.nome}}</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="modulo"
                    label="Módulo"
                    width="300">
            </el-table-column>
            <el-table-column prop="id" label="Ações" width="100">
                <template scope="scope">
                    <el-button size="small" icon="delete" @click="parent.dialog(scope.row.id)"></el-button>
                </template>
            </el-table-column>
        </template>
    </datatable>
</template>