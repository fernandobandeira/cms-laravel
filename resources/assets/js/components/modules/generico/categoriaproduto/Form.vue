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
    export default {
        data() {
            return {
                form: {
                    ativo: true,
                    nome: '',
                },
                url: '',
                loading: false,
                loadingForm: true,
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

                window.axios.get(this.url)
                    .then(function(response) {
                        Object.keys(self.form).forEach(function(k){
                            self.form[k] = response.data[k];
                        });

                        self.loadingForm = false;
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
                this.loadingForm = false;
                this.url = window.location.href.replace('/novo', '');
            }
        }
    }
</script>