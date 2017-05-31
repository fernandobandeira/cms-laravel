<template>
    <div>
        <el-table-column
                prop="ordem"
                label="Ordem"
                sortable
                width="120">
            <template scope="scope">
                <el-input @blur="update(scope.row, 'ordem')" size="mini" v-model="scope.row.ordem" class="ordem"></el-input>
            </template>
        </el-table-column>
        <el-table-column
                prop="referencia"
                label="Referência"
                width="300">
        </el-table-column>
        <el-table-column
                prop="nome"
                sortable
                label="Nome">
        </el-table-column>
        <el-table-column
                prop="ativo"
                sortable
                label="Ativo"
                width="120">
            <template scope="scope">
                <el-switch
                        @change="update(scope.row, 'ativo')"
                        v-model="scope.row.ativo"
                        on-text=""
                        off-text="">
                </el-switch>
            </template>
        </el-table-column>
        <el-table-column
                prop="disponivel"
                sortable
                label="Disponível"
                width="130">
            <template scope="scope">
                <el-switch
                        @change="update(scope.row, 'disponivel')"
                        v-model="scope.row.disponivel"
                        on-text=""
                        off-text="">
                </el-switch>
            </template>
        </el-table-column>
        <el-table-column
                prop="destaque"
                sortable
                label="Destaque"
                width="120">
            <template scope="scope">
                <el-switch
                        @change="update(scope.row, 'destaque')"
                        v-model="scope.row.destaque"
                        on-text=""
                        off-text="">
                </el-switch>
            </template>
        </el-table-column>
        <el-table-column prop="id" label="Ações" width="100">
            <template scope="scope">
                <el-button size="small" icon="search" @click="editar(scope.row)">Ver</el-button>
            </template>
        </el-table-column>
    </div>
</template>

<script>
    export default {
        methods: {
            update(data, column) {
                this.$parent.$emit('update', data, column);
            },
            editar(data) {
                window.location.href = window.location.href + '/' + data.id + '/editar';
            }
        }
    }
</script>