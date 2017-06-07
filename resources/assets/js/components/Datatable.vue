<template>
    <div class="datatable">
        <v-card>
            <v-card-title>
                Listagem de Produtos
                <v-spacer></v-spacer>
                <v-text-field
                        append-icon="search"
                        label="Pesquisar"
                        single-line
                        hide-details
                        v-model="search"
                ></v-text-field>
            </v-card-title>
            <v-data-table
                    v-bind:headers="headers"
                    v-bind:items="tableData"
                    v-bind:loading="loading"
                    v-bind:search="search"
                    v-bind:rows-per-page-text="pageText"
                    v-bind:rows-per-page-items="pageNumbers"
                    v-bind:noDataText="noDataText"
                    v-bind:noResultsText="noResultsText"
                    v-bind:total-items="total"
                    v-bind:pagination.sync="pagination"
            >
                <template slot="items" scope="props">
                    <td class="smallColumn">
                        <v-text-field
                                @change="update(props.item, 'ordem')"
                                single-line
                                v-model="props.item.ordem"
                        ></v-text-field>
                    </td>
                    <td>{{ props.item.nome }}</td>
                    <td class="mediumColumn">{{ props.item.referencia }}</td>
                    <td class="smallColumn">
                        <v-switch @change="update(props.item, 'ativo')" v-model="props.item.ativo" dark></v-switch>
                    </td>
                    <td class="smallColumn">
                        <v-switch @change="update(props.item, 'disponivel')" v-model="props.item.disponivel" dark></v-switch>
                    </td>
                    <td class="smallColumn">
                        <v-switch @change="update(props.item, 'destaque')" v-model="props.item.destaque" dark></v-switch>
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
            </v-data-table>
        </v-card>
        <v-btn floating class="indigo newButton">
            <v-icon light>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tableData: [],
                headers: [
                    { text: 'Ordem', value: 'ordem', left: true },
                    { text: 'Nome', value: 'nome', left: true },
                    { text: 'Referência', value: 'referencia', left: true },
                    { text: 'Ativo', value: 'ativo', left: true },
                    { text: 'Disponível', value: 'disponivel', left: true },
                    { text: 'Destaque', value: 'destaque', left: true },
                    { text: 'Ações'}
                ],
                pageText: 'Itens por página:',
                pageNumbers: [10, 25, 50, { text: 'Todos', value: -1 }],
                noDataText: 'Não há itens para mostrar.',
                noResultsText: 'Não foram encontrados resultados para a busca.',
                loading: true,
                pagination: { page:1, rowsPerPage: 10, sortBy: '' },
                total: 0,
                search: ''
            }
        },
        watch: {
            pagination: {
                handler () {
                    this.getData();
                },
                deep: true
            },
            search: {
                handler () {
                    this.getData();
                },
                deep: true
            }
        },
        methods: {
            getData() {
                const { sortBy, descending, page, rowsPerPage } = this.pagination
                let self = this;
                let query = '';

                this.loading = true;

                query += '?_limit=' + rowsPerPage;
                query += '&_offset=' + ((page - 1) * rowsPerPage);
                if(sortBy != '' && sortBy != null) {
                    query += '&_sort=';
                    if (descending) {
                        query += '-';
                    }
                    query += sortBy;
                }
                if(this.search != '') {
                    query += '&_q=' + this.search;
                }

                window.axios.get(window.location.href + query)
                    .then(function(response) {
                        self.total = parseInt(response.headers["meta-filter-count"]);
                        self.loading = false;
                        self.tableData = response.data;
                    });
            },
            update(data, column) {
                let self = this;
                let dados = {};
                dados[column] = data[column];

                window.axios.put(window.location.href + '/' + data.id, dados)
                    .then(function(response) {
                        self.getData();
                    });
            },
            adicionar() {
                window.location.href = window.location.href + '/novo';
            }
        }
    }
</script>