<template>
    <v-list dense class="pt-0">
        <v-list-item v-for="modulo in modulos" :key="modulo.id" @click="navegar(modulo)">
            <v-list-tile>
                <v-list-tile-action>
                    <v-icon>shop</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>{{ modulo.nome }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list-item>
    </v-list>
</template>

<script>
    export default {
        data: function() {
            return {
                modulos: [],
                loading: true
            }
        },
        methods: {
            navegar: function(modulo) {
                window.location.href = modulo.rota;
            },
            getModulos: function() {
                let self = this;

                window.axios.get('/modulos')
                    .then(function(response) {
                        self.loading = false;

                        self.modulos = response.data;
                    });
            }
        },
        created: function() {
            this.getModulos();
        }
    }
</script>