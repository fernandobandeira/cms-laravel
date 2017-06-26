<template>
    <tree nome="Listagem de Categorias de Produtos" :defaultProps="defaultProps" url="/api/categoriasprodutos" :customParams="customParams"></tree>
</template>

<script>
    export default {
        data() {
            return {
                defaultProps: {
                    children: 'filhas',
                    label: 'nome'
                },
                customParams: {
                    _with: 'filhas',
                    depth: 0
                }
            }
        }
    }
</script>