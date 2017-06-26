export default {
    data() {
        return {
            form: {},
            loading: false,
            loadingForm: true,
            update: false,
            data: {},
            nome: '',
            url: '',
            customParams: {},
            editorOptions: window.editorOptions
        }
    },
    methods: {
        onSubmit() {
            let self = this;
            this.loading = true;

            if (this.update == true) {
                window.axios.put(this.url + '/' + this.customParams.id, this.form)
                    .then(function(response) {
                        self.url = self.url.replace('/' + response.data.id, '');
                        window.location.href = window.location.href.replace('/editar', '').replace('/' + self.customParams.id, '');
                    });
            } else {
                window.axios.post(this.url, this.form)
                    .then(function(response) {
                        window.location.href = window.location.href.replace('/novo', '');
                    });
            }
        },
        getData() {
            let self = this;
            let url = this.url;

            if (this.customParams != '') {
                for(var key in this.customParams) {
                    url = window.helpers.addParameter(url, key, this.customParams[key]);
                }
            }

            window.axios.get(url)
                .then(function(response) {
                    Object.keys(self.form).forEach(function(k) {
                        self.form[k] = response.data[0][k];
                    });

                    self.afterLoad();
                    self.loadingForm = false;
                });
        },
        afterLoad() {

        }
    },
    created() {
        let url = window.location.href;
        if (url.indexOf('/editar') != -1) {
            url = url.replace('/editar', '');

            this.update = true;
            this.nome = 'Editando ';
            this.customParams.id = url.substr(url.lastIndexOf('/') + 1);
            this.getData();
        } else {
            this.loadingForm = false;
            this.nome = 'Adicionando ';
        }
    }
}