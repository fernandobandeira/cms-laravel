<template>
    <div class="form" v-loading.fullscreen.lock="loadingForm" element-loading-text="Carregando...">
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
                    <el-form-item label="Descrição" v-if="!update || !loadingForm">
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
                    descricao: '',
                },
                url: '',
                loading: false,
                loadingForm: false,
                update: false,
                data: {},
                editorOptions: window.editorOptions
            }
        },
        methods: {
            onSubmit() {
                let self = this;
                this.loading = true;

                if (this.update == true) {
                    window.axios.put(this.url, this.form)
                        .then(function(response) {
                            self.url = self.url.replace('/' + response.data.id, '');
                            window.location.href = self.url;
                        });
                } else {
                    window.axios.post(this.url, this.form)
                        .then(function(response) {
                            window.location.href = self.url + '/' + response.data.id + '/editar';
                        });
                }
            },
            getData() {
                let self = this;

                this.loadingForm = true;

                window.axios.get(this.url)
                    .then(function(response) {
                        self.loadingForm = false;

                        Object.keys(self.form).forEach(function(k){
                            self.form[k] = response.data[k];
                        });
                    });
            }
        },
        created() {
            this.url = window.location.href;
            if (this.url.indexOf('/editar') != -1) {
                this.url = window.location.href.replace('/editar', '');
                this.update = true;
                this.getData();
            } else {
                this.url = window.location.href.replace('/novo', '');
            }
        }
    }
</script>