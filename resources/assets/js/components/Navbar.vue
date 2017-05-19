<template>
    <el-menu :default-active="activeIndex" class="el-menu-default" mode="horizontal">
        <el-menu-item index="1" @click="navegar('/')">Dashboard</el-menu-item>

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
        data() {
            return {
                activeIndex: ''
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            navegar: function(rota) {
                window.location = rota;
            }
        }
    }
</script>