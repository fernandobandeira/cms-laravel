<template>
    <div class="form">
        <v-card>
            <v-card-title>
                Novo Produto
            </v-card-title>
            <v-layout row>
                <v-flex xs10 offset-xs1 v-if="!loadingForm">
                    <v-switch label="Ativo" v-model="form.ativo" dark></v-switch>
                    <v-switch label="Disponível" v-model="form.disponivel" dark></v-switch>
                    <v-switch label="Destaque" v-model="form.destaque" dark></v-switch>
                    <v-text-field
                            v-model="form.referencia"
                            label="Referência"
                    ></v-text-field>
                    <v-text-field
                            v-model="form.nome"
                            label="Nome"
                    ></v-text-field>
                    <span>Descrição</span>
                    <tinymce id="descricao" v-model="form.descricao" :other-props="editorOptions"></tinymce>
                    <v-btn
                            class="saveButton"
                            light
                            :loading="loading"
                            @click.native="onSubmit"
                            :disabled="loading"
                            secondary>
                        Salvar
                        <v-icon right light>save</v-icon>
                    </v-btn>
                </v-flex>
                <v-flex xs12 class="text-xs-center" v-if="loadingForm">
                    <v-progress-circular indeterminate class="primary--text" size="50"></v-progress-circular>
                </v-flex>
            </v-layout>
        </v-card>
    </div>
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
                },
            }
        }
    }
</script>