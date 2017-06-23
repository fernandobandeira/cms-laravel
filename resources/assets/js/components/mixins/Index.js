export default {
    data() {
        return {
            data: [],
            loading: false,
            currentPage: 0,
            total: 0,
            pageSize: 0,
            order: '',
            search: '',
            dialogVisible: false,
            loadingDelete: false
        }
    },
    methods: {
        getData() {
            let self = this;
            let query = '';

            this.loading = true;

            query += '?_limit=' + this.pageSize;
            query += '&_offset=' + ((this.currentPage - 1) * this.pageSize);
            if(this.order != '') {
                query += '&_sort=' + this.order;
            }
            if(this.search != '') {
                query += '&_q=' + this.search;
            }

            window.axios.get(window.location.href + query)
                .then(function(response) {
                    self.total = parseInt(response.headers["meta-filter-count"]);
                    self.loading = false;
                    self.data = response.data;
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
            this.dialogVisible = true;
        },
        closeDialog() {
            this.deletingItem = '';
            this.dialogVisible = false;
        },
        destroy() {
            let self = this;
            this.loadingDelete = true;

            window.axios.delete(window.location.href + '/' + this.deletingItem)
                .then(function(response) {
                    self.deletingItem = '';
                    self.dialogVisible = false;
                    self.loadingDelete = false;
                    self.getData();
                });
        }
    },
    created: function() {
        this.getData();
    }
}