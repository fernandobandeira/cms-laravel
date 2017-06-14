<template>
    <datatable :headers="headers" nome="Listagem de Categorias">
        <template slot="colunas" scope="props">
            <td>
                <span v-if="props.row.item.depth != 0">
                    <span v-for="n in props.row.item.depth - 1">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                </span>
                <a @click="props.editar(props.row.item.id)" href="#">
                    {{ props.row.item.nome }}
                </a>
            </td>
            <td class="smallColumn">
                <v-switch @change="props.update(props.row.item, 'ativo')" v-model="props.row.item.ativo"></v-switch>
            </td>
            <td class="text-xs-right smallColumn">
                <v-btn icon dark @click.native="props.dialog(props.row.item)">
                    <v-icon>delete</v-icon>
                </v-btn>
            </td>
        </template>
    </datatable>
</template>

<script>
    export default {
        data() {
            return {
                headers: [
                    { text: 'Nome', value: 'nome', left: true, sortable: false },
                    { text: 'Ativo', value: 'ativo', left: true, sortable: false },
                    { text: 'Ações', value: 'id', sortable: false}
                ]
            }
        }
    }
</script>