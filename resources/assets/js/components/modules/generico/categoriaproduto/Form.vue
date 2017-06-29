<template>
    <el-card class="box-card">
        <div slot="header" class="clearfix">
            <span style="line-height: 36px;">{{nome}} Categoria de Produto</span>
            <el-button size="small" type="primary" icon="check" class="fr" @click="onSubmit" :loading="loading">Salvar</el-button>
        </div>
        <el-form ref="form" :rules="rules" :model="form" label-width="120px" v-loading.fullscreen="loadingForm" element-loading-text="Carregando...">
            <el-form-item label="Ativo" prop="ativo">
                <el-switch on-text="" off-text="" v-model="form.ativo"></el-switch>
            </el-form-item>
            <el-form-item label="Nome" prop="nome">
                <el-col :span="12">
                    <el-input placeholder="Nome" v-model="form.nome"></el-input>
                </el-col>
            </el-form-item>
            <el-form-item label="Categoria Pai" prop="parent_id">
                <el-col :span="12">
                    <el-select v-model="form.parent_id" clearable filterable placeholder="Categoria Pai">
                        <nestedselect :item="categoria" :key="categoria[selectConfig.key]" v-for="categoria in categorias" :config="selectConfig"></nestedselect>
                    </el-select>
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
                    nome: '',
                    parent_id: null,
                },
                rules: {
                    nome: [
                        { required: true, message: 'Informe um nome', trigger: 'blur' },
                        { max: 150, message: 'O nome não pode ter mais do que 150 caracteres', trigger: 'blur' }
                    ]
                },
                categorias: [],
                url: '/api/categoriasprodutos',
                selectConfig: {
                    key: 'id',
                    label: 'nome',
                    value: 'id'
                }
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