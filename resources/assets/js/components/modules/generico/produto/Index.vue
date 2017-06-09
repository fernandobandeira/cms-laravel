<template>
    <datatable :headers="headers" nome="Listagem de Produtos">
        <template slot="colunas" scope="props">
            <td class="smallColumn">
                <v-text-field
                        @change="props.update(props.row.item, 'ordem')"
                        single-line
                        v-model="props.row.item.ordem"
                ></v-text-field>
            </td>
            <td>
                <a href="#">
                    {{ props.row.item.nome }}
                </a>
            </td>
            <td class="mediumColumn">{{ props.row.item.referencia }}</td>
            <td class="smallColumn">
                <v-switch @change="props.update(props.row.item, 'ativo')" v-model="props.row.item.ativo"></v-switch>
            </td>
            <td class="smallColumn">
                <v-switch @change="props.update(props.row.item, 'disponivel')" v-model="props.row.item.disponivel"></v-switch>
            </td>
            <td class="smallColumn">
                <v-switch @change="props.update(props.row.item, 'destaque')" v-model="props.row.item.destaque"></v-switch>
            </td>
            <td class="text-xs-right mediumColumn">
                <v-btn icon dark>
                    <v-icon>edit</v-icon>
                </v-btn>
                <v-btn icon dark>
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
                    { text: 'Referência', value: 'referencia', left: true },
                    { text: 'Ativo', value: 'ativo', left: true },
                    { text: 'Disponível', value: 'disponivel', left: true },
                    { text: 'Destaque', value: 'destaque', left: true },
                    { text: 'Ações', value: 'id'}
                ]
            }
        }
    }
</script>