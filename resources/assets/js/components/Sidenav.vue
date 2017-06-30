<template>
    <el-menu v-loading.body="loading" defaultActive="''">
        <el-menu-item :index="modulo.modulo" v-for="modulo in $root.modulos" :key="modulo.id" @click="navegar(modulo)">{{ modulo.nome }}</el-menu-item>
    </el-menu>
</template>

<script>
    export default {
        data: function() {
            return {                
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

                        self.$root.modulos = response.data;
                    });
            }
        },
        created: function() {
            this.getModulos();
        }
    }
</script>