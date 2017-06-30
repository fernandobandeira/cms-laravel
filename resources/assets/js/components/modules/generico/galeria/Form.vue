<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">{{nome}} Galeria</span>
            <el-button size="small" type="primary" icon="check" class="fr" @click="onSubmit" :loading="loading">Salvar</el-button>
        </div>
        <el-row :gutter="20">
            <el-col :span="12">
                <el-form ref="form" :rules="rules" :model="form" label-width="120px" v-loading.fullscreen="loadingForm" element-loading-text="Carregando...">
                    <el-form-item label="Nome" prop="nome">                
                        <el-input placeholder="Nome" v-model="form.nome"></el-input>                
                    </el-form-item>
                    <el-form-item label="Módulo" prop="modulo">                        
                            <el-select v-model="form.modulo" filterable placeholder="Módulo">
                                <el-option
                                  v-for="modulo in $root.modulos"
                                  v-if="modulo.nome != 'Galerias'"
                                  :key="modulo.id"
                                  :label="modulo.nome"
                                  :value="modulo.id">
                                </el-option>
                            </el-select>                        
                    </el-form-item>
                </el-form>
            </el-col>
            <el-col :span="12">
            </el-col>
        </el-row>
    </el-card>
</template>

<script>
    import BaseForm from "../../../mixins/Form";

    export default {
        mixins: [BaseForm],
        data() {
            return {                
                form: {
                    nome: '',
                    modulo: ''
                },
                rules: {
                    nome: [
                        { required: true, message: 'Informe um nome', trigger: 'blur' },
                        { max: 150, message: 'O nome não pode ter mais do que 150 caracteres', trigger: 'blur' }
                    ],
                    modulo: [
                        { required: true, message: 'Informe um módulo', trigger: 'blur' },
                    ]
                },
                url: '/api/produtos'
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