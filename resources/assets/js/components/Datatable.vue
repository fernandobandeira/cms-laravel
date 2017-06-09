<template>
    <div class="datatable">
        <v-card>
            <v-card-title>
                {{ nome }}
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
                    v-bind:pagination.sync="pagination">
                <template slot="items" scope="props">
                    <slot name="colunas" :row="props" :update="update"></slot>
                </template>
            </v-data-table>
        </v-card>
        <v-btn secondary floating class="newButton" @click="adicionar">
            <v-icon>add</v-icon>
        </v-btn>
    </div>
</template>

<script>
    export default {
        props: ['headers', 'nome'],
        data() {
            return {
                tableData: [],
                pageText: 'Itens por página:',
                pageNumbers: [10, 25, 50, { text: 'Todos', value: -1 }],
                noDataText: 'Não há itens para mostrar.',
                noResultsText: 'Não foram encontrados resultados para a busca.',
                loading: true,
                pagination: { page:1, rowsPerPage: 10, sortBy: '' },
                total: 0,
                search: '',
                colunas: window.component
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
            adicionar() {
                window.location.href = window.location.href + '/novo';
            },
            criado(headers) {
                this.headers = headers;
            },
            update(data, column) {
                let self = this;
                let dados = {};
                dados[column] = data[column];

                window.axios.put(window.location.href + '/' + data.id, dados)
                    .then(function(response) {
                        self.getData();
                    });
            }
        }
    }
</script>