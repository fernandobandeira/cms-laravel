@extends('pages.datatable')

@section('columns')
<el-table-column
        prop="referencia"
        label="Referência"
        width="300">
</el-table-column>
<el-table-column
        prop="nome"
        label="Nome">
</el-table-column>
<el-table-column
        prop="ativo"
        label="Ativo"
        width="100">
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
        label="Destaque"
        width="100">
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
        label="Disponível"
        width="125">
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