<template>
    <datatable :headers="headers" nome="Listagem de Categorias">
        <template slot="colunas" scope="props">
            <td class="smallColumn">
                <v-text-field
                        @change="props.update(props.row.item, 'ordem')"
                        single-line
                        v-model="props.row.item.ordem"
                ></v-text-field>
            </td>
            <td>
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
                    { text: 'Ordem', value: 'ordem', left: true },
                    { text: 'Nome', value: 'nome', left: true },
                    { text: 'Ativo', value: 'ativo', left: true },
                    { text: 'Ações', value: 'id'}
                ]
            }
        }
    }
</script>