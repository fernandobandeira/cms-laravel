<template>
    <div class="form">
        <v-card>
            <v-card-title>
                Nova Categoria
            </v-card-title>
            <v-layout row>
                <v-flex xs10 offset-xs1 v-if="!loadingForm">
                    <v-switch label="Ativo" v-model="form.ativo" dark></v-switch>
                    <v-text-field
                            v-model="form.nome"
                            label="Nome"
                    ></v-text-field>
                    <v-select
                            :items="categorias"
                            v-model="form.parent_id"
                            label="Categoria Pai"
                            item-text="nome"
                            item-value="id"
                            dark
                            single-line
                            auto
                    >
                        <template slot="item" scope="data">
                            <v-list-tile-content>
                                <v-list-tile-title v-html="data.item.nome"></v-list-tile-title>
                            </v-list-tile-content>
                        </template>
                    </v-select>
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
                    nome: '',
                    parent_id: null,
                },
                categorias: []
            }
        },
        created() {
            let self = this;

            window.axios.get('/categoriasprodutos')
                .then(function(response) {
                    self.categorias = response.data;
                });
        }
    }
</script>