<template>
    <div class="listagem">
        <v-dialog v-model="dialogOpen" :persistent="true">
            <v-card>
                <v-card-row>
                    <v-card-title>Excluir item.</v-card-title>
                </v-card-row>
                <v-card-row>
                    <v-card-text>Tem certeza que deseja excluir o item?</v-card-text>
                </v-card-row>
                <v-card-row actions>
                    <v-btn secondary flat v-if="!loadingDelete" @click.native="closeDialog">Não</v-btn>
                    <v-btn secondary flat @click.native="destroy" :loading="loadingDelete">Sim</v-btn>
                </v-card-row>
            </v-card>
        </v-dialog>
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
                    <slot name="colunas" :row="props" :update="update" :editar="editar" :dialog="dialog"></slot>
                </template>
            </v-data-table>
        </v-card>
        <v-btn secondary floating class="newButton" @click.native="adicionar">
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
                loadingDelete: false,
                pagination: { page:1, rowsPerPage: 10, sortBy: '' },
                total: 0,
                search: '',
                colunas: window.component,
                deletingItem: '',
                dialogOpen: false,
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
            editar(id) {
                window.location.href = window.location.href + '/' + id + '/editar';
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
            dialog(deletingItem) {
                this.deletingItem = deletingItem;
                this.dialogOpen = true;
            },
            closeDialog() {
                this.deletingItem = '';
                this.dialogOpen = false;
            },
            destroy() {
                let self = this;
                this.loadingDelete = true;

                window.axios.delete(window.location.href + '/' + this.deletingItem.id)
                    .then(function(response) {
                        self.deletingItem = '';
                        self.dialogOpen = false;
                        self.loadingDelete = false;
                        self.getData();
                    });
            }
        }
    }
</script>