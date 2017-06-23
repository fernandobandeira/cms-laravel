<template>
    <tree nome="Listagem de Categorias de Produtos" :defaultProps="defaultProps"></tree>
</template>

<script>
    export default {
        data() {
            return {
                defaultProps: {
                    children: 'children',
                    label: 'nome'
                }
            }
        }
    }
</script>