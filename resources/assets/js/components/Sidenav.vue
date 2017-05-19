<template>
    <el-menu :default-active="activeIndex" class="el-menu-default el-menu--vertical">
        <el-menu-item :index="modulo.modulo" v-for="modulo in modulos" :key="modulo.id" @click="navegar(modulo)">{{ modulo.nome }}</el-menu-item>
    </el-menu>
</template>

<script>
    export default {
        data: function() {
            return {
                activeIndex: window.activeIndex,
                modulos: window.modulos
            }
        },
        methods: {
            navegar: function(modulo) {
                window.location = modulo.rota;
            }
        }
    }
</script>