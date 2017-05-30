<template>
    <el-form ref="form" :model="form" label-width="120px">
        <slot :form="form"></slot>
        <el-form-item>
            <el-button type="primary" @click="onSubmit" icon="check" :loading="loading">Salvar</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        data() {
            return {
                form: campos,
                url: window.location.href.replace('/novo', ''),
                loading: false
            }
        },
        methods: {
            onSubmit() {
                let self = this;
                this.loading = true;

                window.axios.post(this.url, this.form)
                    .then(function(response) {
                        if (response.status == 201) {
                            window.location.href = self.url;
                        } else {
                            this.loading = false;
                            //TODO
                        }
                    });
            }
        }
    }
</script>