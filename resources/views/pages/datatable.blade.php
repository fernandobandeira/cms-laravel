@extends('layout')

@section('content')
<div class="datatable">
    <h3>Listagem de Produtos</h3>
    <el-button size="small" type="primary" icon="plus" class="new">Adicionar</el-button>

    <datatable>
        @yield('columns')
    </datatable>
</div>
@endsection