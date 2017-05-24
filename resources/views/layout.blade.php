@extends('main')

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