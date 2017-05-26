<template>
    <el-menu class="el-menu-default" mode="horizontal">
        <el-menu-item index="Dashboard" @click="navegar('/')">Dashboard</el-menu-item>

        <el-submenu index="3" class="nav">
            <template slot="title">Fernando H. Bandeira</template>
            <el-menu-item index="3-1">Minha Conta</el-menu-item>
            <el-menu-item index="3-2">Sair</el-menu-item>
        </el-submenu>
        <gerenciadores></gerenciadores>
    </el-menu>
</template>

<script>
    export default {
        methods: {
            navegar: function(rota) {
                window.location = rota;
            }
        }
    }
</script>