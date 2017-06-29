<template>
    <el-submenu index="index" class="nav fr">
        <template slot="title">{{ projetoAtivo }}</template>
        <el-menu-item index="index" v-for="projeto in projetos" :key="projeto.id" @click="navegar(projeto.dominio)">{{ projeto.nome }}</el-menu-item>        
    </el-submenu>
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