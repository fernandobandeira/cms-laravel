<template>
    <el-menu class="el-menu-default el-menu--vertical" v-loading.body="loading">
        <el-menu-item :index="modulo.modulo" v-for="modulo in modulos" :key="modulo.id" @click="navegar(modulo)">{{ modulo.nome }}</el-menu-item>
    </el-menu>
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
                window.location = modulo.rota;
            },
            getModulos: function() {
                let self = this;

                window.axios.get('modulos')
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