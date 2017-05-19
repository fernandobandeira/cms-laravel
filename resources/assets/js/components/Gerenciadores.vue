<template>
    <el-submenu index="2" class="nav">
        <template slot="title">Julias Closet</template>
        <el-menu-item index="0" v-for="projeto in projetos" :key="projeto.id">{{ projeto.nome }}</el-menu-item>
    </el-submenu>
</template>

<script>
    export default {
        data: function() {
            return {
                activeIndex: '',
                projetos: window.projetos
            }
        },
        methods: {
        }
    }
</script>