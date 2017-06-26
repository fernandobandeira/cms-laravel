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
            let url = this.url;

            this.loading = true;

            if (this.pageSize != 0) {                
                url = window.helpers.addParameter(url, '_limit', this.pageSize);                
                url = window.helpers.addParameter(url, '_offset', ((this.currentPage - 1) * this.pageSize));
            }
            if(this.order != '') {
                url = window.helpers.addParameter(url, '_sort', this.order);                
            }
            if(this.search != '') {
                url = window.helpers.addParameter(url, '_q', this.search);
            }
            if (this.customParams != '') {
                for(var key in this.customParams) {                    
                    url = window.helpers.addParameter(url, key, this.customParams[key]);                   
                }                
            }

            window.axios.get(url)
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

            window.axios.put(this.url + '/' + data.id, dados)
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

            window.axios.delete(this.url + '/' + this.deletingItem)
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