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
<el-table-column prop="id" label="Ações" width="180">
    <template scope="scope">
        <el-button size="small" icon="search">Ver</el-button>
    </template>
</el-table-column>
@endsection