@extends('pages.form')

@section('form')
<el-form-item label="Ativo">
    <el-switch on-text="Sim" off-text="Não" v-model="form.ativo"></el-switch>
</el-form-item>
<el-form-item label="Disponível">
    <el-switch on-text="Sim" off-text="Não" v-model="form.disponivel"></el-switch>
</el-form-item>
<el-form-item label="Destaque">
    <el-switch on-text="Sim" off-text="Não" v-model="form.destaque"></el-switch>
</el-form-item>
<el-form-item label="Referência">
    <el-input v-model="form.referencia"></el-input>
</el-form-item>
<el-form-item label="Nome">
    <el-input v-model="form.nome"></el-input>
</el-form-item>
<el-form-item label="Descrição">
    <tinymce id="descricao" v-model="form.descricao" :options="editorOptions"></tinymce>
</el-form-item>
@endsection

@push('var')
<script>
    var campos = {
        ativo: false,
        disponivel: false,
        destaque: false,
        referencia: '',
        nome: '',
        descricao: ''
    }
</script>
@endpush