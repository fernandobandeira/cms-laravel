<template>
    <v-list class="pa-0">
        <v-list-item>
            <div class="gerenciadores">
                <v-list-tile tag="ul">
                    <v-menu offset-y>
                        <v-btn flat block slot="activator">
                            <div class="left">
                                {{ projetoAtivo }}
                            </div>
                            <div class="right">
                                <v-icon dark>arrow_drop_down</v-icon>
                            </div>
                        </v-btn>
                        <v-list>
                            <v-list-item v-for="projeto in projetos" :key="projeto.id" @click="navegar(projeto.dominio)">
                                <v-list-tile>
                                    <v-list-tile-title>{{ projeto.nome }}</v-list-tile-title>
                                </v-list-tile>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </v-list-tile>
            </div>
        </v-list-item>
    </v-list>
</template>

<script>
    export default {
        data: function() {
            return {
                activeIndex: '',
                projetos: [],
                projetoAtivo: '',
                loading: true
            }
        },
        methods: {
            navegar: function(dominio) {
                let location = window.location.href;
                window.location = 'http://' + location.replace(/^[^.]*/, dominio);
            },
            getProjetos: function() {
                let self = this;

                window.axios.get('/projetos')
                    .then(function(response) {
                        self.loading = false;

                        self.projetoAtivo = response.data.ativo.nome;
                        delete response.data.ativo;

                        self.projetos = response.data;
                    });
            }
        },
        created: function() {
            this.getProjetos();
        }
    }
</script>