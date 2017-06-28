<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">{{nome}} Produto</span>
            <el-button size="small" type="primary" icon="check" class="fr" @click="onSubmit" :loading="loading">Salvar</el-button>
        </div>
        <el-form ref="form" :model="form" label-width="120px" v-loading.fullscreen="loadingForm" element-loading-text="Carregando...">
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
                <el-col :span="12">
                    <el-input placeholder="Referência" v-model="form.referencia"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item label="Nome">
                <el-col :span="12">
                    <el-input placeholder="Nome" v-model="form.nome"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item label="Categorias">
                <el-col :span="12">
                    <el-select v-model="form.categorias" filterable multiple placeholder="Categorias">
                        <nestedselect :item="categoria" :key="categoria[selectConfig.key]" :onlyLeaves="true" v-for="categoria in categorias" :config="selectConfig"></nestedselect>
                    </el-select>
                </el-col>
            </el-form-item>
            <el-form-item label="Descrição">
                <el-col :span="24">
                    <tinymce id="tinymce" v-model="form.descricao" :options="editorOptions" :content="descricao"></tinymce>
                </el-col>
            </el-form-item>
        </el-form>
    </el-card>
</template>

<script>
    import BaseForm from "../../../mixins/Form";

    export default {
        mixins: [BaseForm],
        data() {
            return {
                form: {
                    ativo: true,
                    disponivel: true,
                    destaque: false,
                    referencia: '',
                    nome: '',
                    descricao: '',
                    categorias : []
                },
                categorias: [],
                descricao: '',
                selectConfig: {
                    key: 'id',
                    label: 'nome',
                    value: 'id'
                },
                url: '/api/produtos',
                customParams: {                    
                    _with: 'categorias'
                }
            }
        },
        methods: {
            afterLoad() {                
                let categorias = [];

                this.descricao = this.form.descricao;
                for(var i=0; i < this.form.categorias.length; i++) {
                   categorias.push(this.form.categorias[i].id);
                }
                this.form.categorias = categorias;
            }
        },
        created() {
            let self = this;

            window.axios.get('/api/categoriasprodutos?_with=filhas&depth=0')
                .then(function(response) {
                    self.categorias = response.data;
                });
        }
    }
</script>