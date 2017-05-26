@extends('main')

@section('app')
<navbar></navbar>

<div class="container">
    <el-row :gutter="15">
        <el-col :span="3">
            <sidenav></sidenav>
        </el-col>
        <el-col :span="21">
            <div class="box">
                @yield('content')
            </div>
        </el-col>
    </el-row>
</div>
@endsection