export default {
    data() {
        return {
            form: {},
            url: '',
            loading: false,
            loadingForm: true,
            update: false,
            data: {},
            nome: '',
            editorOptions: window.editorOptions
        }
    },
    methods: {
        onSubmit() {
            let self = this;
            this.loading = true;

            if (this.update == true) {
                window.axios.put(this.url, this.form)
                    .then(function(response) {
                        self.url = self.url.replace('/' + response.data.id, '');
                        window.location.href = self.url;
                    });
            } else {
                window.axios.post(this.url, this.form)
                    .then(function(response) {
                        window.location.href = self.url;
                    });
            }
        },
        getData() {
            let self = this;

            window.axios.get(this.url)
                .then(function(response) {
                    Object.keys(self.form).forEach(function(k){
                        self.form[k] = response.data[k];
                    });

                    self.afterLoad();
                    self.loadingForm = false;
                });
        },
        afterLoad() {

        }
    },
    created() {
        this.url = window.location.href;
        if (this.url.indexOf('/editar') != -1) {
            this.url = window.location.href.replace('/editar', '');
            this.update = true;
            this.nome = 'Editando ';
            this.getData();
        } else {
            this.loadingForm = false;
            this.nome = 'Novo ';
            this.url = window.location.href.replace('/novo', '');
        }
    }
}