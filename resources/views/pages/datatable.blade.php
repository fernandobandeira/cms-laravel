@extends('layout')

@section('content')
<el-col :span="21">
    <div class="box">
        <h3>Listagem de Produtos</h3>
        <el-button size="small" type="primary" icon="plus">Adicionar</el-button>

        <datatable>
            @yield('columns')
        </datatable>
    </div>
</el-col>
@endsection