<template>
    <div class="login">
        <el-row justify="center" type="flex">
            <el-col :span="8">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span>Acesso ao Gerenciador</span>
                    </div>
                    <div class="item">
                        <el-form ref="form" :model="form" label-width="120px">
                            <el-form-item
                                    prop="email"
                                    label="Email"
                                    :rules="[
                          { required: true, message: 'Informe um endereço de e-mail!', trigger: 'blur' },
                          { type: 'email', message: 'Informe um endereço de e-mail válido!', trigger: 'blur,change' }
                        ]">
                                <el-input type="email" v-model="form.email"></el-input>
                            </el-form-item>
                            <el-form-item
                                    prop="pass"
                                    label="Senha"
                                    :rules="[
                          { required: true, message: 'Informe a sua senha!', trigger: 'blur' }
                        ]">
                                <el-input type="password" v-model="form.pass"></el-input>
                            </el-form-item>
                            <el-form-item>
                                <el-button type="primary" @click="onSubmit">Entrar</el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    email: '',
                    pass: ''
                }
            }
        },
        methods: {
            onSubmit() {
                this.$refs['form'].validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    } else {
                        return false;
                    }
                });
            }
        }
    }
</script>