@extends('layout')

@section('content')
<div>
    <div class="erro404">
        <el-row :gutter="15">
            <el-col :span="12" :offset="6">
                <h1>Página não encontrada</h1>
                <div class="pic-404">
                    <img class="pic-404__parent" src="/layout/404.png" alt="404">
                    <img class="pic-404__child left" src="/layout/404_cloud.png" alt="404">
                    <img class="pic-404__child mid" src="/layout/404_cloud.png" alt="404">
                    <img class="pic-404__child right" src="/layout/404_cloud.png" alt="404">
                </div>
            </el-col>
        </el-row>
    </div>
</div>
@endsection