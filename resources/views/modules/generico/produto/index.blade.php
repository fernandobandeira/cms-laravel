@extends('pages.datatable')

@section('columns')
<el-table-column
        prop="referencia"
        sortable
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
                v-model="scope.row.ativo"
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
                v-model="scope.row.destaque"
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
                v-model="scope.row.disponivel"
                on-text=""
                off-text="">
        </el-switch>
    </template>
</el-table-column>
<el-table-column prop="id" label="Ações" width="100">
    <template scope="scope">
        <el-button size="small" icon="search">Ver</el-button>
    </template>
</el-table-column>
@endsection