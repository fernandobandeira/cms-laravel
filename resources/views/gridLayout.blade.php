@extends('layout')

@push('var')
<script>
    window.modulos = {!! $modulos !!};
    window.projetos = {!! $projetos !!};
</script>
@endpush

@section('app')
<navbar></navbar>

<div class="container">
    <el-row :gutter="15">
        <el-col :span="3">
            <sidenav></sidenav>
        </el-col>
        @yield('content')
    </el-row>
</div>
@endsection