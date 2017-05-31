<template>
    <div class="form">
        <el-row :gutter="15">
            <el-col :span="15">
                <el-form ref="form" :model="form" label-width="120px">
                    <el-form-item label="Ativo">
                        <el-switch on-text="" off-text="" v-model="form.ativo"></el-switch>
                    </el-form-item>
                    <el-form-item label="Disponível">
                        <el-switch on-text="" off-text="" v-model="form.disponivel"></el-switch>
                    </el-form-item>
                    <el-form-item label="Destaque">
                        <el-switch on-text="" off-text="" v-model="form.destaque"></el-switch>
                    </el-form-item>
                    <el-form-item label="Referência">
                        <el-input v-model="form.referencia"></el-input>
                    </el-form-item>
                    <el-form-item label="Nome">
                        <el-input v-model="form.nome"></el-input>
                    </el-form-item>
                    <el-form-item label="Descrição">
                        <tinymce id="descricao" v-model="form.descricao" :other-props="editorOptions"></tinymce>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit" icon="check" :loading="loading">Salvar</el-button>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    ativo: true,
                    disponivel: true,
                    destaque: false,
                    referencia: '',
                    nome: '',
                    descricao: ''
                },
                url: window.location.href.replace('/novo', ''),
                loading: false
            }
        },
        methods: {
            onSubmit() {
                let self = this;
                this.loading = true;

                window.axios.post(this.url, this.form)
                    .then(function(response) {
                        window.location.href = self.url;
                    });
            }
        }
    }
</script>