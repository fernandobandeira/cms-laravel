@extends('layout')

@section('content')
<div class="form">
    <el-row :gutter="15">
        <el-col :span="15">
            <gerenciador-form>
                @yield('form')
            </gerenciador-form>
        </el-col>
    </el-row>
</div>
@endsection